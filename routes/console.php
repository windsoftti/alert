<?php

use Illuminate\Foundation\Inspiring;

use App\User;
use App\Prospecto;
use App\Sesion;
use App\Temporary;
use Carbon\Carbon;
use App\Mail\WelcomeSend;
use Illuminate\Support\Str;
use App\Http\Controllers\WebhookController;
/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('equi-distribute-leads', function () {

    $prospectosNoAsignados = Prospecto::whereNull('asignado_id')
        ->whereNotNull('celular')
        ->orWhere(function($query) {
            $query->whereNull('celular')
                ->whereNull('asignado_id')
                ->where('updated_at','<',Carbon::now()->subMinutes(setting('site.assign_chat_delay')));
        })
        ->get();

    if($prospectosNoAsignados->isNotEmpty()){

        foreach($prospectosNoAsignados as $prospecto){

            // Look for Available Promotors
            $promotoresAsinablesCollection = Temporary::where('key','promotores_asignables')->first();
            $promotoresAsignables = json_decode($promotoresAsinablesCollection->value,true);

            if(empty($promotoresAsignables)){

                $promotoresAsignablesRefill = User::where('tipo_id','>',2)
                    ->pluck('id')->toArray();

                $promotoresAsinablesCollection->value=$promotoresAsignablesRefill;
                $promotoresAsinablesCollection->save();

                $promotoresAsignables = $promotoresAsignablesRefill;

            }

            // Assign Lead to Promotor
            $k = array_key_first($promotoresAsignables);
            $prospecto->asignado_id = $promotoresAsignables[$k];
            $prospecto->fecha_hora = Carbon::now();
            $prospecto->fecha_cambio = Carbon::now();
            $prospecto->status_id = 3;
            $prospecto->seguimiento_id = 1;
            $prospecto->save();
          
            $promotor = User::find($prospecto->asignado_id);
            WebhookController::sendWA($promotor->celular,"Hola ".$promotor->name.", has recibido un nuevo contacto en FullConnect, su nombre es ".$prospecto->nombre." y su teléfono es ".$prospecto->celular.", haz contacto ahora mismo en este link: https://wa.me/52".$prospecto->celular);

            // Remove and update Available Promotors
            unset($promotoresAsignables[$k]);
            $promotoresAsinablesCollection->value=json_encode($promotoresAsignables);
            $promotoresAsinablesCollection->save();

            $this->comment("Prospecto ID:".$prospecto->id." Asignado a Consultor ID:".$prospecto->asignado_id);
            \Log::info("Prospecto ID:".$prospecto->id." Asignado a Consultor ID:".$prospecto->asignado_id);

        }

    }else{
        $this->comment("Prospectos no asignados");
    }

})->describe('Equi distributed leads.');



Artisan::command('reasign-unfollowed-leads {--S|seguimiento=1-2} {--T|to=any_promotor}', function () {

    // Set delay and old seguimiento_id
    if($this->option('seguimiento')=="1-2"){
        $minutesDelay = config('app.reasign-leads-1-2-delay');
        $seguimiento = 1;
        $suffix = "1_2";
    }else{
        $minutesDelay = config('app.reasign-leads-2-3-delay');
        $seguimiento = 2;
        $suffix = "2_3";
    }

    // Find unattended leads
    $prospectos = Prospecto::where("seguimiento_id",$seguimiento)
        ->where('fecha_cambio','<',Carbon::now()->subMinutes($minutesDelay))
        ->get();

    if($prospectos->isNotEmpty()){

        foreach ($prospectos as $prospecto){

            if($this->option('to')=="any_promotor"){ // Assign to any promotor

                // Look for Available Promotors
                $promotoresAsinablesCollection = Temporary::where('key','promotores_reasignables_'.$suffix )->first();
                $promotoresAsignables = json_decode($promotoresAsinablesCollection->value,true);


                if(empty($promotoresAsignables)){ // Re-fill Available Promotors if there's no one

                    $promotoresAsignablesRefill = User::where('tipo_id','>',2)
                        ->where('id','!=',$prospecto->asignado_id)
                        ->pluck('id')->toArray();

                    $promotoresAsinablesCollection->value=$promotoresAsignablesRefill;
                    $promotoresAsinablesCollection->save();

                    $promotoresAsignables = $promotoresAsignablesRefill;

                }else{ // Delete lead promotor if found in acvailables

                    if (($key = array_search($prospecto->asignado_id, $promotoresAsignables)) !== false) {

                        unset($promotoresAsignables[$key]);
                        $promotoresAsinablesCollection->value=json_encode($promotoresAsignables);
                        $promotoresAsinablesCollection->save();

                    }
                }

            }else{ // Asignar a promotores especiales del grupo

                // Obtener promotor, gerente y a los especiales del grupo
                $promotor = User::find($prospecto->asignado_id);
                $gerente = User::find($promotor->asignado_id);

                $promotoresAsignables = User::where('asignado_id',$gerente->id)
                    ->where('tipo_id',4)->pluck('id')->toArray();
            }

            // Re-asignación del lead
            $k = array_key_first($promotoresAsignables);
            $prospecto->asignado_id = $promotoresAsignables[$k];
            $prospecto->fecha_hora = Carbon::now();
            $prospecto->fecha_cambio = Carbon::now();
            $prospecto->seguimiento_id = 10;
            $prospecto->save();
          
            $promotor = User::find($prospecto->asignado_id);
            WebhookController::sendWA($promotor->celular,"Hola ".$promotor->name.", has recibido un nuevo contacto en FullConnect, su nombre es ".$prospecto->nombre." y su teléfono es ".$prospecto->celular.", haz contacto ahora mismo en este link: https://wa.me/52".$prospecto->celular);

            // Remove and update Available Promotors
            unset($promotoresAsignables[$k]);
            $promotoresAsinablesCollection->value=json_encode($promotoresAsignables);
            $promotoresAsinablesCollection->save();

            $this->comment("Prospecto ID:".$prospecto->id." re-asignado a Consultor ID:".$prospecto->asignado_id);

        }

    }else{
        $this->comment("Prospectos no re-asignados");
    }

})->describe('Re-assign Leads');

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('distribute-leads', function () {

    $current_users = [];
    $sessions = Sesion::All();
    $now = Carbon::now();

    foreach( $sessions as $uid => $session ){
        $diff = $now->diffInSeconds( Carbon::createFromTimestamp($session->last_activity)) ;

        if( $diff <=config('session.lifetime')*60){
            $user = User::find($session->user_id);

            if($user){
                if($user->tipo_id>2){
                    $current_users[]= $session->user_id;
                }
            }
        }
    }

    shuffle($current_users);

    $this->comment("Current Users");
    $this->comment(json_encode($current_users));

    $prospectos = Prospecto::whereNull('asignado_id')->whereNotNull('celular')->get();

    $leadsDistributed = [];

    if(!empty($current_users)){
        foreach($prospectos as $prospecto){

            $k = array_rand($current_users);

            $prospecto->asignado_id = $current_users[$k];
            $prospecto->fecha_hora = Carbon::now();
            $prospecto->fecha_cambio = Carbon::now();
            $prospecto->status_id = 3;
            $prospecto->seguimiento_id = 1;

            $prospecto->save();
          
            $promotor = User::find($prospecto->asignado_id);
            WebhookController::sendWA($promotor->celular,"Hola ".$promotor->name.", has recibido un nuevo contacto en FullConnect, su nombre es ".$prospecto->nombre." y su teléfono es ".$prospecto->celular.", haz contacto ahora mismo en este link: https://wa.me/52".$prospecto->celular);

            $leadsDistributed[]= $prospecto->id;
        }
    }

    $this->comment("Leads distributed:");
    $this->comment(json_encode($leadsDistributed));

})->describe('Distribute leads.');



Artisan::command('send-new-passwords', function () {

    $users = User::All();
    foreach ($users as $user){

        $visiblePassword = Str::random(10);
        $user->password= bcrypt($visiblePassword);
        $user->save();

        Mail::to($user)->send(new WelcomeSend($user, $visiblePassword));

        $this->comment($visiblePassword." is the new password of ".$user->email);

    }

})->describe('Send New Passwords');

Artisan::command('send-new-password {--I|id=1}', function () {

        $user = User::findOrFail($this->option('id'));


        $visiblePassword = Str::random(10);
        $user->password= bcrypt($visiblePassword);
        $user->save();

        Mail::to($user)->send(new WelcomeSend($user, $visiblePassword));

        $this->comment($visiblePassword." is the new password of ".$user->email);


})->describe('Send New Password');


Artisan::command('create-admin-user {--U|user=admin@cochi-crm.com}', function () {

    $user = new User;
    $user->role_id = 1;
    $user->name = "Admin";
    $user->email= $this->option('user');
    $user->avatar = "users/default.png";
    $user->asignado_id=1;
    $user->status_id=1;
    $user->tipo_id=1;
    $user->password= bcrypt('password');
    $user->save();

    Mail::to($user)->send(new WelcomeSend($user, "password"));

    $this->comment("password is the new password of ".$user->email);


})->describe('Created new admin user');

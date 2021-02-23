<?php

namespace App\Http\Controllers;

use Storage;
use File;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests;

use App\User;
use App\Prospecto;
use App\Chat;
use App\Events\ChatSent;
use App\Temporary;


class WebhookController extends Controller
{
    public function __construct(Request $request)
    {
        $request->headers->set('Accept', 'application/json');
    }


    public function handle(Request $request)
    {

        // Save the request
        $path='public/prospectos-webhook-requests/'.date('Y').'/'.date('Y-m').'/'.date('Y-m-d');

        if(!File::exists($path)) {
            Storage::makeDirectory($path);
        }

        Storage::disk('local')->put($path.'/'.date('Ymd-His').'-'.rand(1000,9000).'.json', $request);

        // Check if lead already exists
        $prospecto = Prospecto::where("number", $request->number)->first();

        if($prospecto){

            if(empty($prospecto->celular)){ // Not Assigned lead

                if(empty($prospecto->nombre)){

                    if(urldecode($request->{'message-in'})=="Quiero más detalles." or urldecode($request->{'message-in'})=="Quiero más información."){

                        // Mensaje 1.2
                        $response = ["message-out"=>"¿Me puede repetir su nombre completo, por favor?", "delay"=>0];

                    }else{

                        $prospecto->nombre = urldecode($request->{'message-in'});

                        // Mensaje 2.1
                        $response = ["message-out"=>"Muchas gracias. ¿Cuál es su número celular?", "delay"=>0];

                    }

                }elseif(empty($prospecto->celular)){

                    $phone = preg_replace('/\D/', '', urldecode($request->{'message-in'}));

                    if ($phone<1000000000){

                        // Mensaje 2.2
                        $response = ["message-out"=>"¿Me puede repetir su número celular a 10 digitos, por favor?", "delay"=>0];

                    }else{
                        // Store number
                        $prospecto->celular = urldecode($request->{'message-in'});

                        // Mensaje 3
                        $response = ["message-out"=>"Muchas gracias, en un momento más un Ejecutivo se comunicará con usted y le dará toda la información detallada que usted requiere. Se agradece su preferencia. Que tenga un excelente día. Favor de estar atento a la llamada.", "delay"=>0];
                    }

                }else{
                    // Mensaje 4
                    $response = ["message-out"=>"Se agradece su preferencia. Que tenga un excelente día.", "delay"=>0];
                }

                $prospecto->save();

                // Chat
                $chat = new Chat;
                $chat->message = urldecode($request->{'message-in'});
                $chat->user_id = null;
                $chat->lead_id = $prospecto->id;
                $chat->type_id = 6;
                $chat->save();

                $chat = new Chat;
                $chat->message = $response["message-out"];
                $chat->user_id = null;
                $chat->lead_id = $prospecto->id;
                $chat->type_id = 5;
                $chat->save();

            }else{ // Assigned lead

                // Chat
                $chat = new Chat;
                $chat->message = urldecode($request->{'message-in'});
                $chat->user_id = $prospecto->asignado_id;
                $chat->lead_id = $prospecto->id;
                $chat->type_id = 6;
                $chat->save();

                $response = ["message-out"=>"", "delay"=>0];

                broadcast(new chatSent($prospecto, $chat));
            }


        }else{

            // Prospecto
            $prospecto = new Prospecto;
            $prospecto->number = $request->number;
            $prospecto->mensaje = urldecode($request->{'message-in'});
            $prospecto->tipo_mensaje = $request->type;
            $prospecto->tipo_aplicacion = $request->application;
            $prospecto->id_unico = $request->{'unique-id'};
            $prospecto->proyecto_id = $request->{'project-id'};
            $prospecto->status_id = 3;

            // If lead is preasigned, assign it
            if(isset($request->{"assigned_to"})){
                $user = User::findOrFail($request->{"assigned_to"});

                if($user->tipo_id==2){

                    // Create temporary if not exists

                    $promotoresAsinablesCollection = Temporary::where('key',"promotores_asignables_".$user->id)->first();

                    if (!$promotoresAsinablesCollection) {

                        $temporary = new Temporary;
                        $temporary->key = "promotores_asignables_".$user->id;
                        $temporary->display_name = "Promotores re-asignables de ".$user->name;
                        $temporary->save();
                    }

                    // Look for Available Promotors
                    $promotoresAsinablesCollection = Temporary::where('key','promotores_asignables_'.$user->id)->first();
                    $promotoresAsignables = json_decode($promotoresAsinablesCollection->value,true);

                    if(empty($promotoresAsignables)){

                        $promotoresAsignablesRefill = User::where('tipo_id','>',2)
                            ->where('tipo_id','<',4)
                            ->where('asignado_id',$user->id)
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
                    $prospecto->user_source_id = $user->id;

                    $prospecto->save();

                    // Remove and update Available Promotors
                    unset($promotoresAsignables[$k]);
                    $promotoresAsinablesCollection->value=json_encode($promotoresAsignables);
                    $promotoresAsinablesCollection->save();

                }elseif( $user->tipo_id==3 or $user->tipo_id==4 ){

                    $prospecto->asignado_id = $user->id;
                    $prospecto->fecha_hora = Carbon::now();
                    $prospecto->fecha_cambio = Carbon::now();
                    $prospecto->status_id = 3;
                    $prospecto->seguimiento_id = 1;
                    $prospecto->user_source_id = $user->id;

                    $prospecto->save();
                }

            }

            $prospecto->save();

            // Chat
            $chat = new Chat;
            $chat->message = $prospecto->mensaje;
            $chat->user_id = null;
            $chat->lead_id = $prospecto->id;
            $chat->type_id = 6;
            $chat->save();

            // Mensaje 1.1
            $response = ["message-out"=>"Bienvenido, ¿Con quién tengo el gusto, me puede proporcionar su nombre completo?", "delay"=>0];

            $chat = new Chat;
            $chat->message = $response["message-out"];
            $chat->user_id = null;
            $chat->lead_id = $prospecto->id;
            $chat->type_id = 5;
            $chat->save();
        }

        return $response;
    }
  
    public static function sendWA($number="",$message="")
    {
      $info = array(
        "token" => "04042c19cd720662e255168b21e397adb1e4c1ad",
        "priority" => 0,
        "application" => "1",
        "sleep" => 0,
        "globalmessage" => "test",
        "globalmedia" => "",
        "data" => array(
          array(
            "number" => $number,
            "message" => $message
          )
        )
      );
      $json = json_encode($info);
      \Log::info("SEND WA ".$json);
      $url = 'https://pickyassist.com/app/api/v2/push';

      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
          'Content-Type: application/json',
          'Content-Length: ' . strlen($json))
      );

      $result = json_decode(curl_exec($ch),true);
      $result["infoSended"] = $info;

      //--API RESPONSE--
      return ( $result );
    }
    
}
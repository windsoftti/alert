<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Status;
use App\Tipo;
use App\Prospecto;
use App\Http\Requests\StoreUser;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->authorizeResource(User::class, 'user');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('tipo_id','>',1)->get();
        return view('home.users.index',
            ["users"=> $users , "tipo" => "Usuarios"]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $status = Status::where('recurso','Users')->get();

        $usuarios = User::where('tipo_id',2)->get();

        if(auth()->user()->tipo_id==1){

            if($request->tipo=="gerentes"){
                $tipos= Tipo::where('recurso','Users')->where('id',2)->get();
            }elseif($request->tipo=="promotores"){
                $tipos= Tipo::where('recurso','Users')->where('id',">",2)->get();
            }else{
                $tipos= Tipo::where('recurso','Users')->where('id',"!=",1)->get();
            }

        }else{
            $tipos= Tipo::where('recurso','Users')->where('id',">",2)->get();
        }

        $gerentes = User::where('tipo_id',2)->get();

        //  dd(auth()->user()->tipo_id);


        return view('home.users.edit',
            [
                "action"=>"create",
                "status"=>$status,
                "usuarios"=>$usuarios,
                "tipos"=>$tipos,
                "gerentes" => $gerentes,
                "reqTipo" => $request->tipo
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {

        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->celular = $request->celular;
        $user->tipo_id = $request->tipo_id;
        $user->status_id = $request->status_id;
        $user->asignado_id = $request->asignado_id;
        $user->pickyassist_token = $request->pickyassist_token;

        $user->password= bcrypt($request->password);

        $user->role_id = 1;

        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $name = $user->id.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/storage/users/');
            $image->move($destinationPath, $name);
            // $image->save();

            $user->avatar = "users/".$name;

        }else{
            $user->avatar = "users/default.png";
        }


        $user->save();

        $status = [
            "title" => $user->tipo->nombre." ".$user->name." dado de Alta",
            "body" => "El ".$user->tipo->nombre." ".$user->name." fué dado de Alta satisfactoriamente dentro del personal.",
            "icon" => "fas fa-check-circle fa-lg",
            "class" => "bg-success"
        ];

        request()->session()->flash('status', $status);
        return Redirect::back();
        return redirect('home/users');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if($id==0){
            $id=auth()->user()->id;
        }

        $user = User::findOrFail($id);
        $status = Status::where('recurso','Users')->get();
        $usuarios = User::where('tipo_id','<','3')->get();

        if(auth()->user()->tipo_id==1){
            $tipos= Tipo::where('recurso','Users')->where('id',"!=",1)->get();
        }elseif(auth()->user()->tipo_id==2){
            $tipos= Tipo::where('recurso','Users')->where('id',">",2)->get();
        }else{
            $tipos= Tipo::where('recurso','Users')->where('id',auth()->user()->tipo_id)->get();
        }

        return view('home.users.edit',
            [
                "action"=>"edit",
                "user"=> $user,
                "status"=>$status,
                "usuarios"=>$usuarios,
                "tipos"=>$tipos
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUser $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->celular = $request->celular;
        $user->tipo_id = $request->tipo_id;
        $user->status_id = $request->status_id;
        $user->asignado_id = $request->asignado_id;
        $user->pickyassist_token = $request->pickyassist_token;

        if(!empty($request->password)){
            $user->password= bcrypt($request->password);
        }


        if($file   =   $request->file('avatar')) {

            $image = $request->file('avatar');
            $name = $user->id.time().'.'.$image->getClientOriginalExtension();


            $destinationPath = public_path('/storage/users/');
            $image->move($destinationPath, $name);
            // $image->save();

            $user->avatar = "users/".$name;

        }

        $user->save();

        $status = [
            "title" => $user->tipo->nombre." ".$user->name." actualizado",
            "body" => "El ".$user->tipo->nombre." ".$user->name." fué actualizado satisfactoriamente.",
            "icon" => "fas fa-check-circle fa-lg",
            "class" => "bg-success"
        ];

        request()->session()->flash('status', $status);
        return Redirect::back();
        return redirect('home/users');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $user = User::findOrFail($id);
        $user->delete();

        $status = [
            "title" => $user->tipo->nombre." ".$user->name." eliminado",
            "body" => "El ".$user->tipo->nombre." ".$user->name." fué eliminado satisfactoriamente del personal.",
            "icon" => "fas fa-check-circle fa-lg",
            "class" => "bg-success"
        ];

        request()->session()->flash('status', $status);
        return Redirect::back();
    }


    public function gerentes()
    {
        $users = User::where('tipo_id',2)->get();
        return view('home.users.index', ["users"=> $users, "tipo"=> "Gerentes" ]);
    }


    public function promotores()
    {
        if(auth()->user()->tipo_id==1){
            $users = User::whereBetween('tipo_id',array(3,4))->get();
        }else{
            $users = User::whereBetween('tipo_id',array(3,4))->where("asignado_id",auth()->user()->id)->get();
        }

        return view('home.users.index', ["users"=> $users, "tipo"=> "Promotores" ]);
    }

    public function asignar()
    {

        if(auth()->user()->tipo_id!=2){
            abort(403, 'Unauthorized action.');
        }

        $id = auth()->user()->id;
        $gerente = User::findOrFail($id);

        $promotores = User::where('asignado_id',$id)
            ->whereBetween('tipo_id',array(3,4))->get();


        return view('home.users.asignacion', ["promotores"=> $promotores, "gerente"=>$gerente ]);
    }

    public function asignarUpdate(Request $request)
    {
        $gerente = User::findOrFail($request->gerente_id);
        $promotores = User::where('asignado_id',$gerente->id)->get();

        foreach ($promotores as $promotor){

            if(is_null($request->promotores_especiales)){
                $promotor->tipo_id = 3;
            }else{
                if(in_array($promotor->id,$request->promotores_especiales)){
                    $promotor->tipo_id = 4;
                }else{
                    $promotor->tipo_id = 3;
                }

            }

            $promotor->save();


        }

        $status = [
            "title" => "Promotores Asignados",
            "body" => "Los promotores fueron re-asignados satisfactoriamente.",
            "icon" => "fas fa-check-circle fa-lg",
            "class" => "bg-success"
        ];

        return view('home.users.asignacion', ["promotores"=> $promotores, "gerente"=>$gerente ]);
    }

    public function promotoresDelGerenteAjax($id){

        $promotores = User::whereBetween('tipo_id',array(3,4))->where('asignado_id',$id)
            ->orderBy('name')->pluck('name','id');
        return json_encode($promotores);
    }



    public function gerencia()
    {
        $prospectos = Prospecto::whereNotNull('asignado_id')->get();
        $promotores = User::where('tipo_id',3)->where('asignado_id',auth()->user()->id)->orderBy('name')->get();

        return view('home.users.gerencia', ["prospectos"=> $prospectos, "promotores" => $promotores ]);
    }

    public function dashboard()
    {
        $prospectos = Prospecto::whereNotNull('asignado_id')->get();
        $promotores = User::where('tipo_id',3)->where('asignado_id',auth()->user()->id)->get();
        $users = User::All();

        return view('home.users.dashboard', ["prospectos"=> $prospectos, "promotores" => $promotores, "users" =>$users ]);
    }

}

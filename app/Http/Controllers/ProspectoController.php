<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreProspecto;
use Carbon\Carbon;
use App\Chat;
use App\Prospecto;
use App\Seguimiento;
use App\Status;
use App\User;

class ProspectoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        // $this->authorizeResource(Prospecto::class, 'prospecto');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $prospectos = Prospecto::All();
        return view('home.prospectos.index', ["prospectos"=> $prospectos ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = Status::where('recurso','Prospectos')->get();

        if(auth()->user()->tipo_id==1){
            $usuarios = User::whereBetween('tipo_id',array(3,4))->get();
        }elseif(auth()->user()->tipo_id==2){
            $usuarios = User::whereBetween('tipo_id',array(3,4))
                ->where('asignado_id',auth()->user()->id)->get();
        }else{
            $usuarios = User::find(auth()->user()->id);
        }

        $seguimientos = Seguimiento::All();

        return view('home.prospectos.edit',
            [
                "action"=>"create",
                "status"=>$status,
                "usuarios"=>$usuarios,
                "seguimientos" => $seguimientos
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProspecto $request)
    {
        $prospecto = new Prospecto;

        $prospecto->nombre = $request->nombre;
        $prospecto->celular = $request->celular;
        $prospecto->seguimiento_id = $request->seguimiento_id;
        $prospecto->asignado_id = $request->asignado_id;
        $prospecto->status_id = $request->status_id;
        $prospecto->save();

        $status = [
            "title" => "Solicitante dado de Alta",
            "body" => "El solicitante fué dado de Alta satisfactoriamente.",
            "icon" => "fas fa-check-circle fa-lg",
            "class" => "bg-success"
        ];

        request()->session()->flash('status', $status);
        return redirect('home/prospectos-followup');
        return Redirect::back();
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
        $prospecto = Prospecto::findOrFail($id);
        $status = Status::where('recurso','Prospectos')->get();

        if(auth()->user()->tipo_id==1){
            $usuarios = User::whereBetween('tipo_id',array(3,4))->get();
        }elseif(auth()->user()->tipo_id==2){
            $usuarios = User::whereBetween('tipo_id',array(3,4))
                ->where('asignado_id',auth()->user()->id)->get();
        }else{
            $usuarios = User::find(auth()->user()->id);
        }


        $seguimientos = Seguimiento::All();


        return view('home.prospectos.edit',
            [
                "action"=>"edit",
                "prospecto"=> $prospecto,
                "status"=>$status,
                "usuarios"=>$usuarios,
                "seguimientos"=> $seguimientos
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProspecto $request, $id)
    {
        $prospecto = Prospecto::findOrFail($id);

        $prospecto->nombre = $request->nombre;
        $prospecto->celular = $request->celular;
        $prospecto->status_id = $request->status_id;
        $prospecto->asignado_id = $request->asignado_id;

        if($prospecto->seguimiento_id!=$request->seguimiento_id){
            $prospecto->fecha_cambio = Carbon::now();;
        }

        $prospecto->seguimiento_id = $request->seguimiento_id;

        $prospecto->save();

        $status = [
            "title" => "Prospecto ".$prospecto->name." actualizado",
            "body" => "El Prospecto ".$prospecto->name." fué actualizado satisfactoriamente.",
            "icon" => "fas fa-check-circle fa-lg",
            "class" => "bg-success"
        ];

        request()->session()->flash('status', $status);

        return redirect('home/prospectos-followup');
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prospecto = Prospecto::findOrFail($id);
        $prospecto->delete();

        $status = [
            "title" => "Prospecto ".$prospecto->name." eliminado",
            "body" => "El Prospecto ".$prospecto->name." fué eliminado satisfactoriamente.",
            "icon" => "fas fa-check-circle fa-lg",
            "class" => "bg-success"
        ];

        request()->session()->flash('status', $status);
        return Redirect::back();
    }

    public function followup(){


        if(auth()->user()->tipo_id==1){
            $promotores = User::whereBetween('tipo_id',array(3,4))->get();
            $gerentes = User::where('tipo_id',2)->orderBy("name")->get();
            $prospectos = Prospecto::where('seguimiento_id','<>',9)
                ->orderBy('id', 'desc')->take(500)->get();
        }elseif(auth()->user()->tipo_id==2){
            $promotores = User::whereBetween('tipo_id',array(3,4))
                ->where('asignado_id',auth()->user()->id)
                ->get();

            $gerentes = User::where('tipo_id',2)->where('id',auth()->user()->id)->orderBy("name")->get();

            $promotores_ids = [];

            // dd($promotores);

            foreach($promotores as $promotor){
                $promotores_ids[]=$promotor->id;
            }

            // dd($promotores_ids);
            $prospectos = Prospecto::whereIn('asignado_id',$promotores_ids)
                ->where('seguimiento_id','<>',9)
                ->get();

        }else{

            $promotores = [];
            $gerentes = [];
            $prospectos = Prospecto::where('asignado_id',auth()->user()->id)
                ->where('seguimiento_id','<>',9)
                ->get();

        }

        foreach($prospectos as $prospecto){
            $prospecto->chat = Chat::where('lead_id',$prospecto->id)
                ->where('created_at','>',Carbon::now()->subMinutes(setting('site.chat_window')))
                ->orderBy('created_at', 'desc')
                ->first();
        }

        return view('home.prospectos.followup',
            [
                "prospectos"=> $prospectos,
                "promotores" => $promotores,
                "gerentes"  => $gerentes
            ]);

    }


}

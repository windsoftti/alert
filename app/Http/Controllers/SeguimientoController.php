<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Seguimiento;
use App\Tipo;

class SeguimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seguimientos = Seguimiento::All();

        return view('home.seguimiento.index',
            [
                "seguimientos"=> $seguimientos
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipos = Tipo::where('recurso','Seguimientos')->get();

        // dd($tipos);

        return view('home.seguimiento.edit',
            [
                "action"=>"create",
                "tipos"=>$tipos,
                "last"=>Seguimiento::All()->count()
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $seguimiento = new Seguimiento;

        $seguimiento->nombre = $request->nombre;
        $seguimiento->order = $request->order;
        $seguimiento->type_id = $request->type_id;
        $seguimiento->save();

        $status = [
            "title" => "Estatus de Seguimiento dado de Alta",
            "body" => "El estatus de Seguimiento fué dado de Alta satisfactoriamente.",
            "icon" => "fas fa-check-circle fa-lg",
            "class" => "bg-success"
        ];

        request()->session()->flash('status', $status);
        return redirect('home/seguimientos');
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

        $seguimiento = Seguimiento::findOrFail($id);
        $tipos= Tipo::where('recurso','Seguimientos')->get();

        return view('home.seguimiento.edit',
            [
                "action"=>"edit",
                "seguimiento"=> $seguimiento,
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
    public function update(Request $request, $id)
    {
        $seguimiento = Seguimiento::findOrFail($id);

        $seguimiento->nombre = $request->nombre;
        $seguimiento->order = $request->order;
        $seguimiento->type_id = $request->type_id;


        $seguimiento->save();

        $status = [
            "title" => "Estatus de Seguimiento ".$seguimiento->nombre." actualizado",
            "body" => "El Estatus de Seguimiento ".$seguimiento->nombre." fué actualizado satisfactoriamente.",
            "icon" => "fas fa-check-circle fa-lg",
            "class" => "bg-success"
        ];

        request()->session()->flash('status', $status);

        return redirect('home/seguimientos');
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
        $seguimiento = Seguimiento::findOrFail($id);
        $seguimiento->delete();

        $status = [
            "title" => "Estatus de Seguimiento ".$seguimiento->name." eliminado",
            "body" => "El Estatus de Seguimiento ".$seguimiento->name." fué eliminado satisfactoriamente.",
            "icon" => "fas fa-check-circle fa-lg",
            "class" => "bg-success"
        ];

        request()->session()->flash('status', $status);
        return Redirect::back();
    }
}

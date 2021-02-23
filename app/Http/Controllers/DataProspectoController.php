<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Prospecto;
use Illuminate\Http\Request;

class DataProspectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $action = $request->input('action');

        if($action=="month-to-month-count"){

            $data = [
                2020=>[
                    ["Enero",Prospecto::whereMonth('created_at','1')->count()],
                    ["Febrero",Prospecto::whereMonth('created_at','2')->count()],
                    ["Marzo",Prospecto::whereMonth('created_at','3')->count()],
                    ["Abril",Prospecto::whereMonth('created_at','4')->count()],
                    ["Mayo",Prospecto::whereMonth('created_at','5')->count()],
                    ["Junio",Prospecto::whereMonth('created_at','6')->count()],
                    ["Julio",Prospecto::whereMonth('created_at','7')->count()],
                    ["Agosto",Prospecto::whereMonth('created_at','8')->count()]
                ]
            ];

            $data_prev = [
                2020=>[
                    ["Enero",Prospecto::whereMonth('created_at','11')->count()],
                    ["Febrero",Prospecto::whereMonth('created_at','10')->count()],
                    ["Marzo",Prospecto::whereMonth('created_at','10')->count()],
                    ["Abril",Prospecto::whereMonth('created_at','10')->count()],
                    ["Mayo",Prospecto::whereMonth('created_at','10')->count()],
                    ["Junio",Prospecto::whereMonth('created_at','10')->count()],
                    ["Julio",Prospecto::whereMonth('created_at','10')->count()],
                    ["Agosto",Prospecto::whereMonth('created_at','10')->count()]
                ]
            ];


            $output = ["message"=> "Retrived counts", "data" => ["data" => $data, "data_prev" => $data_prev] ];

        }else{
            $output = ["message"=> "Retrived all", "data" => ["data" => $prospectos] ];
        }

        return $output;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Prospecto  $prospecto
     * @return \Illuminate\Http\Response
     */
    public function show(Prospecto $prospecto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Prospecto  $prospecto
     * @return \Illuminate\Http\Response
     */
    public function edit(Prospecto $prospecto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prospecto  $prospecto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prospecto $prospecto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prospecto  $prospecto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prospecto $prospecto)
    {
        //
    }
}

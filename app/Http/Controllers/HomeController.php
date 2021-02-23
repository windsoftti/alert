<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Prospecto;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $prospectos_brute = 0;
        $tables = 0;

        if(auth()->user()->tipo_id==1){

            $promotores = User::whereBetween('tipo_id',array(3,4))->count();
            $prospectos_brute = Prospecto::count();
            $prospectos = Prospecto::where('asignado_id','!=',null)->count();

            $querya = "SELECT
	prospectos.asignado_id,
	users.`name`,
	avg(
		TIMESTAMPDIFF(HOUR, fecha_cambio, now())
	) AS avg_hours
FROM
	prospectos
INNER JOIN users ON users.id = prospectos.asignado_id
INNER JOIN seguimientos ON prospectos.seguimiento_id = seguimientos.id
INNER JOIN tipos ON tipos.id = seguimientos.type_id
WHERE
	tipos.nombre = 'En progreso'
AND users.tipo_id <> 1
GROUP BY
	asignado_id
ORDER BY
	avg_hours ASC
LIMIT 10";

            $queryb = "SELECT
	prospectos.asignado_id,
	users.`name`,
	avg(
		TIMESTAMPDIFF(HOUR, fecha_cambio, now())
	) AS avg_hours
FROM
	prospectos
INNER JOIN users ON users.id = prospectos.asignado_id
INNER JOIN seguimientos ON prospectos.seguimiento_id = seguimientos.id
INNER JOIN tipos ON tipos.id = seguimientos.type_id
WHERE
	tipos.nombre = 'En progreso'
AND users.tipo_id <> 1
GROUP BY
	asignado_id
ORDER BY avg_hours DESC 
limit 20";

            $topBests = DB::select($querya);
            $topWorsts= DB::select($queryb);



            $tables = ["top_bests"=> $topBests, "top_worsts"=> $topWorsts];

        }elseif(auth()->user()->tipo_id==2){

            $promotores = User::whereBetween('tipo_id',array(3,4))
                ->where('asignado_id',auth()->user()->id)
                ->get();
            $promotores_ids = [];
            foreach($promotores as $promotor){
                $promotores_ids[]=$promotor->id;
            }
            $prospectos = Prospecto::whereIn('asignado_id',$promotores_ids)->count();
            $promotores = $promotores->count();

        }else{
            $promotores = null;
            $prospectos = Prospecto::where('asignado_id',auth()->user()->id)->count();
        }

        $gerentes_report = [];
        if(auth()->user()->tipo_id==1) {

            foreach (User::where('tipo_id', 2)->orderBy('name')->get() as $gerente) {

                $promotores_alt = User::whereBetween('tipo_id', array(3, 4))
                    ->where('asignado_id', $gerente->id)
                    ->get();
                $promotores_ids = [];
                foreach ($promotores_alt as $promotor) {
                    $promotores_ids[] = $promotor->id;
                }
                $prospectos_alt = Prospecto::whereIn('asignado_id', $promotores_ids)->count();
                $promotores_alt = $promotores_alt->count();

                $gerentes_report[] = [
                    "nombre" => $gerente->name,
                    "promotores" => $promotores_alt,
                    "prospectos" => $prospectos_alt
                ];
            }

        }


        $total = [
            "solicitantes" => $prospectos,
            "solicitantes_brute" => $prospectos_brute,
            "usuarios"  => User::where('tipo_id','>','1')->count()+1,
            "gerentes" => User::where('tipo_id',2)->count(),
            "promotores" => $promotores,
            ];

        return view('home.index',
            [
                "total"=> $total,
                "gerentes_report" => $gerentes_report,
                "tables" => $tables
            ]);


    }
}

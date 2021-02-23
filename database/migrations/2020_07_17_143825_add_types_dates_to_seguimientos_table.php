<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

use App\Tipo;
use App\Seguimiento;

class AddTypesDatesToSeguimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tipoProg = new Tipo;
        $tipoProg->nombre = "En progreso";
        $tipoProg->recurso = "Seguimientos";
        $tipoProg->save();

        $tipoFin = new Tipo;
        $tipoFin->nombre = "Finalizado";
        $tipoFin->recurso = "Seguimientos";
        $tipoFin->save();

        Schema::table('seguimientos', function (Blueprint $table) use ($tipoProg){
            $table->integer('order')->default(0)->unsigned()->nullable(false)->after('id');
            $table->string("key")->default("")->nullable(false);
            $table->integer('type_id')->default($tipoProg->id)->unsigned()->nullable(false);
            $table->timestamps();
            $table->softDeletes();
        });

        // Set Type
        $seguimientos = Seguimiento::where('nombre', 'No Califica')
            ->orWhere('nombre', 'Concretado')
            ->get();

        foreach($seguimientos as $seguimiento){
            $seguimiento->type_id = $tipoFin->id;
            $seguimiento->save();
        }

        // Set Order & Key
        $allSeguimientos = Seguimiento::All();
        $order=1;
        foreach($allSeguimientos as $seguimiento){

            $seguimiento->key = Str::slug($seguimiento->nombre, '-');
            $seguimiento->order = $order;

            $order=$order+1;

            $seguimiento->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seguimientos', function (Blueprint $table) {
            $table->dropColumn('order');
            $table->dropColumn('key');
            $table->dropColumn('type_id');
            $table->dropTimestamps();
            $table->dropSoftDeletes();
        });

        $types = Tipo::where('recurso','Seguimientos')->get();

        foreach($types as $type){
            $type->delete();
        }

    }
}

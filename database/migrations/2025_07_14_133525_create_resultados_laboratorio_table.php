<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultadosLaboratorioTable extends Migration
{
    public function up()
    {
        Schema::create('resultados_laboratorio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained('pacientes')->onDelete('cascade');
            $table->string('tipo_prueba');
            $table->date('fecha');
            $table->text('resultado');
            $table->string('archivo_pdf')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('resultados_laboratorio');
    }
}

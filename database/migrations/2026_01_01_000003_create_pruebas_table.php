<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pruebas', function (Blueprint $table) {
            $table->id();
            $table->enum('fase', ['pre', 'post'])->default('pre');
            $table->string('institucion', 200)->nullable();
            $table->string('nivel_educativo', 100)->nullable();

            // Dimensión A – Sintaxis (30 pts)
            $table->text('resp_a1')->nullable();
            $table->text('resp_a2')->nullable();
            $table->text('resp_a3')->nullable();

            // Dimensión B – Depuración (30 pts)
            $table->text('resp_b1_error1')->nullable();
            $table->text('resp_b1_error2')->nullable();
            $table->text('resp_b1_error3')->nullable();
            $table->text('resp_b2_resultado')->nullable();
            $table->text('resp_b2_correccion')->nullable();
            $table->string('resp_b3_archivo', 300)->nullable();
            $table->string('resp_b3_npe', 500)->nullable();
            $table->text('resp_b3_acciones')->nullable();

            // Dimensión C – Arquitectura (40 pts)
            $table->string('resp_c1_clientedao', 100)->nullable();
            $table->string('resp_c1_formulario', 100)->nullable();
            $table->string('resp_c1_serviciofactura', 100)->nullable();
            $table->string('resp_c1_panelprincipal', 100)->nullable();
            $table->string('resp_c1_productorepo', 100)->nullable();
            $table->text('resp_c2_violacion1')->nullable();
            $table->text('resp_c2_violacion2')->nullable();
            $table->text('resp_c3_clases')->nullable();
            $table->text('resp_c3_flujo')->nullable();
            $table->text('resp_c3_justificacion')->nullable();

            $table->decimal('puntaje_total', 5, 1)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pruebas');
    }
};

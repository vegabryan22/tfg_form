<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('entrevistas', function (Blueprint $table) {
            $table->id();

            // Datos del entrevistado
            $table->string('codigo_participante', 20);
            $table->string('fecha_hora', 50);
            $table->string('institucion', 200);
            $table->string('modalidad', 50);
            $table->string('years_experiencia', 50);
            $table->string('cursos_actuales', 300)->nullable();

            // Categoría 1 – Dificultades de aprendizaje
            $table->text('resp_cat1_p1')->nullable();
            $table->text('resp_cat1_p2')->nullable();
            $table->text('resp_cat1_p3')->nullable();

            // Categoría 2 – Uso actual de IA
            $table->text('resp_cat2_p1')->nullable();
            $table->text('resp_cat2_p2')->nullable();
            $table->text('resp_cat2_p3')->nullable();

            // Categoría 3 – Percepción pedagógica de la IA
            $table->text('resp_cat3_p1')->nullable();
            $table->text('resp_cat3_p2')->nullable();
            $table->text('resp_cat3_p3')->nullable();

            // Categoría 4 – Contexto institucional
            $table->text('resp_cat4_p1')->nullable();
            $table->text('resp_cat4_p2')->nullable();

            // Cierre
            $table->text('resp_cierre')->nullable();
            $table->text('observaciones')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('entrevistas');
    }
};

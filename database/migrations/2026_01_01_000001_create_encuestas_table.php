<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('encuestas', function (Blueprint $table) {
            $table->id();
            $table->enum('fase', ['pre', 'post'])->default('pre');

            // Sección A – Datos generales
            $table->string('institucion', 200);
            $table->string('nivel_educativo', 100);
            $table->string('genero', 50);
            $table->string('curso_actual', 200)->nullable();
            $table->string('acceso_internet', 100);

            // Sección B – Herramientas
            $table->json('herramientas_ia')->nullable();
            $table->string('otra_herramienta', 200)->nullable();
            $table->string('frecuencia_ia', 100);

            // Sección C – Likert (6 ítems)
            $table->tinyInteger('likert_c_1')->nullable();
            $table->tinyInteger('likert_c_2')->nullable();
            $table->tinyInteger('likert_c_3')->nullable();
            $table->tinyInteger('likert_c_4')->nullable();
            $table->tinyInteger('likert_c_5')->nullable();
            $table->tinyInteger('likert_c_6')->nullable();

            // Sección D – Likert (8 ítems)
            $table->tinyInteger('likert_d_1')->nullable();
            $table->tinyInteger('likert_d_2')->nullable();
            $table->tinyInteger('likert_d_3')->nullable();
            $table->tinyInteger('likert_d_4')->nullable();
            $table->tinyInteger('likert_d_5')->nullable();
            $table->tinyInteger('likert_d_6')->nullable();
            $table->tinyInteger('likert_d_7')->nullable();
            $table->tinyInteger('likert_d_8')->nullable();

            // Sección E – Likert post-intervención (6 ítems)
            $table->tinyInteger('likert_e_1')->nullable();
            $table->tinyInteger('likert_e_2')->nullable();
            $table->tinyInteger('likert_e_3')->nullable();
            $table->tinyInteger('likert_e_4')->nullable();
            $table->tinyInteger('likert_e_5')->nullable();
            $table->tinyInteger('likert_e_6')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('encuestas');
    }
};

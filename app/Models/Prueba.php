<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prueba extends Model
{
    protected $table = 'pruebas';

    protected $fillable = [
        'codigo_participante',
        'fase',
        'institucion',
        'nivel_educativo',
        // Dimensión A – Sintaxis
        'resp_a1', 'resp_a2', 'resp_a3',
        // Dimensión B – Depuración
        'resp_b1_error1', 'resp_b1_error2', 'resp_b1_error3',
        'resp_b2_resultado', 'resp_b2_correccion',
        'resp_b3_archivo', 'resp_b3_npe', 'resp_b3_acciones',
        // Dimensión C – Arquitectura
        'resp_c1_clientedao', 'resp_c1_formulario',
        'resp_c1_serviciofactura', 'resp_c1_panelprincipal',
        'resp_c1_productorepo',
        'resp_c2_violacion1', 'resp_c2_violacion2',
        'resp_c3_clases', 'resp_c3_flujo', 'resp_c3_justificacion',
        'puntaje_total',
    ];

    protected $casts = [
        'puntaje_total' => 'decimal:1',
    ];
}

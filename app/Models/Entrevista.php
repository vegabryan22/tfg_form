<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrevista extends Model
{
    protected $table = 'entrevistas';

    protected $fillable = [
        'codigo_participante',
        'fecha_hora',
        'institucion',
        'modalidad',
        'years_experiencia',
        'cursos_actuales',
        // Categoría 1
        'resp_cat1_p1', 'resp_cat1_p2', 'resp_cat1_p3',
        // Categoría 2
        'resp_cat2_p1', 'resp_cat2_p2', 'resp_cat2_p3',
        // Categoría 3
        'resp_cat3_p1', 'resp_cat3_p2', 'resp_cat3_p3',
        // Categoría 4
        'resp_cat4_p1', 'resp_cat4_p2',
        'resp_cierre',
        'observaciones',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Encuesta extends Model
{
    protected $table = 'encuestas';

    protected $fillable = [
        'fase',
        'institucion',
        'nivel_educativo',
        'genero',
        'curso_actual',
        'acceso_internet',
        'herramientas_ia',
        'otra_herramienta',
        'frecuencia_ia',
        // Likert C (6 ítems)
        'likert_c_1', 'likert_c_2', 'likert_c_3',
        'likert_c_4', 'likert_c_5', 'likert_c_6',
        // Likert D (8 ítems)
        'likert_d_1', 'likert_d_2', 'likert_d_3', 'likert_d_4',
        'likert_d_5', 'likert_d_6', 'likert_d_7', 'likert_d_8',
        // Likert E (6 ítems — solo post-intervención)
        'likert_e_1', 'likert_e_2', 'likert_e_3',
        'likert_e_4', 'likert_e_5', 'likert_e_6',
    ];

    protected $casts = [
        'herramientas_ia' => 'array',
        'likert_c_1' => 'integer', 'likert_c_2' => 'integer',
        'likert_c_3' => 'integer', 'likert_c_4' => 'integer',
        'likert_c_5' => 'integer', 'likert_c_6' => 'integer',
        'likert_d_1' => 'integer', 'likert_d_2' => 'integer',
        'likert_d_3' => 'integer', 'likert_d_4' => 'integer',
        'likert_d_5' => 'integer', 'likert_d_6' => 'integer',
        'likert_d_7' => 'integer', 'likert_d_8' => 'integer',
        'likert_e_1' => 'integer', 'likert_e_2' => 'integer',
        'likert_e_3' => 'integer', 'likert_e_4' => 'integer',
        'likert_e_5' => 'integer', 'likert_e_6' => 'integer',
    ];

    public function promedioC(): float
    {
        $vals = array_filter([
            $this->likert_c_1, $this->likert_c_2, $this->likert_c_3,
            $this->likert_c_4, $this->likert_c_5, $this->likert_c_6,
        ]);
        return count($vals) ? array_sum($vals) / count($vals) : 0;
    }

    public function promedioD(): float
    {
        $vals = array_filter([
            $this->likert_d_1, $this->likert_d_2, $this->likert_d_3,
            $this->likert_d_4, $this->likert_d_5, $this->likert_d_6,
            $this->likert_d_7, $this->likert_d_8,
        ]);
        return count($vals) ? array_sum($vals) / count($vals) : 0;
    }

    public function promedioE(): float
    {
        $vals = array_filter([
            $this->likert_e_1, $this->likert_e_2, $this->likert_e_3,
            $this->likert_e_4, $this->likert_e_5, $this->likert_e_6,
        ]);
        return count($vals) ? array_sum($vals) / count($vals) : 0;
    }
}

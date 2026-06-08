<?php

namespace App\Http\Controllers;

use App\Models\Encuesta;
use Illuminate\Http\Request;

class EncuestaController extends Controller
{
    public function show()
    {
        return view('encuesta.show');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'fase'            => 'required|in:pre,post',
            'institucion'     => 'required|string|max:200',
            'nivel_educativo' => 'required|string|max:100',
            'genero'          => 'required|string|max:50',
            'curso_actual'    => 'nullable|string|max:200',
            'acceso_internet' => 'required|string|max:100',
            'herramientas_ia' => 'nullable|array',
            'herramientas_ia.*' => 'string|max:100',
            'otra_herramienta'=> 'nullable|string|max:200',
            'frecuencia_ia'   => 'required|string|max:100',
            // Likert C
            'likert_c_1' => 'required|integer|min:1|max:5',
            'likert_c_2' => 'required|integer|min:1|max:5',
            'likert_c_3' => 'required|integer|min:1|max:5',
            'likert_c_4' => 'required|integer|min:1|max:5',
            'likert_c_5' => 'required|integer|min:1|max:5',
            'likert_c_6' => 'required|integer|min:1|max:5',
            // Likert D
            'likert_d_1' => 'required|integer|min:1|max:5',
            'likert_d_2' => 'required|integer|min:1|max:5',
            'likert_d_3' => 'required|integer|min:1|max:5',
            'likert_d_4' => 'required|integer|min:1|max:5',
            'likert_d_5' => 'required|integer|min:1|max:5',
            'likert_d_6' => 'required|integer|min:1|max:5',
            'likert_d_7' => 'required|integer|min:1|max:5',
            'likert_d_8' => 'required|integer|min:1|max:5',
            // Likert E – solo obligatorio si fase=post
            'likert_e_1' => 'nullable|integer|min:1|max:5',
            'likert_e_2' => 'nullable|integer|min:1|max:5',
            'likert_e_3' => 'nullable|integer|min:1|max:5',
            'likert_e_4' => 'nullable|integer|min:1|max:5',
            'likert_e_5' => 'nullable|integer|min:1|max:5',
            'likert_e_6' => 'nullable|integer|min:1|max:5',
        ], [
            'required' => 'Este campo es obligatorio.',
            'integer'  => 'Debe seleccionar una opción.',
            'min'      => 'Valor fuera de rango.',
            'max'      => 'Valor fuera de rango.',
        ]);

        if ($request->fase === 'post') {
            $request->validate([
                'likert_e_1' => 'required|integer|min:1|max:5',
                'likert_e_2' => 'required|integer|min:1|max:5',
                'likert_e_3' => 'required|integer|min:1|max:5',
                'likert_e_4' => 'required|integer|min:1|max:5',
                'likert_e_5' => 'required|integer|min:1|max:5',
                'likert_e_6' => 'required|integer|min:1|max:5',
            ], ['required' => 'En fase post-intervención la Sección E es obligatoria.']);
        }

        Encuesta::create($data);

        return redirect()->route('encuesta.gracias');
    }

    public function gracias()
    {
        return view('encuesta.gracias');
    }
}

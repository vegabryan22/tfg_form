<?php

namespace App\Http\Controllers;

use App\Models\Prueba;
use Illuminate\Http\Request;

class PruebaController extends Controller
{
    public function show()
    {
        return view('prueba.show');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'codigo_participante' => 'required|string|max:20',
            'fase'                => 'required|in:pre,post',
            'institucion'         => 'nullable|string|max:200',
            'nivel_educativo' => 'nullable|string|max:100',
            // Dimensión A
            'resp_a1' => 'nullable|string',
            'resp_a2' => 'nullable|string',
            'resp_a3' => 'nullable|string',
            // Dimensión B
            'resp_b1_error1'     => 'nullable|string',
            'resp_b1_error2'     => 'nullable|string',
            'resp_b1_error3'     => 'nullable|string',
            'resp_b2_resultado'  => 'nullable|string',
            'resp_b2_correccion' => 'nullable|string',
            'resp_b3_archivo'    => 'nullable|string|max:300',
            'resp_b3_npe'        => 'nullable|string|max:500',
            'resp_b3_acciones'   => 'nullable|string',
            // Dimensión C
            'resp_c1_clientedao'      => 'nullable|string|max:100',
            'resp_c1_formulario'      => 'nullable|string|max:100',
            'resp_c1_serviciofactura' => 'nullable|string|max:100',
            'resp_c1_panelprincipal'  => 'nullable|string|max:100',
            'resp_c1_productorepo'    => 'nullable|string|max:100',
            'resp_c2_violacion1'      => 'nullable|string',
            'resp_c2_violacion2'      => 'nullable|string',
            'resp_c3_clases'          => 'nullable|string',
            'resp_c3_flujo'           => 'nullable|string',
            'resp_c3_justificacion'   => 'nullable|string',
        ], ['required' => 'Este campo es obligatorio.']);

        Prueba::create($data);

        return redirect()->route('prueba.gracias');
    }

    public function gracias()
    {
        return view('prueba.gracias');
    }
}

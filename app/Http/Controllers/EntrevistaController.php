<?php

namespace App\Http\Controllers;

use App\Models\Entrevista;
use Illuminate\Http\Request;

class EntrevistaController extends Controller
{
    public function show()
    {
        return view('entrevista.show');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'codigo_participante' => 'required|string|max:20',
            'fecha_hora'          => 'required|string|max:50',
            'institucion'         => 'required|string|max:200',
            'modalidad'           => 'required|string|max:50',
            'years_experiencia'   => 'required|string|max:50',
            'cursos_actuales'     => 'nullable|string|max:300',
            'resp_cat1_p1'  => 'nullable|string',
            'resp_cat1_p2'  => 'nullable|string',
            'resp_cat1_p3'  => 'nullable|string',
            'resp_cat2_p1'  => 'nullable|string',
            'resp_cat2_p2'  => 'nullable|string',
            'resp_cat2_p3'  => 'nullable|string',
            'resp_cat3_p1'  => 'nullable|string',
            'resp_cat3_p2'  => 'nullable|string',
            'resp_cat3_p3'  => 'nullable|string',
            'resp_cat4_p1'  => 'nullable|string',
            'resp_cat4_p2'  => 'nullable|string',
            'resp_cierre'   => 'nullable|string',
            'observaciones' => 'nullable|string',
        ], ['required' => 'Este campo es obligatorio.']);

        Entrevista::create($data);

        return redirect()->route('entrevista.gracias');
    }

    public function gracias()
    {
        return view('entrevista.gracias');
    }
}

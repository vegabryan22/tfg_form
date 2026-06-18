<?php

namespace App\Http\Controllers;

use App\Models\Encuesta;
use App\Models\Entrevista;
use App\Models\Prueba;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminController extends Controller
{
    public function loginForm()
    {
        if (session('admin_authenticated')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate(['password' => 'required|string']);

        if ($request->password === config('admin.password')) {
            session(['admin_authenticated' => true]);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['password' => 'Contraseña incorrecta.']);
    }

    public function logout()
    {
        session()->forget('admin_authenticated');
        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        return view('admin.dashboard', [
            'totalEncuestas'   => Encuesta::count(),
            'totalEntrevistas' => Entrevista::count(),
            'totalPruebas'     => Prueba::count(),
            'encuestasPre'     => Encuesta::where('fase', 'pre')->count(),
            'encuestasPost'    => Encuesta::where('fase', 'post')->count(),
            'pruebasPre'       => Prueba::where('fase', 'pre')->count(),
            'pruebasPost'      => Prueba::where('fase', 'post')->count(),
            'ultimasEncuestas' => Encuesta::latest()->take(5)->get(),
            'ultimasEntrevistas' => Entrevista::latest()->take(5)->get(),
            'ultimasPruebas'   => Prueba::latest()->take(5)->get(),
        ]);
    }

    // ── Encuestas ─────────────────────────────────────────────────────────────

    public function encuestas(Request $request)
    {
        $query = Encuesta::latest();
        if ($request->fase) {
            $query->where('fase', $request->fase);
        }
        if ($request->institucion) {
            $query->where('institucion', 'like', '%'.$request->institucion.'%');
        }
        return view('admin.encuestas.index', ['encuestas' => $query->paginate(20)]);
    }

    public function verEncuesta(Encuesta $encuesta)
    {
        return view('admin.encuestas.show', compact('encuesta'));
    }

    public function exportEncuestas()
    {
        $encuestas = Encuesta::all();
        $filename  = 'encuestas_'.now()->format('Ymd_His').'.csv';

        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($encuestas) {
            $out = fopen('php://output', 'w');
            // BOM para Excel
            fwrite($out, "\xEF\xBB\xBF");
            fputcsv($out, [
                'ID','Código Participante','Fecha','Fase','Institución','Nivel','Género','Curso',
                'Acceso Internet','Herramientas IA','Otra herramienta','Frecuencia IA',
                'C1','C2','C3','C4','C5','C6',
                'D1','D2','D3','D4','D5','D6','D7','D8',
                'E1','E2','E3','E4','E5','E6',
                'Prom C','Prom D','Prom E',
            ]);
            foreach ($encuestas as $e) {
                fputcsv($out, [
                    $e->id, $e->codigo_participante, $e->created_at->format('d/m/Y H:i'), $e->fase,
                    $e->institucion, $e->nivel_educativo, $e->genero,
                    $e->curso_actual, $e->acceso_internet,
                    implode('; ', $e->herramientas_ia ?? []),
                    $e->otra_herramienta, $e->frecuencia_ia,
                    $e->likert_c_1, $e->likert_c_2, $e->likert_c_3,
                    $e->likert_c_4, $e->likert_c_5, $e->likert_c_6,
                    $e->likert_d_1, $e->likert_d_2, $e->likert_d_3, $e->likert_d_4,
                    $e->likert_d_5, $e->likert_d_6, $e->likert_d_7, $e->likert_d_8,
                    $e->likert_e_1, $e->likert_e_2, $e->likert_e_3,
                    $e->likert_e_4, $e->likert_e_5, $e->likert_e_6,
                    round($e->promedioC(), 2),
                    round($e->promedioD(), 2),
                    round($e->promedioE(), 2),
                ]);
            }
            fclose($out);
        };

        return response()->stream($callback, 200, $headers);
    }

    // ── Entrevistas ───────────────────────────────────────────────────────────

    public function entrevistas()
    {
        return view('admin.entrevistas.index', [
            'entrevistas' => Entrevista::latest()->paginate(20),
        ]);
    }

    public function verEntrevista(Entrevista $entrevista)
    {
        return view('admin.entrevistas.show', compact('entrevista'));
    }

    public function exportEntrevistas()
    {
        $rows     = Entrevista::all();
        $filename = 'entrevistas_'.now()->format('Ymd_His').'.csv';

        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($rows) {
            $out = fopen('php://output', 'w');
            fwrite($out, "\xEF\xBB\xBF");
            fputcsv($out, [
                'ID','Fecha','Código','Institución','Modalidad','Experiencia',
                'Cursos','C1-P1','C1-P2','C1-P3',
                'C2-P1','C2-P2','C2-P3',
                'C3-P1','C3-P2','C3-P3',
                'C4-P1','C4-P2','Cierre','Observaciones',
            ]);
            foreach ($rows as $e) {
                fputcsv($out, [
                    $e->id, $e->created_at->format('d/m/Y H:i'),
                    $e->codigo_participante, $e->institucion,
                    $e->modalidad, $e->years_experiencia, $e->cursos_actuales,
                    $e->resp_cat1_p1, $e->resp_cat1_p2, $e->resp_cat1_p3,
                    $e->resp_cat2_p1, $e->resp_cat2_p2, $e->resp_cat2_p3,
                    $e->resp_cat3_p1, $e->resp_cat3_p2, $e->resp_cat3_p3,
                    $e->resp_cat4_p1, $e->resp_cat4_p2,
                    $e->resp_cierre, $e->observaciones,
                ]);
            }
            fclose($out);
        };

        return response()->stream($callback, 200, $headers);
    }

    // ── Pruebas ───────────────────────────────────────────────────────────────

    public function pruebas(Request $request)
    {
        $query = Prueba::latest();
        if ($request->fase) {
            $query->where('fase', $request->fase);
        }
        return view('admin.pruebas.index', ['pruebas' => $query->paginate(20)]);
    }

    public function verPrueba(Prueba $prueba)
    {
        return view('admin.pruebas.show', compact('prueba'));
    }

    public function exportPruebas()
    {
        $rows     = Prueba::all();
        $filename = 'pruebas_'.now()->format('Ymd_His').'.csv';

        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($rows) {
            $out = fopen('php://output', 'w');
            fwrite($out, "\xEF\xBB\xBF");
            fputcsv($out, [
                'ID','Código Participante','Fecha','Fase','Institución','Nivel',
                'A1','A2','A3',
                'B1-E1','B1-E2','B1-E3','B2-Resultado','B2-Corrección',
                'B3-Archivo','B3-NPE','B3-Acciones',
                'C1-ClienteDAO','C1-Formulario','C1-ServicioFactura',
                'C1-PanelPrincipal','C1-ProductoRepo',
                'C2-V1','C2-V2',
                'C3-Clases','C3-Flujo','C3-Justificación',
                'Puntaje',
            ]);
            foreach ($rows as $p) {
                fputcsv($out, [
                    $p->id, $p->codigo_participante, $p->created_at->format('d/m/Y H:i'),
                    $p->fase, $p->institucion, $p->nivel_educativo,
                    $p->resp_a1, $p->resp_a2, $p->resp_a3,
                    $p->resp_b1_error1, $p->resp_b1_error2, $p->resp_b1_error3,
                    $p->resp_b2_resultado, $p->resp_b2_correccion,
                    $p->resp_b3_archivo, $p->resp_b3_npe, $p->resp_b3_acciones,
                    $p->resp_c1_clientedao, $p->resp_c1_formulario,
                    $p->resp_c1_serviciofactura, $p->resp_c1_panelprincipal,
                    $p->resp_c1_productorepo,
                    $p->resp_c2_violacion1, $p->resp_c2_violacion2,
                    $p->resp_c3_clases, $p->resp_c3_flujo, $p->resp_c3_justificacion,
                    $p->puntaje_total,
                ]);
            }
            fclose($out);
        };

        return response()->stream($callback, 200, $headers);
    }
}

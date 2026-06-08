@extends('admin.layout')
@section('title', 'Entrevista #' . $entrevista->id)

@section('content')
<a href="{{ route('admin.entrevistas') }}" class="btn-back">← Volver a entrevistas</a>
<h2 class="page-title">Entrevista {{ $entrevista->codigo_participante }}</h2>

<div class="detail-section">
  <h3>Datos del participante</h3>
  <div class="detail-row"><span class="key">Código</span><span class="val" style="font-family:'JetBrains Mono',monospace">{{ $entrevista->codigo_participante }}</span></div>
  <div class="detail-row"><span class="key">Fecha y hora</span><span class="val">{{ $entrevista->fecha_hora }}</span></div>
  <div class="detail-row"><span class="key">Institución</span><span class="val">{{ $entrevista->institucion }}</span></div>
  <div class="detail-row"><span class="key">Modalidad</span><span class="val">{{ $entrevista->modalidad }}</span></div>
  <div class="detail-row"><span class="key">Experiencia docente</span><span class="val">{{ $entrevista->years_experiencia }}</span></div>
  <div class="detail-row"><span class="key">Cursos actuales</span><span class="val">{{ $entrevista->cursos_actuales ?: '—' }}</span></div>
  <div class="detail-row"><span class="key">Registrado en sistema</span><span class="val">{{ $entrevista->created_at->format('d/m/Y H:i') }}</span></div>
</div>

@php
$categorias = [
  'Categoría 1 — Dificultades de aprendizaje' => [
    ['P.E. 1.1', $entrevista->resp_cat1_p1],
    ['P.E. 1.2', $entrevista->resp_cat1_p2],
    ['P.E. 1.3', $entrevista->resp_cat1_p3],
  ],
  'Categoría 2 — Uso actual de IA por los estudiantes' => [
    ['P.E. 2.1', $entrevista->resp_cat2_p1],
    ['P.E. 2.2', $entrevista->resp_cat2_p2],
    ['P.E. 2.3', $entrevista->resp_cat2_p3],
  ],
  'Categoría 3 — Percepción del potencial pedagógico' => [
    ['P.E. 3.1', $entrevista->resp_cat3_p1],
    ['P.E. 3.2', $entrevista->resp_cat3_p2],
    ['P.E. 3.3', $entrevista->resp_cat3_p3],
  ],
  'Categoría 4 — Contexto institucional' => [
    ['P.E. 4.1', $entrevista->resp_cat4_p1],
    ['P.E. 4.2', $entrevista->resp_cat4_p2],
    ['Cierre', $entrevista->resp_cierre],
  ],
];
@endphp

@foreach($categorias as $titulo => $preguntas)
<div class="detail-section">
  <h3>{{ $titulo }}</h3>
  @foreach($preguntas as [$label, $resp])
    <div class="detail-row" style="align-items:flex-start">
      <span class="key" style="font-family:'JetBrains Mono',monospace">{{ $label }}</span>
      <span class="val" style="white-space:pre-wrap;line-height:1.7">{{ $resp ?: '(sin respuesta)' }}</span>
    </div>
  @endforeach
</div>
@endforeach

@if($entrevista->observaciones)
<div class="detail-section">
  <h3>Observaciones del entrevistador</h3>
  <p style="white-space:pre-wrap;font-size:0.87rem;line-height:1.7">{{ $entrevista->observaciones }}</p>
</div>
@endif
@endsection

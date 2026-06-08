@extends('admin.layout')
@section('title', 'Encuesta #' . $encuesta->id)

@section('content')
<a href="{{ route('admin.encuestas') }}" class="btn-back">← Volver a encuestas</a>
<h2 class="page-title">Encuesta #{{ $encuesta->id }} <span class="badge badge-{{ $encuesta->fase }}" style="font-size:0.8rem">{{ $encuesta->fase }}</span></h2>

<div class="detail-section">
  <h3>Datos generales</h3>
  <div class="detail-row"><span class="key">Fecha de envío</span><span class="val">{{ $encuesta->created_at->format('d/m/Y H:i') }}</span></div>
  <div class="detail-row"><span class="key">Institución</span><span class="val">{{ $encuesta->institucion }}</span></div>
  <div class="detail-row"><span class="key">Nivel educativo</span><span class="val">{{ $encuesta->nivel_educativo }}</span></div>
  <div class="detail-row"><span class="key">Género</span><span class="val">{{ $encuesta->genero }}</span></div>
  <div class="detail-row"><span class="key">Curso actual</span><span class="val">{{ $encuesta->curso_actual ?: '—' }}</span></div>
  <div class="detail-row"><span class="key">Acceso internet</span><span class="val">{{ $encuesta->acceso_internet }}</span></div>
  <div class="detail-row"><span class="key">Herramientas IA</span><span class="val">{{ implode(', ', $encuesta->herramientas_ia ?? []) ?: '—' }}</span></div>
  <div class="detail-row"><span class="key">Otra herramienta</span><span class="val">{{ $encuesta->otra_herramienta ?: '—' }}</span></div>
  <div class="detail-row"><span class="key">Frecuencia de uso IA</span><span class="val">{{ $encuesta->frecuencia_ia }}</span></div>
</div>

@php
$itemsC = [
  "Entiendo la diferencia entre una variable, un método y una clase.",
  "Soy capaz de escribir un programa en Java sin ayuda.",
  "Cuando mi código produce un error, sé cómo interpretar el mensaje.",
  "Puedo depurar un error de forma autónoma sin pedir ayuda.",
  "Comprendo qué significa 'separación de responsabilidades por capas'.",
  "Sería capaz de diseñar un sistema completo con arquitectura por capas.",
];
$itemsD = [
  "Utilizo IA para resolver dudas sobre sintaxis.",
  "Cuando la IA me genera código, comprendo completamente por qué está así.",
  "Utilizo la IA para identificar y corregir errores en mis programas.",
  "Uso IA para programar sin orientación docente sobre cómo hacerlo.",
  "El uso de IA me ha ayudado a aprender mejor programación.",
  "Me gustaría que el docente me enseñara a hacer preguntas efectivas a la IA.",
  "Cuando la IA me da una solución, la evalúo críticamente antes de aceptarla.",
  "El uso de IA en clase debería ir acompañado de guías claras del docente.",
];
$itemsE = [
  "Comprendo mejor la diferencia entre las capas de un sistema de software.",
  "El uso guiado de la IA me ayudó a entender el propósito arquitectónico del código.",
  "Soy más capaz de depurar errores de arquitectura de forma autónoma.",
  "Cambié la forma en que hago preguntas a la IA.",
  "Las actividades me ayudaron a pensar de manera más estructurada.",
  "Recomendaría el uso de guías de prompts en otros cursos.",
];
$dotClass = fn($v) => $v ? 'l'.$v : '';
@endphp

<div class="detail-section">
  <h3>Sección C — Competencias digitales (Promedio: {{ number_format($encuesta->promedioC(), 2) }})</h3>
  @foreach($itemsC as $i => $item)
    @php $v = $encuesta->{'likert_c_'.($i+1)}; @endphp
    <div class="detail-row">
      <span class="key">C{{ $i+1 }}</span>
      <span class="val" style="display:flex;align-items:center;gap:10px;flex-wrap:wrap">
        <div class="likert-mini">
          @for($x=1;$x<=5;$x++)
            <div class="likert-dot {{ $v == $x ? 'l'.$x : '' }}" style="{{ $v == $x ? '' : 'background:#eee;color:#aaa' }}">{{ $x }}</div>
          @endfor
        </div>
        <span style="font-size:0.82rem;color:#555">{{ $item }}</span>
      </span>
    </div>
  @endforeach
</div>

<div class="detail-section">
  <h3>Sección D — Percepción pedagógica de la IA (Promedio: {{ number_format($encuesta->promedioD(), 2) }})</h3>
  @foreach($itemsD as $i => $item)
    @php $v = $encuesta->{'likert_d_'.($i+1)}; @endphp
    <div class="detail-row">
      <span class="key">D{{ $i+1 }}</span>
      <span class="val" style="display:flex;align-items:center;gap:10px;flex-wrap:wrap">
        <div class="likert-mini">
          @for($x=1;$x<=5;$x++)
            <div class="likert-dot" style="{{ $v == $x ? 'background:var(--azul-medio);color:#fff' : 'background:#eee;color:#aaa' }}">{{ $x }}</div>
          @endfor
        </div>
        <span style="font-size:0.82rem;color:#555">{{ $item }}</span>
      </span>
    </div>
  @endforeach
</div>

@if($encuesta->fase === 'post')
<div class="detail-section">
  <h3>Sección E — Post-intervención (Promedio: {{ number_format($encuesta->promedioE(), 2) }})</h3>
  @foreach($itemsE as $i => $item)
    @php $v = $encuesta->{'likert_e_'.($i+1)}; @endphp
    <div class="detail-row">
      <span class="key">E{{ $i+1 }}</span>
      <span class="val" style="display:flex;align-items:center;gap:10px;flex-wrap:wrap">
        <div class="likert-mini">
          @for($x=1;$x<=5;$x++)
            <div class="likert-dot" style="{{ $v == $x ? 'background:var(--verde);color:#fff' : 'background:#eee;color:#aaa' }}">{{ $x }}</div>
          @endfor
        </div>
        <span style="font-size:0.82rem;color:#555">{{ $item }}</span>
      </span>
    </div>
  @endforeach
</div>
@endif
@endsection

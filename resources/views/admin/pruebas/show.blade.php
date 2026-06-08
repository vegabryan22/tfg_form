@extends('admin.layout')
@section('title', 'Prueba #' . $prueba->id)

@section('content')
<a href="{{ route('admin.pruebas') }}" class="btn-back">← Volver a pruebas</a>
<h2 class="page-title">
  Prueba #{{ $prueba->id }}
  <span class="badge badge-{{ $prueba->fase }}" style="font-size:0.8rem">{{ $prueba->fase }}</span>
  @if($prueba->puntaje_total !== null)
    <span style="font-family:'JetBrains Mono',monospace;font-size:0.85rem;color:var(--naranja);margin-left:12px">{{ $prueba->puntaje_total }}/100 pts</span>
  @endif
</h2>

<div class="detail-section">
  <h3>Identificación</h3>
  <div class="detail-row"><span class="key">Fecha</span><span class="val">{{ $prueba->created_at->format('d/m/Y H:i') }}</span></div>
  <div class="detail-row"><span class="key">Institución</span><span class="val">{{ $prueba->institucion ?? '—' }}</span></div>
  <div class="detail-row"><span class="key">Nivel educativo</span><span class="val">{{ $prueba->nivel_educativo ?? '—' }}</span></div>
</div>

<div class="detail-section">
  <h3>Dimensión A — Sintaxis (30 pts)</h3>
  @foreach(['resp_a1' => 'A1 · Clase Producto','resp_a2' => 'A2 · Herencia (ProductoDigital)','resp_a3' => 'A3 · Colecciones y ciclos'] as $field => $label)
    <div class="detail-row" style="align-items:flex-start">
      <span class="key" style="font-family:'JetBrains Mono',monospace">{{ $label }}</span>
      <pre style="font-family:'JetBrains Mono',monospace;font-size:0.78rem;background:#1A1A2E;color:#C9D1D9;padding:12px 14px;border-radius:4px;white-space:pre-wrap;flex:1;line-height:1.6">{{ $prueba->$field ?: '(sin respuesta)' }}</pre>
    </div>
  @endforeach
</div>

<div class="detail-section">
  <h3>Dimensión B — Depuración (30 pts)</h3>
  <div class="detail-row" style="align-items:flex-start"><span class="key">B1 Error 1</span><span class="val" style="white-space:pre-wrap">{{ $prueba->resp_b1_error1 ?: '—' }}</span></div>
  <div class="detail-row" style="align-items:flex-start"><span class="key">B1 Error 2</span><span class="val" style="white-space:pre-wrap">{{ $prueba->resp_b1_error2 ?: '—' }}</span></div>
  <div class="detail-row" style="align-items:flex-start"><span class="key">B1 Error 3</span><span class="val" style="white-space:pre-wrap">{{ $prueba->resp_b1_error3 ?: '—' }}</span></div>
  <div class="detail-row" style="align-items:flex-start"><span class="key">B2 ¿Qué produce?</span><span class="val" style="white-space:pre-wrap">{{ $prueba->resp_b2_resultado ?: '—' }}</span></div>
  <div class="detail-row" style="align-items:flex-start"><span class="key">B2 Corrección</span><span class="val" style="white-space:pre-wrap">{{ $prueba->resp_b2_correccion ?: '—' }}</span></div>
  <div class="detail-row"><span class="key">B3 Archivo/línea</span><span class="val">{{ $prueba->resp_b3_archivo ?: '—' }}</span></div>
  <div class="detail-row"><span class="key">B3 NullPointerException</span><span class="val">{{ $prueba->resp_b3_npe ?: '—' }}</span></div>
  <div class="detail-row" style="align-items:flex-start"><span class="key">B3 Acciones</span><span class="val" style="white-space:pre-wrap">{{ $prueba->resp_b3_acciones ?: '—' }}</span></div>
</div>

<div class="detail-section">
  <h3>Dimensión C — Arquitectura (40 pts)</h3>
  <h4 style="font-size:0.82rem;color:var(--azul);margin-bottom:12px;font-family:'JetBrains Mono',monospace">C1 · Identificación de capas</h4>
  @php
  $c1 = [
    'ClienteDAO' => $prueba->resp_c1_clientedao,
    'FormularioRegistro' => $prueba->resp_c1_formulario,
    'ServicioFactura' => $prueba->resp_c1_serviciofactura,
    'PanelPrincipal' => $prueba->resp_c1_panelprincipal,
    'ProductoRepository' => $prueba->resp_c1_productorepo,
  ];
  @endphp
  @foreach($c1 as $clase => $resp)
    <div class="detail-row">
      <span class="key" style="font-family:'JetBrains Mono',monospace">{{ $clase }}</span>
      <span class="val">{{ $resp ?: '—' }}</span>
    </div>
  @endforeach
  <div style="margin-top:16px">
    <div class="detail-row" style="align-items:flex-start"><span class="key">C2 Violación 1</span><span class="val" style="white-space:pre-wrap">{{ $prueba->resp_c2_violacion1 ?: '—' }}</span></div>
    <div class="detail-row" style="align-items:flex-start"><span class="key">C2 Violación 2</span><span class="val" style="white-space:pre-wrap">{{ $prueba->resp_c2_violacion2 ?: '—' }}</span></div>
    <div class="detail-row" style="align-items:flex-start"><span class="key">C3 Clases propuestas</span><span class="val" style="white-space:pre-wrap">{{ $prueba->resp_c3_clases ?: '—' }}</span></div>
    <div class="detail-row" style="align-items:flex-start"><span class="key">C3 Flujo por capas</span><span class="val" style="white-space:pre-wrap">{{ $prueba->resp_c3_flujo ?: '—' }}</span></div>
    <div class="detail-row" style="align-items:flex-start"><span class="key">C3 Justificación</span><span class="val" style="white-space:pre-wrap">{{ $prueba->resp_c3_justificacion ?: '—' }}</span></div>
  </div>
</div>
@endsection

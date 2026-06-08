@extends('admin.layout')
@section('title', 'Dashboard')

@section('content')
<h2 class="page-title">Dashboard</h2>

<div class="stat-grid">
  <div class="stat-card">
    <div class="num">{{ $totalEncuestas }}</div>
    <div class="label">Encuestas (Instrumento 1)</div>
  </div>
  <div class="stat-card orange">
    <div class="num">{{ $encuestasPre }}</div>
    <div class="label">Encuestas pre-intervención</div>
  </div>
  <div class="stat-card green">
    <div class="num">{{ $encuestasPost }}</div>
    <div class="label">Encuestas post-intervención</div>
  </div>
  <div class="stat-card">
    <div class="num">{{ $totalEntrevistas }}</div>
    <div class="label">Entrevistas (Instrumento 2)</div>
  </div>
  <div class="stat-card orange">
    <div class="num">{{ $totalPruebas }}</div>
    <div class="label">Pruebas (Instrumento 3)</div>
  </div>
  <div class="stat-card green">
    <div class="num">{{ $pruebasPre + $pruebasPost }}</div>
    <div class="label">Pre: {{ $pruebasPre }} / Post: {{ $pruebasPost }}</div>
  </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:20px">

  {{-- ÚLTIMAS ENCUESTAS --}}
  <div class="section-card">
    <div class="section-card-header">
      ÚLTIMAS ENCUESTAS
      <span class="count">{{ $totalEncuestas }}</span>
    </div>
    <table class="data-table">
      <thead><tr><th>Fecha</th><th>Inst.</th><th>Fase</th><th></th></tr></thead>
      <tbody>
        @forelse($ultimasEncuestas as $e)
        <tr>
          <td style="font-family:'JetBrains Mono',monospace;font-size:0.75rem">{{ $e->created_at->format('d/m/y') }}</td>
          <td style="font-size:0.78rem">{{ Str::limit($e->institucion, 14) }}</td>
          <td><span class="badge badge-{{ $e->fase }}">{{ $e->fase }}</span></td>
          <td><a href="{{ route('admin.encuesta.show', $e) }}" class="btn-sm">Ver</a></td>
        </tr>
        @empty
        <tr><td colspan="4" style="color:#999;font-size:0.82rem;padding:14px">Sin registros aún.</td></tr>
        @endforelse
      </tbody>
    </table>
    <div style="padding:10px 14px;border-top:1px solid var(--borde)">
      <a href="{{ route('admin.encuestas') }}" style="font-size:0.8rem;color:var(--azul-medio)">Ver todos →</a>
    </div>
  </div>

  {{-- ÚLTIMAS ENTREVISTAS --}}
  <div class="section-card">
    <div class="section-card-header">
      ÚLTIMAS ENTREVISTAS
      <span class="count">{{ $totalEntrevistas }}</span>
    </div>
    <table class="data-table">
      <thead><tr><th>Fecha</th><th>Código</th><th>Inst.</th><th></th></tr></thead>
      <tbody>
        @forelse($ultimasEntrevistas as $e)
        <tr>
          <td style="font-family:'JetBrains Mono',monospace;font-size:0.75rem">{{ $e->created_at->format('d/m/y') }}</td>
          <td style="font-family:'JetBrains Mono',monospace;font-size:0.75rem">{{ $e->codigo_participante }}</td>
          <td style="font-size:0.78rem">{{ Str::limit($e->institucion, 14) }}</td>
          <td><a href="{{ route('admin.entrevista.show', $e) }}" class="btn-sm">Ver</a></td>
        </tr>
        @empty
        <tr><td colspan="4" style="color:#999;font-size:0.82rem;padding:14px">Sin registros aún.</td></tr>
        @endforelse
      </tbody>
    </table>
    <div style="padding:10px 14px;border-top:1px solid var(--borde)">
      <a href="{{ route('admin.entrevistas') }}" style="font-size:0.8rem;color:var(--azul-medio)">Ver todas →</a>
    </div>
  </div>

  {{-- ÚLTIMAS PRUEBAS --}}
  <div class="section-card">
    <div class="section-card-header">
      ÚLTIMAS PRUEBAS
      <span class="count">{{ $totalPruebas }}</span>
    </div>
    <table class="data-table">
      <thead><tr><th>Fecha</th><th>Inst.</th><th>Fase</th><th></th></tr></thead>
      <tbody>
        @forelse($ultimasPruebas as $p)
        <tr>
          <td style="font-family:'JetBrains Mono',monospace;font-size:0.75rem">{{ $p->created_at->format('d/m/y') }}</td>
          <td style="font-size:0.78rem">{{ Str::limit($p->institucion ?? '—', 14) }}</td>
          <td><span class="badge badge-{{ $p->fase }}">{{ $p->fase }}</span></td>
          <td><a href="{{ route('admin.prueba.show', $p) }}" class="btn-sm">Ver</a></td>
        </tr>
        @empty
        <tr><td colspan="4" style="color:#999;font-size:0.82rem;padding:14px">Sin registros aún.</td></tr>
        @endforelse
      </tbody>
    </table>
    <div style="padding:10px 14px;border-top:1px solid var(--borde)">
      <a href="{{ route('admin.pruebas') }}" style="font-size:0.8rem;color:var(--azul-medio)">Ver todas →</a>
    </div>
  </div>

</div>
@endsection

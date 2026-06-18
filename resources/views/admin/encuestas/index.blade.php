@extends('admin.layout')
@section('title', 'Encuestas')

@section('content')
<h2 class="page-title">Encuestas Likert — Instrumento 1</h2>

<div style="display:flex;gap:12px;align-items:center;margin-bottom:16px;flex-wrap:wrap">
  <a href="{{ route('admin.encuestas.export') }}" class="btn-export">↓ Exportar CSV</a>
  <form method="GET" style="display:flex;gap:8px;align-items:center">
    <select name="fase" onchange="this.form.submit()" style="padding:8px 12px;border:1px solid var(--borde);border-radius:4px;font-size:0.83rem">
      <option value="">Todas las fases</option>
      <option value="pre" {{ request('fase') == 'pre' ? 'selected' : '' }}>Pre-intervención</option>
      <option value="post" {{ request('fase') == 'post' ? 'selected' : '' }}>Post-intervención</option>
    </select>
  </form>
</div>

<div class="section-card">
  <table class="data-table">
    <thead>
      <tr>
        <th>#</th><th>Código</th><th>Fecha</th><th>Fase</th><th>Institución</th>
        <th>Nivel</th><th>Género</th><th>Prom C</th><th>Prom D</th><th>Prom E</th><th></th>
      </tr>
    </thead>
    <tbody>
      @forelse($encuestas as $e)
      <tr>
        <td style="font-family:'JetBrains Mono',monospace;font-size:0.75rem;color:#999">{{ $e->id }}</td>
        <td style="font-family:'JetBrains Mono',monospace;font-size:0.82rem;font-weight:700;color:var(--azul)">{{ $e->codigo_participante ?? '—' }}</td>
        <td style="font-family:'JetBrains Mono',monospace;font-size:0.75rem">{{ $e->created_at->format('d/m/y H:i') }}</td>
        <td><span class="badge badge-{{ $e->fase }}">{{ $e->fase }}</span></td>
        <td style="font-size:0.82rem">{{ $e->institucion }}</td>
        <td style="font-size:0.8rem">{{ $e->nivel_educativo }}</td>
        <td style="font-size:0.8rem">{{ $e->genero }}</td>
        <td style="font-family:'JetBrains Mono',monospace;font-size:0.8rem">{{ number_format($e->promedioC(), 1) }}</td>
        <td style="font-family:'JetBrains Mono',monospace;font-size:0.8rem">{{ number_format($e->promedioD(), 1) }}</td>
        <td style="font-family:'JetBrains Mono',monospace;font-size:0.8rem">{{ $e->fase == 'post' ? number_format($e->promedioE(), 1) : '—' }}</td>
        <td><a href="{{ route('admin.encuesta.show', $e) }}" class="btn-sm">Ver</a></td>
      </tr>
      @empty
      <tr><td colspan="10" style="color:#999;padding:20px;text-align:center">No hay encuestas registradas aún.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>

<div class="pagination">
  {{ $encuestas->links() }}
</div>
@endsection

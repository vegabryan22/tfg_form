@extends('admin.layout')
@section('title', 'Pruebas')

@section('content')
<h2 class="page-title">Pruebas Diagnósticas — Instrumento 3</h2>

<div style="display:flex;gap:12px;align-items:center;margin-bottom:16px;flex-wrap:wrap">
  <a href="{{ route('admin.pruebas.export') }}" class="btn-export">↓ Exportar CSV</a>
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
      <tr><th>#</th><th>Código</th><th>Fecha</th><th>Fase</th><th>Institución</th><th>Nivel</th><th>Puntaje</th><th></th></tr>
    </thead>
    <tbody>
      @forelse($pruebas as $p)
      <tr>
        <td style="font-family:'JetBrains Mono',monospace;font-size:0.75rem;color:#999">{{ $p->id }}</td>
        <td style="font-family:'JetBrains Mono',monospace;font-size:0.82rem;font-weight:700;color:var(--azul)">{{ $p->codigo_participante ?? '—' }}</td>
        <td style="font-family:'JetBrains Mono',monospace;font-size:0.75rem">{{ $p->created_at->format('d/m/y H:i') }}</td>
        <td><span class="badge badge-{{ $p->fase }}">{{ $p->fase }}</span></td>
        <td style="font-size:0.82rem">{{ $p->institucion ?? '—' }}</td>
        <td style="font-size:0.8rem">{{ $p->nivel_educativo ?? '—' }}</td>
        <td style="font-family:'JetBrains Mono',monospace;font-size:0.85rem">
          {{ $p->puntaje_total !== null ? $p->puntaje_total . '/100' : '—' }}
        </td>
        <td><a href="{{ route('admin.prueba.show', $p) }}" class="btn-sm">Ver</a></td>
      </tr>
      @empty
      <tr><td colspan="7" style="color:#999;padding:20px;text-align:center">No hay pruebas registradas aún.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>

<div class="pagination">{{ $pruebas->links() }}</div>
@endsection

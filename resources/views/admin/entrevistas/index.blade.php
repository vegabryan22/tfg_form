@extends('admin.layout')
@section('title', 'Entrevistas')

@section('content')
<h2 class="page-title">Entrevistas Docentes — Instrumento 2</h2>

<a href="{{ route('admin.entrevistas.export') }}" class="btn-export" style="margin-bottom:16px;display:inline-flex">↓ Exportar CSV</a>

<div class="section-card">
  <table class="data-table">
    <thead>
      <tr><th>#</th><th>Fecha</th><th>Código</th><th>Institución</th><th>Modalidad</th><th>Experiencia</th><th></th></tr>
    </thead>
    <tbody>
      @forelse($entrevistas as $e)
      <tr>
        <td style="font-family:'JetBrains Mono',monospace;font-size:0.75rem;color:#999">{{ $e->id }}</td>
        <td style="font-family:'JetBrains Mono',monospace;font-size:0.75rem">{{ $e->created_at->format('d/m/y H:i') }}</td>
        <td style="font-family:'JetBrains Mono',monospace;font-size:0.8rem">{{ $e->codigo_participante }}</td>
        <td style="font-size:0.82rem">{{ $e->institucion }}</td>
        <td style="font-size:0.8rem">{{ $e->modalidad }}</td>
        <td style="font-size:0.8rem">{{ $e->years_experiencia }}</td>
        <td><a href="{{ route('admin.entrevista.show', $e) }}" class="btn-sm">Ver</a></td>
      </tr>
      @empty
      <tr><td colspan="7" style="color:#999;padding:20px;text-align:center">No hay entrevistas registradas aún.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>

<div class="pagination">{{ $entrevistas->links() }}</div>
@endsection

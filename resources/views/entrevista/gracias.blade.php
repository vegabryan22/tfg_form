@extends('layouts.app')
@section('title', 'Entrevista registrada')

@section('content')
<div style="text-align:center;padding:60px 20px">
  <div style="font-size:3rem;margin-bottom:16px">✓</div>
  <h2 style="font-family:'Playfair Display',serif;color:var(--azul);font-size:1.8rem;margin-bottom:12px">¡Entrevista guardada!</h2>
  <p style="color:#555;max-width:480px;margin:0 auto 32px">El registro de entrevista se ha guardado correctamente.</p>
  <a href="{{ route('entrevista.show') }}" class="btn-secondary">Registrar otra entrevista</a>
</div>
@endsection

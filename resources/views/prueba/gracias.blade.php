@extends('layouts.app')
@section('title', 'Prueba registrada')

@section('content')
<div style="text-align:center;padding:60px 20px">
  <div style="font-size:3rem;margin-bottom:16px">✓</div>
  <h2 style="font-family:'Playfair Display',serif;color:var(--azul);font-size:1.8rem;margin-bottom:12px">¡Prueba registrada!</h2>
  <p style="color:#555;max-width:480px;margin:0 auto 32px">Las respuestas de la prueba diagnóstica se han guardado correctamente.</p>
  <a href="{{ route('prueba.show') }}" class="btn-secondary">Registrar otra prueba</a>
</div>
@endsection

@extends('layouts.app')
@section('title', 'Respuesta registrada')

@section('content')
<div style="text-align:center;padding:60px 20px">
  <div style="font-size:3rem;margin-bottom:16px">✓</div>
  <h2 style="font-family:'Playfair Display',serif;color:var(--azul);font-size:1.8rem;margin-bottom:12px">¡Respuesta registrada!</h2>
  <p style="color:#555;max-width:480px;margin:0 auto 32px">Tu encuesta ha sido guardada correctamente. Muchas gracias por participar en esta investigación.</p>
  <a href="{{ route('encuesta.show') }}" class="btn-secondary">Registrar otra respuesta</a>
</div>
@endsection

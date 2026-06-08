<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Acceso Administrador — TFG</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Source+Serif+4:wght@0,400;0,600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
  :root { --azul:#1A3A5C; --naranja:#D4702A; --borde:#C8D8E8; --crema:#FAF7F2; }
  * { box-sizing:border-box; margin:0; padding:0; }
  body { font-family:'Source Serif 4',serif; background:var(--azul); min-height:100vh; display:flex; align-items:center; justify-content:center; }
  .card { background:#fff; border-radius:4px; padding:40px 48px; width:100%; max-width:400px; box-shadow:0 8px 40px rgba(0,0,0,0.3); }
  .card h1 { font-family:'Playfair Display',serif; color:var(--azul); font-size:1.4rem; margin-bottom:4px; }
  .card p { font-size:0.82rem; color:#777; font-family:'JetBrains Mono',monospace; margin-bottom:28px; }
  label { display:block; font-size:0.88rem; font-weight:600; color:var(--azul); margin-bottom:6px; }
  input[type="password"] { width:100%; padding:10px 14px; border:1.5px solid var(--borde); border-radius:4px; font-family:'Source Serif 4',serif; font-size:0.9rem; background:var(--crema); outline:none; }
  input[type="password"]:focus { border-color:var(--azul); }
  .btn { width:100%; margin-top:20px; padding:12px; background:var(--naranja); color:#fff; border:none; border-radius:4px; font-family:'Source Serif 4',serif; font-size:0.95rem; font-weight:600; cursor:pointer; }
  .btn:hover { background:#b85e22; }
  .error { background:#fde8e8; border-left:4px solid #c0392b; padding:10px 14px; margin-bottom:20px; font-size:0.85rem; color:#7b1f1f; border-radius:0 4px 4px 0; }
  .orange { color:var(--naranja); }
</style>
</head>
<body>
<div class="card">
  <h1>Panel <span class="orange">Administrativo</span></h1>
  <p>TFG Bryan Vega Rondón · USM 2026</p>

  @if(session('error'))
    <div class="error">{{ session('error') }}</div>
  @endif

  @if($errors->has('password'))
    <div class="error">{{ $errors->first('password') }}</div>
  @endif

  <form method="POST" action="{{ route('admin.authenticate') }}">
    @csrf
    <label for="password">Contraseña de administrador</label>
    <input type="password" id="password" name="password" autofocus required placeholder="••••••••">
    <button type="submit" class="btn">Ingresar →</button>
  </form>
</div>
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Instrumentos TFG') – Bryan Vega Rondón</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Source+Serif+4:ital,wght@0,300;0,400;0,600;1,400&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
  :root {
    --azul: #1A3A5C; --azul-medio: #2E6DA4; --azul-claro: #D6E8F7;
    --naranja: #D4702A; --crema: #FAF7F2; --gris-texto: #2C2C2C;
    --gris-leve: #F0EDE8; --verde-ok: #2E7D32; --borde: #C8D8E8;
  }
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body { font-family: 'Source Serif 4', Georgia, serif; background: var(--crema); color: var(--gris-texto); line-height: 1.7; }

  nav {
    background: var(--azul); position: sticky; top: 0; z-index: 100;
    display: flex; align-items: center; gap: 0;
    border-bottom: 3px solid var(--naranja);
  }
  .nav-brand {
    padding: 14px 24px; color: #fff; font-family: 'Playfair Display', serif;
    font-size: 0.95rem; border-right: 1px solid rgba(255,255,255,0.15); min-width: 260px;
  }
  .nav-brand span { color: var(--naranja); font-size: 0.75rem; display: block; font-family: 'JetBrains Mono', monospace; letter-spacing: 0.05em; margin-top: 2px; }
  .nav-tabs { display: flex; flex: 1; overflow-x: auto; }
  .nav-tab {
    display: block; padding: 16px 22px; color: rgba(255,255,255,0.65);
    cursor: pointer; font-size: 0.85rem; white-space: nowrap;
    border-bottom: 3px solid transparent; margin-bottom: -3px; transition: all 0.2s;
    font-family: 'Source Serif 4', serif; letter-spacing: 0.01em; text-decoration: none;
  }
  .nav-tab:hover { color: #fff; background: rgba(255,255,255,0.06); }
  .nav-tab.active { color: #fff; border-bottom-color: var(--naranja); background: rgba(255,255,255,0.08); }
  .nav-tab .tab-num { font-family: 'JetBrains Mono', monospace; font-size: 0.7rem; color: var(--naranja); display: block; }

  main { max-width: 860px; margin: 0 auto; padding: 40px 24px 80px; }

  .instrumento-header {
    background: var(--azul); color: #fff; padding: 32px 36px;
    border-radius: 2px 2px 0 0; position: relative; overflow: hidden;
  }
  .instrumento-header::after {
    content: ''; position: absolute; right: -20px; top: -20px;
    width: 140px; height: 140px; border-radius: 50%; background: rgba(255,255,255,0.04);
  }
  .instrumento-header h1 { font-family: 'Playfair Display', serif; font-size: 1.55rem; line-height: 1.3; margin-bottom: 8px; }
  .instrumento-header .meta { font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; color: rgba(255,255,255,0.6); letter-spacing: 0.08em; text-transform: uppercase; }
  .instrumento-header .meta span { color: var(--naranja); }

  .instrumento-body { background: #fff; border: 1px solid var(--borde); border-top: none; border-radius: 0 0 2px 2px; padding: 32px 36px; }

  .instrucciones { background: var(--azul-claro); border-left: 4px solid var(--azul-medio); padding: 16px 20px; margin-bottom: 32px; font-size: 0.9rem; border-radius: 0 4px 4px 0; }
  .instrucciones strong { color: var(--azul); display: block; margin-bottom: 4px; font-size: 0.8rem; font-family: 'JetBrains Mono', monospace; text-transform: uppercase; letter-spacing: 0.06em; }

  .bloque { margin-bottom: 36px; }
  .bloque-titulo { font-family: 'Playfair Display', serif; font-size: 1.05rem; color: var(--azul); border-bottom: 2px solid var(--azul-claro); padding-bottom: 8px; margin-bottom: 20px; }
  .bloque-titulo .num { font-family: 'JetBrains Mono', monospace; font-size: 0.8rem; color: var(--naranja); display: block; margin-bottom: 4px; }

  .campo { margin-bottom: 22px; }
  .campo label { display: block; font-size: 0.88rem; font-weight: 600; color: var(--azul); margin-bottom: 6px; }
  .campo label .req { color: var(--naranja); }
  .campo input[type="text"], .campo input[type="email"], .campo input[type="number"],
  .campo select, .campo textarea {
    width: 100%; padding: 10px 14px; border: 1.5px solid var(--borde); border-radius: 4px;
    font-family: 'Source Serif 4', serif; font-size: 0.9rem; background: var(--crema);
    color: var(--gris-texto); transition: border-color 0.2s; outline: none;
  }
  .campo input:focus, .campo select:focus, .campo textarea:focus { border-color: var(--azul-medio); background: #fff; }
  .campo textarea { min-height: 90px; resize: vertical; }
  .campo .error-msg { color: #c0392b; font-size: 0.8rem; margin-top: 4px; font-family: 'JetBrains Mono', monospace; }

  .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

  .likert-wrap { overflow-x: auto; }
  .likert-table { width: 100%; border-collapse: collapse; font-size: 0.85rem; margin-bottom: 8px; }
  .likert-table th { background: var(--azul); color: #fff; padding: 10px 8px; text-align: center; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; letter-spacing: 0.04em; font-weight: 500; }
  .likert-table th.th-item { text-align: left; padding-left: 16px; min-width: 320px; }
  .likert-table td { padding: 12px 8px; border-bottom: 1px solid var(--gris-leve); text-align: center; vertical-align: middle; }
  .likert-table td.td-item { text-align: left; padding-left: 16px; font-size: 0.87rem; line-height: 1.5; color: var(--gris-texto); }
  .likert-table tr:nth-child(even) td { background: var(--crema); }
  .likert-table tr:hover td { background: var(--azul-claro); }
  input[type="radio"] { accent-color: var(--azul-medio); width: 18px; height: 18px; cursor: pointer; }

  .escala-ref { display: flex; gap: 6px; flex-wrap: wrap; margin-bottom: 16px; font-size: 0.78rem; font-family: 'JetBrains Mono', monospace; }
  .escala-ref span { background: var(--azul); color: #fff; padding: 3px 10px; border-radius: 20px; }
  .escala-ref span em { color: var(--naranja); font-style: normal; margin-right: 4px; }

  .checkbox-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 16px; }
  .checkbox-item { display: flex; align-items: center; gap: 10px; font-size: 0.88rem; cursor: pointer; padding: 10px 14px; border: 1.5px solid var(--borde); border-radius: 4px; background: var(--crema); }
  .checkbox-item input[type="checkbox"] { accent-color: var(--azul-medio); width: 16px; height: 16px; flex-shrink: 0; }

  .pregunta-entrevista { background: #fff; border: 1px solid var(--borde); border-left: 4px solid var(--azul-medio); padding: 16px 20px; margin-bottom: 16px; border-radius: 0 4px 4px 0; }
  .pregunta-entrevista .pnum { font-family: 'JetBrains Mono', monospace; font-size: 0.7rem; color: var(--naranja); text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 6px; }
  .pregunta-entrevista .ptexto { font-size: 0.92rem; color: var(--gris-texto); margin-bottom: 10px; font-weight: 600; }
  .pregunta-entrevista .subpregs { list-style: none; padding-left: 12px; border-left: 2px solid var(--borde); margin: 8px 0 12px; }
  .pregunta-entrevista .subpregs li { font-size: 0.83rem; color: #555; padding: 3px 0; font-style: italic; }
  .pregunta-entrevista .subpregs li::before { content: "→ "; color: var(--azul-medio); font-style: normal; }

  .ejercicio { background: #fff; border: 1px solid var(--borde); padding: 20px 24px; margin-bottom: 20px; border-radius: 4px; position: relative; }
  .ejercicio .etiqueta { font-family: 'JetBrains Mono', monospace; font-size: 0.68rem; text-transform: uppercase; letter-spacing: 0.08em; color: #fff; background: var(--azul-medio); padding: 2px 10px; border-radius: 20px; display: inline-block; margin-bottom: 10px; }
  .ejercicio .etiqueta.dim2 { background: var(--naranja); }
  .ejercicio .etiqueta.dim3 { background: var(--verde-ok); }
  .ejercicio h4 { font-size: 0.92rem; color: var(--azul); margin-bottom: 10px; }
  .ejercicio .pts { font-family: 'JetBrains Mono', monospace; font-size: 0.7rem; color: var(--naranja); position: absolute; top: 16px; right: 18px; }
  .ejercicio .codigo { font-family: 'JetBrains Mono', monospace; font-size: 0.82rem; background: #1A1A2E; color: #C9D1D9; padding: 16px 18px; border-radius: 4px; overflow-x: auto; line-height: 1.6; margin: 12px 0; white-space: pre; }
  .ejercicio .kw { color: #FF7B72; } .ejercicio .str { color: #A5D6FF; }
  .ejercicio .cm { color: #8B949E; font-style: italic; } .ejercicio .cls { color: #FFA657; }
  .ejercicio .fn { color: #D2A8FF; }

  .btn-submit { display: inline-flex; align-items: center; gap: 8px; background: var(--naranja); color: #fff; padding: 13px 32px; border: none; border-radius: 4px; cursor: pointer; font-family: 'Source Serif 4', serif; font-size: 0.95rem; margin-top: 32px; transition: background 0.2s; font-weight: 600; }
  .btn-submit:hover { background: #b85e22; }
  .btn-secondary { display: inline-flex; align-items: center; gap: 8px; background: var(--azul); color: #fff; padding: 10px 22px; border: none; border-radius: 4px; cursor: pointer; font-family: 'Source Serif 4', serif; font-size: 0.88rem; margin-top: 8px; transition: background 0.2s; text-decoration: none; }
  .btn-secondary:hover { background: var(--azul-medio); }

  .nota-pie { font-size: 0.8rem; color: #777; font-style: italic; border-top: 1px solid var(--borde); padding-top: 16px; margin-top: 32px; }

  .alert-error { background: #fde8e8; border-left: 4px solid #c0392b; padding: 14px 18px; margin-bottom: 24px; border-radius: 0 4px 4px 0; font-size: 0.88rem; color: #7b1f1f; }
  .alert-success { background: #e8f5e9; border-left: 4px solid var(--verde-ok); padding: 14px 18px; margin-bottom: 24px; border-radius: 0 4px 4px 0; font-size: 0.88rem; color: #1b5e20; }

  @media (max-width: 600px) {
    .grid-2 { grid-template-columns: 1fr; }
    .checkbox-grid { grid-template-columns: 1fr; }
    .instrumento-body, .instrumento-header { padding: 20px 18px; }
    .nav-brand { min-width: unset; }
  }
</style>
@stack('styles')
</head>
<body>

<nav>
  <div class="nav-brand">
    Instrumentos TFG
    <span>Bryan Vega Rondón · <span>USM 2026</span></span>
  </div>
  <div class="nav-tabs">
    <a class="nav-tab {{ request()->routeIs('encuesta.*') ? 'active' : '' }}" href="{{ route('encuesta.show') }}">
      <span class="tab-num">Instrumento 1</span>
      Encuesta Likert — Estudiantes
    </a>
    <a class="nav-tab {{ request()->routeIs('entrevista.*') ? 'active' : '' }}" href="{{ route('entrevista.show') }}">
      <span class="tab-num">Instrumento 2</span>
      Cuestionario — Docentes
    </a>
    <a class="nav-tab {{ request()->routeIs('prueba.*') ? 'active' : '' }}" href="{{ route('prueba.show') }}">
      <span class="tab-num">Instrumento 3</span>
      Prueba Diagnóstica — Programación
    </a>
  </div>
</nav>

<main>
  @yield('content')
</main>

@stack('scripts')
</body>
</html>

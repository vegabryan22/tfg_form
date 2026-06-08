<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Admin') — TFG Panel</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Source+Serif+4:wght@0,400;0,600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
  :root { --azul:#1A3A5C; --azul-medio:#2E6DA4; --azul-claro:#D6E8F7; --naranja:#D4702A; --crema:#FAF7F2; --borde:#C8D8E8; --verde:#2E7D32; }
  * { box-sizing:border-box; margin:0; padding:0; }
  body { font-family:'Source Serif 4',serif; background:#f4f6f9; color:#2C2C2C; }
  .topbar { background:var(--azul); color:#fff; padding:0 24px; display:flex; align-items:center; justify-content:space-between; border-bottom:3px solid var(--naranja); position:sticky; top:0; z-index:100; }
  .topbar-brand { font-family:'Playfair Display',serif; padding:14px 0; font-size:1rem; }
  .topbar-brand span { color:var(--naranja); font-size:0.7rem; display:block; font-family:'JetBrains Mono',monospace; }
  .topbar-nav { display:flex; gap:4px; }
  .topbar-nav a { color:rgba(255,255,255,0.7); padding:10px 14px; text-decoration:none; font-size:0.82rem; border-radius:4px; transition:all 0.2s; }
  .topbar-nav a:hover, .topbar-nav a.active { color:#fff; background:rgba(255,255,255,0.1); }
  .topbar-form button { background:none; border:1px solid rgba(255,255,255,0.3); color:rgba(255,255,255,0.7); padding:8px 14px; border-radius:4px; cursor:pointer; font-size:0.8rem; }
  .topbar-form button:hover { background:rgba(255,255,255,0.1); color:#fff; }
  .content { max-width:1100px; margin:0 auto; padding:32px 24px 60px; }
  .page-title { font-family:'Playfair Display',serif; color:var(--azul); font-size:1.5rem; margin-bottom:24px; }
  .stat-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(160px,1fr)); gap:16px; margin-bottom:32px; }
  .stat-card { background:#fff; border:1px solid var(--borde); border-radius:4px; padding:20px 22px; }
  .stat-card .num { font-family:'JetBrains Mono',monospace; font-size:2rem; color:var(--azul); font-weight:700; }
  .stat-card .label { font-size:0.78rem; color:#777; margin-top:4px; }
  .stat-card.orange .num { color:var(--naranja); }
  .stat-card.green .num { color:var(--verde); }
  table.data-table { width:100%; border-collapse:collapse; font-size:0.85rem; background:#fff; }
  table.data-table th { background:var(--azul); color:#fff; padding:10px 14px; text-align:left; font-family:'JetBrains Mono',monospace; font-size:0.72rem; letter-spacing:0.04em; }
  table.data-table td { padding:10px 14px; border-bottom:1px solid var(--borde); vertical-align:top; }
  table.data-table tr:hover td { background:var(--azul-claro); }
  .badge { font-family:'JetBrains Mono',monospace; font-size:0.68rem; padding:2px 8px; border-radius:20px; font-weight:700; }
  .badge-pre { background:#fff3cd; color:#856404; }
  .badge-post { background:#d1ecf1; color:#0c5460; }
  .btn-sm { display:inline-block; padding:4px 12px; background:var(--azul); color:#fff; text-decoration:none; border-radius:3px; font-size:0.78rem; font-family:'JetBrains Mono',monospace; }
  .btn-sm:hover { background:var(--azul-medio); }
  .btn-export { display:inline-flex; align-items:center; gap:6px; padding:9px 18px; background:var(--verde); color:#fff; text-decoration:none; border-radius:4px; font-size:0.83rem; margin-bottom:16px; }
  .btn-export:hover { background:#1b5e20; }
  .btn-back { display:inline-flex; align-items:center; gap:6px; padding:8px 16px; background:var(--azul); color:#fff; text-decoration:none; border-radius:4px; font-size:0.83rem; margin-bottom:20px; }
  .btn-back:hover { background:var(--azul-medio); }
  .detail-section { background:#fff; border:1px solid var(--borde); border-radius:4px; padding:24px 28px; margin-bottom:20px; }
  .detail-section h3 { font-family:'Playfair Display',serif; color:var(--azul); font-size:1rem; border-bottom:2px solid var(--azul-claro); padding-bottom:8px; margin-bottom:16px; }
  .detail-row { display:flex; gap:16px; margin-bottom:10px; font-size:0.87rem; }
  .detail-row .key { font-family:'JetBrains Mono',monospace; font-size:0.72rem; color:#777; min-width:180px; padding-top:2px; }
  .detail-row .val { color:#2C2C2C; line-height:1.6; }
  .likert-mini { display:flex; gap:4px; align-items:center; }
  .likert-dot { width:22px; height:22px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-family:'JetBrains Mono',monospace; font-size:0.65rem; font-weight:700; }
  .l1{background:#e53935;color:#fff;} .l2{background:#e57373;color:#fff;} .l3{background:#ffd54f;color:#333;}
  .l4{background:#81c784;color:#fff;} .l5{background:#388e3c;color:#fff;}
  .pagination { display:flex; gap:4px; margin-top:16px; justify-content:center; }
  .pagination a, .pagination span { padding:6px 12px; border:1px solid var(--borde); border-radius:3px; font-size:0.82rem; text-decoration:none; color:var(--azul); }
  .pagination .active span, .pagination span.current { background:var(--azul); color:#fff; border-color:var(--azul); }
  .section-card { background:#fff; border:1px solid var(--borde); border-radius:4px; overflow:hidden; }
  .section-card-header { background:var(--azul); color:#fff; padding:12px 18px; font-family:'JetBrains Mono',monospace; font-size:0.75rem; letter-spacing:0.06em; display:flex; justify-content:space-between; align-items:center; }
  .section-card-header .count { color:var(--naranja); font-size:0.9rem; }
</style>
</head>
<body>

<div class="topbar">
  <div class="topbar-brand">
    Panel de Administración
    <span>TFG Bryan Vega Rondón · USM 2026</span>
  </div>
  <div style="display:flex;align-items:center;gap:12px">
    <nav class="topbar-nav">
      <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
      <a href="{{ route('admin.encuestas') }}" class="{{ request()->routeIs('admin.encuestas*') ? 'active' : '' }}">Encuestas</a>
      <a href="{{ route('admin.entrevistas') }}" class="{{ request()->routeIs('admin.entrevistas*') ? 'active' : '' }}">Entrevistas</a>
      <a href="{{ route('admin.pruebas') }}" class="{{ request()->routeIs('admin.pruebas*') ? 'active' : '' }}">Pruebas</a>
    </nav>
    <form method="POST" action="{{ route('admin.logout') }}" class="topbar-form">
      @csrf
      <button type="submit">Cerrar sesión</button>
    </form>
  </div>
</div>

<div class="content">
  @yield('content')
</div>

</body>
</html>

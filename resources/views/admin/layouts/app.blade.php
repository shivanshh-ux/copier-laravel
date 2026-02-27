<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') — Copier</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --sidebar-w: 260px;
            --navy:      #0a0f1e;
            --navy-2:    #0d1526;
            --navy-3:    #111d35;
            --navy-4:    #162040;
            --gold:      #f0a500;
            --gold-2:    #ffc107;
            --gold-glow: rgba(240,165,0,.18);
            --text:      #e2e8f0;
            --text-muted:#8892a4;
            --border:    rgba(255,255,255,.07);
            --card-bg:   rgba(13,21,38,.85);
            --success:   #10b981;
            --danger:    #ef4444;
            --warning:   #f59e0b;
            --info:      #3b82f6;
        }

        html, body { height: 100%; font-family: 'Inter', sans-serif; background: var(--navy); color: var(--text); }

        /* ── SIDEBAR ───────────────────────────────────────── */
        .sidebar {
            position: fixed; top: 0; left: 0;
            width: var(--sidebar-w); height: 100vh;
            background: linear-gradient(180deg, var(--navy-2) 0%, var(--navy-4) 100%);
            border-right: none;
            display: flex; flex-direction: column;
            z-index: 100;
            backdrop-filter: blur(20px);
        }

        .sidebar-brand {
            padding: 28px 24px 20px;
            border-bottom: 1px solid var(--border);
        }
        .sidebar-brand .logo {
            font-size: 1.5rem; font-weight: 800;
            background: linear-gradient(135deg, var(--gold) 0%, var(--gold-2) 100%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            letter-spacing: -0.5px;
        }
        .sidebar-brand .logo-sub {
            font-size: .7rem; color: var(--text-muted); letter-spacing: 3px;
            text-transform: uppercase; margin-top: 2px;
        }

        .sidebar-nav { flex: 1; padding: 16px 0; overflow-y: auto; }
        .nav-section-label {
            font-size: .65rem; font-weight: 600; letter-spacing: 2px;
            color: var(--text-muted); text-transform: uppercase;
            padding: 16px 24px 8px;
        }

        .nav-item { display: block; text-decoration: none; }
        .nav-link {
            display: flex; align-items: center; gap: 12px;
            padding: 11px 24px; color: var(--text-muted);
            font-size: .88rem; font-weight: 500;
            transition: all .2s ease; position: relative;
            border-radius: 0;
        }
        .nav-link .nav-icon {
            width: 36px; height: 36px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: .9rem; background: transparent;
            transition: all .2s ease; flex-shrink: 0;
        }
        .nav-link:hover { color: var(--text); }
        .nav-link:hover .nav-icon { background: var(--gold-glow); color: var(--gold); }

        .nav-link.active {
            color: var(--gold);
            background: linear-gradient(90deg, var(--gold-glow) 0%, transparent 100%);
        }
        .nav-link.active::before {
            content: ''; position: absolute; left: 0; top: 0; bottom: 0;
            width: 3px; background: var(--gold); border-radius: 0 3px 3px 0;
        }
        .nav-link.active .nav-icon { background: var(--gold-glow); color: var(--gold); }

        .sidebar-footer {
            padding: 16px 24px;
            border-top: 1px solid var(--border);
        }
        .admin-badge {
            display: flex; align-items: center; gap: 10px;
            padding: 10px; border-radius: 12px;
            background: var(--gold-glow); margin-bottom: 12px;
        }
        .admin-avatar {
            width: 36px; height: 36px; border-radius: 50%;
            background: linear-gradient(135deg, var(--gold), var(--gold-2));
            display: flex; align-items: center; justify-content: center;
            font-size: .85rem; font-weight: 700; color: var(--navy);
            flex-shrink: 0;
        }
        .admin-info { flex: 1; min-width: 0; }
        .admin-name { font-size: .8rem; font-weight: 600; color: var(--text); truncate; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .admin-role { font-size: .7rem; color: var(--gold); }

        .logout-btn {
            width: 100%; padding: 9px; border: 1px solid rgba(239,68,68,.3);
            background: rgba(239,68,68,.08); color: #ef4444;
            border-radius: 8px; font-size: .82rem; font-weight: 500;
            cursor: pointer; transition: all .2s; display: flex; align-items: center;
            justify-content: center; gap: 8px; text-decoration: none;
        }
        .logout-btn:hover { background: rgba(239,68,68,.18); border-color: rgba(239,68,68,.5); }

        /* ── MAIN ──────────────────────────────────────────── */
        .main-wrapper {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex; flex-direction: column;
        }

        .topbar {
            position: sticky; top: 0; z-index: 50;
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 32px; height: 64px;
            background: rgba(10,15,30,.9);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
        }
        .topbar-title { font-size: 1.1rem; font-weight: 700; }
        .topbar-right { display: flex; align-items: center; gap: 16px; }
        .topbar-time { font-size: .78rem; color: var(--text-muted); }

        .page-content { padding: 32px; flex: 1; }

        /* ── ALERTS ────────────────────────────────────────── */
        .alert {
            padding: 12px 16px; border-radius: 10px; margin-bottom: 24px;
            font-size: .875rem; display: flex; align-items: center; gap: 10px;
            animation: slideDown .3s ease;
        }
        .alert-success { background: rgba(16,185,129,.12); border: 1px solid rgba(16,185,129,.3); color: #34d399; }
        .alert-error   { background: rgba(239,68,68,.12);  border: 1px solid rgba(239,68,68,.3);  color: #f87171; }

        @keyframes slideDown { from { opacity:0; transform:translateY(-10px); } to { opacity:1; transform:translateY(0); } }

        /* ── CARDS ─────────────────────────────────────────── */
        .card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 16px;
            backdrop-filter: blur(20px);
            overflow: hidden;
        }
        .card-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
        }
        .card-title { font-size: 1rem; font-weight: 600; }
        .card-body { padding: 24px; }

        /* ── STAT CARDS ────────────────────────────────────── */
        .stat-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 22px;
            display: flex; align-items: center; gap: 16px;
            transition: transform .2s, border-color .2s;
            backdrop-filter: blur(20px);
        }
        .stat-card:hover { transform: translateY(-2px); border-color: var(--gold); }
        .stat-icon {
            width: 52px; height: 52px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem; flex-shrink: 0;
        }
        .stat-icon.gold    { background: var(--gold-glow);            color: var(--gold); }
        .stat-icon.green   { background: rgba(16,185,129,.15);        color: #10b981; }
        .stat-icon.blue    { background: rgba(59,130,246,.15);        color: #3b82f6; }
        .stat-icon.purple  { background: rgba(139,92,246,.15);        color: #8b5cf6; }
        .stat-icon.red     { background: rgba(239,68,68,.15);         color: #ef4444; }
        .stat-value { font-size: 1.8rem; font-weight: 800; line-height: 1; }
        .stat-label { font-size: .78rem; color: var(--text-muted); margin-top: 4px; }

        /* ── TABLES ────────────────────────────────────────── */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        thead th {
            padding: 12px 16px; text-align: left;
            font-size: .72rem; font-weight: 600; letter-spacing: 1px;
            text-transform: uppercase; color: var(--text-muted);
            border-bottom: 1px solid var(--border);
        }
        tbody tr { transition: background .15s; }
        tbody tr:hover { background: rgba(255,255,255,.03); }
        tbody td { padding: 14px 16px; font-size: .875rem; border-bottom: 1px solid var(--border); vertical-align: middle; }
        tbody tr:last-child td { border-bottom: none; }

        /* ── BADGES ────────────────────────────────────────── */
        .badge {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 4px 10px; border-radius: 20px;
            font-size: .72rem; font-weight: 600;
        }
        .badge-success { background: rgba(16,185,129,.15); color: #10b981; }
        .badge-danger  { background: rgba(239,68,68,.15);  color: #ef4444; }
        .badge-warning { background: rgba(245,158,11,.15); color: #f59e0b; }
        .badge-info    { background: rgba(59,130,246,.15); color: #3b82f6; }
        .badge-muted   { background: rgba(255,255,255,.08); color: var(--text-muted); }

        /* ── BUTTONS ───────────────────────────────────────── */
        .btn {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 9px 18px; border-radius: 9px;
            font-size: .855rem; font-weight: 600;
            cursor: pointer; border: none; transition: all .2s;
            text-decoration: none; white-space: nowrap;
        }
        .btn-gold {
            background: linear-gradient(135deg, var(--gold), var(--gold-2));
            color: var(--navy);
        }
        .btn-gold:hover { opacity: .9; transform: translateY(-1px); box-shadow: 0 4px 15px var(--gold-glow); }
        .btn-outline {
            background: transparent; color: var(--text-muted);
            border: 1px solid var(--border);
        }
        .btn-outline:hover { border-color: var(--gold); color: var(--gold); }
        .btn-danger { background: rgba(239,68,68,.15); color: #ef4444; border: 1px solid rgba(239,68,68,.3); }
        .btn-danger:hover { background: rgba(239,68,68,.25); }
        .btn-sm { padding: 6px 12px; font-size: .8rem; border-radius: 7px; }

        /* ── FORMS ─────────────────────────────────────────── */
        .form-group { margin-bottom: 20px; }
        .form-label { display: block; font-size: .8rem; font-weight: 600; color: var(--text-muted); margin-bottom: 6px; letter-spacing: .5px; text-transform: uppercase; }
        .form-control {
            width: 100%; padding: 10px 14px;
            background: rgba(255,255,255,.05);
            border: 1px solid var(--border);
            border-radius: 9px; color: var(--text);
            font-size: .875rem; font-family: inherit;
            transition: border-color .2s, box-shadow .2s;
            outline: none;
        }
        .form-control:focus { border-color: var(--gold); box-shadow: 0 0 0 3px var(--gold-glow); }
        .form-control::placeholder { color: var(--text-muted); }
        select.form-control option { background: var(--navy-3); }
        textarea.form-control { resize: vertical; min-height: 100px; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .form-actions { display: flex; gap: 12px; align-items: center; padding-top: 8px; }
        .invalid-feedback { font-size: .78rem; color: #f87171; margin-top: 4px; }

        /* ── SEARCH BAR ────────────────────────────────────── */
        .search-bar {
            display: flex; gap: 12px; align-items: center; margin-bottom: 24px;
            flex-wrap: wrap;
        }
        .search-input-wrap { position: relative; flex: 1; min-width: 200px; }
        .search-input-wrap i { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: .85rem; }
        .search-input-wrap .form-control { padding-left: 36px; }

        /* ── PAGINATION ────────────────────────────────────── */
        .pagination-wrap { padding: 16px 24px; border-top: 1px solid var(--border); }
        .pagination-wrap .pagination { display: flex; gap: 4px; list-style: none; }
        .pagination-wrap .page-link { padding: 6px 12px; border-radius: 7px; font-size: .82rem; color: var(--text-muted); text-decoration: none; border: 1px solid var(--border); transition: all .2s; }
        .pagination-wrap .page-link:hover, .pagination-wrap .page-item.active .page-link { background: var(--gold); color: var(--navy); border-color: var(--gold); }

        /* ── GRID ──────────────────────────────────────────── */
        .grid-2 { display: grid; grid-template-columns: repeat(2,1fr); gap: 24px; }
        .grid-3 { display: grid; grid-template-columns: repeat(3,1fr); gap: 24px; }
        .grid-4 { display: grid; grid-template-columns: repeat(4,1fr); gap: 24px; }
        .grid-5 { display: grid; grid-template-columns: repeat(5,1fr); gap: 24px; }

        @media (max-width: 1200px) { .grid-5 { grid-template-columns: repeat(3,1fr); } .grid-4 { grid-template-columns: repeat(2,1fr); } }
        @media (max-width: 900px)  { .grid-3,.grid-4,.grid-5 { grid-template-columns: repeat(2,1fr); } }
        @media (max-width: 600px)  { .grid-2,.grid-3,.grid-4,.grid-5 { grid-template-columns: 1fr; } .form-grid { grid-template-columns: 1fr; } }

        /* ── MISC ──────────────────────────────────────────── */
        .page-header { margin-bottom: 28px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; }
        .page-header h1 { font-size: 1.5rem; font-weight: 800; }
        .page-header .breadcrumb { font-size: .8rem; color: var(--text-muted); margin-top: 4px; }
        .page-header .breadcrumb span { color: var(--gold); }
        .empty-state { text-align: center; padding: 60px 24px; color: var(--text-muted); }
        .empty-state i { font-size: 3rem; margin-bottom: 16px; opacity: .4; }
        .mt-4 { margin-top: 24px; } .mb-4 { margin-bottom: 24px; }
        .text-muted { color: var(--text-muted); } .text-gold { color: var(--gold); }
        .text-success { color: #10b981; } .text-danger { color: #ef4444; }
        .fw-600 { font-weight: 600; } .fw-700 { font-weight: 700; }
        del { color: var(--text-muted); font-size: .85em; }
    </style>
    @stack('styles')
</head>
<body>

{{-- SIDEBAR --}}
<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="logo">⚡ Copier</div>
        <div class="logo-sub">Admin Panel</div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section-label">Main</div>

        <a href="{{ route('admin.dashboard') }}" class="nav-item nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="nav-icon"><i class="fas fa-th-large"></i></span>
            Dashboard
        </a>

        <div class="nav-section-label">Manage</div>

        <a href="{{ route('admin.customers.index') }}" class="nav-item nav-link {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}">
            <span class="nav-icon"><i class="fas fa-users"></i></span>
            Customers
        </a>

        <a href="{{ route('admin.orders.index') }}" class="nav-item nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
            <span class="nav-icon"><i class="fas fa-shopping-bag"></i></span>
            Orders
        </a>

        <div class="nav-section-label">Catalog</div>

        <a href="{{ route('admin.plans.index') }}" class="nav-item nav-link {{ request()->routeIs('admin.plans.*') ? 'active' : '' }}">
            <span class="nav-icon"><i class="fas fa-layer-group"></i></span>
            Plans
        </a>

        <a href="{{ route('admin.offers.index') }}" class="nav-item nav-link {{ request()->routeIs('admin.offers.*') ? 'active' : '' }}">
            <span class="nav-icon"><i class="fas fa-tags"></i></span>
            Offers
        </a>

        <div class="nav-section-label">Content</div>

        <a href="{{ route('admin.media.index') }}" class="nav-item nav-link {{ request()->routeIs('admin.media.*') ? 'active' : '' }}">
            <span class="nav-icon"><i class="fas fa-photo-film"></i></span>
            Video & PDF
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="admin-badge">
            <div class="admin-avatar">A</div>
            <div class="admin-info">
                <div class="admin-name">{{ session('admin_username', 'Admin') }}</div>
                <div class="admin-role">Super Admin</div>
            </div>
        </div>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>
</aside>

{{-- MAIN --}}
<div class="main-wrapper">
    <header class="topbar">
        <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
        <div class="topbar-right">
            <span class="topbar-time" id="topbarClock"></span>
        </div>
    </header>

    <main class="page-content">
        @if(session('success'))
            <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
        @endif

        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-error"><i class="fas fa-exclamation-triangle"></i> {{ $error }}</div>
            @endforeach
        @endif

        @yield('content')
    </main>
</div>

<script>
    // Live clock
    function updateClock() {
        const now = new Date();
        document.getElementById('topbarClock').textContent =
            now.toLocaleDateString('en-IN', { weekday:'short', day:'2-digit', month:'short' }) +
            ' — ' + now.toLocaleTimeString('en-IN', { hour:'2-digit', minute:'2-digit' });
    }
    updateClock(); setInterval(updateClock, 1000);

    // Auto-dismiss alerts
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(el => {
            el.style.transition = 'opacity .5s'; el.style.opacity = '0';
            setTimeout(() => el.remove(), 500);
        });
    }, 4000);
</script>
@stack('scripts')
</body>
</html>

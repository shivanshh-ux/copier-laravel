<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — Copier</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --navy:    #0a0f1e;
            --navy-2:  #0d1526;
            --gold:    #f0a500;
            --gold-2:  #ffc107;
            --gold-g:  rgba(240,165,0,.18);
            --border:  rgba(255,255,255,.08);
            --text:    #e2e8f0;
            --muted:   #8892a4;
        }
        html, body {
            height: 100%; font-family: 'Inter', sans-serif;
            background: var(--navy); color: var(--text);
            overflow: hidden;
        }

        /* Animated background */
        .bg {
            position: fixed; inset: 0; z-index: 0;
            background: radial-gradient(ellipse at 20% 50%, rgba(240,165,0,.06) 0%, transparent 60%),
                        radial-gradient(ellipse at 80% 20%, rgba(59,130,246,.06) 0%, transparent 50%),
                        radial-gradient(ellipse at 60% 80%, rgba(139,92,246,.05) 0%, transparent 50%);
        }
        .grid-lines {
            position: fixed; inset: 0; z-index: 0;
            background-image:
                linear-gradient(rgba(255,255,255,.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.025) 1px, transparent 1px);
            background-size: 60px 60px;
        }

        /* Floating particles */
        .particles { position: fixed; inset: 0; z-index: 0; overflow: hidden; }
        .particle {
            position: absolute; border-radius: 50%;
            background: var(--gold); opacity: .4;
            animation: float linear infinite;
        }
        @keyframes float {
            0%   { transform: translateY(100vh) scale(0); opacity: 0; }
            10%  { opacity: .4; }
            90%  { opacity: .4; }
            100% { transform: translateY(-100px) scale(1); opacity: 0; }
        }

        .login-wrap {
            position: relative; z-index: 10;
            display: flex; align-items: center; justify-content: center;
            min-height: 100vh; padding: 24px;
        }

        .login-card {
            width: 100%; max-width: 420px;
            background: rgba(13,21,38,.9);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 44px 40px;
            backdrop-filter: blur(30px);
            box-shadow: 0 40px 80px rgba(0,0,0,.4), 0 0 0 1px rgba(240,165,0,.08);
            animation: cardIn .6s cubic-bezier(.16,1,.3,1) both;
        }
        @keyframes cardIn { from { opacity:0; transform:translateY(30px) scale(.97); } to { opacity:1; transform:none; } }

        .card-logo {
            text-align: center; margin-bottom: 36px;
        }
        .logo-icon {
            width: 64px; height: 64px; border-radius: 18px; margin: 0 auto 12px;
            background: linear-gradient(135deg, var(--gold), var(--gold-2));
            display: flex; align-items: center; justify-content: center;
            font-size: 1.8rem;
            box-shadow: 0 8px 30px rgba(240,165,0,.3);
            animation: pulse 3s ease-in-out infinite;
        }
        @keyframes pulse { 0%,100% { box-shadow: 0 8px 30px rgba(240,165,0,.3); } 50% { box-shadow: 0 8px 40px rgba(240,165,0,.5); } }
        .logo-text {
            font-size: 1.6rem; font-weight: 800;
            background: linear-gradient(135deg, var(--gold), var(--gold-2));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        }
        .logo-sub { font-size: .78rem; color: var(--muted); margin-top: 2px; letter-spacing: 2px; text-transform: uppercase; }

        .alert {
            padding: 11px 14px; border-radius: 10px; margin-bottom: 20px;
            font-size: .83rem; display: flex; align-items: center; gap: 8px;
            animation: shake .4s ease;
        }
        @keyframes shake { 0%,100%{transform:translateX(0)} 25%{transform:translateX(-6px)} 75%{transform:translateX(6px)} }
        .alert-error { background: rgba(239,68,68,.12); border: 1px solid rgba(239,68,68,.3); color: #f87171; }
        .alert-success { background: rgba(16,185,129,.12); border: 1px solid rgba(16,185,129,.3); color: #34d399; }

        .form-group { margin-bottom: 18px; }
        .form-label { display: block; font-size: .75rem; font-weight: 600; color: var(--muted); margin-bottom: 6px; text-transform: uppercase; letter-spacing: .8px; }
        .input-wrap { position: relative; }
        .input-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--muted); font-size: .85rem; }
        .form-control {
            width: 100%; padding: 12px 14px 12px 40px;
            background: rgba(255,255,255,.05);
            border: 1px solid var(--border);
            border-radius: 10px; color: var(--text);
            font-size: .9rem; font-family: inherit;
            transition: border-color .25s, box-shadow .25s;
            outline: none;
        }
        .form-control:focus { border-color: var(--gold); box-shadow: 0 0 0 3px rgba(240,165,0,.15); }
        .form-control::placeholder { color: var(--muted); }

        .toggle-pass {
            position: absolute; right: 14px; top: 50%; transform: translateY(-50%);
            color: var(--muted); cursor: pointer; font-size: .85rem;
            background: none; border: none; padding: 0;
            transition: color .2s;
        }
        .toggle-pass:hover { color: var(--gold); }
        input[type="password"]#password { padding-right: 42px; }

        .btn-login {
            width: 100%; padding: 13px;
            background: linear-gradient(135deg, var(--gold), var(--gold-2));
            color: #0a0f1e; border: none; border-radius: 10px;
            font-size: .95rem; font-weight: 700; font-family: inherit;
            cursor: pointer; margin-top: 8px;
            transition: all .25s;
            display: flex; align-items: center; justify-content: center; gap: 8px;
        }
        .btn-login:hover { transform: translateY(-1px); box-shadow: 0 8px 25px rgba(240,165,0,.35); opacity: .92; }
        .btn-login:active { transform: translateY(0); }

        .login-footer { text-align: center; margin-top: 24px; font-size: .78rem; color: var(--muted); }

        .back-to-site {
            display: inline-flex; align-items: center; gap: 6px;
            color: var(--muted); font-size: .78rem; text-decoration: none;
            transition: color .2s; margin-top: 16px;
        }
        .back-to-site:hover { color: var(--gold); }
    </style>
</head>
<body>
<div class="bg"></div>
<div class="grid-lines"></div>
<div class="particles" id="particles"></div>

<div class="login-wrap">
    <div class="login-card">
        <div class="card-logo">
            <div class="logo-icon">⚡</div>
            <div class="logo-text">Copier</div>
            <div class="logo-sub">Admin Panel</div>
        </div>

        @if(session('error'))
            <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
        @endif
        @if(session('success'))
            <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf

            <div class="form-group">
                <label class="form-label" for="username">Username</label>
                <div class="input-wrap">
                    <i class="fas fa-user input-icon"></i>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        class="form-control"
                        placeholder="Enter admin username"
                        value="{{ old('username') }}"
                        autocomplete="username"
                        autofocus
                        required
                    >
                </div>
                @error('username')
                    <div style="font-size:.75rem;color:#f87171;margin-top:5px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <div class="input-wrap">
                    <i class="fas fa-lock input-icon"></i>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        placeholder="Enter your password"
                        autocomplete="current-password"
                        required
                    >
                    <button type="button" class="toggle-pass" onclick="togglePass()" id="toggleBtn">
                        <i class="fas fa-eye" id="eyeIcon"></i>
                    </button>
                </div>
                @error('password')
                    <div style="font-size:.75rem;color:#f87171;margin-top:5px;">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt"></i> Sign In to Admin
            </button>
        </form>

        <div class="login-footer">
            <a href="{{ route('home') }}" class="back-to-site">
                <i class="fas fa-arrow-left"></i> Back to main website
            </a>
        </div>
    </div>
</div>

<script>
    // Floating particles
    const container = document.getElementById('particles');
    for (let i = 0; i < 18; i++) {
        const p = document.createElement('div');
        p.className = 'particle';
        const size = Math.random() * 4 + 1;
        p.style.cssText = `
            width:${size}px; height:${size}px;
            left:${Math.random()*100}%;
            animation-duration:${Math.random()*12+8}s;
            animation-delay:${Math.random()*10}s;
        `;
        container.appendChild(p);
    }

    // Password toggle
    function togglePass() {
        const pw = document.getElementById('password');
        const icon = document.getElementById('eyeIcon');
        if (pw.type === 'password') {
            pw.type = 'text';
            icon.className = 'fas fa-eye-slash';
        } else {
            pw.type = 'password';
            icon.className = 'fas fa-eye';
        }
    }
</script>
</body>
</html>

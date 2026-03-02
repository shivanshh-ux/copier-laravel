@extends('customer.layouts.app')

@push('styles')
<style>
    /* ── THEME VARIABLES ── */
    :root {
        --cyan: #00D4FF;
        --blue: #1E5FAD;
        --dark: #060D1A;
        --darker: #020914;
        --card-bg: rgba(10,22,45,0.85);
        --border: rgba(0,212,255,0.18);
    }


    /* ── GRID OVERLAY ── */
    .grid-bg {
        background-image:
            linear-gradient(rgba(0,212,255,0.035) 1px, transparent 1px),
            linear-gradient(90deg, rgba(0,212,255,0.035) 1px, transparent 1px);
        background-size: 60px 60px;
    }

    /* ── ANIMATIONS ── */
    @keyframes fadeUp { from { opacity:0; transform:translateY(40px); } to { opacity:1; transform:translateY(0); } }
    @keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
    @keyframes shimmer { 0% { background-position:-200% center; } 100% { background-position:200% center; } }
    @keyframes float { 0%,100% { transform:translateY(0) rotateZ(0deg); } 50% { transform:translateY(-14px) rotateZ(1deg); } }
    @keyframes pulseGlow { 0%,100% { box-shadow:0 0 25px rgba(0,212,255,0.3); } 50% { box-shadow:0 0 70px rgba(0,212,255,0.65),0 0 120px rgba(0,212,255,0.2); } }
    @keyframes borderFlow {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    @keyframes scanDown { 0% { top:-3px; } 100% { top:100%; } }
    @keyframes ticker { 0% { transform:translateX(0); } 100% { transform:translateX(-50%); } }
    @keyframes countUp { from { opacity:0; transform:translateY(8px); } to { opacity:1; transform:translateY(0); } }
    @keyframes rotateSlow { from { transform:rotate(0deg); } to { transform:rotate(360deg); } }
    @keyframes orbPulse { 0%,100% { opacity:0.18; transform:scale(1); } 50% { opacity:0.35; transform:scale(1.08); } }

    .anim-fade-up   { animation: fadeUp 0.8s ease forwards; }
    .anim-fade-up-2 { animation: fadeUp 0.8s 0.15s ease forwards; opacity:0; }
    .anim-fade-up-3 { animation: fadeUp 0.8s 0.30s ease forwards; opacity:0; }
    .anim-fade-up-4 { animation: fadeUp 0.8s 0.45s ease forwards; opacity:0; }
    .anim-fade-in   { animation: fadeIn 1s 0.5s ease forwards; opacity:0; }
    .anim-float     { animation: float 5s ease-in-out infinite; }
    .pulse-glow     { animation: pulseGlow 3s ease-in-out infinite; }

    /* ── GRADIENT TEXT ── */
    .gradient-text {
        background: linear-gradient(90deg, #fff 0%, #00D4FF 55%, #1E5FAD 100%);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    }
    .gradient-shimmer {
        background: linear-gradient(90deg, #fff 20%, #00D4FF 50%, #fff 80%);
        background-size: 200% auto;
        -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        animation: shimmer 4s linear infinite;
    }

    /* ── SCROLL REVEAL ── */
    .reveal {
        opacity: 0;
        transition: opacity 0.85s cubic-bezier(0.23,1,0.32,1),
                    transform 0.85s cubic-bezier(0.23,1,0.32,1);
        will-change: transform, opacity;
    }
    .reveal.from-left   { transform: translateX(-70px); }
    .reveal.from-right  { transform: translateX(70px); }
    .reveal.from-bottom { transform: translateY(55px); }
    .reveal.from-scale  { transform: scale(0.82); }
    .reveal.from-rotate { transform: rotateY(25deg) translateX(-30px); }
    .reveal.visible     { opacity:1 !important; transform:none !important; }
    .reveal-d1 { transition-delay: 0.08s; }
    .reveal-d2 { transition-delay: 0.16s; }
    .reveal-d3 { transition-delay: 0.24s; }
    .reveal-d4 { transition-delay: 0.32s; }
    .reveal-d5 { transition-delay: 0.40s; }
    .reveal-d6 { transition-delay: 0.48s; }

    /* ── CARDS ── */
    .card {
        transition: transform 0.4s cubic-bezier(0.23,1,0.32,1),
                    box-shadow 0.4s ease,
                    border-color 0.4s ease;
        position: relative;
        transform-style: preserve-3d;
        background: var(--card-bg);
        border: 1px solid var(--border) !important;
        backdrop-filter: blur(10px);
    }
    .card::before {
        content: '';
        position: absolute; top: 0; left: 0; right: 0; bottom: 0;
        border-radius: inherit;
        background: radial-gradient(circle at var(--mx,50%) var(--my,50%), rgba(0,212,255,0.07) 0%, transparent 60%);
        opacity: 0;
        transition: opacity 0.3s ease;
        pointer-events: none;
    }
    .card:hover::before { opacity: 1; }
    .card::after {
        content: '';
        position: absolute; left: 0; width: 100%; height: 2px;
        background: linear-gradient(90deg, transparent, var(--cyan), transparent);
        top: -2px; opacity: 0;
        transition: top 0.1s linear;
        pointer-events: none;
        z-index: 10;
    }
    .card:hover { 
        transform: translateY(-10px) rotateX(3deg); 
        border-color: rgba(0,212,255,0.45) !important; 
        box-shadow: 0 32px 80px rgba(0,212,255,0.18), 0 0 0 1px rgba(0,212,255,0.25); 
    }
    .card:hover::after { opacity: 1; animation: scanDown 2s linear infinite; }

    /* ── FEAT ICON ── */
    .feat-icon {
        width: 54px; height: 54px; border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        background: linear-gradient(135deg, rgba(30,95,173,0.4), rgba(0,212,255,0.2));
        border: 1px solid rgba(0,212,255,0.25);
        transition: all 0.35s ease;
    }
    .card:hover .feat-icon { box-shadow: 0 0 24px rgba(0,212,255,0.4); background: linear-gradient(135deg, rgba(30,95,173,0.6), rgba(0,212,255,0.35)); }

    /* ── BUTTONS ── */
    .btn-primary {
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 0.9rem 2.2rem; border-radius: 0.875rem;
        font-weight: 600; font-size: 0.9rem; letter-spacing: 0.04em;
        text-decoration: none; cursor: pointer; white-space: nowrap;
        background: linear-gradient(135deg, #1E5FAD, #00D4FF);
        color: #fff; border: none;
        position: relative; overflow: hidden;
        transition: transform 0.3s cubic-bezier(0.23,1,0.32,1), box-shadow 0.3s ease;
    }
    .btn-primary::before {
        content: '';
        position: absolute; inset: 0;
        background: linear-gradient(135deg, #00D4FF, #1E5FAD);
        opacity: 0; transition: opacity 0.3s ease;
    }
    .btn-primary > * { position: relative; z-index: 1; }
    .btn-primary:hover { transform: translateY(-3px) scale(1.02); box-shadow: 0 18px 55px rgba(0,212,255,0.45); }
    .btn-primary:hover::before { opacity: 1; }

    .btn-outline {
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 0.9rem 2.2rem; border-radius: 0.875rem;
        font-weight: 500; font-size: 0.9rem; letter-spacing: 0.04em;
        text-decoration: none; cursor: pointer; white-space: nowrap;
        background: transparent; color: rgba(226,232,240,0.85);
        border: 1px solid rgba(0,212,255,0.3);
        transition: all 0.3s ease;
    }
    .btn-outline:hover { background: rgba(0,212,255,0.1); border-color: var(--cyan); color: var(--cyan); transform: translateY(-2px); box-shadow: 0 8px 30px rgba(0,212,255,0.15); }

    /* ── MODAL ── */
    #feature-modal {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 9999;
        align-items: center;
        justify-content: center;
        padding: 1.5rem;
    }
    #feature-modal.active { display: flex; }
    #modal-backdrop {
        position: absolute;
        inset: 0;
        background: rgba(4, 9, 20, 0.85);
        backdrop-filter: blur(12px);
        opacity: 0;
        transition: opacity 0.4s ease;
    }
    #feature-modal.active #modal-backdrop { opacity: 1; }
    #modal-content {
        position: relative;
        width: 100%;
        max-width: 600px;
        background: linear-gradient(135deg, rgba(30,95,173,0.15), rgba(0,212,255,0.05));
        border: 1px solid rgba(0,212,255,0.2);
        border-radius: 2rem;
        padding: 3rem;
        transform: translateY(30px) scale(0.95);
        opacity: 0;
        transition: all 0.4s cubic-bezier(0.23,1,0.32,1);
        box-shadow: 0 40px 100px rgba(0,0,0,0.5), 0 0 0 1px rgba(0,212,255,0.1);
    }
    #feature-modal.active #modal-content { transform: translateY(0) scale(1); opacity: 1; }
    .close-modal {
        position: absolute;
        top: 1.5rem;
        right: 1.5rem;
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        color: #fff;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .close-modal:hover { background: rgba(0,212,255,0.15); border-color: rgba(0,212,255,0.4); color: #00D4FF; transform: rotate(90deg); }


    /* ── STAT NUM ── */
    .stat-num { font-family: 'Rajdhani', sans-serif; font-weight: 700; }

    /* ── TICKER ── */
    .ticker-wrapper { overflow: hidden; }
    .ticker-track { display: flex; animation: ticker 30s linear infinite; width: max-content; }
    .ticker-track:hover { animation-play-state: paused; }

    /* ── SECTION HEADING DECO ── */
    .section-tag {
        display: inline-flex; align-items: center; gap: 0.5rem;
        font-size: 0.7rem; letter-spacing: 0.3em; text-transform: uppercase;
        color: var(--cyan); margin-bottom: 0.75rem;
    }
    .section-tag::before, .section-tag::after {
        content: ''; flex: 1; height: 1px;
        background: linear-gradient(90deg, transparent, rgba(0,212,255,0.5));
        width: 30px;
    }
    .section-tag::after { background: linear-gradient(270deg, transparent, rgba(0,212,255,0.5)); }

    /* ── STEP CIRCLE ── */
    .step-circle {
        width: 64px; height: 64px; border-radius: 20px;
        display: flex; align-items: center; justify-content: center;
        background: linear-gradient(135deg, #1E5FAD, #00D4FF);
        box-shadow: 0 0 0 8px rgba(0,212,255,0.08), 0 0 40px rgba(0,212,255,0.3);
        position: relative; z-index: 2;
        transition: box-shadow 0.3s ease, transform 0.3s ease;
    }
    .step-circle:hover { box-shadow: 0 0 0 12px rgba(0,212,255,0.12), 0 0 60px rgba(0,212,255,0.5); transform: scale(1.08); }

    /* ── ORB DECORATION ── */
    .orb {
        position: absolute; border-radius: 50%;
        filter: blur(70px); pointer-events: none;
        animation: orbPulse 6s ease-in-out infinite;
    }

    /* ── CTA CARD ── */
    .cta-card {
        background: linear-gradient(135deg, rgba(30,95,173,0.22), rgba(0,212,255,0.08));
        border: 1px solid rgba(0,212,255,0.2);
        border-radius: 2rem;
        position: relative;
        overflow: hidden;
    }
    .cta-card::before {
        content: '';
        position: absolute; inset: -2px;
        border-radius: inherit;
        background: linear-gradient(270deg, #1E5FAD, #00D4FF, #1E5FAD);
        background-size: 300% 300%;
        animation: borderFlow 6s linear infinite;
        z-index: -1;
        mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        padding: 2px;
    }

    /* ── HOVER 3D TILT (JS) ── */
    .tilt-3d { transition: transform 0.15s ease; transform-style: preserve-3d; }

    /* ── MOBILE ── */
    @media (max-width: 480px) {
        .btn-primary, .btn-outline { padding: 0.75rem 1.5rem; font-size: 0.85rem; }
    }

    /* ── PAGE TRANSITION OVERLAY ── */
    #page-transition {
        position:fixed; inset:0; z-index:9999;
        background:linear-gradient(135deg, #020914, #0A1628);
        transform:scaleY(0); transform-origin:bottom;
        transition:transform 0.5s cubic-bezier(0.76,0,0.24,1);
        pointer-events:none;
    }
    #page-transition.entering { transform:scaleY(1); transform-origin:top; }
</style>
@include('customer.partials.preloader_styles')
@endpush

@section('content')

<!-- ===================== HERO ===================== -->
<section class="relative min-h-screen flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8 overflow-hidden" style="padding-top:5rem;padding-bottom:3rem;">
    <!-- Grid + radial glows -->
    <div class="absolute inset-0 grid-bg opacity-50 pointer-events-none"></div>
    <div class="absolute inset-0 pointer-events-none" style="background:radial-gradient(ellipse 80% 55% at 50% 15%, rgba(30,95,173,0.22) 0%,transparent 70%);"></div>
    <div class="absolute inset-0 pointer-events-none" style="background:radial-gradient(ellipse 50% 40% at 85% 80%, rgba(0,212,255,0.09) 0%,transparent 60%);"></div>

    <!-- Decorative ring -->
    <div class="absolute pointer-events-none" style="top:50%;left:50%;transform:translate(-50%,-50%);width:min(700px,90vw);height:min(700px,90vw);border-radius:50%;border:1px solid rgba(0,212,255,0.06);"></div>
    <div class="absolute pointer-events-none" style="top:50%;left:50%;transform:translate(-50%,-50%);width:min(500px,70vw);height:min(500px,70vw);border-radius:50%;border:1px dashed rgba(0,212,255,0.05);"></div>

    <!-- Animated chart deco -->
    <div class="absolute right-[-3%] top-1/2 -translate-y-1/2 w-[42vw] max-w-[480px] pointer-events-none hidden lg:block anim-float" style="opacity:0.055;">
        <svg viewBox="0 0 520 320" fill="none">
            <polyline points="0,260 90,200 180,225 280,140 360,165 440,75 520,95" stroke="#00D4FF" stroke-width="2.5" fill="none"/>
            <polyline points="0,280 90,250 180,260 280,190 360,215 440,130 520,155" stroke="#1E5FAD" stroke-width="1.5" stroke-dasharray="6,4" fill="none"/>
            <!-- candles -->
            <rect x="80" y="175" width="10" height="30" fill="rgba(0,212,255,0.4)" rx="1"/>
            <rect x="170" y="200" width="10" height="30" fill="rgba(30,95,173,0.5)" rx="1"/>
            <rect x="270" y="115" width="10" height="30" fill="rgba(0,212,255,0.4)" rx="1"/>
            <rect x="430" y="50" width="10" height="30" fill="rgba(0,212,255,0.6)" rx="1"/>
        </svg>
    </div>

    <!-- Left deco -->
    <div class="absolute left-4 top-1/3 hidden xl:block pointer-events-none" style="opacity:0.04;">
        <svg width="80" height="300" viewBox="0 0 80 300">
            <line x1="40" y1="0" x2="40" y2="300" stroke="#00D4FF" stroke-width="1" stroke-dasharray="4,8"/>
            <circle cx="40" cy="60" r="4" fill="#00D4FF"/>
            <circle cx="40" cy="140" r="4" fill="#00D4FF"/>
            <circle cx="40" cy="220" r="4" fill="#00D4FF"/>
        </svg>
    </div>

    <div class="relative max-w-4xl mx-auto text-center w-full">
        <!-- Badge -->
        <div class="anim-fade-up inline-flex items-center gap-2 px-4 py-1.5 rounded-full mb-6 text-xs font-medium tracking-widest uppercase" style="background:rgba(0,212,255,0.08);border:1px solid rgba(0,212,255,0.22);color:#00D4FF;">
            <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse" style="box-shadow:0 0 8px #4ade80;"></span>
            Live Trading Platform &nbsp;·&nbsp; 12,000+ Traders
        </div>

        <!-- Headline -->
        <h1 class="anim-fade-up-2 font-bold leading-tight mb-6" style="font-family:'Rajdhani',sans-serif;font-size:clamp(2.4rem,6.5vw,4.4rem);letter-spacing:-0.01em;">
            <span class="gradient-shimmer">Automate Your Trades</span><br>
            <span style="color:#E2E8F0;">With Algorithmic</span>
            <span class="gradient-text"> Precision</span>
        </h1>

        <!-- Sub -->
        <p class="anim-fade-up-3 mx-auto mb-10 leading-relaxed max-w-2xl" style="font-size:clamp(0.95rem,2vw,1.15rem);color:rgba(226,232,240,0.65);">
            Copier connects your strategies to markets 24/7 — executing trades with speed, discipline, and zero emotion. Institution-grade tools for every trader.
        </p>

        <!-- CTAs -->
        <div class="anim-fade-up-4 flex flex-wrap gap-3 justify-center">
            <a href="{{ route('signup') }}" class="btn-primary pulse-glow">
                <i data-lucide="zap" style="width:16px;height:16px;"></i>
                <span>Get Started Free</span>
            </a>
            <a href="{{ route('services') }}" class="btn-outline">
                <i data-lucide="play-circle" style="width:16px;height:16px;"></i>
                <span>View Plans</span>
            </a>
        </div>
    </div>
</section>

<!-- ===================== STATS ===================== -->
<section class="relative px-4 sm:px-6 lg:px-8 py-20">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            @php
            $stats=[
                ['val'=>'$2.4B+','label'=>'Volume Traded','icon'=>'trending-up','delay'=>'reveal-d1'],
                ['val'=>'12,000+','label'=>'Active Traders','icon'=>'users','delay'=>'reveal-d2'],
                ['val'=>'99.9%','label'=>'Uptime SLA','icon'=>'shield-check','delay'=>'reveal-d3'],
                ['val'=>'<50ms','label'=>'Execution Speed','icon'=>'zap','delay'=>'reveal-d4'],
            ];
            @endphp
            @foreach($stats as $i=>$s)
            <div class="card reveal from-bottom {{ $s['delay'] }} rounded-2xl p-5 sm:p-7 text-center tilt-3d">
                <div class="feat-icon mx-auto mb-4">
                    <i data-lucide="{{ $s['icon'] }}" style="width:22px;height:22px;color:#00D4FF;"></i>
                </div>
                <div class="stat-num text-2xl sm:text-3xl lg:text-4xl gradient-text mb-1">{{ $s['val'] }}</div>
                <p class="text-xs sm:text-sm" style="color:rgba(226,232,240,0.5);">{{ $s['label'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ===================== FEATURES ===================== -->
<section class="relative px-4 sm:px-6 lg:px-8 py-20 overflow-hidden">
    <div class="absolute inset-0 grid-bg opacity-35 pointer-events-none"></div>
    <!-- Orb decorations -->
    <div class="orb" style="width:400px;height:400px;background:rgba(30,95,173,0.25);top:10%;right:-100px;animation-delay:0s;"></div>
    <div class="orb" style="width:300px;height:300px;background:rgba(0,212,255,0.1);bottom:5%;left:-80px;animation-delay:3s;"></div>

    <div class="max-w-7xl mx-auto relative">
        <div class="text-center mb-16 reveal from-bottom">
            <div class="section-tag">Why Copier</div>
            <h2 class="font-bold mb-4" style="font-family:'Rajdhani',sans-serif;font-size:clamp(1.9rem,4vw,3rem);color:#E2E8F0;">
                Everything You Need to <span class="gradient-text">Trade Smarter</span>
            </h2>
            <p class="mx-auto max-w-xl" style="font-size:0.95rem;color:rgba(226,232,240,0.55);">From strategy setup to live execution, Copier handles every step with institutional-grade technology.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6">
            @php
            $features=[
                [
                    'icon'=>'cpu',
                    'title'=>'Smart Algorithms',
                    'desc'=>'Deploy pre-built or custom strategies. Our engine adapts to market conditions in real time.',
                    'details'=>'Our proprietary execution engine leverages machine learning to anticipate order book movements and optimize entry/exit points. Whether you\'re using our pre-built library of 50+ strategies or coding your own in Python or C++, the system scales with your needs.',
                    'dir'=>'from-left'
                ],
                [
                    'icon'=>'shield',
                    'title'=>'Risk Management',
                    'desc'=>'Advanced position sizing, stop-loss automation, and drawdown controls to protect your capital.',
                    'details'=>'Protect your capital with institution-grade risk controls. Set hard stops, trailing stops, and total daily drawdown limits at the account or strategy level. Our system monitors volatility 24/7, automatically pausing execution if predefined risk thresholds are breached.',
                    'dir'=>'from-bottom'
                ],
                [
                    'icon'=>'bar-chart-2',
                    'title'=>'Deep Analytics',
                    'desc'=>'Live P&L dashboards, trade journals, and performance attribution across all your strategies.',
                    'details'=>'Gain total visibility into your trading performance. Our analytics suite includes real-time P&L attribution, Monte Carlo simulations, and trade journaling. Identify which market conditions favor your strategies and refine your approach with data-driven insights.',
                    'dir'=>'from-right'
                ],
                [
                    'icon'=>'globe',
                    'title'=>'Multi-Market Access',
                    'desc'=>'Trade equities, forex, crypto, and commodities from a single unified account.',
                    'details'=>'Connect to the world\'s most liquid exchanges through a single unified API. Trade Equities (NYSE, NASDAQ, LSE), Forex (Major & Minor pairs), Crypto (Top 200 assets), and Commodities (Gold, Oil, Natural Gas) from one dashboard.',
                    'dir'=>'from-left'
                ],
                [
                    'icon'=>'bell',
                    'title'=>'Smart Alerts',
                    'desc'=>'Custom push/email/SMS notifications for fills, drawdown thresholds, and market signals.',
                    'details'=>'Stay informed wherever you are. Configure multi-channel alerts via Push Notifications, SMS, Email, or Slack/Discord webhooks. Get notified about trade fills, margin levels, stop-loss triggers, or unusual market activity in milliseconds.',
                    'dir'=>'from-bottom'
                ],
                [
                    'icon'=>'lock',
                    'title'=>'Bank-Grade Security',
                    'desc'=>'256-bit encryption, 2FA, and SOC 2 certified infrastructure to keep your account safe.',
                    'details'=>'Your data and assets are protected by industry-leading security protocols. We utilize AES-256 encryption, mandatory 2FA, and cold storage for API keys. Our infrastructure is SOC 2 compliant and undergoes regular third-party penetration testing.',
                    'dir'=>'from-right'
                ],
            ];
            $delays=['reveal-d1','reveal-d2','reveal-d3','reveal-d4','reveal-d5','reveal-d6'];
            @endphp
            @foreach($features as $i=>$f)
            <div class="card reveal {{ $f['dir'].' '.$delays[$i] }} rounded-2xl p-6 tilt-3d flex flex-col items-start text-left">
                <div class="feat-icon mb-5">
                    <i data-lucide="{{ $f['icon'] }}" style="width:22px;height:22px;color:#00D4FF;"></i>
                </div>
                <h3 class="font-semibold mb-2" style="color:#E2E8F0;font-family:'Rajdhani',sans-serif;font-size:1.15rem;letter-spacing:0.02em;">{{ $f['title'] }}</h3>
                <p class="text-sm leading-relaxed mb-6" style="color:rgba(226,232,240,0.55);">{{ $f['desc'] }}</p>

                <button class="mt-auto group flex items-center gap-2 text-xs font-semibold tracking-widest uppercase transition-colors hover:text-cyan-400"
                        style="color: rgba(0,212,255,0.7);"
                        onclick="showFeatureDetails({{ $i }})">
                    Learn More
                    <i data-lucide="chevron-right" class="w-3 h-3 transition-transform group-hover:translate-x-1"></i>
                </button>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ===================== LEARNING RESOURCES (MEDIA) ===================== -->
@if($media->count() > 0)
<section class="relative px-4 sm:px-6 lg:px-8 py-20 overflow-hidden">
    <div class="absolute inset-0 grid-bg opacity-30 pointer-events-none"></div>
    <div class="orb" style="width:400px;height:400px;background:rgba(0,212,255,0.06);top:20%;left:-100px;animation-delay:1s;"></div>
    
    <div class="max-w-7xl mx-auto relative">
        <div class="text-center mb-16 reveal from-bottom">
            <div class="section-tag">Resources</div>
            <h2 class="font-bold mb-4" style="font-family:'Rajdhani',sans-serif;font-size:clamp(1.9rem,4vw,3rem);color:#E2E8F0;">
                Learning <span class="gradient-text">Center</span>
            </h2>
            <p class="mx-auto max-w-xl" style="font-size:0.95rem;color:rgba(226,232,240,0.55);">Access our exclusive guides and video tutorials to master the art of algorithmic trading.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            @foreach($media as $i => $item)
            <div class="card reveal from-bottom reveal-d{{ ($i % 4) + 1 }} rounded-2xl p-6 tilt-3d flex flex-col">
                <div class="flex items-start justify-between mb-6">
                    <div class="feat-icon">
                        <i data-lucide="{{ $item->type == 'video' ? 'play-circle' : 'file-text' }}" style="width:24px;height:24px;color:#00D4FF;"></i>
                    </div>
                    <span class="text-[0.65rem] font-bold tracking-widest uppercase px-3 py-1 rounded-full" style="background:rgba(0,212,255,0.1); color:#00D4FF; border:1px solid rgba(0,212,255,0.15);">
                        {{ strtoupper($item->type) }}
                    </span>
                </div>

                <h3 class="font-semibold mb-3" style="color:#E2E8F0;font-family:'Rajdhani',sans-serif;font-size:1.2rem;letter-spacing:0.02em;">{{ $item->title }}</h3>
                <p class="text-sm leading-relaxed mb-8 flex-1" style="color:rgba(226,232,240,0.5);">{{ $item->description }}</p>

                <div class="pt-6 border-t border-white/5">
                    @if($item->type == 'video')
                        <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank" class="btn-primary w-full justify-center py-3 text-xs">
                            <i data-lucide="play" style="width:14px;height:14px;"></i>
                            <span>Watch Tutorial</span>
                        </a>
                    @else
                        <a href="{{ asset('storage/' . $item->file_path) }}" download="{{ $item->original_name }}" class="btn-outline w-full justify-center py-3 text-xs">
                            <i data-lucide="download" style="width:14px;height:14px;"></i>
                            <span>Download Guide</span>
                        </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif


<!-- ===================== HOW IT WORKS ===================== -->
<section class="relative px-4 sm:px-6 lg:px-8 py-20">
    <div class="max-w-5xl mx-auto">
        <div class="text-center mb-16 reveal from-bottom">
            <div class="section-tag">Simple Process</div>
            <h2 class="font-bold" style="font-family:'Rajdhani',sans-serif;font-size:clamp(1.9rem,4vw,3rem);color:#E2E8F0;">
                Up and Running in <span class="gradient-text">3 Steps</span>
            </h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-10 sm:gap-6 relative">
            <!-- Connector line -->
            <div class="hidden sm:block absolute top-8 left-[calc(16.67%+32px)] right-[calc(16.67%+32px)] h-px" style="background:linear-gradient(90deg,rgba(0,212,255,0.4),rgba(0,212,255,0.7),rgba(0,212,255,0.4));top:32px;"></div>

            @php
            $steps=[
                ['n'=>'01','icon'=>'user-plus','title'=>'Create Account','desc'=>'Sign up in under 2 minutes. No credit card needed for your free trial.','dir'=>'from-left'],
                ['n'=>'02','icon'=>'sliders','title'=>'Configure Strategy','desc'=>'Choose from our strategy library or upload your own algorithm.','dir'=>'from-bottom'],
                ['n'=>'03','icon'=>'play','title'=>'Go Live','desc'=>'Connect your broker, review risk settings, and activate your strategy.','dir'=>'from-right'],
            ];
            @endphp
            @foreach($steps as $i=>$s)
            <div class="reveal {{ $s['dir'].' reveal-d'.($i+1) }} flex flex-col items-center text-center">
                <div class="step-circle mb-5">
                    <i data-lucide="{{ $s['icon'] }}" style="width:26px;height:26px;color:#fff;stroke-width:2;"></i>
                </div>
                <span class="text-xs font-bold tracking-widest mb-2" style="color:rgba(0,212,255,0.45);">{{ $s['n'] }}</span>
                <h3 class="font-semibold text-lg mb-2" style="color:#E2E8F0;font-family:'Rajdhani',sans-serif;">{{ $s['title'] }}</h3>
                <p class="text-sm max-w-xs" style="color:rgba(226,232,240,0.55);">{{ $s['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ===================== TESTIMONIALS ===================== -->
<section class="relative px-4 sm:px-6 lg:px-8 py-20 overflow-hidden">
    <div class="absolute inset-0 grid-bg opacity-25 pointer-events-none"></div>
    <div class="orb" style="width:350px;height:350px;background:rgba(0,212,255,0.08);top:20%;left:10%;animation-delay:2s;"></div>

    <div class="max-w-7xl mx-auto relative">
        <div class="flex flex-col sm:flex-row items-center justify-between mb-14 reveal from-bottom">
            <div class="text-center sm:text-left mb-6 sm:mb-0">
                <div class="section-tag">Testimonials</div>
                <h2 class="font-bold" style="font-family:'Rajdhani',sans-serif;font-size:clamp(1.9rem,4vw,3rem);color:#E2E8F0;">
                    Traders <span class="gradient-text">Love Copier</span>
                </h2>
            </div>
            <button onclick="openReviewModal()" class="btn-outline py-2.5 px-6 text-sm">
                <i data-lucide="edit-3" class="w-4 h-4"></i>
                <span>Write a Review</span>
            </button>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6">
            @foreach($reviews as $i => $t)
            @php
                $delays = ['reveal-d1', 'reveal-d2', 'reveal-d3', 'reveal-d4', 'reveal-d5', 'reveal-d6'];
                $dir = $i % 3 == 0 ? 'from-left' : ($i % 3 == 1 ? 'from-bottom' : 'from-right');
                $delay = $delays[$i % 6];
            @endphp
            <div class="card reveal {{ $dir }} {{ $delay }} rounded-2xl p-6 tilt-3d">
                <!-- Quote icon -->
                <div style="font-size:3rem;line-height:1;color:rgba(0,212,255,0.15);font-family:serif;margin-bottom:0.5rem;">"</div>
                <!-- Stars -->
                <div class="flex gap-1 mb-4">
                    @for($s=0; $s<5; $s++)
                    <i data-lucide="star" style="width:13px;height:13px;color:{{ $s < $t->rating ? '#FBBF24' : 'rgba(255,255,255,0.1)' }};fill:{{ $s < $t->rating ? '#FBBF24' : 'transparent' }};"></i>
                    @endfor
                </div>
                <p class="text-sm leading-relaxed mb-5" style="color:rgba(226,232,240,0.75);">{{ $t->content }}</p>
                <div class="flex items-center gap-3" style="border-top:1px solid rgba(0,212,255,0.1);padding-top:1rem;">
                    <div class="w-9 h-9 rounded-full overflow-hidden flex items-center justify-center flex-shrink-0 text-sm font-bold" style="background:linear-gradient(135deg,#1E5FAD,#00D4FF);color:#fff;font-family:'Rajdhani',sans-serif;">
                        @if($t->avatar)
                            <img src="{{ asset($t->avatar) }}" style="width:100%;height:100%;object-fit:cover">
                        @else
                            {{ $t->name[0] }}
                        @endif
                    </div>
                    <div>
                        <p class="text-sm font-semibold" style="color:#E2E8F0;">{{ $t->name }}</p>
                        <p class="text-xs" style="color:#00D4FF;opacity:0.7;">{{ $t->role }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ===================== COMPARISON ===================== -->
<section class="relative px-4 sm:px-6 lg:px-8 py-20 overflow-hidden" style="background:rgba(6,13,26,0.65);backdrop-filter:blur(2px);">
    <div class="orb" style="width:420px;height:420px;background:rgba(0,212,255,0.06);bottom:-80px;right:-100px;"></div>
    <div class="max-w-5xl mx-auto relative">
        <div class="text-center mb-14 reveal from-bottom">
            <div class="section-tag">Why Switch</div>
            <h2 class="font-bold" style="font-family:'Rajdhani',sans-serif;font-size:clamp(1.9rem,4vw,3rem);color:#E2E8F0;">
                Copier vs. <span class="gradient-text">The Rest</span>
            </h2>
            <p class="mt-3 max-w-xl mx-auto text-sm" style="color:rgba(226,232,240,0.50);">See why professional traders are switching to Copier from traditional platforms.</p>
        </div>

        <div class="reveal from-bottom" style="border:1px solid rgba(0,212,255,0.15);border-radius:1.5rem;overflow:hidden;backdrop-filter:blur(12px);">
            <!-- Header row -->
            <div class="grid grid-cols-3 text-xs font-bold uppercase tracking-widest" style="background:rgba(0,212,255,0.06);border-bottom:1px solid rgba(0,212,255,0.12);">
                <div class="p-4 sm:p-5" style="color:rgba(226,232,240,0.4);">Feature</div>
                <div class="p-4 sm:p-5 text-center" style="color:#00D4FF;">Copier</div>
                <div class="p-4 sm:p-5 text-center" style="color:rgba(226,232,240,0.35);">Traditional Platforms</div>
            </div>
            @php
            $comparisons = [
                ['feat'=>'Execution Speed',       'us'=>'< 50ms average',      'them'=>'200ms – 2s'],
                ['feat'=>'Strategy Automation',   'us'=>'Full (Python, C++)',   'them'=>'Limited / Manual'],
                ['feat'=>'Risk Controls',         'us'=>'Granular & Real-time', 'them'=>'Basic stop-loss only'],
                ['feat'=>'Portfolio Analytics',   'us'=>'Monte Carlo + AI',     'them'=>'Basic P&L charts'],
                ['feat'=>'Multi-Asset Support',   'us'=>'Stocks, Forex, Crypto','them'=>'Single asset class'],
                ['feat'=>'24/7 Market Coverage',  'us'=>'Fully automated',      'them'=>'Manual monitoring'],
                ['feat'=>'Fee Structure',         'us'=>'Performance-based',    'them'=>'Fixed + hidden fees'],
            ];
            @endphp
            @foreach($comparisons as $i => $c)
            <div class="grid grid-cols-3" style="border-bottom:1px solid rgba(0,212,255,{{ $i < count($comparisons)-1 ? '0.08' : '0' }});">
                <div class="p-4 sm:p-5 text-sm font-medium" style="color:rgba(226,232,240,0.65);">{{ $c['feat'] }}</div>
                <div class="p-4 sm:p-5 text-center text-sm flex items-center justify-center gap-2 font-semibold" style="color:#E2E8F0;">
                    <i data-lucide="check-circle-2" style="width:15px;height:15px;color:#00D4FF;flex-shrink:0;"></i>
                    {{ $c['us'] }}
                </div>
                <div class="p-4 sm:p-5 text-center text-sm" style="color:rgba(226,232,240,0.35);">{{ $c['them'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ===================== TRUST STRIP ===================== -->
<section class="relative px-4 sm:px-6 lg:px-8 py-16">
    <div class="max-w-5xl mx-auto">
        <p class="text-center text-xs font-bold uppercase tracking-[0.3em] mb-10 reveal from-bottom" style="color:rgba(226,232,240,0.3);">Powered By Industry-Leading Technology</p>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            @php
            $tech = [
                ['icon'=>'zap',      'name'=>'Ultra-Low Latency','sub'=>'Sub-50ms execution engine'],
                ['icon'=>'shield',   'name'=>'SOC 2 Certified',  'sub'=>'Enterprise security audit'],
                ['icon'=>'server',   'name'=>'99.9% Uptime',     'sub'=>'Redundant global infrastructure'],
                ['icon'=>'trending-up','name'=>'AI-Powered',     'sub'=>'Real-time adaptive algorithms'],
            ];
            @endphp
            @foreach($tech as $i => $t)
            <div class="reveal from-bottom reveal-d{{ $i+1 }} text-center p-5 rounded-2xl" style="background:rgba(0,212,255,0.04);border:1px solid rgba(0,212,255,0.1);">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl mb-3" style="background:linear-gradient(135deg,rgba(30,95,173,0.4),rgba(0,212,255,0.2));border:1px solid rgba(0,212,255,0.2);">
                    <i data-lucide="{{ $t['icon'] }}" style="width:20px;height:20px;color:#00D4FF;"></i>
                </div>
                <p class="font-bold text-sm mb-1" style="color:#E2E8F0;font-family:'Rajdhani',sans-serif;">{{ $t['name'] }}</p>
                <p class="text-xs" style="color:rgba(226,232,240,0.4);">{{ $t['sub'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ===================== FAQ ===================== -->
<section class="relative px-4 sm:px-6 lg:px-8 py-20 overflow-hidden" style="background:rgba(6,13,26,0.55);backdrop-filter:blur(2px);">
    <div class="absolute inset-0 grid-bg opacity-25 pointer-events-none"></div>
    <div class="max-w-3xl mx-auto relative">
        <div class="text-center mb-14 reveal from-bottom">
            <div class="section-tag">FAQ</div>
            <h2 class="font-bold" style="font-family:'Rajdhani',sans-serif;font-size:clamp(1.9rem,4vw,3rem);color:#E2E8F0;">
                Common <span class="gradient-text">Questions</span>
            </h2>
        </div>
        @php
        $faqs = [
            ['q'=>'Do I need programming experience?',
             'a'=>'No. Copier offers a strategy library of 50+ pre-built algorithms. Simply choose one, configure risk parameters, connect your broker, and go live in minutes.'],
            ['q'=>'Which brokers does Copier support?',
             'a'=>'We integrate with all major brokers via MT4, MT5, and FIX API — including Interactive Brokers, Oanda, Binance, Kraken, and 80+ others globally.'],
            ['q'=>'How is my capital protected?',
             'a'=>'Your funds remain in your own broker account at all times. Copier never touches your capital — we only send trade instructions to your broker via a secure API connection.'],
            ['q'=>'What is the minimum capital required?',
             'a'=>'There is no hard minimum. However, for effective position sizing and diversification, most traders start with $500–$2,000 depending on their strategy.'],
            ['q'=>'Can I run multiple strategies simultaneously?',
             'a'=>'Yes. You can run unlimited strategies across multiple broker accounts, each with independent risk settings and allocation budgets.'],
        ];
        @endphp
        <div class="space-y-3" id="faq-list">
            @foreach($faqs as $i => $faq)
            <div class="reveal from-bottom reveal-d{{ ($i % 4) + 1 }} faq-item rounded-2xl overflow-hidden" style="border:1px solid rgba(0,212,255,0.12);">
                <button class="faq-toggle w-full flex items-center justify-between gap-4 p-5 text-left" onclick="toggleFaq(this)">
                    <span class="font-semibold text-sm sm:text-base" style="color:#E2E8F0;font-family:'Rajdhani',sans-serif;">{{ $faq['q'] }}</span>
                    <i data-lucide="plus" class="faq-icon flex-shrink-0" style="width:18px;height:18px;color:#00D4FF;transition:transform 0.3s ease;"></i>
                </button>
                <div class="faq-answer overflow-hidden" style="max-height:0;transition:max-height 0.45s cubic-bezier(0.23,1,0.32,1);">
                    <p class="px-5 pb-5 text-sm leading-relaxed" style="color:rgba(226,232,240,0.6);">{{ $faq['a'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ===================== CTA BANNER ===================== -->
<section class="relative px-4 sm:px-6 lg:px-8 py-20">
    <div class="max-w-4xl mx-auto reveal from-scale">
        <div class="cta-card p-10 sm:p-14 text-center">
            <div class="absolute inset-0 pointer-events-none rounded-3xl overflow-hidden">
                <div style="position:absolute;inset:0;background:radial-gradient(ellipse at 50% 0%, rgba(0,212,255,0.12) 0%,transparent 65%);"></div>
            </div>
            <!-- Decorative lines -->
            <div class="absolute top-6 left-6 right-6 h-px" style="background:linear-gradient(90deg,transparent,rgba(0,212,255,0.2),transparent);"></div>
            <div class="absolute bottom-6 left-6 right-6 h-px" style="background:linear-gradient(90deg,transparent,rgba(0,212,255,0.2),transparent);"></div>

            <div class="relative">
                <div class="section-tag justify-center mb-3">Limited Offer</div>
                <h2 class="font-bold mb-4" style="font-family:'Rajdhani',sans-serif;font-size:clamp(1.8rem,4vw,2.8rem);color:#E2E8F0;">
                    Ready to Trade on <span class="gradient-shimmer">Autopilot?</span>
                </h2>
                <p class="mb-8 max-w-xl mx-auto" style="font-size:0.95rem;color:rgba(226,232,240,0.6);">Join thousands of traders automating their strategies. Start your free 14-day trial — no credit card required.</p>
                <div class="flex flex-wrap gap-3 justify-center">
                    <a href="{{ route('signup') }}" class="btn-primary">
                        <i data-lucide="rocket" style="width:16px;height:16px;"></i>
                        <span>Start Free Trial</span>
                    </a>
                    <a href="{{ route('help') }}" class="btn-outline">
                        <i data-lucide="message-circle" style="width:16px;height:16px;"></i>
                        <span>Talk to Sales</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('overlays')
<div id="feature-modal" role="dialog" aria-modal="true" aria-labelledby="modal-title">
    <div id="modal-backdrop" onclick="closeFeatureModal()"></div>
    <div id="modal-content">
        <button class="close-modal" aria-label="Close modal" onclick="closeFeatureModal()">
            <i data-lucide="x" class="w-5 h-5"></i>
        </button>
        <div class="feat-icon mb-6 scale-125 origin-left">
            <i id="modal-icon" data-lucide="cpu" style="width:22px;height:22px;color:#00D4FF;"></i>
        </div>
        <h2 id="modal-title" class="text-3xl font-bold mb-4" style="font-family:'Rajdhani',sans-serif; color:#fff;"></h2>
        <div class="h-1 w-20 rounded-full mb-8" style="background: linear-gradient(90deg, #1E5FAD, #00D4FF);"></div>
        <p id="modal-desc" class="text-lg leading-relaxed mb-8" style="color:rgba(226,232,240,0.7);"></p>

        <div class="flex flex-wrap gap-4 pt-4 border-t border-white/5">
            <a href="{{ route('signup') }}" class="btn-primary py-3 px-8 text-sm">
                <span>Try this now</span>
                <i data-lucide="zap" class="w-4 h-4"></i>
            </a>
            <button onclick="closeFeatureModal()" class="text-xs font-bold uppercase tracking-[0.2em] px-4 opacity-50 hover:opacity-100 transition-opacity">
                Close
            </button>
        </div>
    </div>
</div>

{{-- Review Submission Modal --}}
<div id="review-modal" style="display:none; position:fixed; inset:0; z-index:9999; align-items:center; justify-content:center; padding:1.5rem;">
    <div id="review-backdrop" style="position:absolute; inset:0; background:rgba(4, 9, 20, 0.85); backdrop-filter:blur(12px); opacity:0; transition:opacity 0.4s ease;" onclick="closeReviewModal()"></div>
    <div id="review-content" style="position:relative; width:100%; max-width:550px; background:linear-gradient(135deg, rgba(30,95,173,0.15), rgba(0,212,255,0.05)); border:1px solid rgba(0,212,255,0.2); border-radius:2rem; padding:2.5rem; transform:translateY(30px) scale(0.95); opacity:0; transition:all 0.4s cubic-bezier(0.23,1,0.32,1); box-shadow:0 40px 100px rgba(0,0,0,0.5);">
        <button class="close-modal" onclick="closeReviewModal()" style="position:absolute; top:1.5rem; right:1.5rem; width:40px; height:40px; border-radius:12px; display:flex; align-items:center; justify-content:center; background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.1); color:#fff; cursor:pointer;">
            <i data-lucide="x" class="w-5 h-5"></i>
        </button>
        
        <h2 style="font-family:'Rajdhani',sans-serif; font-size:2rem; font-weight:700; color:#fff; margin-bottom:0.5rem;">Share Your Experience</h2>
        <p style="color:rgba(226,232,240,0.6); margin-bottom:2rem; font-size:0.9rem;">Your review will help other traders make the right choice.</p>

        <form id="publicReviewForm" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label style="display:block; font-size:0.7rem; font-weight:600; text-transform:uppercase; color:#00D4FF; letter-spacing:0.1em; margin-bottom:0.5rem;">Full Name</label>
                    <input type="text" name="name" required placeholder="John Doe" 
                           style="width:100%; background:rgba(255,255,255,0.05); border:1px solid rgba(0,212,255,0.2); border-radius:0.75rem; padding:0.75rem 1rem; color:#fff; outline:none; font-size:0.9rem;">
                </div>
                <div>
                    <label style="display:block; font-size:0.7rem; font-weight:600; text-transform:uppercase; color:#00D4FF; letter-spacing:0.1em; margin-bottom:0.5rem;">Role / Title</label>
                    <input type="text" name="role" placeholder="Professional Trader" 
                           style="width:100%; background:rgba(255,255,255,0.05); border:1px solid rgba(0,212,255,0.2); border-radius:0.75rem; padding:0.75rem 1rem; color:#fff; outline:none; font-size:0.9rem;">
                </div>
            </div>

            <div>
                <label style="display:block; font-size:0.7rem; font-weight:600; text-transform:uppercase; color:#00D4FF; letter-spacing:0.1em; margin-bottom:0.5rem;">Rating</label>
                <div class="flex gap-2" id="starRatingContainer">
                    @for($i=1; $i<=5; $i++)
                        <i data-lucide="star" class="star-picker cursor-pointer" data-rating="{{ $i }}" 
                           style="width:24px; height:24px; color:rgba(255,255,255,0.2); fill:transparent; transition:all 0.2s ease;"></i>
                    @endfor
                </div>
                <input type="hidden" name="rating" id="ratingInput" value="5">
            </div>

            <div>
                <label style="display:block; font-size:0.7rem; font-weight:600; text-transform:uppercase; color:#00D4FF; letter-spacing:0.1em; margin-bottom:0.5rem;">Your Message</label>
                <textarea name="content" required rows="4" placeholder="How has Copier helped your trading?" 
                          style="width:100%; background:rgba(255,255,255,0.05); border:1px solid rgba(0,212,255,0.2); border-radius:0.75rem; padding:0.75rem 1rem; color:#fff; outline:none; font-size:0.9rem; resize:none;"></textarea>
            </div>

            <div>
                <label style="display:block; font-size:0.7rem; font-weight:600; text-transform:uppercase; color:#00D4FF; letter-spacing:0.1em; margin-bottom:0.5rem;">Avatar (Optional)</label>
                <input type="file" name="avatar" accept="image/*" 
                       style="width:100%; font-size:0.8rem; color:rgba(226,232,240,0.5);">
            </div>

            <button type="submit" class="btn-primary w-full py-4 rounded-xl mt-4" id="submitReviewBtn">
                <i data-lucide="send" class="w-4 h-4"></i>
                <span>Submit Review</span>
            </button>
        </form>
    </div>
</div>
@endpush

@push('scripts')
<script>



/* ── SCROLL REVEAL + 3D TILT ── */
(function() {
    /* ── INTERSECTION OBSERVER for .reveal ── */
    const revealEls = document.querySelectorAll('.reveal');
    const obs = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.classList.add('visible');
                obs.unobserve(e.target);
            }
        });
    }, { threshold: 0.12, rootMargin: '0px 0px -50px 0px' });
    revealEls.forEach(el => obs.observe(el));

    /* ── 3D CARD TILT ── */
    document.querySelectorAll('.tilt-3d').forEach(card => {
        card.addEventListener('mousemove', e => {
            const rect = card.getBoundingClientRect();
            const cx = rect.left + rect.width / 2;
            const cy = rect.top + rect.height / 2;
            const dx = (e.clientX - cx) / (rect.width / 2);
            const dy = (e.clientY - cy) / (rect.height / 2);
            card.style.transform = `perspective(800px) rotateX(${-dy * 8}deg) rotateY(${dx * 8}deg) translateY(-8px)`;
            card.style.setProperty('--mx', ((e.clientX - rect.left) / rect.width * 100) + '%');
            card.style.setProperty('--my', ((e.clientY - rect.top) / rect.height * 100) + '%');
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = '';
        });
    });

    /* ── FEATURE MODAL LOGIC ── */
    const features = @json($features);
    const modal = document.getElementById('feature-modal');
    const modalTitle = document.getElementById('modal-title');
    const modalDesc = document.getElementById('modal-desc');
    const modalIcon = document.getElementById('modal-icon');

    window.showFeatureDetails = function(index) {
        const f = features[index];
        modalTitle.textContent = f.title;
        modalDesc.innerHTML = f.details; // Using innerHTML in case we add markup later

        // Update icon
        modalIcon.setAttribute('data-lucide', f.icon);
        if(window.lucide) lucide.createIcons();

        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    };

    window.closeFeatureModal = function() {
        modal.classList.remove('active');
        document.body.style.overflow = '';
    };

    /* ── REVIEW MODAL LOGIC ── */
    const reviewModal = document.getElementById('review-modal');
    const reviewContent = document.getElementById('review-content');
    const reviewBackdrop = document.getElementById('review-backdrop');
    const publicReviewForm = document.getElementById('publicReviewForm');
    const starPickers = document.querySelectorAll('.star-picker');
    const ratingInput = document.getElementById('ratingInput');

    window.openReviewModal = function() {
        reviewModal.style.display = 'flex';
        // Force reflow
        reviewModal.offsetHeight;
        reviewBackdrop.style.opacity = '1';
        reviewContent.style.opacity = '1';
        reviewContent.style.transform = 'translateY(0) scale(1)';
        document.body.style.overflow = 'hidden';
        
        // Reset form
        publicReviewForm.reset();
        setRating(5);
    };

    window.closeReviewModal = function() {
        reviewBackdrop.style.opacity = '0';
        reviewContent.style.opacity = '0';
        reviewContent.style.transform = 'translateY(30px) scale(0.95)';
        setTimeout(() => {
            reviewModal.style.display = 'none';
            document.body.style.overflow = '';
        }, 400);
    };

    function setRating(val) {
        ratingInput.value = val;
        // Select fresh elements as Lucide might have replaced <i> with <svg>
        const currentStars = document.querySelectorAll('.star-picker');
        currentStars.forEach(s => {
            const r = parseInt(s.getAttribute('data-rating'));
            if (r <= val) {
                s.style.color = '#FBBF24';
                s.style.fill = '#FBBF24';
            } else {
                s.style.color = 'rgba(255,255,255,0.2)';
                s.style.fill = 'transparent';
            }
        });
    }

    // Use event delegation for reliability since Lucide replaces elements
    const starContainer = document.getElementById('starRatingContainer');
    starContainer.addEventListener('click', (e) => {
        const star = e.target.closest('.star-picker');
        if (star) {
            setRating(parseInt(star.getAttribute('data-rating')));
        }
    });

    publicReviewForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const btn = document.getElementById('submitReviewBtn');
        const btnText = btn.querySelector('span');
        const originalText = btnText.textContent;

        btn.disabled = true;
        btnText.textContent = 'Submitting...';

        const formData = new FormData(this);

        fetch("{{ route('reviews.store') }}", {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    title: 'Thank You!',
                    text: data.message,
                    icon: 'success',
                    background: '#0d1526',
                    color: '#e2e8f0',
                    confirmButtonColor: '#00D4FF'
                });
                closeReviewModal();
            } else {
                Swal.fire({
                    title: 'Error',
                    text: data.message || 'Something went wrong.',
                    icon: 'error',
                    background: '#0d1526',
                    color: '#e2e8f0',
                    confirmButtonColor: '#ef4444'
                });
            }
        })
        .catch(err => {
            console.error(err);
            Swal.fire({
                title: 'Error',
                text: 'Could not submit review. Please try again.',
                icon: 'error',
                background: '#0d1526',
                color: '#e2e8f0'
            });
        })
        .finally(() => {
            btn.disabled = false;
            btnText.textContent = originalText;
        });
    });

    // Close on Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            if (modal.classList.contains('active')) closeFeatureModal();
            if (reviewModal.style.display === 'flex') closeReviewModal();
        }
    });

    /* ── FAQ ACCORDION ── */
    window.toggleFaq = function(btn) {
        const item   = btn.closest('.faq-item');
        const answer = item.querySelector('.faq-answer');
        const icon   = item.querySelector('.faq-icon');
        const isOpen = answer.style.maxHeight && answer.style.maxHeight !== '0px';

        // Close all others
        document.querySelectorAll('.faq-item').forEach(other => {
            if (other !== item) {
                other.querySelector('.faq-answer').style.maxHeight = '0px';
                const oi = other.querySelector('.faq-icon');
                oi.setAttribute('data-lucide','plus');
                oi.style.transform = '';
                if(window.lucide) lucide.createIcons({ nodes: [oi] });
            }
        });

        if (isOpen) {
            answer.style.maxHeight = '0px';
            icon.setAttribute('data-lucide','plus');
            icon.style.transform = '';
        } else {
            answer.style.maxHeight = answer.scrollHeight + 'px';
            icon.setAttribute('data-lucide','minus');
            icon.style.transform = 'rotate(180deg)';
        }
        if(window.lucide) lucide.createIcons({ nodes: [icon] });
    };

})();
</script>
@endpush


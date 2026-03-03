@extends('customer.layouts.app')

@section('title', 'About Copier — Our Story, Team & Mission')

@push('styles')
<style>
    :root { --cyan:#00D4FF; --blue:#1E5FAD; --dark:#060D1A; --card-bg:rgba(10,22,45,0.85); --border:rgba(0,212,255,0.15); }

    /* ── GLOBAL MOBILE OVERFLOW FIX ── */
    html, body { overflow-x: hidden; max-width: 100vw; }
    * { box-sizing: border-box; }

    .grid-bg { background-image: linear-gradient(rgba(0,212,255,0.03) 1px,transparent 1px), linear-gradient(90deg,rgba(0,212,255,0.03) 1px,transparent 1px); background-size:60px 60px; }

    /* ── ANIMATIONS ── */
    @keyframes shimmer { 0%{background-position:-200% center;} 100%{background-position:200% center;} }
    @keyframes float { 0%,100%{transform:translateY(0);} 50%{transform:translateY(-12px);} }
    @keyframes orbPulse { 0%,100%{opacity:0.18;transform:scale(1);} 50%{opacity:0.3;transform:scale(1.06);} }
    @keyframes timelinePulse { 0%,100%{box-shadow:0 0 0 0 rgba(0,212,255,0.4);} 50%{box-shadow:0 0 0 8px rgba(0,212,255,0);} }
    @keyframes scanDown { 0%{top:-3px;} 100%{top:100%;} }

    .gradient-text { background:linear-gradient(90deg,#fff 0%,#00D4FF 55%,#1E5FAD 100%); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
    .gradient-shimmer { background:linear-gradient(90deg,#fff 20%,#00D4FF 50%,#fff 80%); background-size:200% auto; -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; animation:shimmer 4s linear infinite; }
    .anim-float { animation:float 5s ease-in-out infinite; }

    /* ── SCROLL REVEAL ── */
    .reveal { opacity:0; transition:opacity 0.85s cubic-bezier(0.23,1,0.32,1), transform 0.85s cubic-bezier(0.23,1,0.32,1); will-change:transform,opacity; }
    .reveal.from-left   { transform:translateX(-70px); }
    .reveal.from-right  { transform:translateX(70px); }
    .reveal.from-bottom { transform:translateY(55px); }
    .reveal.from-scale  { transform:scale(0.82); }
    .reveal.visible     { opacity:1 !important; transform:none !important; }
    .reveal-d1{transition-delay:0.08s;} .reveal-d2{transition-delay:0.18s;} .reveal-d3{transition-delay:0.28s;} .reveal-d4{transition-delay:0.38s;}

    /* ── CARDS ── */
    .card { transition:transform 0.4s cubic-bezier(0.23,1,0.32,1),box-shadow 0.4s ease,border-color 0.4s ease; position:relative; transform-style:preserve-3d; background: transparent; border: 1px solid var(--border) !important; backdrop-filter: blur(10px); }
    .card::before { content:''; position:absolute; inset:0; border-radius:inherit; background:radial-gradient(circle at var(--mx,50%) var(--my,50%),rgba(0,212,255,0.07) 0%,transparent 60%); opacity:0; transition:opacity 0.3s; pointer-events:none; }
    .card:hover::before { opacity:1; }

    @media (min-width: 768px) {
        .card::after { content:''; position:absolute; left:0; width:100%; height:2px; background:linear-gradient(90deg,transparent,var(--cyan),transparent); top:-2px; opacity:0; }
        .card:hover { transform:translateY(-10px) rotateX(3deg); border-color:rgba(0,212,255,0.35) !important; box-shadow:0 30px 80px rgba(0,212,255,0.18),0 0 0 1px rgba(0,212,255,0.2); }
        .card:hover::after { opacity:1; animation:scanDown 1.8s linear infinite; }
        .card:hover .feat-icon { box-shadow:0 0 24px rgba(0,212,255,0.4); background:linear-gradient(135deg,rgba(30,95,173,0.6),rgba(0,212,255,0.35)); }
    }

    .feat-icon { width:52px; height:52px; border-radius:14px; display:flex; align-items:center; justify-content:center; flex-shrink:0; background:linear-gradient(135deg,rgba(30,95,173,0.4),rgba(0,212,255,0.2)); border:1px solid rgba(0,212,255,0.25); transition:all 0.35s ease; }

    /* ── BUTTONS ── */
    .btn-primary { display:inline-flex; align-items:center; justify-content:center; gap:0.5rem; padding:0.9rem 2.2rem; border-radius:0.875rem; font-weight:600; font-size:0.9rem; letter-spacing:0.04em; text-decoration:none; cursor:pointer; white-space:nowrap; background:linear-gradient(135deg,#1E5FAD,#00D4FF); color:#fff; border:none; position:relative; overflow:hidden; transition:transform 0.3s cubic-bezier(0.23,1,0.32,1),box-shadow 0.3s ease; }
    .btn-primary::before { content:''; position:absolute; inset:0; background:linear-gradient(135deg,#00D4FF,#1E5FAD); opacity:0; transition:opacity 0.3s ease; }
    .btn-primary>*{position:relative;z-index:1;}
    .btn-primary:hover { transform:translateY(-3px) scale(1.02); box-shadow:0 18px 55px rgba(0,212,255,0.45); }
    .btn-primary:hover::before { opacity:1; }
    .btn-outline { display:inline-flex; align-items:center; justify-content:center; gap:0.5rem; padding:0.9rem 2.2rem; border-radius:0.875rem; font-weight:500; font-size:0.9rem; text-decoration:none; cursor:pointer; background:transparent; color:rgba(226,232,240,0.85); border:1px solid rgba(0,212,255,0.3); transition:all 0.3s ease; }
    .btn-outline:hover { background:rgba(0,212,255,0.1); border-color:var(--cyan); color:var(--cyan); transform:translateY(-2px); }

    /* ── SECTION TAG ── */
    .section-tag { display:inline-flex; align-items:center; gap:0.5rem; font-size:0.7rem; letter-spacing:0.3em; text-transform:uppercase; color:var(--cyan); margin-bottom:0.75rem; }
    .section-tag::before,.section-tag::after { content:''; height:1px; background:linear-gradient(90deg,transparent,rgba(0,212,255,0.5)); width:30px; }
    .section-tag::after { background:linear-gradient(270deg,transparent,rgba(0,212,255,0.5)); }

    /* ── ORB ── */
    .orb { position:absolute; border-radius:50%; filter:blur(70px); pointer-events:none; animation:orbPulse 6s ease-in-out infinite; }
    @media (max-width: 639px) { .orb { display: none; } }

    /* ── TIMELINE ── */
    .timeline-dot { animation:timelinePulse 2.5s ease-in-out infinite; }

    /* ── STAT MINI ── */
    .stat-mini { font-family:'Rajdhani',sans-serif; font-weight:700; }

    /* ── TEAM CARD ── */
    .team-card { transition:transform 0.4s cubic-bezier(0.23,1,0.32,1),box-shadow 0.4s ease; background:transparent; border:1px solid var(--border); backdrop-filter:blur(10px); }
    @media (min-width: 768px) {
        .team-card:hover { transform:translateY(-10px) rotateY(-5deg); box-shadow:0 25px 60px rgba(0,212,255,0.2); }
    }

    /* ── RESPONSIVE ── */
    @media (max-width: 767px) {
        /* Hero */
        .hero-section { padding-top: 5rem !important; padding-bottom: 3rem !important; }

        /* Story section grid */
        .story-grid { grid-template-columns: 1fr !important; gap: 2rem !important; }

        /* Values grid */
        .values-grid { grid-template-columns: 1fr 1fr !important; gap: 0.875rem !important; }

        /* Timeline mobile spacing */
        .timeline-mobile { padding-left: 1.5rem !important; }

        /* Regions grid */
        .regions-grid { grid-template-columns: 1fr !important; }

        /* Global stats */
        .global-stats-grid { grid-template-columns: 1fr 1fr !important; gap: 0.75rem !important; }

        /* Awards grid */
        .awards-grid { grid-template-columns: 1fr !important; }

        /* CTA buttons */
        .cta-buttons { flex-direction: column; align-items: stretch; }
        .cta-buttons a { width: 100%; justify-content: center; }

        /* Reduce section padding */
        .section-pad { padding-top: 3.5rem !important; padding-bottom: 3.5rem !important; }

        /* Mini stats 2-col */
        .mini-stats-grid { grid-template-columns: 1fr 1fr !important; }
    }

    @media (max-width: 479px) {
        /* Values full width on tiny screens */
        .values-grid { grid-template-columns: 1fr !important; }
        /* Pillars single col */
        .pillars-grid { grid-template-columns: 1fr !important; }
    }

    @media (min-width: 480px) and (max-width: 767px) {
        .pillars-grid { grid-template-columns: 1fr !important; }
    }

    @media (min-width: 640px) and (max-width: 1023px) {
        .regions-grid { grid-template-columns: 1fr 1fr !important; }
        .awards-grid { grid-template-columns: 1fr 1fr 1fr !important; }
    }
</style>
@endpush

@section('content')
<main style="overflow-x:hidden;">

    <!-- ── HERO ── -->
    <section class="hero-section relative overflow-hidden" style="padding-top:clamp(5rem,10vw,7rem);padding-bottom:clamp(3rem,6vw,5rem);">
        <div class="absolute inset-0 grid-bg opacity-40 pointer-events-none"></div>
        <div class="absolute inset-0 pointer-events-none" style="background:radial-gradient(ellipse 70% 50% at 50% 0%,rgba(30,95,173,0.25) 0%,transparent 70%);"></div>
        <div class="absolute pointer-events-none hidden sm:block" style="top:50%;left:50%;transform:translate(-50%,-50%);width:600px;height:600px;border-radius:50%;border:1px solid rgba(0,212,255,0.05);"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative">
            <div class="reveal from-bottom inline-flex items-center gap-2 px-4 py-1.5 rounded-full mb-6 text-xs font-medium tracking-widest uppercase" style="background:rgba(0,212,255,0.08);border:1px solid rgba(0,212,255,0.22);color:#00D4FF;">
                <span class="w-1.5 h-1.5 rounded-full bg-green-400 animate-pulse"></span>
                Est. 2026 &nbsp;·&nbsp; New York, USA
            </div>
            <h1 class="reveal from-bottom reveal-d1 font-bold mb-5" style="font-family:'Rajdhani',sans-serif;font-size:clamp(1.9rem,6vw,4.2rem);color:#fff;line-height:1.1;">
                The Future of Trading<br>
                <span class="gradient-shimmer">Is Algorithmic</span>
            </h1>
            <p class="reveal from-bottom reveal-d2 max-w-2xl mx-auto leading-relaxed px-2" style="font-size:clamp(0.88rem,2vw,1.1rem);color:rgba(226,232,240,0.6);">
                Copier was born from a simple belief: every trader deserves access to the same tools used by Wall Street's finest institutions.
            </p>
        </div>
    </section>

    <!-- ── OUR STORY ── -->
    <section class="section-pad py-16 sm:py-20 lg:py-28 px-4 sm:px-6 lg:px-8" style="background:rgba(6,13,26,0.6);backdrop-filter:blur(2px);">
        <div class="max-w-7xl mx-auto">
            <div class="story-grid grid grid-cols-1 lg:grid-cols-2 gap-8 sm:gap-12 lg:gap-20 items-center">

                <!-- Image -->
                <div class="reveal from-left relative">
                    <div class="absolute -inset-4 rounded-3xl opacity-20 pointer-events-none hidden sm:block" style="background:linear-gradient(135deg,#1E5FAD,#00D4FF);filter:blur(24px);"></div>
                    <div class="relative rounded-2xl overflow-hidden" style="border:1px solid rgba(0,212,255,0.2);">
                        <img src="https://images.unsplash.com/photo-1631038506857-6c970dd9ba02?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080"
                             alt="Copier team" class="w-full object-cover" style="height:clamp(200px,40vw,400px);">
                        <div class="absolute inset-0" style="background:linear-gradient(180deg,transparent 50%,rgba(6,13,26,0.8) 100%);"></div>
                        <div class="absolute bottom-4 left-4 right-4">
                            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs" style="background:rgba(0,212,255,0.15);border:1px solid rgba(0,212,255,0.3);color:#00D4FF;">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-400 animate-pulse"></span>
                                Est. 2026 — New York, USA
                            </div>
                        </div>
                        <div class="absolute top-3 right-3 w-8 h-8 hidden sm:block" style="border-top:2px solid rgba(0,212,255,0.5);border-right:2px solid rgba(0,212,255,0.5);border-radius:0 4px 0 0;"></div>
                        <div class="absolute bottom-3 left-3 w-8 h-8 hidden sm:block" style="border-bottom:2px solid rgba(0,212,255,0.5);border-left:2px solid rgba(0,212,255,0.5);border-radius:0 0 0 4px;"></div>
                    </div>
                </div>

                <!-- Text -->
                <div class="reveal from-right">
                    <div class="section-tag">Our Story</div>
                    <h2 class="font-bold mb-6" style="font-family:'Rajdhani',sans-serif;font-size:clamp(1.6rem,3.5vw,2.8rem);color:#fff;">Democratizing Algo Trading</h2>
                    <div class="space-y-4 mb-8" style="font-size:0.93rem;color:rgba(226,232,240,0.65);line-height:1.75;">
                        <p>Founded in early 2026, Copier emerged from the frustration of seeing retail traders lose to institutional algorithms. Our founding team — quants, engineers, and traders — came together to level the playing field.</p>
                        <p>We built Copier from the ground up using the same principles that power the world's best hedge funds: rigorous backtesting, disciplined risk management, and relentless optimization.</p>
                        <p>Today, Copier serves thousands of traders across 60+ countries, processing millions of trades monthly with institutional-grade infrastructure and unmatched transparency.</p>
                    </div>
                    <!-- Mini stats -->
                    <div class="mini-stats-grid grid grid-cols-2 gap-4">
                        @php
                        $miniStats=[['val'=>'60+','desc'=>'Countries Served'],['val'=>'12K+','desc'=>'Active Traders'],['val'=>'99.9%','desc'=>'Platform Uptime'],['val'=>'$500M+','desc'=>'Volume Managed']];
                        @endphp
                        @foreach($miniStats as $i=>$ms)
                        <div class="reveal from-bottom reveal-d{{ $i+1 }} p-4 rounded-xl" style="background:rgba(0,212,255,0.05);border:1px solid rgba(0,212,255,0.12);">
                            <p class="stat-mini" style="font-size:clamp(1.3rem,3vw,1.8rem);color:#00D4FF;">{{ $ms['val'] }}</p>
                            <p style="font-size:0.72rem;color:rgba(226,232,240,0.5);margin-top:0.2rem;">{{ $ms['desc'] }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── VALUES ── -->
    <section class="section-pad relative py-16 sm:py-20 lg:py-28 px-4 sm:px-6 lg:px-8 overflow-hidden">
        <div class="absolute inset-0 grid-bg opacity-30 pointer-events-none"></div>
        <div class="orb" style="width:400px;height:400px;background:rgba(30,95,173,0.2);top:10%;right:-80px;animation-delay:0s;"></div>
        <div class="orb" style="width:300px;height:300px;background:rgba(0,212,255,0.08);bottom:10%;left:-60px;animation-delay:3s;"></div>

        <div class="max-w-7xl mx-auto relative">
            <div class="text-center mb-12 sm:mb-16 reveal from-bottom">
                <div class="section-tag">Our Values</div>
                <h2 class="font-bold" style="font-family:'Rajdhani',sans-serif;font-size:clamp(1.7rem,4vw,3rem);color:#fff;">What Drives Us</h2>
            </div>
            <div class="values-grid grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
                @php
                $values=[
                    ['icon'=>'target','title'=>'Precision','desc'=>'Every line of code and trade execution is optimized for maximum accuracy.','dir'=>'from-left'],
                    ['icon'=>'heart','title'=>'Transparency','desc'=>'We share real performance data. No misleading promises, only verified results.','dir'=>'from-bottom'],
                    ['icon'=>'lightbulb','title'=>'Innovation','desc'=>'Continuously evolving our AI models and infrastructure to stay ahead of markets.','dir'=>'from-bottom'],
                    ['icon'=>'users','title'=>'Community','desc'=>'A thriving ecosystem of traders, developers, and analysts sharing knowledge.','dir'=>'from-right'],
                ];
                @endphp
                @foreach($values as $i=>$v)
                <div class="card reveal {{ $v['dir'] }} reveal-d{{ $i+1 }} p-5 sm:p-6 rounded-2xl">
                    <div class="feat-icon mb-4 sm:mb-5" style="width:44px;height:44px;">
                        <i data-lucide="{{ $v['icon'] }}" style="width:20px;height:20px;color:#00D4FF;"></i>
                    </div>
                    <h3 class="font-semibold mb-2" style="color:#fff;font-family:'Rajdhani',sans-serif;font-size:1.05rem;">{{ $v['title'] }}</h3>
                    <p class="text-xs sm:text-sm leading-relaxed" style="color:rgba(226,232,240,0.55);">{{ $v['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ── TIMELINE ── -->
    <section class="section-pad py-16 sm:py-20 lg:py-28 px-4 sm:px-6 lg:px-8" style="background:rgba(6,13,26,0.7);backdrop-filter:blur(2px);">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-12 sm:mb-16 reveal from-bottom">
                <div class="section-tag">Milestones</div>
                <h2 class="font-bold" style="font-family:'Rajdhani',sans-serif;font-size:clamp(1.7rem,4vw,3rem);color:#fff;">Our Journey</h2>
            </div>

            @php
            $milestones=[
                ['year'=>'2026 Q1','title'=>'Copier Founded','desc'=>'Launched with a mission to democratize algorithmic trading for all investor types.'],
                ['year'=>'2026 Q2','title'=>'Platform Beta','desc'=>'Released beta version with copy trading and basic automation features to 500 early users.'],
                ['year'=>'2026 Q3','title'=>'MetaTrader Launch','desc'=>'Full MT4 & MT5 integration deployed with 99.9% uptime guarantee and sub-50ms execution.'],
                ['year'=>'2026 Q4','title'=>'10,000 Traders','desc'=>'Crossed 10,000 active traders milestone with $500M+ in volume managed monthly.'],
            ];
            @endphp

            <!-- Mobile: vertical left-aligned -->
            <div class="sm:hidden space-y-5 timeline-mobile" style="padding-left:1.75rem;border-left:1px solid rgba(0,212,255,0.2);">
                @foreach($milestones as $i=>$m)
                <div class="reveal from-right reveal-d{{ ($i%4)+1 }} relative">
                    <div class="absolute timeline-dot" style="left:-2.22rem;top:1rem;width:0.875rem;height:0.875rem;border-radius:50%;background:linear-gradient(135deg,#1E5FAD,#00D4FF);box-shadow:0 0 10px rgba(0,212,255,0.6);"></div>
                    <div class="p-4 rounded-xl" style="background:var(--card-bg);border:1px solid var(--border);">
                        <span class="text-xs tracking-widest uppercase" style="color:#00D4FF;">{{ $m['year'] }}</span>
                        <h3 class="font-semibold mt-1 mb-1.5" style="color:#fff;font-family:'Rajdhani',sans-serif;font-size:1rem;">{{ $m['title'] }}</h3>
                        <p class="text-xs leading-relaxed" style="color:rgba(226,232,240,0.55);">{{ $m['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Desktop: centred alternating -->
            <div class="hidden sm:block relative">
                <div class="absolute left-1/2 top-0 bottom-0 w-px -translate-x-1/2" style="background:linear-gradient(180deg,#1E5FAD,#00D4FF,transparent);"></div>
                <div class="space-y-12">
                    @foreach($milestones as $i=>$m)
                    @php $isLeft=$i%2===0; @endphp
                    <div class="flex items-center gap-8 {{ $isLeft?'':'flex-row-reverse' }}">
                        <div class="flex-1 {{ $isLeft?'text-right':'text-left' }} reveal {{ $isLeft?'from-left':'from-right' }} reveal-d{{ ($i%4)+1 }}">
                            <div class="inline-block p-5 rounded-xl max-w-xs" style="background:var(--card-bg);border:1px solid var(--border);">
                                <span class="text-xs tracking-widest uppercase" style="color:#00D4FF;">{{ $m['year'] }}</span>
                                <h3 class="font-semibold mt-1 mb-1.5" style="color:#fff;font-family:'Rajdhani',sans-serif;font-size:1.05rem;">{{ $m['title'] }}</h3>
                                <p class="text-sm leading-relaxed" style="color:rgba(226,232,240,0.55);">{{ $m['desc'] }}</p>
                            </div>
                        </div>
                        <div class="relative z-10 w-5 h-5 rounded-full flex-shrink-0 timeline-dot" style="background:linear-gradient(135deg,#1E5FAD,#00D4FF);box-shadow:0 0 14px rgba(0,212,255,0.7);"></div>
                        <div class="flex-1"></div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- ── HOW WE BUILD ── -->
    <section class="section-pad py-16 sm:py-20 lg:py-28 px-4 sm:px-6 lg:px-8" style="background:rgba(6,13,26,0.65);backdrop-filter:blur(2px);">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12 sm:mb-16 reveal from-bottom">
                <div class="section-tag">Engineering Philosophy</div>
                <h2 class="font-bold" style="font-family:'Rajdhani',sans-serif;font-size:clamp(1.7rem,4vw,3rem);color:#fff;">How We Build</h2>
                <p class="mt-3 max-w-xl mx-auto text-sm px-4" style="color:rgba(226,232,240,0.5);">Every decision at Copier is driven by three non-negotiable principles: speed, resilience, and trust.</p>
            </div>
            <div class="pillars-grid grid grid-cols-1 lg:grid-cols-3 gap-5 sm:gap-6">
                @php
                $pillars = [
                    ['icon' => 'zap','num' => '01','title' => 'Speed First','desc' => 'Our co-location nodes sit millimetres from exchange matching engines. Every microsecond matters — we obsessively profile, benchmark, and eliminate latency at every layer of the stack.','stat' => '< 50ms','stat_label' => 'Avg. Execution','dir' => 'from-left'],
                    ['icon' => 'refresh-cw','num' => '02','title' => 'Built for Resilience','desc' => 'Active-active redundancy across three AWS regions means zero single points of failure. Chaos engineering drills run weekly to harden every subsystem before markets open.','stat' => '99.9%','stat_label' => 'Guaranteed Uptime','dir' => 'from-bottom'],
                    ['icon' => 'lock','num' => '03','title' => 'Security by Design','desc' => 'Security is not an afterthought. We enforce end-to-end encryption, zero-trust networking, and quarterly third-party penetration tests — the same standard trusted by tier-1 banks.','stat' => 'SOC 2','stat_label' => 'Type II Certified','dir' => 'from-right'],
                ];
                @endphp
                @foreach($pillars as $i => $p)
                <div class="card reveal {{ $p['dir'] }} reveal-d{{ $i+1 }} p-6 sm:p-7 rounded-2xl flex flex-col gap-5">
                    <div class="flex items-center gap-4">
                        <div class="feat-icon">
                            <i data-lucide="{{ $p['icon'] }}" style="width:20px;height:20px;color:#00D4FF;"></i>
                        </div>
                        <span class="text-xs font-bold tracking-[0.3em]" style="color:rgba(0,212,255,0.4);">{{ $p['num'] }}</span>
                    </div>
                    <div>
                        <h3 class="font-bold mb-2" style="color:#fff;font-family:'Rajdhani',sans-serif;font-size:1.2rem;">{{ $p['title'] }}</h3>
                        <p class="text-sm leading-relaxed" style="color:rgba(226,232,240,0.55);">{{ $p['desc'] }}</p>
                    </div>
                    <div class="mt-auto pt-5" style="border-top:1px solid rgba(0,212,255,0.1);">
                        <p class="font-bold" style="font-family:'Rajdhani',sans-serif;font-size:1.5rem;color:#00D4FF;">{{ $p['stat'] }}</p>
                        <p class="text-xs mt-0.5" style="color:rgba(226,232,240,0.4);">{{ $p['stat_label'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ── GLOBAL PRESENCE ── -->
    <section class="section-pad relative py-16 sm:py-20 lg:py-28 px-4 sm:px-6 lg:px-8 overflow-hidden">
        <div class="absolute inset-0 grid-bg opacity-25 pointer-events-none"></div>
        <div class="orb" style="width:500px;height:500px;background:rgba(30,95,173,0.15);top:50%;left:50%;transform:translate(-50%,-50%);"></div>
        <div class="max-w-7xl mx-auto relative">
            <div class="text-center mb-12 sm:mb-16 reveal from-bottom">
                <div class="section-tag">Global Reach</div>
                <h2 class="font-bold" style="font-family:'Rajdhani',sans-serif;font-size:clamp(1.7rem,4vw,3rem);color:#fff;">Trusted Around the World</h2>
                <p class="mt-3 max-w-xl mx-auto text-sm px-4" style="color:rgba(226,232,240,0.5);">Copier operates across every major financial market, around the clock.</p>
            </div>

            <!-- Large stats grid -->
            <div class="global-stats-grid grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5 mb-8 sm:mb-12">
                @php
                $globalStats = [
                    ['val'=>'60+','label'=>'Countries','sub'=>'Active trader base'],
                    ['val'=>'$2B+','label'=>'Annual Volume','sub'=>'Managed algorithmically'],
                    ['val'=>'18ms','label'=>'Fastest Fill','sub'=>'Sub-20ms on liquid pairs'],
                    ['val'=>'4.9★','label'=>'User Rating','sub'=>'Avg. across app stores'],
                ];
                @endphp
                @foreach($globalStats as $i => $gs)
                <div class="reveal from-bottom reveal-d{{ $i+1 }} p-5 sm:p-6 rounded-2xl text-center" style="background:rgba(0,212,255,0.04);border:1px solid rgba(0,212,255,0.12);">
                    <p class="font-bold mb-1" style="font-family:'Rajdhani',sans-serif;font-size:clamp(1.5rem,4vw,2.5rem);color:#00D4FF;">{{ $gs['val'] }}</p>
                    <p class="font-semibold text-xs sm:text-sm mb-0.5" style="color:#E2E8F0;">{{ $gs['label'] }}</p>
                    <p class="text-xs hidden sm:block" style="color:rgba(226,232,240,0.4);">{{ $gs['sub'] }}</p>
                </div>
                @endforeach
            </div>

            <!-- Region cards -->
            <div class="regions-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-5">
                @php
                $regions = [
                    ['region'=>'North America','icon'=>'map-pin','traders'=>'4,200+','exchanges'=>'NYSE, NASDAQ, CME','dir'=>'from-left'],
                    ['region'=>'Europe','icon'=>'map-pin','traders'=>'3,800+','exchanges'=>'LSE, Euronext, XETRA','dir'=>'from-bottom'],
                    ['region'=>'Asia-Pacific','icon'=>'map-pin','traders'=>'2,900+','exchanges'=>'Nikkei, HKEx, ASX','dir'=>'from-bottom'],
                    ['region'=>'Middle East','icon'=>'map-pin','traders'=>'980+','exchanges'=>'Tadawul, DFM, ADX','dir'=>'from-bottom'],
                    ['region'=>'South America','icon'=>'map-pin','traders'=>'620+','exchanges'=>'B3, BVC, BYMA','dir'=>'from-bottom'],
                    ['region'=>'Crypto Global','icon'=>'map-pin','traders'=>'5,100+','exchanges'=>'Binance, Coinbase, Kraken','dir'=>'from-right'],
                ];
                @endphp
                @foreach($regions as $i => $r)
                <div class="card reveal {{ $r['dir'] }} reveal-d{{ ($i%4)+1 }} p-4 sm:p-5 rounded-2xl flex items-center gap-4">
                    <div class="feat-icon flex-shrink-0" style="width:44px;height:44px;">
                        <i data-lucide="{{ $r['icon'] }}" style="width:18px;height:18px;color:#00D4FF;"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="font-bold text-sm" style="color:#fff;font-family:'Rajdhani',sans-serif;">{{ $r['region'] }}</p>
                        <p class="text-xs mt-0.5 truncate" style="color:#00D4FF;">{{ $r['traders'] }} traders · {{ $r['exchanges'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ── AWARDS & RECOGNITION ── -->
    <section class="section-pad py-14 sm:py-16 px-4 sm:px-6 lg:px-8" style="background:rgba(6,13,26,0.7);backdrop-filter:blur(2px);">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-10 sm:mb-12 reveal from-bottom">
                <div class="section-tag">Recognition</div>
                <h2 class="font-bold" style="font-family:'Rajdhani',sans-serif;font-size:clamp(1.5rem,3.5vw,2.5rem);color:#fff;">Awards & Press</h2>
            </div>
            <div class="awards-grid grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-5">
                @php
                $awards = [
                    ['icon'=>'award','title'=>'Best FinTech 2026','body'=>'TechCrunch Disrupt — "Most innovative algo-trading platform of the year."','dir'=>'from-left'],
                    ['icon'=>'trophy','title'=>'Top Startup 2026','body'=>'Forbes 30 Under 30 — Founders Marcus Chen & Sofia Reyes named to the list.','dir'=>'from-bottom'],
                    ['icon'=>'star','title'=>'4.9 / 5 Rating','body'=>'Rated by over 8,000 active users across Trustpilot, App Store, and Google Play.','dir'=>'from-right'],
                ];
                @endphp
                @foreach($awards as $i => $aw)
                <div class="card reveal {{ $aw['dir'] }} reveal-d{{ $i+1 }} p-5 sm:p-6 rounded-2xl text-center">
                    <div class="inline-flex items-center justify-center w-12 h-12 sm:w-14 sm:h-14 rounded-2xl mb-4 sm:mb-5 mx-auto" style="background:linear-gradient(135deg,rgba(30,95,173,0.5),rgba(0,212,255,0.25));border:1px solid rgba(0,212,255,0.3);">
                        <i data-lucide="{{ $aw['icon'] }}" style="width:22px;height:22px;color:#00D4FF;"></i>
                    </div>
                    <h3 class="font-bold mb-2" style="color:#fff;font-family:'Rajdhani',sans-serif;font-size:1.1rem;">{{ $aw['title'] }}</h3>
                    <p class="text-xs leading-relaxed" style="color:rgba(226,232,240,0.5);">{{ $aw['body'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ── CTA ── -->
    <section class="py-14 sm:py-16 px-4 sm:px-6 lg:px-8" style="border-top:1px solid rgba(0,212,255,0.08);">
        <div class="max-w-3xl mx-auto text-center reveal from-scale">
            <div class="section-tag justify-center mb-4">Join Us</div>
            <h2 class="font-bold mb-4" style="font-family:'Rajdhani',sans-serif;font-size:clamp(1.4rem,4vw,2.4rem);color:#fff;">Ready to Join the Copier Family?</h2>
            <p class="mb-8 px-2" style="font-size:0.95rem;color:rgba(226,232,240,0.55);">Experience professional algo trading trusted by thousands globally.</p>
            <div class="cta-buttons flex flex-wrap gap-3 justify-center">
                <a href="{{ route('services') }}" class="btn-primary">
                    <i data-lucide="arrow-right" style="width:16px;height:16px;"></i>
                    <span>View Our Packages</span>
                </a>
                <a href="{{ route('signup') }}" class="btn-outline">
                    <i data-lucide="user-plus" style="width:16px;height:16px;"></i>
                    <span>Start Free Trial</span>
                </a>
            </div>
        </div>
    </section>

</main>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded',()=>{
    if(typeof lucide !== 'undefined') lucide.createIcons();

    /* Scroll reveal */
    const obs=new IntersectionObserver(entries=>{
        entries.forEach(e=>{ if(e.isIntersecting){e.target.classList.add('visible');obs.unobserve(e.target);} });
    },{threshold:0.08,rootMargin:'0px 0px -30px 0px'});
    document.querySelectorAll('.reveal').forEach(el=>obs.observe(el));

    /* 3D tilt on cards — desktop only */
    if(window.innerWidth >= 768) {
        document.querySelectorAll('.card, .team-card').forEach(card=>{
            card.addEventListener('mousemove',e=>{
                const r=card.getBoundingClientRect();
                const dx=(e.clientX-r.left-r.width/2)/(r.width/2);
                const dy=(e.clientY-r.top-r.height/2)/(r.height/2);
                card.style.transform=`perspective(700px) rotateX(${-dy*8}deg) rotateY(${dx*8}deg) translateY(-8px)`;
                card.style.setProperty('--mx',((e.clientX-r.left)/r.width*100)+'%');
                card.style.setProperty('--my',((e.clientY-r.top)/r.height*100)+'%');
            });
            card.addEventListener('mouseleave',()=>card.style.transform='');
        });
    }
});
</script>
@endpush
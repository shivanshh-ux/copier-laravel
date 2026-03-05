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

    /* ── GLOBAL MOBILE OVERFLOW FIX ── */
    html, body { overflow-x: hidden; max-width: 100vw; }
    * { box-sizing: border-box; }

    .grid-bg{background-image:linear-gradient(rgba(0,212,255,0.03) 1px,transparent 1px),linear-gradient(90deg,rgba(0,212,255,0.03) 1px,transparent 1px);background-size:60px 60px;}

    @keyframes shimmer{0%{background-position:-200% center;}100%{background-position:200% center;}}
    @keyframes float{0%,100%{transform:translateY(0);}50%{transform:translateY(-12px);}}
    @keyframes orbPulse{0%,100%{opacity:0.18;transform:scale(1);}50%{opacity:0.3;transform:scale(1.06);}}
    @keyframes scanDown{0%{top:-3px;}100%{top:100%;}}
    @keyframes borderFlow{0%{background-position:0% 50%;}50%{background-position:100% 50%;}100%{background-position:0% 50%;}}
    @keyframes priceFlash{0%{opacity:0;transform:scale(0.8);}100%{opacity:1;transform:scale(1);}}
    @keyframes badgePulse{0%,100%{box-shadow:0 0 0 0 rgba(0,212,255,0.4);}50%{box-shadow:0 0 0 6px rgba(0,212,255,0);}}
    @keyframes checkPop{0%{opacity:0;transform:scale(0);}70%{transform:scale(1.2);}100%{opacity:1;transform:scale(1);}}

    .gradient-text{background:linear-gradient(90deg,#fff 0%,#00D4FF 55%,#1E5FAD 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;}
    .gradient-shimmer{background:linear-gradient(90deg,#fff 20%,#00D4FF 50%,#fff 80%);background-size:200% auto;-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;animation:shimmer 4s linear infinite;}

    /* ── SCROLL REVEAL ── */
    .reveal{opacity:0;transition:opacity 0.85s cubic-bezier(0.23,1,0.32,1),transform 0.85s cubic-bezier(0.23,1,0.32,1);will-change:transform,opacity;}
    .reveal.from-left{transform:translateX(-70px);}
    .reveal.from-right{transform:translateX(70px);}
    .reveal.from-bottom{transform:translateY(55px);}
    .reveal.from-scale{transform:scale(0.82);}
    .reveal.from-top{transform:translateY(-40px);}
    .reveal.visible{opacity:1!important;transform:none!important;}
    .reveal-d1{transition-delay:0.06s;}.reveal-d2{transition-delay:0.14s;}.reveal-d3{transition-delay:0.22s;}.reveal-d4{transition-delay:0.30s;}

    /* ── PRICING CARDS ── */
    .pricing-card{
        position:relative;border-radius:1.5rem;overflow:hidden;
        background: transparent; backdrop-filter:blur(12px);
        transition:transform 0.45s cubic-bezier(0.23,1,0.32,1),box-shadow 0.45s ease, border-color 0.45s ease;
        transform-style:preserve-3d;
        border: 1px solid var(--border) !important;
    }
    @media (min-width: 768px) {
        .pricing-card:hover{
            transform:translateY(-14px) rotateX(3deg);
            box-shadow:0 40px 100px rgba(0,212,255,0.2);
            border-color: rgba(0,212,255,0.45) !important;
        }
        .pricing-card::after {
            content:''; position:absolute; left:0; width:100%; height:2px;
            background:linear-gradient(90deg,transparent,var(--cyan),transparent);
            top:-2px; opacity:0;
            transition: top 0.1s linear;
            pointer-events: none;
            z-index: 10;
            border-radius: inherit;
        }
        .pricing-card:hover::after { opacity: 1; animation: scanDown 2s linear infinite; }
        .pricing-card.featured:hover{transform:translateY(-18px) rotateX(3deg) scale(1.02);box-shadow:0 50px 120px rgba(0,212,255,0.3); border-color: rgba(0,212,255,0.8) !important;}
    }

    .pricing-card.featured{
        background:linear-gradient(160deg,rgba(0,90,140,0.35),rgba(0,212,255,0.08));
        border:1px solid rgba(0,212,255,0.5)!important;
        box-shadow:0 0 60px rgba(0,212,255,0.15);
    }

    /* animated top stripe for featured */
    .pricing-card.featured::before{
        content:'';position:absolute;top:0;left:0;right:0;height:3px;
        background:linear-gradient(270deg,#1E5FAD,#00D4FF,#7EEEFF,#00D4FF,#1E5FAD);
        background-size:300% 100%;animation:borderFlow 4s linear infinite;
    }
    .pricing-card.enterprise::before{
        content:'';position:absolute;top:0;left:0;right:0;height:3px;
        background:linear-gradient(270deg,#92400E,#F59E0B,#FDE68A,#F59E0B,#92400E);
        background-size:300% 100%;animation:borderFlow 4s linear infinite;
    }

    /* ── FEAT ICON ── */
    .feat-icon{width:52px;height:52px;border-radius:14px;display:flex;align-items:center;justify-content:center;flex-shrink:0;background:linear-gradient(135deg,rgba(30,95,173,0.4),rgba(0,212,255,0.2));border:1px solid rgba(0,212,255,0.25);transition:all 0.35s ease;}

    /* ── CARD HOVER ── */
    .card{
        transition:transform 0.4s cubic-bezier(0.23,1,0.32,1),box-shadow 0.4s ease,border-color 0.4s ease;
        position:relative;
        transform-style:preserve-3d;
        background: transparent;
        border: 1px solid var(--border) !important;
        backdrop-filter: blur(10px);
    }
    @media (min-width: 768px) {
        .card::after{
            content:'';position:absolute;left:0;width:100%;height:2px;
            background:linear-gradient(90deg,transparent,var(--cyan),transparent);
            top:-2px;opacity:0;
            transition: top 0.1s linear;
            pointer-events: none;
            z-index: 10;
            border-radius: inherit;
        }
        .card:hover{transform:translateY(-8px) rotateX(3deg);border-color:rgba(0,212,255,0.45)!important;box-shadow:0 30px 80px rgba(0,212,255,0.18);}
        .card:hover::after{opacity:1;animation:scanDown 2s linear infinite;}
        .card:hover .feat-icon{box-shadow:0 0 24px rgba(0,212,255,0.4);background:linear-gradient(135deg,rgba(30,95,173,0.6),rgba(0,212,255,0.35));}
    }

    /* ── BUTTONS ── */
    .btn-primary{display:inline-flex;align-items:center;justify-content:center;gap:0.5rem;padding:0.9rem 2.2rem;border-radius:0.875rem;font-weight:600;font-size:0.9rem;letter-spacing:0.04em;text-decoration:none;cursor:pointer;white-space:nowrap;background:linear-gradient(135deg,#1E5FAD,#00D4FF);color:#fff;border:none;position:relative;overflow:hidden;transition:transform 0.3s cubic-bezier(0.23,1,0.32,1),box-shadow 0.3s ease;}
    .btn-primary::before{content:'';position:absolute;inset:0;background:linear-gradient(135deg,#00D4FF,#1E5FAD);opacity:0;transition:opacity 0.3s ease;}
    .btn-primary>*{position:relative;z-index:1;}
    .btn-primary:hover{transform:translateY(-3px) scale(1.02);box-shadow:0 18px 55px rgba(0,212,255,0.45);}
    .btn-primary:hover::before{opacity:1;}
    .btn-outline{display:inline-flex;align-items:center;justify-content:center;gap:0.5rem;padding:0.9rem 2.2rem;border-radius:0.875rem;font-weight:500;font-size:0.9rem;text-decoration:none;cursor:pointer;background:transparent;color:rgba(226,232,240,0.85);border:1px solid rgba(0,212,255,0.3);transition:all 0.3s ease;}
    .btn-outline:hover{background:rgba(0,212,255,0.1);border-color:var(--cyan);color:var(--cyan);transform:translateY(-2px);}
    .btn-gold{background:linear-gradient(135deg,#92400E,#F59E0B)!important;color:#fff!important;}
    .btn-gold:hover{box-shadow:0 18px 55px rgba(245,158,11,0.4)!important;}

    /* ── SECTION TAG ── */
    .section-tag{display:inline-flex;align-items:center;gap:0.5rem;font-size:0.7rem;letter-spacing:0.3em;text-transform:uppercase;color:var(--cyan);margin-bottom:0.75rem;}
    .section-tag::before,.section-tag::after{content:'';height:1px;background:linear-gradient(90deg,transparent,rgba(0,212,255,0.5));width:30px;}
    .section-tag::after { background:linear-gradient(270deg,transparent,rgba(0,212,255,0.5)); }

    /* ── ORB ── */
    .orb{position:absolute;border-radius:50%;filter:blur(70px);pointer-events:none;animation:orbPulse 6s ease-in-out infinite;}
    /* Orbs hidden on mobile to prevent overflow */
    @media (max-width: 639px) { .orb { display: none; } }

    /* ── CHECK ITEMS ── */
    .check-item{display:flex;align-items:flex-start;gap:0.6rem;font-size:0.82rem;color:rgba(226,232,240,0.8);margin-bottom:0.6rem;line-height:1.4;}
    .check-item .icon-yes{color:#10B981;flex-shrink:0;margin-top:0.05rem;}
    .check-item .icon-no{color:rgba(226,232,240,0.2);flex-shrink:0;margin-top:0.05rem;}
    .check-item.crossed{color:rgba(226,232,240,0.25);text-decoration:line-through;}

    /* ── POPULAR BADGE ── */
    .popular-badge{animation:badgePulse 2.5s ease-in-out infinite;}

    /* ── PRICE NUM ── */
    .price-num{font-family:'Rajdhani',sans-serif;font-weight:700;line-height:1;}

    /* ── PAGE TRANSITION ── */
    #page-transition{position:fixed;inset:0;z-index:9999;background:linear-gradient(135deg,#020914,#0A1628);transform:scaleY(0);transform-origin:bottom;transition:transform 0.5s cubic-bezier(0.76,0,0.24,1);pointer-events:none;}
    #page-transition.entering{transform:scaleY(1);transform-origin:top;}

    /* ── MODAL ── */
    .modal-backdrop {
        position: fixed; inset: 0; background: rgba(2, 9, 20, 0.85); backdrop-filter: blur(10px);
        z-index: 1000; display: flex; align-items: center; justify-content: center;
        opacity: 0; pointer-events: none; transition: opacity 0.4s ease;
        padding: 1rem;
    }
    .modal-backdrop.active { opacity: 1; pointer-events: auto; }
    .modal-content {
        background: var(--card-bg); border: 1px solid var(--border); border-radius: 2rem;
        width: 100%; max-width: 500px; padding: 2.5rem; transform: scale(0.9);
        transition: transform 0.4s cubic-bezier(0.23, 1, 0.32, 1);
        position: relative; overflow: hidden;
        max-height: 90vh;
        overflow-y: auto;
    }
    .modal-backdrop.active .modal-content { transform: scale(1); }
    .modal-content::before {
        content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
        background: linear-gradient(90deg, #1E5FAD, #00D4FF);
    }

    /* ── RESPONSIVE OVERRIDES ── */
    @media (max-width: 767px) {
        /* Hero section */
        section[style*="padding-top:7rem"] {
            padding-top: 5rem !important;
            padding-bottom: 3rem !important;
        }

        /* Pricing grid single column */
        .pricing-cards-grid {
            grid-template-columns: 1fr !important;
        }

        /* Pricing card inner padding */
        .pricing-card-inner {
            padding: 1.5rem !important;
            padding-top: 2.5rem !important;
        }

        /* Comparison table horizontal scroll */
        .comparison-scroll-wrapper {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            border-radius: 1rem;
        }
        .comparison-scroll-wrapper table {
            min-width: 480px;
        }

        /* Addons grid */
        .addons-grid {
            grid-template-columns: 1fr !important;
        }

        /* FAQ */
        .faq-item { padding: 1rem 1.25rem !important; }

        /* CTA buttons stack */
        .cta-buttons {
            flex-direction: column;
            align-items: stretch;
        }
        .cta-buttons a, .cta-buttons button {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 500px) {
        .modal-content { padding: 1.75rem 1.25rem; border-radius: 1.5rem; }
        .modal-content h2 { font-size: 1.75rem !important; }
        .modal-content .section-tag { font-size: 0.6rem; letter-spacing: 0.2em; }
        .modal-content .btn-primary { padding: 0.8rem 1rem; font-size: 0.85rem; }

        /* Hero text */
        h1[style*="4.2rem"] { font-size: clamp(1.8rem, 8vw, 3rem) !important; }

        /* Table cells smaller text */
        td, th { font-size: 0.75rem !important; padding: 0.6rem 0.75rem !important; }
    }

    @media (min-width: 768px) and (max-width: 1023px) {
        /* Tablet: 2 col addons */
        .addons-grid {
            grid-template-columns: repeat(2, 1fr) !important;
        }
    }
</style>
@endpush

@section('content')

<main style="overflow-x:hidden;">

    <!-- ── HERO ── -->
    <section class="relative overflow-hidden" style="padding-top:clamp(5rem,10vw,7rem);padding-bottom:clamp(3rem,6vw,5rem);">
        <div class="absolute inset-0 grid-bg opacity-40 pointer-events-none"></div>
        <div class="absolute inset-0 pointer-events-none" style="background:radial-gradient(ellipse 70% 50% at 50% 0%,rgba(30,95,173,0.22) 0%,transparent 70%);"></div>

        <!-- Decorative rings (hidden on mobile via CSS) -->
        <div class="absolute pointer-events-none hidden sm:block" style="top:50%;left:50%;transform:translate(-50%,-50%);width:700px;height:700px;border-radius:50%;border:1px solid rgba(0,212,255,0.04);"></div>
        <div class="absolute pointer-events-none hidden sm:block" style="top:50%;left:50%;transform:translate(-50%,-50%);width:480px;height:480px;border-radius:50%;border:1px dashed rgba(0,212,255,0.04);"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative">
            <div class="reveal from-top inline-flex items-center gap-2 px-4 py-1.5 rounded-full mb-6 text-xs font-medium tracking-widest uppercase" style="background:rgba(0,212,255,0.08);border:1px solid rgba(0,212,255,0.22);color:#00D4FF;">
                <i data-lucide="tag" style="width:12px;height:12px;"></i>
                Pricing & Plans &nbsp;·&nbsp; 14-Day Free Trial
            </div>
            <h1 class="reveal from-bottom reveal-d1 font-bold mb-5" style="font-family:'Rajdhani',sans-serif;font-size:clamp(1.9rem,6vw,4.2rem);color:#fff;line-height:1.1;">
                Choose Your <span class="gradient-shimmer">Trading Plan</span>
            </h1>
            <p class="reveal from-bottom reveal-d2 max-w-2xl mx-auto" style="font-size:clamp(0.88rem,2vw,1.1rem);color:rgba(226,232,240,0.6);line-height:1.7;">
                All plans include core automation features. Upgrade or downgrade at any time. No hidden fees.
            </p>
        </div>
    </section>

    <!-- ── PRICING CARDS ── -->
    <section class="relative py-10 pb-24 px-4 sm:px-6 lg:px-8" style="overflow:hidden;">
        <div class="orb" style="width:500px;height:500px;background:rgba(30,95,173,0.2);top:0%;right:-100px;animation-delay:0s;"></div>
        <div class="orb" style="width:350px;height:350px;background:rgba(0,212,255,0.07);bottom:10%;left:-60px;animation-delay:3s;"></div>

        <div class="max-w-7xl mx-auto relative">
            <div class="pricing-cards-grid grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 items-start">
                @foreach($plans as $index => $plan)
                @php
                    $isMiddle = count($plans) > 2 && $index === 1;
                    $isLast = count($plans) > 2 && $index === 2;
                    $cardClass = 'pricing-card reveal ' . ($index == 0 ? 'from-left' : ($index == count($plans)-1 ? 'from-right' : 'from-bottom')) . ' reveal-d' . ($index + 1);
                    if($isMiddle) $cardClass .= ' featured';
                    if($isLast) $cardClass .= ' enterprise';

                    $color = $isMiddle ? '#00D4FF' : ($isLast ? '#F59E0B' : '#1E5FAD');
                    $btnClass = $isMiddle ? 'btn-primary' : ($isLast ? 'btn-primary btn-gold' : 'btn-outline');

                    $symbols = ['INR' => '₹', 'USD' => '$', 'EUR' => '€', 'GBP' => '£'];
                    $symbol = $symbols[$plan->currency] ?? '$';

                    $descMarkup = $plan->description;
                    $descMarkup = str_replace(['<li>', '</li>', '<p>', '</p>', '<br>', '<br/>', '<br />'], ["\n", "\n", "\n", "\n", "\n", "\n", "\n"], $descMarkup);
                    $descMarkup = html_entity_decode($descMarkup);
                    $descMarkup = strip_tags($descMarkup);
                    $features = array_filter(array_map('trim', explode("\n", $descMarkup)));
                @endphp

                <div class="{{ $cardClass }}">
                    @if($isMiddle)
                    <div class="popular-badge absolute top-4 right-4 px-3 py-1 rounded-full text-xs font-bold tracking-widest" style="background:linear-gradient(135deg,#1E5FAD,#00D4FF);color:#fff;z-index:5;">
                        ⭐ Most Popular
                    </div>
                    @elseif($isLast)
                    <div class="popular-badge absolute top-4 right-4 px-3 py-1 rounded-full text-xs font-bold tracking-widest" style="background:linear-gradient(135deg,#92400E,#F59E0B);color:#fff;z-index:5;">
                        👑 Best Value
                    </div>
                    @endif

                    <div class="pricing-card-inner p-6 sm:p-8" style="padding-top:{{ ($isMiddle || $isLast) ? '3.5rem' : '2rem' }};">
                        <!-- Header -->
                        <h3 class="font-bold mb-2" style="font-family:'Rajdhani',sans-serif;font-size:1.5rem;color:#fff;">{{ $plan->name }}</h3>
                        <p class="text-xs mb-6" style="color:rgba(226,232,240,0.5);">{{ $plan->duration_days }} Days Protection</p>

                        <!-- Price -->
                        <div class="flex items-baseline flex-wrap gap-1 mb-7">
                            <span class="price-num" style="font-size:clamp(2rem,5vw,3.2rem);color:{{ $color }};">
                                {{ $symbol }}{{ $plan->discounted_price ?? $plan->actual_price }}
                            </span>
                            @if($plan->discounted_price)
                            <span class="text-sm line-through opacity-30 ml-2" style="color:#fff;">{{ $symbol }}{{ $plan->actual_price }}</span>
                            @endif
                            <span class="text-sm" style="color:rgba(226,232,240,0.4);">/month</span>
                        </div>

                        <!-- CTA -->
                        @if(Auth::guard('customer')->check())
                            <div class="mb-7">
                                <button type="button"
                                        onclick="openSummaryModal({{ json_encode([
                                            'id' => $plan->id,
                                            'name' => $plan->name,
                                            'price' => $plan->discounted_price ?? $plan->actual_price,
                                            'actual_price' => $plan->actual_price,
                                            'symbol' => $symbol,
                                            'duration' => $plan->duration_days
                                        ]) }})"
                                        class="{{ $btnClass }} w-full py-3 rounded-xl text-sm font-semibold"
                                        style="{{ ($isMiddle||$isLast)?'':'background:rgba(255,255,255,0.05);color:#E2E8F0;border:1px solid rgba(0,212,255,0.25);' }}">
                                    <span>Purchase Plan</span>
                                </button>
                            </div>
                        @else
                            <a href="{{ route('signup', ['plan' => $plan->id]) }}" class="{{ $btnClass }} block w-full py-3 rounded-xl text-sm text-center font-semibold mb-7" style="{{ ($isMiddle||$isLast)?'':'background:rgba(255,255,255,0.05);color:#E2E8F0;border:1px solid rgba(0,212,255,0.25);' }}text-decoration:none;">
                                <span>Start Free Trial</span>
                            </a>
                        @endif

                        <!-- Divider -->
                        <div style="border-top:1px solid rgba(0,212,255,0.1);margin-bottom:1.25rem;"></div>

                        <!-- Features -->
                        <div>
                            @foreach($features as $feat)
                            <div class="check-item">
                                <i data-lucide="check-circle" class="icon-yes" style="width:15px;height:15px;flex-shrink:0;"></i>
                                <span>{{ $feat }}</span>
                            </div>
                            @endforeach

                            @if($plan->offers->count() > 0)
                                @foreach($plan->offers as $offer)
                                <div class="check-item" style="color: #00D4FF; font-weight: 600;">
                                    <i data-lucide="zap" class="icon-yes" style="width:15px;height:15px; color: #00D4FF;flex-shrink:0;"></i>
                                    <span>{{ $offer->name }}</span>
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <p class="text-center text-xs mt-8 px-4" style="color:rgba(226,232,240,0.3);">
                * All prices are as per the selected currency. Cancel anytime. No hidden fees. Risk Disclosure applies.
            </p>
        </div>
    </section>

    <!-- ── COMPARISON TABLE ── -->
    <section class="py-16 sm:py-20 px-4 sm:px-6 lg:px-8 overflow-hidden" style="background:transparent;backdrop-filter:blur(2px);">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-10 sm:mb-14 reveal from-bottom">
                <div class="section-tag">Compare</div>
                <h2 class="font-bold" style="font-family:'Rajdhani',sans-serif;font-size:clamp(1.6rem,4vw,3rem);color:#fff;">Feature Comparison</h2>
            </div>
            <div class="reveal from-bottom reveal-d1 comparison-scroll-wrapper" style="border-radius:1rem;border:1px solid rgba(0,212,255,0.15);">
                <div style="overflow-x:auto;-webkit-overflow-scrolling:touch;">
                    <table style="width:100%;min-width:420px;border-collapse:collapse;background:var(--card-bg);backdrop-filter:blur(10px);">
                        <thead>
                            <tr style="border-bottom:1px solid rgba(0,212,255,0.15);">
                                <th style="padding:0.9rem 1rem;text-align:left;font-size:0.75rem;color:rgba(226,232,240,0.5);font-weight:500;">Feature</th>
                                <th style="padding:0.9rem 0.75rem;text-align:center;font-family:'Rajdhani',sans-serif;font-size:0.9rem;color:#1E5FAD;">Starter</th>
                                <th style="padding:0.9rem 0.75rem;text-align:center;font-family:'Rajdhani',sans-serif;font-size:0.9rem;color:#00D4FF;background:rgba(0,212,255,0.04);">Pro</th>
                                <th style="padding:0.9rem 0.75rem;text-align:center;font-family:'Rajdhani',sans-serif;font-size:0.9rem;color:#F59E0B;">Enterprise</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $rows=[
                                ['feat'=>'Trading Accounts','s'=>'1','p'=>'5','e'=>'Unlimited'],
                                ['feat'=>'Copy Strategies','s'=>'3','p'=>'Unlimited','e'=>'Unlimited'],
                                ['feat'=>'Trades/Minute','s'=>'5','p'=>'50','e'=>'Unlimited'],
                                ['feat'=>'MT4/MT5 Support','s'=>true,'p'=>true,'e'=>true],
                                ['feat'=>'API Access','s'=>false,'p'=>true,'e'=>true],
                                ['feat'=>'AI Strategy Builder','s'=>false,'p'=>true,'e'=>true],
                                ['feat'=>'Backtesting Engine','s'=>false,'p'=>false,'e'=>true],
                                ['feat'=>'White-label Option','s'=>false,'p'=>false,'e'=>true],
                                ['feat'=>'Dedicated Manager','s'=>false,'p'=>false,'e'=>true],
                            ];
                            function renderCell($v,$col='#00D4FF'){
                                if($v===true) return '<i data-lucide="check" style="width:16px;height:16px;color:#10B981;margin:0 auto;display:block;"></i>';
                                if($v===false) return '<i data-lucide="minus" style="width:16px;height:16px;color:rgba(226,232,240,0.2);margin:0 auto;display:block;"></i>';
                                return '<span style="font-family:\'Rajdhani\',sans-serif;font-weight:600;color:'.$col.';font-size:0.85rem;">'.$v.'</span>';
                            }
                            @endphp
                            @foreach($rows as $i=>$row)
                            <tr style="border-bottom:1px solid rgba(0,212,255,0.07);{{ $i%2==0?'background:rgba(0,0,0,0.15);':'' }}">
                                <td style="padding:0.8rem 1rem;font-size:0.78rem;color:rgba(226,232,240,0.7);white-space:nowrap;">{{ $row['feat'] }}</td>
                                <td style="padding:0.8rem 0.75rem;text-align:center;">{!! renderCell($row['s'],'#1E5FAD') !!}</td>
                                <td style="padding:0.8rem 0.75rem;text-align:center;background:rgba(0,212,255,0.03);">{!! renderCell($row['p'],'#00D4FF') !!}</td>
                                <td style="padding:0.8rem 0.75rem;text-align:center;">{!! renderCell($row['e'],'#F59E0B') !!}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Scroll hint on mobile -->
            <p class="text-center text-xs mt-3 sm:hidden" style="color:rgba(0,212,255,0.4);">← Scroll to see all columns →</p>
        </div>
    </section>

    <!-- ── ADD-ONS ── -->
    <section class="relative py-16 sm:py-20 lg:py-28 px-4 sm:px-6 lg:px-8 overflow-hidden">
        <div class="absolute inset-0 grid-bg opacity-30 pointer-events-none"></div>
        <div class="orb" style="width:400px;height:400px;background:rgba(30,95,173,0.18);top:20%;left:-80px;animation-delay:1s;"></div>

        <div class="max-w-7xl mx-auto relative">
            <div class="text-center mb-12 sm:mb-16 reveal from-bottom">
                <div class="section-tag">Add-Ons</div>
                <h2 class="font-bold" style="font-family:'Rajdhani',sans-serif;font-size:clamp(1.7rem,4vw,3rem);color:#fff;">
                    Supercharge Your <span class="gradient-text">Plan</span>
                </h2>
            </div>
            <div class="addons-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @php
                $addons=[
                    ['icon'=>'trending-up','title'=>'VPS Trading Server','price'=>'$19/mo','desc'=>'Ultra-low latency server near major exchanges for fastest execution.','dir'=>'from-left'],
                    ['icon'=>'zap','title'=>'Signal Alerts Pack','price'=>'$29/mo','desc'=>'200+ daily signals across Forex, Crypto & Indices with 85%+ accuracy.','dir'=>'from-bottom'],
                    ['icon'=>'shield','title'=>'Extended Backtest','price'=>'$39/mo','desc'=>'20 years of historical data with tick-by-tick accuracy for strategy validation.','dir'=>'from-bottom'],
                    ['icon'=>'star','title'=>'Strategy Marketplace','price'=>'Free','desc'=>'Access 500+ community-built trading strategies vetted by our team.','dir'=>'from-right'],
                ];
                @endphp
                @foreach($addons as $i=>$a)
                <div class="card reveal {{ $a['dir'].' reveal-d'.($i+1) }} p-6 rounded-2xl">
                    <div class="feat-icon mb-5">
                        <i data-lucide="{{ $a['icon'] }}" style="width:22px;height:22px;color:#00D4FF;"></i>
                    </div>
                    <div class="flex items-start justify-between mb-3 gap-2">
                        <h3 class="font-semibold text-sm" style="color:#fff;font-family:'Rajdhani',sans-serif;font-size:1.05rem;">{{ $a['title'] }}</h3>
                        <span class="text-xs px-2 py-0.5 rounded-full flex-shrink-0" style="background:rgba(0,212,255,0.15);color:#00D4FF;font-weight:600;white-space:nowrap;">{{ $a['price'] }}</span>
                    </div>
                    <p class="text-sm leading-relaxed" style="color:rgba(226,232,240,0.55);">{{ $a['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>


    <!-- ── CTA ── -->
    <section class="py-16 px-4 sm:px-6 lg:px-8" style="border-top:1px solid rgba(0,212,255,0.08);">
        <div class="max-w-3xl mx-auto text-center reveal from-scale">
            <div class="section-tag justify-center mb-4">Get Started</div>
            <h2 class="font-bold mb-4" style="font-family:'Rajdhani',sans-serif;font-size:clamp(1.4rem,4vw,2.4rem);color:#fff;">
                Still Have <span class="gradient-text">Questions?</span>
            </h2>
            <p class="mb-8 px-2" style="font-size:0.95rem;color:rgba(226,232,240,0.55);">Our support team is available 24/7 to help you choose the right plan for your trading goals.</p>
            <div class="cta-buttons flex flex-wrap gap-3 justify-center">
                <a href="{{ route('help') }}" class="btn-primary">
                    <i data-lucide="message-circle" style="width:16px;height:16px;"></i>
                    <span>Visit Help Center</span>
                </a>
                <a href="{{ route('about') }}" class="btn-outline">
                    <i data-lucide="info" style="width:16px;height:16px;"></i>
                    <span>Learn More</span>
                </a>
            </div>
        </div>
    </section>

</main>

@endsection

@push('overlays')
<!-- Plan Summary Modal -->
<div id="summaryModal" class="modal-backdrop">
    <div class="modal-content shadow-2xl">
        <button onclick="closeSummaryModal()" class="absolute top-6 right-6 text-white/40 hover:text-white transition-colors" style="z-index:10;">
            <i data-lucide="x" style="width:20px; height:20px;"></i>
        </button>

        <div class="text-center mb-8">
            <div class="section-tag justify-center">Order Summary</div>
            <h2 id="modalPlanName" class="text-3xl font-bold text-white mt-4" style="font-family:'Rajdhani',sans-serif;"></h2>
            <p id="modalPlanDuration" class="text-white/50 text-sm mt-2"></p>
        </div>

        <div class="space-y-4 mb-8">
            <div class="flex justify-between items-center py-3 border-b border-white/5">
                <span class="text-white/60 text-sm">Plan Price</span>
                <span id="modalPlanPrice" class="text-white font-bold" style="font-family:'Rajdhani',sans-serif; font-size: 1.2rem;"></span>
            </div>
            <div id="savingsRow" class="flex justify-between items-center py-3 border-b border-white/5 hidden">
                <span class="text-sm" style="color:#00D4FF;">Total Savings</span>
                <span id="modalSavings" class="font-bold" style="color:#00D4FF;"></span>
            </div>
            <div class="flex justify-between items-center py-4">
                <span class="text-white font-semibold text-sm">Total Payable</span>
                <span id="modalTotalPayable" class="font-bold" style="color:#00D4FF;font-family:'Rajdhani',sans-serif;font-size:1.5rem;"></span>
            </div>
        </div>

        <form action="{{ route('razorpay.initiate') }}" method="POST">
            @csrf
            <input type="hidden" name="plan_id" id="modalPlanId">
            <button type="submit" class="btn-primary w-full py-4 rounded-xl text-base sm:text-lg font-bold flex items-center justify-center gap-3">
                <i data-lucide="shopping-cart" style="width:20px; height:20px;"></i>
                <span>Proceed to Checkout</span>
            </button>
        </form>

        <p class="text-center text-xs mt-6 uppercase tracking-widest" style="color:rgba(255,255,255,0.3);">
            <i data-lucide="lock" class="inline-block w-3 h-3 mr-1" style="vertical-align: -2px;"></i>
            Secure 256-bit SSL Encryption
        </p>
    </div>
</div>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded',()=>{
    if(typeof lucide!=='undefined') lucide.createIcons();

    /* Scroll reveal */
    const obs=new IntersectionObserver(entries=>{
        entries.forEach(e=>{if(e.isIntersecting){e.target.classList.add('visible');obs.unobserve(e.target);}});
    },{threshold:0.08,rootMargin:'0px 0px -30px 0px'});
    document.querySelectorAll('.reveal').forEach(el=>obs.observe(el));

    /* Pricing card 3D tilt — desktop only */
    if(window.innerWidth >= 768) {
        document.querySelectorAll('.pricing-card').forEach(card=>{
            card.addEventListener('mousemove',e=>{
                const r=card.getBoundingClientRect();
                const dx=(e.clientX-r.left-r.width/2)/(r.width/2);
                const dy=(e.clientY-r.top-r.height/2)/(r.height/2);
                const isFeatured=card.classList.contains('featured');
                const lift=isFeatured?20:14;
                card.style.transform=`perspective(900px) rotateX(${-dy*6}deg) rotateY(${dx*6}deg) translateY(-${lift}px)`;
            });
            card.addEventListener('mouseleave',()=>card.style.transform='');
        });
    }

    /* FAQ accordion */
    document.querySelectorAll('.faq-item').forEach(item=>{
        item.addEventListener('click',()=>{
            const body=item.querySelector('.faq-body');
            const icon=item.querySelector('.faq-icon');
            const isOpen=item.classList.contains('open');
            document.querySelectorAll('.faq-item').forEach(i=>{
                i.classList.remove('open');
                i.querySelector('.faq-body').style.maxHeight='0';
                i.querySelector('.faq-icon').style.transform='';
                i.style.borderColor='rgba(0,212,255,0.15)';
            });
            if(!isOpen){
                item.classList.add('open');
                body.style.maxHeight=body.scrollHeight+'px';
                icon.style.transform='rotate(180deg)';
                item.style.borderColor='rgba(0,212,255,0.35)';
            }
        });
    });
});

function openSummaryModal(plan) {
    document.getElementById('modalPlanId').value = plan.id;
    document.getElementById('modalPlanName').innerText = plan.name;
    document.getElementById('modalPlanDuration').innerText = plan.duration + ' Days Protection • Active Connection';

    const priceText = plan.symbol + plan.price;
    document.getElementById('modalPlanPrice').innerText = priceText;
    document.getElementById('modalTotalPayable').innerText = priceText;

    const savingsRow = document.getElementById('savingsRow');
    if (plan.actual_price > plan.price) {
        const savings = plan.actual_price - plan.price;
        document.getElementById('modalSavings').innerText = plan.symbol + savings.toFixed(2);
        savingsRow.classList.remove('hidden');
    } else {
        savingsRow.classList.add('hidden');
    }

    const modal = document.getElementById('summaryModal');
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';

    if(typeof lucide !== 'undefined') lucide.createIcons();
}

function closeSummaryModal() {
    const modal = document.getElementById('summaryModal');
    modal.classList.remove('active');
    document.body.style.overflow = '';
}

window.addEventListener('click', function(event) {
    const modal = document.getElementById('summaryModal');
    if (event.target == modal) {
        closeSummaryModal();
    }
});
</script>
@endpush
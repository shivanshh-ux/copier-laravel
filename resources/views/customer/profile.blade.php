@extends('customer.layouts.app')

@section('title', 'Your Profile — Copier Algo Trading')
@section('description', 'Manage your Copier account, trading API keys, and subscription settings.')

@push('styles')
<style>
    /* Hide scrollbar for horizontal nav on mobile */
    nav::-webkit-scrollbar { display: none; }
    /* xs breakpoint helper */
    @media (min-width: 480px) {
        .xs\:grid-cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
    }

</style>
@endpush

@section('content')

<main class="flex-1 pb-20" style="background: transparent; padding-top: 5.5rem;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Dashboard Header -->
        <div class="mb-8 sm:mb-12 flex flex-col sm:flex-row sm:items-end justify-between gap-4" data-aos="fade-up">
            <div>
                <span class="text-xs uppercase tracking-[0.3em] mb-2 block" style="color: #00D4FF">Account Center</span>
                <h1 style="font-family: 'Rajdhani', sans-serif; font-weight: 700; font-size: clamp(1.6rem, 5vw, 3rem); color: #fff; line-height: 1.1;">
                    Welcome Back, <span style="background: linear-gradient(90deg, #1E5FAD, #00D4FF); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">{{ Auth::guard('customer')->user()->name }}</span>
                </h1>
            </div>
            <div class="flex flex-wrap gap-2 sm:gap-3">
                <div class="px-3 py-1.5 sm:px-4 sm:py-2 rounded-xl text-xs font-bold uppercase tracking-widest flex items-center gap-2" style="background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.2); color: #10B981; white-space: nowrap;">
                    <span class="w-2 h-2 rounded-full animate-pulse flex-shrink-0" style="background: #10B981;"></span>
                    Live Connection
                </div>
                <div class="px-3 py-1.5 sm:px-4 sm:py-2 rounded-xl text-xs font-bold uppercase tracking-widest" style="background: rgba(245,158,11,0.1); border: 1px solid rgba(245,158,11,0.2); color: #F59E0B; white-space: nowrap;">
                    {{ Auth::guard('customer')->user()->plan->name ?? 'No Plan Active' }}
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">

            <!-- ── SIDEBAR ── -->
            <div class="space-y-5 lg:space-y-6" data-aos="fade-right">
                <!-- User Card -->
                <div class="p-5 sm:p-6 rounded-2xl lg:rounded-3xl" style="background: rgba(15,30,53,0.7); border: 1px solid rgba(0,212,255,0.15); backdrop-filter: blur(10px);">
                    <!-- Avatar + name -->
                    <div class="flex items-center gap-3 sm:gap-4 mb-6 sm:mb-8">
                        <div class="w-12 h-12 sm:w-16 sm:h-16 rounded-xl sm:rounded-2xl flex items-center justify-center text-lg sm:text-2xl font-bold text-white flex-shrink-0" style="background: linear-gradient(135deg, #1E5FAD, #00D4FF); font-family: 'Rajdhani', sans-serif;">
                            @php
                                $names = explode(' ', Auth::guard('customer')->user()->name);
                                $initials = strtoupper(substr($names[0], 0, 1) . (isset($names[1]) ? substr($names[1], 0, 1) : ''));
                            @endphp
                            {{ $initials }}
                        </div>
                        <div class="min-w-0">
                            <h3 class="text-base sm:text-lg font-bold text-white truncate">{{ Auth::guard('customer')->user()->name }}</h3>
                            <p class="text-xs opacity-50 truncate" style="color: #E2E8F0;">Member since {{ Auth::guard('customer')->user()->created_at->format('M Y') }}</p>
                        </div>
                    </div>

                    <!-- Nav menu — horizontal scroll on mobile, vertical on desktop -->
                    <nav class="flex lg:flex-col gap-1 overflow-x-auto pb-1 lg:pb-0 -mx-1 px-1 lg:mx-0 lg:px-0 lg:overflow-x-visible" style="scrollbar-width: none;">
                        @php
                        $menu = [
                            ['icon' => 'layout-dashboard', 'label' => 'Overview',       'active' => true],
                            ['icon' => 'key',              'label' => 'API',             'active' => false],
                            ['icon' => 'activity',         'label' => 'Trades',          'active' => false],
                            ['icon' => 'shield-check',     'label' => 'Security',        'active' => false],
                            ['icon' => 'credit-card',      'label' => 'Billing',         'active' => false],
                            ['icon' => 'settings',         'label' => 'Settings',        'active' => false],
                        ];
                        @endphp
                        @foreach ($menu as $m)
                            <a href="#" class="flex flex-shrink-0 lg:flex-shrink items-center gap-2 lg:gap-3 px-3 py-2.5 lg:py-3 rounded-xl transition-all duration-300 text-center lg:text-left"
                               style="background: {{ $m['active'] ? 'rgba(0,212,255,0.1)' : 'transparent' }}; 
                                      color: {{ $m['active'] ? '#00D4FF' : 'rgba(226,232,240,0.6)' }};
                                      font-weight: {{ $m['active'] ? '600' : '400' }};
                                      white-space: nowrap;">
                                <i data-lucide="{{ $m['icon'] }}" style="width:16px; height:16px; flex-shrink:0;"></i>
                                <span class="text-xs sm:text-sm">{{ $m['label'] }}</span>
                            </a>
                        @endforeach
                        <form id="logout-form" action="{{ route('logout.customer') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a href="javascript:void(0);" onclick="document.getElementById('logout-form').submit();" class="flex flex-shrink-0 lg:flex-shrink items-center gap-2 lg:gap-3 px-3 py-2.5 lg:py-3 rounded-xl transition-all duration-300 mt-0 lg:mt-3" style="color: rgba(248,113,113,0.7); white-space: nowrap;">
                            <i data-lucide="log-out" style="width:16px; height:16px; flex-shrink:0;"></i>
                            <span class="text-xs sm:text-sm">Log Out</span>
                        </a>
                    </nav>
                </div>
            </div>

            <!-- ── MAIN CONTENT ── -->
            <div class="lg:col-span-2 space-y-5 sm:space-y-6 lg:space-y-8" data-aos="fade-left">

                <!-- Stats Overview -->
                <div class="grid grid-cols-1 xs:grid-cols-3 gap-3 sm:gap-4">
                    @php
                    $stats = [
                        ['label' => 'Total Equity',  'val' => '$0.00', 'change' => '0.0%', 'color' => '#10B981'],
                        ['label' => 'Active Bots',   'val' => '0 Running',  'change' => 'Inactive',  'color' => '#64748b'],
                        ['label' => "Today's PnL",   'val' => '+$0.00',   'change' => '0.0%',   'color' => '#10B981'],
                    ];
                    @endphp
                    @foreach ($stats as $s)
                        <div class="p-4 sm:p-5 lg:p-6 rounded-xl sm:rounded-2xl" style="background: rgba(15,30,53,0.5); border: 1px solid rgba(0,212,255,0.1)">
                            <p class="text-[10px] uppercase tracking-widest opacity-50 mb-1.5" style="color: #E2E8F0;">{{ $s['label'] }}</p>
                            <h4 class="text-lg sm:text-xl font-bold text-white mb-1" style="font-family: 'Rajdhani', sans-serif;">{{ $s['val'] }}</h4>
                            <p class="text-xs font-bold" style="color: {{ $s['color'] }};">{{ $s['change'] }}</p>
                        </div>
                    @endforeach
                </div>

                <!-- Connected Brokers -->
                <div class="p-5 sm:p-6 lg:p-8 rounded-2xl lg:rounded-3xl" style="background: rgba(15,30,53,0.7); border: 1px solid rgba(0,212,255,0.15); backdrop-filter: blur(10px);">
                    <div class="flex items-center justify-between mb-5 sm:mb-6 lg:mb-8 gap-3">
                        <h3 class="text-base sm:text-lg font-bold text-white flex-1 min-w-0" style="font-family: 'Rajdhani', sans-serif;">Connected Brokers</h3>
                        <button class="text-xs px-3 py-2 sm:px-4 rounded-lg font-bold uppercase tracking-widest transition-all hover:brightness-110 flex-shrink-0" style="background: #00D4FF; color: #060D1A;">Add New</button>
                    </div>
                    
                    <div class="text-center py-10 opacity-40">
                        <i data-lucide="server-off" style="width:40px; height:40px; margin: 0 auto 1rem; color: #00D4FF"></i>
                        <p class="text-sm">No brokers connected yet.</p>
                    </div>
                </div>

                <!-- Security Notifications -->
                <div class="p-5 sm:p-6 lg:p-8 rounded-2xl lg:rounded-3xl" style="background: rgba(15,30,53,0.7); border: 1px solid rgba(0,212,255,0.15); backdrop-filter: blur(10px);">
                    <h3 class="text-base sm:text-lg font-bold text-white mb-5 sm:mb-6 lg:mb-8" style="font-family: 'Rajdhani', sans-serif;">Security Notifications</h3>
                    <div class="space-y-4 sm:space-y-6">
                        <div class="flex gap-3 sm:gap-4">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5" style="background: rgba(16,185,129,0.1); color: #10B981;">
                                <i data-lucide="check" style="width:14px; height:14px;"></i>
                            </div>
                            <div class="min-w-0">
                                <p class="text-sm" style="color: rgba(255,255,255,0.9);">Current Session Active</p>
                                <p class="text-xs opacity-40 mt-0.5" style="color: #E2E8F0;">Recently logged in from {{ request()->ip() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- /main content -->
        </div><!-- /grid -->
    </div>
</main>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    if(typeof lucide !== 'undefined') lucide.createIcons();
});
</script>
@endpush


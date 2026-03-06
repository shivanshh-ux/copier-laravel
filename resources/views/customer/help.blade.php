@extends('customer.layouts.app')

@push('styles')
<style>
    /* Page-specific styles if any, otherwise empty */
</style>
@endpush

@section('content')

@php
$faqs = [
    ['category' => 'Getting Started', 'q' => 'How do I get started with Copier?', 'a' => 'Sign up for a plan on our Services page, then follow the onboarding wizard to connect your broker and MetaTrader account. The whole process takes under 10 minutes.'],
    ['category' => 'Getting Started', 'q' => 'Is there a free trial available?', 'a' => 'Yes! All plans come with a 14-day free trial. No credit card required to start. You can explore all features before committing.'],
    ['category' => 'Trading', 'q' => 'What markets can I trade with Copier?', 'a' => 'Copier supports Forex (100+ pairs), Cryptocurrencies (50+), Stocks (500+), Indices (30+), Commodities (20+), and Options (1000+).'],
    ['category' => 'Trading', 'q' => 'Can I customize risk settings for each strategy?', 'a' => 'Absolutely. Each strategy allows you to set custom lot sizes, maximum daily loss limits, max drawdown thresholds, trading hours, and more from the strategy settings panel.'],
    ['category' => 'MetaTrader', 'q' => 'Does Copier work with MetaTrader 4 and MetaTrader 5?', 'a' => 'Yes, we provide Expert Advisors (EAs) for both MT4 and MT5. Simply download the EA, install it in your terminal\'s Experts folder, and enter your API key to connect.'],
    ['category' => 'Account', 'q' => 'How many trading accounts can I connect?', 'a' => 'This depends on your plan. Starter supports 1 account, Professional supports 5, and Enterprise supports unlimited accounts across multiple brokers.'],
    ['category' => 'Account', 'q' => 'Can I upgrade or downgrade my plan?', 'a' => 'Yes, you can change your plan at any time. Upgrades take effect immediately. Downgrades take effect at the start of the next billing cycle.'],
    ['category' => 'Security', 'q' => 'Is my trading data and financial information secure?', 'a' => 'We use bank-level AES-256 encryption for all data at rest and in transit. We never store your broker passwords — only read-only API keys. Our infrastructure is SOC 2 compliant.'],
    ['category' => 'Billing', 'q' => 'What payment methods do you accept?', 'a' => 'We accept all major credit/debit cards (Visa, Mastercard, AmEx), PayPal, bank transfers, and select cryptocurrencies (BTC, USDT).'],
    ['category' => 'Technical', 'q' => 'What happens to my trades if Copier goes offline?', 'a' => 'Our platform has 99.9% uptime with dual-cloud redundancy. Any open trades remain active at your broker. We recommend VPS hosting for additional protection.'],
    ['category' => 'Getting Started', 'q' => 'Do I need programming experience?', 'a' => 'No. Copier offers a strategy library of 50+ pre-built algorithms. Simply choose one, configure risk parameters, connect your broker, and go live in minutes.'],
    ['category' => 'Trading', 'q' => 'Which brokers does Copier support?', 'a' => 'We integrate with all major brokers via MT4, MT5, and FIX API — including Interactive Brokers, Oanda, Binance, Kraken, and 80+ others globally.'],
    ['category' => 'Security', 'q' => 'How is my capital protected?', 'a' => 'Your funds remain in your own broker account at all times. Copier never touches your capital — we only send trade instructions to your broker via a secure API connection.'],
    ['category' => 'Trading', 'q' => 'What is the minimum capital required?', 'a' => 'There is no hard minimum. However, for effective position sizing and diversification, most traders start with $500–$2,000 depending on their strategy.'],
    ['category' => 'Trading', 'q' => 'Can I run multiple strategies simultaneously?', 'a' => 'Yes. You can run unlimited strategies across multiple broker accounts, each with independent risk settings and allocation budgets.'],
];
@endphp

<main class="flex-1">
    <!-- Hero -->
    <section class="relative pt-32 pb-20 overflow-hidden" style="background: transparent">
        <div class="absolute inset-0 opacity-[0.04] pointer-events-none" style="background-image: linear-gradient(rgba(0,212,255,1) 1px, transparent 1px), linear-gradient(90deg, rgba(0,212,255,1) 1px, transparent 1px); background-size: 60px 60px"></div>
        <div class="absolute top-1/2 right-0 w-96 h-96 rounded-full opacity-10 pointer-events-none" style="background: #1E5FAD; filter: blur(100px)"></div>
        <div class="max-w-3xl mx-auto px-4 sm:px-6 text-center" data-aos="fade-up">
            <span class="text-xs uppercase tracking-[0.3em] mb-3 block" style="color: #00D4FF">Help Center</span>
            <h1 style="font-family: 'Rajdhani', sans-serif; font-weight: 700; font-size: clamp(2.5rem, 5vw, 4rem); color: #fff; line-height: 1.1; margin-bottom: 1.25rem">
                How Can We <span style="background: linear-gradient(90deg, #1E5FAD, #00D4FF); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Help You?</span>
            </h1>
            <!-- Search -->
            <div class="relative max-w-xl mx-auto">
                <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 opacity-40" style="width:16px; height:16px; color: #E2E8F0"></i>
                <input type="text" id="help-search" placeholder="Search for answers..." class="w-full pl-12 pr-4 py-4 rounded-2xl text-sm outline-none transition-all" style="background: rgba(15,30,53,0.9); border: 1px solid rgba(0,212,255,0.2); color: #E2E8F0;">
            </div>
        </div>
    </section>

    <!-- Help Categories -->
    <section class="py-16" style="background: transparent">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10" data-aos="fade-up">
                <h2 style="font-family: 'Rajdhani', sans-serif; font-weight: 700; font-size: clamp(1.5rem, 3vw, 2rem); color: #fff">Browse by Category</h2>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
                @php
                $categories = [
                    ['icon' => 'zap', 'label' => 'Getting Started', 'count' => 12],
                    ['icon' => 'settings', 'label' => 'Account & Setup', 'count' => 18],
                    ['icon' => 'trending-up', 'label' => 'Trading & Strategies', 'count' => 24],
                    ['icon' => 'shield', 'label' => 'Security & Privacy', 'count' => 9],
                    ['icon' => 'book-open', 'label' => 'MetaTrader Guides', 'count' => 15],
                    ['icon' => 'check-circle', 'label' => 'Billing & Subscriptions', 'count' => 11],
                ];
                @endphp
                @foreach ($categories as $i => $cat)
                    <button class="cat-filter-card p-5 rounded-2xl text-center group hover:-translate-y-1 transition-all duration-300" data-category="{{ explode(' ', $cat['label'])[0] }}" style="background: rgba(15,30,53,0.7); border: 1px solid rgba(0,212,255,0.1)" data-aos="fade-up" data-aos-delay="{{ $i * 60 }}">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center mx-auto mb-3" style="background: rgba(0,212,255,0.1)">
                            <i data-lucide="{{ $cat['icon'] }}" style="width:18px; height:18px; color: #00D4FF"></i>
                        </div>
                        <p class="text-xs mb-1" style="color: #fff; font-weight: 600">{{ $cat['label'] }}</p>
                        <p class="text-[10px] opacity-40" style="color: #E2E8F0">{{ $cat['count'] }} articles</p>
                    </button>
                @endforeach
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-24" style="background: transparent">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10" data-aos="fade-up">
                <span class="text-xs uppercase tracking-[0.3em] mb-3 block" style="color: #00D4FF">FAQ</span>
                <h2 style="font-family: 'Rajdhani', sans-serif; font-weight: 700; font-size: clamp(1.8rem, 4vw, 3rem); color: #fff">Frequently Asked Questions</h2>
            </div>

            <!-- Category Filter Tabs -->
            <div class="flex flex-wrap gap-2 mb-8 justify-center" id="faq-category-tabs" data-aos="fade-up">
                <button data-category="All" class="faq-cat-btn px-4 py-2 rounded-lg text-xs tracking-wide transition-all duration-300 active" style="background: linear-gradient(135deg, #1E5FAD, #00D4FF); color: #fff; font-weight: 700; border: none;">All</button>
                @php
                $uniqueCats = array_unique(array_map(function($f){ return $f['category']; }, $faqs));
                @endphp
                @foreach ($uniqueCats as $cat)
                    <button data-category="{{ $cat }}" class="faq-cat-btn px-4 py-2 rounded-lg text-xs tracking-wide transition-all duration-300" style="background: rgba(255,255,255,0.05); color: rgba(226,232,240,0.6); font-weight: 400; border: 1px solid rgba(0,212,255,0.1);">{{ $cat }}</button>
                @endforeach
            </div>

            <div class="space-y-3" id="faq-list" data-aos="fade-up" data-aos-delay="100">
                @foreach ($faqs as $i => $faq)
                    <div class="faq-item rounded-xl overflow-hidden transition-all duration-300" data-category="{{ $faq['category'] }}" data-q="{{ strtolower($faq['q']) }}" data-a="{{ strtolower($faq['a']) }}" style="background: rgba(15,30,53,0.6); border: 1px solid rgba(0,212,255,0.1)">
                        <button class="faq-toggle w-full flex items-center justify-between p-5 text-left">
                            <div class="flex items-center gap-3 flex-1">
                                <span class="text-xs px-2 py-0.5 rounded-full shrink-0" style="background: rgba(0,212,255,0.1); color: #00D4FF; font-size: 10px;">{{ $faq['category'] }}</span>
                                <span class="text-sm" style="color: #fff; font-weight: 500">{{ $faq['q'] }}</span>
                            </div>
                            <i data-lucide="chevron-down" class="faq-icon shrink-0 ml-3 transition-transform duration-300" style="width:16px; height:16px; color: #00D4FF"></i>
                        </button>
                        <div class="faq-content hidden px-5 pb-5">
                            <p class="text-sm leading-relaxed opacity-65" style="color: #E2E8F0">{{ $faq['a'] }}</p>
                        </div>
                    </div>
                @endforeach
                
                <div id="no-faqs" class="hidden text-center py-12 opacity-40" style="color: #E2E8F0">
                    <i data-lucide="search" class="mx-auto mb-3" style="width:32px; height:32px"></i>
                    <p>No results found. Try a different search term.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Cards -->
    <section class="py-24" style="background: transparent">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <span class="text-xs uppercase tracking-[0.3em] mb-3 block" style="color: #00D4FF">Contact Us</span>
                <h2 style="font-family: 'Rajdhani', sans-serif; font-weight: 700; font-size: clamp(1.8rem, 4vw, 3rem); color: #fff">Still Need Help?</h2>
                <p class="mt-3 opacity-55 text-sm" style="color: #E2E8F0">Our support team is available around the clock.</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                $contacts = [
                    ['icon' => 'message-circle', 'title' => 'Live Chat', 'desc' => 'Chat with our support team in real time.', 'badge' => 'Online Now', 'color' => '#10B981'],
                    ['icon' => 'mail', 'title' => 'Email Support', 'desc' => 'support@copier.trade — reply within 2 hours.', 'badge' => '< 2h Reply', 'color' => '#00D4FF'],
                    ['icon' => 'phone', 'title' => 'Phone Support', 'desc' => '+1 (800) COPIER-1 — available 9am–9pm EST.', 'badge' => 'Mon–Fri', 'color' => '#1E5FAD'],
                    ['icon' => 'book-open', 'title' => 'Documentation', 'desc' => 'Detailed technical docs and API reference.', 'badge' => 'Always Open', 'color' => '#F59E0B'],
                ];
                @endphp
                @foreach ($contacts as $i => $c)
                    <div class="p-7 rounded-2xl group hover:-translate-y-1 transition-all duration-300 cursor-pointer" style="background: rgba(15,30,53,0.7); border: 1px solid rgba(0,212,255,0.1)" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                        <div class="flex items-start justify-between mb-5">
                            <div class="w-11 h-11 rounded-xl flex items-center justify-center" style="background: {{ $c['color'] }}15">
                                <i data-lucide="{{ $c['icon'] }}" style="width:20px; height:20px; color: {{ $c['color'] }}"></i>
                            </div>
                            <span class="text-[10px] px-2 py-1 rounded-full" style="background: {{ $c['color'] }}15; color: {{ $c['color'] }}; font-weight: 700">{{ $c['badge'] }}</span>
                        </div>
                        <h3 class="text-base mb-2" style="color: #fff; font-weight: 600">{{ $c['title'] }}</h3>
                        <p class="text-xs opacity-55 leading-relaxed" style="color: #E2E8F0">{{ $c['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Contact Form -->
    <section class="py-24" style="background: transparent">
        <div class="max-w-2xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-10" data-aos="fade-up">
                <h2 style="font-family: 'Rajdhani', sans-serif; font-weight: 700; font-size: clamp(1.8rem, 4vw, 2.5rem); color: #fff">Send a Message</h2>
            </div>
            <div class="p-8 rounded-2xl" style="background: rgba(15,30,53,0.7); border: 1px solid rgba(0,212,255,0.12)" data-aos="fade-up" data-aos-delay="100">
                @if(session('success'))
                    <div class="mb-6 p-4 rounded-xl text-sm" style="background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.3); color: #10B981">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 p-4 rounded-xl text-sm" style="background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.3); color: #EF4444">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('help.send') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-5">
                        <div>
                            <label class="block text-xs mb-2 opacity-60" style="color: #E2E8F0">Full Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Full Name" required class="w-full px-4 py-3 rounded-xl text-sm outline-none transition-all" style="background: rgba(0,0,0,0.3); border: 1px solid rgba(0,212,255,0.12); color: #E2E8F0">
                        </div>
                        <div>
                            <label class="block text-xs mb-2 opacity-60" style="color: #E2E8F0">Email Address</label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Email Address" required class="w-full px-4 py-3 rounded-xl text-sm outline-none transition-all" style="background: rgba(0,0,0,0.3); border: 1px solid rgba(0,212,255,0.12); color: #E2E8F0">
                        </div>
                    </div>
                    <div class="mb-5">
                        <label class="block text-xs mb-2 opacity-60" style="color: #E2E8F0">Subject</label>
                        <select name="subject" class="w-full px-4 py-3 rounded-xl text-sm outline-none" style="background: rgba(0,0,0,0.3); border: 1px solid rgba(0,212,255,0.12); color: #E2E8F0">
                            <option value="General Inquiry" {{ old('subject') == 'General Inquiry' ? 'selected' : '' }} class="bg-black">General Inquiry</option>
                            <option value="Technical Support" {{ old('subject') == 'Technical Support' ? 'selected' : '' }} class="bg-black">Technical Support</option>
                            <option value="Billing & Subscriptions" {{ old('subject') == 'Billing & Subscriptions' ? 'selected' : '' }} class="bg-black">Billing & Subscriptions</option>
                            <option value="MetaTrader Setup" {{ old('subject') == 'MetaTrader Setup' ? 'selected' : '' }} class="bg-black">MetaTrader Setup</option>
                            <option value="Strategy Questions" {{ old('subject') == 'Strategy Questions' ? 'selected' : '' }} class="bg-black">Strategy Questions</option>
                            <option value="Partnership" {{ old('subject') == 'Partnership' ? 'selected' : '' }} class="bg-black">Partnership</option>
                        </select>
                    </div>
                    <div class="mb-6">
                        <label class="block text-xs mb-2 opacity-60" style="color: #E2E8F0">Message</label>
                        <textarea name="message" rows="4" placeholder="Describe your question or issue..." required class="w-full px-4 py-3 rounded-xl text-sm outline-none resize-none" style="background: rgba(0,0,0,0.3); border: 1px solid rgba(0,212,255,0.12); color: #E2E8F0">{{ old('message') }}</textarea>
                    </div>
                    <button type="submit" class="w-full py-3.5 rounded-xl text-sm flex items-center justify-center gap-2 group transition-all duration-300 hover:-translate-y-0.5 hover:shadow-lg" style="background: linear-gradient(135deg, #1E5FAD, #00D4FF); color: #fff; font-weight: 700">
                        Send Message
                        <i data-lucide="arrow-right" class="group-hover:translate-x-1 transition-transform duration-300" style="width:16px; height:16px"></i>
                    </button>
                    <div class="flex items-center gap-2 mt-4 justify-center text-xs opacity-40" style="color: #E2E8F0">
                        <i data-lucide="clock" style="width:11px; height:11px"></i>
                        Average response time: under 2 hours
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('help-search');
    const catCards = document.querySelectorAll('.cat-filter-card');
    const catBtns = document.querySelectorAll('.faq-cat-btn');
    const faqItems = document.querySelectorAll('.faq-item');
    const noResults = document.getElementById('no-faqs');
    
    let activeCategory = 'All';
    let searchTerm = '';

    function filterFAQs() {
        let visibleCount = 0;
        faqItems.forEach(item => {
            const catMatch = activeCategory === 'All' || item.getAttribute('data-category').includes(activeCategory);
            const q = item.getAttribute('data-q');
            const a = item.getAttribute('data-a');
            const searchMatch = q.includes(searchTerm) || a.includes(searchTerm);
            
            if (catMatch && searchMatch) {
                item.style.display = 'block';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });
        
        if (noResults) noResults.classList.toggle('hidden', visibleCount > 0);
    }

    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            searchTerm = e.target.value.toLowerCase();
            filterFAQs();
        });
    }

    catBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            catBtns.forEach(b => {
                b.style.background = 'rgba(255,255,255,0.05)';
                b.style.color = 'rgba(226,232,240,0.6)';
                b.style.fontWeight = '400';
                b.style.border = '1px solid rgba(0,212,255,0.1)';
            });
            
            btn.style.background = 'linear-gradient(135deg, #1E5FAD, #00D4FF)';
            btn.style.color = '#fff';
            btn.style.fontWeight = '700';
            btn.style.border = 'none';
            
            activeCategory = btn.getAttribute('data-category');
            filterFAQs();
        });
    });

    catCards.forEach(card => {
        card.addEventListener('click', () => {
            const cat = card.getAttribute('data-category');
            const targetBtn = Array.from(catBtns).find(b => b.getAttribute('data-category').includes(cat));
            const targetSection = document.getElementById('faq-category-tabs');
            if (targetBtn) targetBtn.click();
            if (window.lenis) {
                window.lenis.scrollTo(targetSection, { offset: -100, duration: 1.2 });
            } else {
                if (targetSection) targetSection.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    // Accordion Logic
    faqItems.forEach(item => {
        const toggle = item.querySelector('.faq-toggle');
        const content = item.querySelector('.faq-content');
        const icon = item.querySelector('.faq-icon');
        
        if (toggle) {
            toggle.addEventListener('click', () => {
                const isHidden = content.classList.contains('hidden');
                if (isHidden) {
                    content.classList.remove('hidden');
                    if (icon) icon.style.transform = 'rotate(180deg)';
                    item.style.background = 'rgba(0,212,255,0.05)';
                    item.style.borderColor = 'rgba(0,212,255,0.3)';
                } else {
                    content.classList.add('hidden');
                    if (icon) icon.style.transform = 'none';
                    item.style.background = 'rgba(15,30,53,0.6)';
                    item.style.borderColor = 'rgba(0,212,255,0.1)';
                }
            });
        }
    });
});
</script>
@endpush


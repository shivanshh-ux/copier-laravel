@extends('customer.layouts.app')

@section('title', 'Your Profile - Copier Algo Trading')
@section('description', 'Manage your Master and Slave trading accounts.')

@push('styles')
<style>
    .glass-card {
        background: rgba(15, 30, 53, 0.7);
        border: 1px solid rgba(0, 212, 255, 0.15);
        backdrop-filter: blur(12px);
        border-radius: 1.5rem;
    }
    .profile-nav-item {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
    }
    .profile-nav-item.active {
        background: rgba(0, 212, 255, 0.1);
        color: #00D4FF;
        border-color: rgba(0, 212, 255, 0.3);
    }
    .profile-nav-item:not(.active) {
        color: rgba(226, 232, 240, 0.6);
    }
    .profile-nav-item:hover:not(.active) {
        color: #fff;
        background: rgba(255, 255, 255, 0.05);
    }
    .tab-content {
        display: none;
    }
    .tab-content.active {
        display: block;
        animation: fadeIn 0.4s ease-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 1000;
        background: rgba(2, 9, 20, 0.8);
        backdrop-filter: blur(8px);
        align-items: center;
        justify-content: center;
        padding: 1.5rem;
    }
    .modal.active {
        display: flex;
    }

    /* Password Toggle Styles */
    .password-wrapper {
        position: relative;
    }
    .password-toggle {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        padding: 0.5rem;
        color: rgba(226, 232, 240, 0.4);
        cursor: pointer;
        transition: color 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .password-toggle:hover {
        color: #00D4FF;
    }
</style>
@endpush

@section('content')
<main class="flex-1 pb-20" style="padding-top: 5.5rem;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- 2.1 Header Section -->
        <div class="mb-10" data-aos="fade-down">
            <h1 style="font-family: 'Rajdhani', sans-serif; font-weight: 700; font-size: clamp(1.8rem, 5vw, 3.5rem); color: #fff; line-height: 1.1;">
                Welcome <span style="background: linear-gradient(90deg, #1E5FAD, #00D4FF); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">{{ auth()->guard('customer')->user()->name }}</span>
            </h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            
            <!-- Left Sidebar -->
            <div class="lg:col-span-1 space-y-6">
                <!-- 2.2 Customer Information Section -->
                <div class="glass-card p-6" data-aos="fade-right">
                    <h3 class="text-xs uppercase tracking-[0.2em] mb-4 text-gray-400 font-bold">Account Info</h3>
                    <div class="space-y-4">
                        <div>
                            <p class="text-xs opacity-50 mb-1">Customer Name</p>
                            <p class="text-sm font-semibold text-white">{{ auth()->guard('customer')->user()->name }}</p>
                        </div>
                        <div>
                            <p class="text-xs opacity-50 mb-1">Joining Month</p>
                            <p class="text-sm font-semibold text-white">{{ auth()->guard('customer')->user()->created_at->format('F Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- 2.3 Navigation Menu -->
                <div class="glass-card p-2" data-aos="fade-right" data-aos-delay="100">
                    <nav class="space-y-1">
                        <div onclick="switchTab('overview')" id="nav-overview" class="profile-nav-item active flex items-center gap-3 px-4 py-3 rounded-xl border border-transparent">
                            <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                            <span class="font-semibold text-sm">Overview</span>
                        </div>
                        <div onclick="switchTab('security')" id="nav-security" class="profile-nav-item flex items-center gap-3 px-4 py-3 rounded-xl border border-transparent">
                            <i data-lucide="shield-check" class="w-5 h-5"></i>
                            <span class="font-semibold text-sm">Security</span>
                        </div>
                        <div onclick="switchTab('billing')" id="nav-billing" class="profile-nav-item flex items-center gap-3 px-4 py-3 rounded-xl border border-transparent">
                            <i data-lucide="credit-card" class="w-5 h-5"></i>
                            <span class="font-semibold text-sm">Billing</span>
                        </div>
                        <hr class="border-gray-800 my-2 mx-4">
                        <form id="logout-form" action="{{ route('logout.customer') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <button onclick="document.getElementById('logout-form').submit();" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-red-400 hover:bg-red-500/10 transition-colors">
                            <i data-lucide="log-out" class="w-5 h-5"></i>
                            <span class="font-semibold text-sm">Logout</span>
                        </button>
                    </nav>
                </div>
            </div>

            <!-- Right Content -->
            <div class="lg:col-span-3">
                
                <!-- Overview Tab Content -->
                <div id="tab-overview" class="tab-content active space-y-8" data-aos="fade-up">
                    
                    @if(!$hasActivePlan)
                        <!-- Empty Plan State -->
                        <div class="glass-card p-12 text-center border-dashed border-2 border-white/5">
                            <div class="w-20 h-20 bg-[#00D4FF]/10 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i data-lucide="lock" class="w-10 h-10 text-[#00D4FF]"></i>
                            </div>
                            <h2 class="text-2xl font-bold text-white mb-3" style="font-family: 'Rajdhani', sans-serif;">Unlock Overview Section</h2>
                            <p class="text-gray-400 mb-8 max-w-md mx-auto">Purchase a trading plan to manage your master and slave accounts and start automating your trades.</p>
                            <a href="{{ route('services') }}" class="inline-flex items-center gap-2 px-8 py-3 rounded-xl bg-[#00D4FF] text-[#060D1A] font-bold text-sm tracking-widest hover:brightness-110 transition-all shadow-[0_0_20px_rgba(0,212,255,0.3)]">
                                View Plans <i data-lucide="arrow-right" class="w-4 h-4"></i>
                            </a>
                        </div>
                    @else
                        <!-- 4. Master Account Creation -->
                        <div class="glass-card p-6 sm:p-8">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
                                <div>
                                    <h2 class="text-xl sm:text-2xl font-bold text-white mb-2" style="font-family: 'Rajdhani', sans-serif;">Master Trading Account</h2>
                                    <p class="text-sm text-gray-400">Control trading credentials and mirror trades to slave accounts.</p>
                                </div>
                                @if(!$masterAccount)
                                    <button onclick="openModal('master-modal')" class="px-6 py-2.5 rounded-xl bg-[#00D4FF] text-[#060D1A] font-bold text-sm tracking-widest hover:brightness-110 transition-all shadow-[0_0_20px_rgba(0,212,255,0.3)]">
                                        Create Your Master Account
                                    </button>
                                @endif
                            </div>

                            @if($masterAccount)
                                <div class="overflow-x-auto rounded-xl border border-gray-800">
                                    <table class="w-full text-left text-sm">
                                        <thead class="bg-gray-900/50 text-gray-400 uppercase text-[10px] tracking-widest">
                                            <tr>
                                                <th class="px-6 py-4">ID</th>
                                                <th class="px-6 py-4">Server</th>
                                                <th class="px-6 py-4">Password</th>
                                                <th class="px-6 py-4 text-right">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-800">
                                            <tr>
                                                <td class="px-6 py-4 font-mono text-gray-500">MSTR-{{ str_pad($masterAccount->id, 4, '0', STR_PAD_LEFT) }}</td>
                                                <td class="px-6 py-4 text-white">{{ $masterAccount->server }}</td>
                                                <td class="px-6 py-4 text-gray-400 font-mono">{{ str_repeat('.', strlen($masterAccount->password)) }}</td>
                                                <td class="px-6 py-4 text-right">
                                                    <button onclick="editMaster('{{ $masterAccount->server }}')" class="text-xs font-bold text-[#00D4FF] hover:underline uppercase tracking-widest">Edit</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-8 opacity-40 border border-gray-800/10 rounded-xl">
                                    <p class="text-sm italic">No master account created yet.</p>
                                </div>
                            @endif
                        </div>

                        <!-- 5 Slave Accounts -->
                        @if($masterAccount)
                            <div class="glass-card p-6 sm:p-8">
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
                                    <div>
                                        <h2 class="text-xl sm:text-2xl font-bold text-white mb-2" style="font-family: 'Rajdhani', sans-serif;">Slave Accounts</h2>
                                        <p class="text-sm text-gray-400">Linked accounts that mirror Master Account trades. (Max 10)</p>
                                    </div>
                                    @if($masterAccount->slaveAccounts->count() < 10)
                                        <button onclick="openModal('slave-modal')" class="px-6 py-2.5 rounded-xl border border-[#00D4FF]/30 text-[#00D4FF] font-bold text-sm tracking-widest hover:bg-[#00D4FF]/10 transition-all">
                                            Add Slave Account
                                        </button>
                                    @endif
                                </div>

                                <div class="overflow-x-auto rounded-xl border border-gray-800">
                                    <table class="w-full text-left text-sm">
                                        <thead class="bg-gray-900/50 text-gray-400 uppercase text-[10px] tracking-widest">
                                            <tr>
                                                <th class="px-6 py-4">ID</th>
                                                <th class="px-6 py-4">Server</th>
                                                <th class="px-6 py-4">Password</th>
                                                <th class="px-6 py-4 text-right">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-800">
                                            @foreach($masterAccount->slaveAccounts as $slave)
                                            <tr>
                                                <td class="px-6 py-4 font-mono text-gray-500">SLV-{{ str_pad($slave->id, 4, '0', STR_PAD_LEFT) }}</td>
                                                <td class="px-6 py-4 text-white">{{ $slave->server }}</td>
                                                <td class="px-6 py-4 text-gray-400 font-mono">{{ str_repeat('.', strlen($slave->password)) }}</td>
                                                <td class="px-6 py-4 text-right">
                                                    <button onclick="editSlave({{ $slave->id }}, '{{ $slave->server }}')" class="text-xs font-bold text-[#00D4FF] hover:underline uppercase tracking-widest">Edit</button>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @if($masterAccount->slaveAccounts->isEmpty())
                                            <tr>
                                                <td colspan="4" class="px-6 py-12 text-center text-gray-500 italic">
                                                    No slave accounts added yet.
                                                </td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-4 flex items-center justify-between text-[11px] uppercase tracking-widest text-gray-500 font-bold">
                                    <span>Usage: {{ $masterAccount->slaveAccounts->count() }} / 10 Accounts</span>
                                    <div class="w-32 h-1 bg-gray-800 rounded-full overflow-hidden">
                                        <div class="h-full bg-[#00D4FF]" style="width: {{ $masterAccount->slaveAccounts->count() * 10 }}%"></div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>

                <!-- Security Tab Content -->
                <div id="tab-security" class="tab-content space-y-8">
                    <!-- (Security section remains as before but with real placeholders if needed) -->
                    <div class="glass-card p-6 sm:p-8">
                        <h2 class="text-xl sm:text-2xl font-bold text-white mb-6" style="font-family: 'Rajdhani', sans-serif;">Security Settings</h2>
                        <p class="text-sm text-gray-400 mb-8">Manage your account security and authentication methods.</p>
                        <div class="space-y-6">
                            <div class="flex items-center justify-between p-4 rounded-xl bg-white/5 border border-white/10">
                                <div>
                                    <p class="text-white font-semibold">Two-Factor Authentication</p>
                                    <p class="text-xs text-gray-500">Add an extra layer of security to your account.</p>
                                </div>
                                <button class="text-xs font-bold text-[#00D4FF] uppercase tracking-widest">Enable</button>
                            </div>
                            <div class="flex items-center justify-between p-4 rounded-xl bg-white/5 border border-white/10">
                                <div>
                                    <p class="text-white font-semibold">Change Password</p>
                                    <p class="text-xs text-gray-500">Update your account password regularly.</p>
                                </div>
                                <button class="text-xs font-bold text-[#00D4FF] uppercase tracking-widest">Update</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Billing Tab Content -->
                <div id="tab-billing" class="tab-content space-y-8">
                    <div class="glass-card p-6 sm:p-8">
                        <h2 class="text-xl sm:text-2xl font-bold text-white mb-6" style="font-family: 'Rajdhani', sans-serif;">Billing & Subscription</h2>
                        <p class="text-sm text-gray-400 mb-8">View your current plan and billing history.</p>
                        <div class="p-6 rounded-2xl bg-gradient-to-br from-[#1E5FAD]/20 to-[#00D4FF]/20 border border-[#00D4FF]/30">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <p class="text-xs uppercase tracking-widest text-[#00D4FF] mb-1 font-bold">Current Plan</p>
                                    <h4 class="text-2xl font-bold text-white">{{ auth()->guard('customer')->user()->plan->name ?? 'No Plan Active' }}</h4>
                                </div>
                                @if($hasActivePlan)
                                    <span class="px-3 py-1 bg-green-500/10 text-green-500 text-[10px] font-bold uppercase tracking-widest rounded-full border border-green-500/20">Active</span>
                                @else
                                    <span class="px-3 py-1 bg-gray-500/10 text-gray-500 text-[10px] font-bold uppercase tracking-widest rounded-full border border-gray-500/20">Inactive</span>
                                @endif
                            </div>
                            <a href="{{ route('services') }}" class="block w-full text-center py-3 rounded-xl bg-white text-black font-bold text-xs uppercase tracking-widest hover:bg-gray-200 transition-colors">
                                {{ $hasActivePlan ? 'Upgrade Plan' : 'Buy Plan' }}
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>

<!-- Modals -->
<div id="master-modal" class="modal">
    <div class="glass-card p-8 w-full max-w-md" data-aos="zoom-in">
        <h2 id="master-modal-title" class="text-2xl font-bold text-white mb-6" style="font-family: 'Rajdhani', sans-serif;">Create Master Account</h2>
        <form id="master-form" action="{{ route('accounts.master.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2 font-bold">Trading Server</label>
                    <input type="text" name="server" id="master-server" required placeholder="........" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#00D4FF] transition-colors">
                </div>
                <div>
                    <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2 font-bold">Account Password</label>
                    <div class="password-wrapper"><input type="password" name="password" id="master-password" required placeholder="........" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#00D4FF] transition-colors pr-12"><button type="button" class="password-toggle" onclick="togglePassword('master-password', 'master-toggle-icon')"><i data-lucide="eye" id="master-toggle-icon" class="w-5 h-5"></i></button></div>
                </div>
                <div class="flex gap-4 pt-4">
                    <button type="button" onclick="closeModal('master-modal')" class="flex-1 py-3 rounded-xl border border-white/10 text-white font-bold text-xs uppercase tracking-widest hover:bg-white/5 transition-colors">Cancel</button>
                    <button type="submit" class="flex-1 py-3 rounded-xl bg-[#00D4FF] text-[#060D1A] font-bold text-xs uppercase tracking-widest hover:brightness-110 transition-all">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="slave-modal" class="modal">
    <div class="glass-card p-8 w-full max-w-md" data-aos="zoom-in">
        <h2 id="slave-modal-title" class="text-2xl font-bold text-white mb-6" style="font-family: 'Rajdhani', sans-serif;">Add Slave Account</h2>
        <form id="slave-form" action="{{ route('accounts.slave.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2 font-bold">Trading Server</label>
                    <input type="text" name="server" id="slave-server" required placeholder="........" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#00D4FF] transition-colors">
                </div>
                <div>
                    <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2 font-bold">Account Password</label>
                    <div class="password-wrapper"><input type="password" name="password" id="slave-password" required placeholder="........" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-[#00D4FF] transition-colors pr-12"><button type="button" class="password-toggle" onclick="togglePassword('slave-password', 'slave-toggle-icon')"><i data-lucide="eye" id="slave-toggle-icon" class="w-5 h-5"></i></button></div>
                </div>
                <div class="flex gap-4 pt-4">
                    <button type="button" onclick="closeModal('slave-modal')" class="flex-1 py-3 rounded-xl border border-white/10 text-white font-bold text-xs uppercase tracking-widest hover:bg-white/5 transition-colors">Cancel</button>
                    <button type="submit" class="flex-1 py-3 rounded-xl bg-[#00D4FF] text-[#060D1A] font-bold text-xs uppercase tracking-widest hover:brightness-110 transition-all">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function togglePassword(inputId, iconId) {
        const passwordInput = document.getElementById(inputId);
        const toggleIcon = document.getElementById(iconId);
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.setAttribute('data-lucide', 'eye-off');
        } else {
            passwordInput.type = 'password';
            toggleIcon.setAttribute('data-lucide', 'eye');
        }
        
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    }

    function switchTab(tabId) {
        document.querySelectorAll('.profile-nav-item').forEach(el => el.classList.remove('active'));
        document.getElementById('nav-' + tabId).classList.add('active');

        document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
        document.getElementById('tab-' + tabId).classList.add('active');

        if (typeof AOS !== 'undefined') AOS.refresh();
    }

    function openModal(id) {
        document.getElementById(id).classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(id) {
        document.getElementById(id).classList.remove('active');
        document.body.style.overflow = '';
    }

    function editMaster(server) {
        document.getElementById('master-modal-title').innerText = 'Edit Master Account';
        document.getElementById('master-form').action = "{{ route('accounts.master.update') }}";
        document.getElementById('master-server').value = server;
        openModal('master-modal');
    }

    function editSlave(id, server) {
        document.getElementById('slave-modal-title').innerText = 'Edit Slave Account';
        let url = "{{ route('accounts.slave.update', ':id') }}";
        document.getElementById('slave-form').action = url.replace(':id', id);
        document.getElementById('slave-server').value = server;
        openModal('slave-modal');
    }

    document.addEventListener('DOMContentLoaded', () => {
        if(typeof lucide !== 'undefined') lucide.createIcons();

        // Flash message handling
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ session('success') }}",
                confirmButtonColor: '#00D4FF',
                background: '#0F1E35',
                color: '#fff'
            });
        @endif
        
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "{{ session('error') }}",
                confirmButtonColor: '#00D4FF',
                background: '#0F1E35',
                color: '#fff'
            });
        @endif
    });
</script>
@endpush



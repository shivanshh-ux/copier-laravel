@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="page-header">
    <div>
        <h1>Dashboard</h1>
        <div class="breadcrumb">Welcome back, <span>{{ session('admin_username') }}</span></div>
    </div>
    <span class="text-muted" style="font-size:.8rem;">{{ now()->format('D, d M Y') }}</span>
</div>

{{-- STAT CARDS --}}
<div class="grid-5 mb-4">
    <div class="stat-card">
        <div class="stat-icon gold"><i class="fas fa-users"></i></div>
        <div>
            <div class="stat-value">{{ $stats['total_customers'] }}</div>
            <div class="stat-label">Total Customers</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green"><i class="fas fa-user-check"></i></div>
        <div>
            <div class="stat-value">{{ $stats['active_customers'] }}</div>
            <div class="stat-label">Active Customers</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon blue"><i class="fas fa-shopping-bag"></i></div>
        <div>
            <div class="stat-value">{{ $stats['total_orders'] }}</div>
            <div class="stat-label">Total Orders</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon purple"><i class="fas fa-layer-group"></i></div>
        <div>
            <div class="stat-value">{{ $stats['active_plans'] }}</div>
            <div class="stat-label">Active Plans</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green"><i class="fas fa-rupee-sign"></i></div>
        <div>
            <div class="stat-value">₹{{ number_format($stats['total_revenue'],0) }}</div>
            <div class="stat-label">Total Revenue</div>
        </div>
    </div>
</div>

{{-- SECOND ROW STATS --}}
<div class="grid-4 mb-4">
    <div class="stat-card">
        <div class="stat-icon red"><i class="fas fa-clock"></i></div>
        <div>
            <div class="stat-value">{{ $stats['pending_orders'] }}</div>
            <div class="stat-label">Pending Orders</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon gold"><i class="fas fa-tags"></i></div>
        <div>
            <div class="stat-value">{{ $stats['active_offers'] }}</div>
            <div class="stat-label">Active Offers</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon blue"><i class="fas fa-photo-film"></i></div>
        <div>
            <div class="stat-value">{{ $stats['total_media'] }}</div>
            <div class="stat-label">Media Files</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon purple"><i class="fas fa-percent"></i></div>
        <div>
            <div class="stat-value">{{ $stats['total_offers'] }}</div>
            <div class="stat-label">Total Offers</div>
        </div>
    </div>
</div>

{{-- BOTTOM GRID --}}
<div class="grid-2">
    {{-- Recent Orders --}}
    <div class="card">
        <div class="card-header">
            <div class="card-title"><i class="fas fa-shopping-bag text-gold" style="margin-right:8px"></i>Recent Orders</div>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-outline btn-sm">View All</a>
        </div>
        @if($recent_orders->isEmpty())
            <div class="empty-state"><i class="fas fa-inbox"></i><p>No orders yet</p></div>
        @else
        <div class="table-wrap">
            <table>
                <thead><tr><th>Customer</th><th>Plan</th><th>Amount</th><th>Status</th></tr></thead>
                <tbody>
                @foreach($recent_orders as $order)
                <tr>
                    <td class="fw-600">{{ $order->customer->name ?? '—' }}</td>
                    <td class="text-muted">{{ $order->plan->name ?? '—' }}</td>
                    <td>₹{{ number_format($order->amount,2) }}</td>
                    <td>
                        @php
                            $cls = match($order->status) {
                                'active'    => 'badge-success',
                                'pending'   => 'badge-warning',
                                'cancelled' => 'badge-danger',
                                'completed' => 'badge-info',
                                default     => 'badge-muted',
                            };
                        @endphp
                        <span class="badge {{ $cls }}">{{ ucfirst($order->status) }}</span>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

    {{-- Recent Customers --}}
    <div class="card">
        <div class="card-header">
            <div class="card-title"><i class="fas fa-users text-gold" style="margin-right:8px"></i>Recent Customers</div>
            <a href="{{ route('admin.customers.index') }}" class="btn btn-outline btn-sm">View All</a>
        </div>
        @if($recent_customers->isEmpty())
            <div class="empty-state"><i class="fas fa-user-plus"></i><p>No customers yet</p></div>
        @else
        <div class="table-wrap">
            <table>
                <thead><tr><th>Name</th><th>Plan</th><th>Status</th></tr></thead>
                <tbody>
                @foreach($recent_customers as $customer)
                <tr>
                    <td>
                        <div class="fw-600">{{ $customer->name }}</div>
                        <div class="text-muted" style="font-size:.78rem">{{ $customer->email }}</div>
                    </td>
                    <td class="text-muted">{{ $customer->plan->name ?? 'No Plan' }}</td>
                    <td>
                        <span class="badge {{ $customer->status === 'active' ? 'badge-success' : 'badge-danger' }}">
                            {{ ucfirst($customer->status) }}
                        </span>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>
@endsection

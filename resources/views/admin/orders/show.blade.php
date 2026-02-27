@extends('admin.layouts.app')
@section('title', 'Order #' . $order->id)
@section('page-title', 'Order Details')

@section('content')
<div class="page-header">
    <div>
        <h1>Order #{{ $order->id }}</h1>
        <div class="breadcrumb">Admin / <a href="{{ route('admin.orders.index') }}" style="color:var(--text-muted);text-decoration:none">Orders</a> / <span>#{{ $order->id }}</span></div>
    </div>
    <div style="display:flex;gap:10px">
        <a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-gold"><i class="fas fa-edit"></i> Edit Order</a>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back</a>
    </div>
</div>

<div class="grid-2">
    <div class="card">
        <div class="card-header"><div class="card-title">Order Info</div></div>
        <div class="card-body">
            <table style="width:100%">
                <tr><td class="text-muted" style="padding:8px 0;width:40%">Order ID</td><td class="fw-600">#{{ $order->id }}</td></tr>
                <tr><td class="text-muted" style="padding:8px 0">Amount</td><td class="fw-600 text-gold">₹{{ number_format($order->amount,2) }}</td></tr>
                <tr><td class="text-muted" style="padding:8px 0">Plan</td><td>{{ $order->plan->name ?? '—' }}</td></tr>
                <tr><td class="text-muted" style="padding:8px 0">Status</td>
                    <td>
                        @php $cls = match($order->status){ 'active'=>'badge-success','pending'=>'badge-warning','cancelled'=>'badge-danger','completed'=>'badge-info',default=>'badge-muted'}; @endphp
                        <span class="badge {{ $cls }}">{{ ucfirst($order->status) }}</span>
                    </td>
                </tr>
                <tr><td class="text-muted" style="padding:8px 0">Created</td><td>{{ $order->created_at->format('d M Y, h:i A') }}</td></tr>
            </table>
            @if($order->notes)
            <div style="margin-top:16px;padding:12px;background:rgba(255,255,255,.04);border-radius:10px;border:1px solid var(--border)">
                <div class="text-muted" style="font-size:.75rem;margin-bottom:6px">NOTES</div>
                <div>{{ $order->notes }}</div>
            </div>
            @endif
        </div>
    </div>

    <div class="card">
        <div class="card-header"><div class="card-title">Customer Info</div></div>
        <div class="card-body">
            <table style="width:100%">
                <tr><td class="text-muted" style="padding:8px 0;width:40%">Name</td><td class="fw-600">{{ $order->customer->name ?? '—' }}</td></tr>
                <tr><td class="text-muted" style="padding:8px 0">Email</td><td>{{ $order->customer->email ?? '—' }}</td></tr>
                <tr><td class="text-muted" style="padding:8px 0">Phone</td><td>{{ $order->customer->phone ?? '—' }}</td></tr>
                <tr><td class="text-muted" style="padding:8px 0">Status</td>
                    <td><span class="badge {{ $order->customer->status === 'active' ? 'badge-success' : 'badge-danger' }}">{{ ucfirst($order->customer->status ?? '—') }}</span></td>
                </tr>
            </table>
            @if($order->customer)
            <div style="margin-top:16px">
                <a href="{{ route('admin.customers.edit', $order->customer) }}" class="btn btn-outline btn-sm"><i class="fas fa-user-edit"></i> Edit Customer</a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

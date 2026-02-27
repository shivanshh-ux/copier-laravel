@extends('admin.layouts.app')
@section('title', 'Orders')
@section('page-title', 'Orders')

@section('content')
<div class="page-header">
    <div>
        <h1>Orders</h1>
        <div class="breadcrumb">Admin / <span>Orders</span></div>
    </div>
    <div style="display:flex;gap:12px;align-items:center">
        <a href="{{ route('admin.orders.create') }}" class="btn btn-gold"><i class="fas fa-plus"></i> New Order</a>
    </div>
</div>

<div class="search-bar">
    <form method="GET" action="{{ route('admin.orders.index') }}" style="display:flex;gap:12px;flex:1;flex-wrap:wrap">
        <div class="search-input-wrap">
            <i class="fas fa-search"></i>
            <input type="text" name="search" class="form-control" placeholder="Search by customer name..." value="{{ request('search') }}">
        </div>
        <select name="status" class="form-control" style="width:170px">
            <option value="">All Status</option>
            <option value="pending"   {{ request('status')=='pending'   ?'selected':'' }}>Pending</option>
            <option value="active"    {{ request('status')=='active'    ?'selected':'' }}>Active</option>
            <option value="completed" {{ request('status')=='completed' ?'selected':'' }}>Completed</option>
            <option value="cancelled" {{ request('status')=='cancelled' ?'selected':'' }}>Cancelled</option>
        </select>
        <button type="submit" class="btn btn-gold"><i class="fas fa-filter"></i> Filter</button>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline"><i class="fas fa-times"></i> Clear</a>
    </form>
</div>

<div class="card">
    <div class="card-header">
        <div class="card-title"><i class="fas fa-shopping-bag" style="margin-right:8px;color:var(--gold)"></i>All Orders ({{ $orders->total() }})</div>
    </div>
    @if($orders->isEmpty())
        <div class="empty-state"><i class="fas fa-inbox"></i><p>No orders found</p></div>
    @else
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Customer</th>
                    <th>Plan</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
            @php
                $cls = match($order->status) {
                    'active'    => 'badge-success',
                    'pending'   => 'badge-warning',
                    'cancelled' => 'badge-danger',
                    'completed' => 'badge-info',
                    default     => 'badge-muted',
                };
            @endphp
            <tr>
                <td class="text-muted fw-600">#{{ $order->id }}</td>
                <td>
                    <div class="fw-600">{{ $order->customer->name ?? '—' }}</div>
                    <div class="text-muted" style="font-size:.78rem">{{ $order->customer->email ?? '' }}</div>
                </td>
                <td class="text-muted">{{ $order->plan->name ?? '—' }}</td>
                <td class="fw-600 text-gold">₹{{ number_format($order->amount, 2) }}</td>
                <td><span class="badge {{ $cls }}">{{ ucfirst($order->status) }}</span></td>
                <td class="text-muted">{{ $order->created_at->format('d M Y') }}</td>
                <td>
                    <div style="display:flex;gap:8px">
                        <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-outline btn-sm"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-outline btn-sm"><i class="fas fa-edit"></i> Edit</a>
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination-wrap">{{ $orders->withQueryString()->links() }}</div>
    @endif
</div>
@endsection

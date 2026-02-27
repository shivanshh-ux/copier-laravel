@extends('admin.layouts.app')
@section('title', 'Customers')
@section('page-title', 'Customers')

@section('content')
<div class="page-header">
    <div>
        <h1>Customers</h1>
        <div class="breadcrumb">Admin / <span>Customers</span></div>
    </div>
    <div style="display:flex;gap:12px;align-items:center">
        <a href="{{ route('admin.customers.create') }}" class="btn btn-gold"><i class="fas fa-plus"></i> New Customer</a>
    </div>
</div>

<div class="search-bar">
    <form method="GET" action="{{ route('admin.customers.index') }}" style="display:flex;gap:12px;flex:1;flex-wrap:wrap">
        <div class="search-input-wrap">
            <i class="fas fa-search"></i>
            <input type="text" name="search" class="form-control" placeholder="Search by name or email..." value="{{ request('search') }}">
        </div>
        <select name="status" class="form-control" style="width:160px">
            <option value="">All Status</option>
            <option value="active"   {{ request('status')=='active'   ? 'selected':'' }}>Active</option>
            <option value="inactive" {{ request('status')=='inactive' ? 'selected':'' }}>Inactive</option>
        </select>
        <button type="submit" class="btn btn-gold"><i class="fas fa-filter"></i> Filter</button>
        <a href="{{ route('admin.customers.index') }}" class="btn btn-outline"><i class="fas fa-times"></i> Clear</a>
    </form>
</div>

<div class="card">
    <div class="card-header">
        <div class="card-title"><i class="fas fa-users" style="margin-right:8px;color:var(--gold)"></i>All Customers ({{ $customers->total() }})</div>
    </div>
    @if($customers->isEmpty())
        <div class="empty-state">
            <i class="fas fa-users"></i>
            <p>No customers found</p>
        </div>
    @else
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Phone</th>
                    <th>Plan</th>
                    <th>Status</th>
                    <th>Joined</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($customers as $customer)
            <tr>
                <td class="text-muted">{{ $customer->id }}</td>
                <td>
                    <div class="fw-600">{{ $customer->name }}</div>
                    <div class="text-muted" style="font-size:.78rem">{{ $customer->email }}</div>
                </td>
                <td class="text-muted">{{ $customer->phone ?? '—' }}</td>
                <td>
                    @if($customer->plan)
                        <span class="badge badge-info">{{ $customer->plan->name }}</span>
                    @else
                        <span class="text-muted">—</span>
                    @endif
                </td>
                <td>
                    <span class="badge {{ $customer->status === 'active' ? 'badge-success' : 'badge-danger' }}">
                        <i class="fas fa-circle" style="font-size:.5rem"></i>
                        {{ ucfirst($customer->status) }}
                    </span>
                </td>
                <td class="text-muted">{{ $customer->created_at->format('d M Y') }}</td>
                <td>
                    <div style="display:flex;gap:8px">
                        <a href="{{ route('admin.customers.edit', $customer) }}" class="btn btn-outline btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form method="POST" action="{{ route('admin.customers.destroy', $customer) }}" onsubmit="return confirm('Delete this customer?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination-wrap">
        {{ $customers->withQueryString()->links() }}
    </div>
    @endif
</div>
@endsection

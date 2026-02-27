@extends('admin.layouts.app')
@section('title', 'Edit Order')
@section('page-title', 'Edit Order')

@section('content')
<div class="page-header">
    <div>
        <h1>Edit Order #{{ $order->id }}</h1>
        <div class="breadcrumb">Admin / <a href="{{ route('admin.orders.index') }}" style="color:var(--text-muted);text-decoration:none">Orders</a> / <span>Edit</span></div>
    </div>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back</a>
</div>

<div style="max-width:720px">
    <div class="card">
        <div class="card-header">
            <div class="card-title"><i class="fas fa-edit" style="margin-right:8px;color:var(--gold)"></i>Order Details</div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.orders.update', $order) }}">
                @csrf @method('PUT')

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Customer *</label>
                        <select name="customer_id" class="form-control" required>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" {{ old('customer_id', $order->customer_id) == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->name }} ({{ $customer->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('customer_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Plan</label>
                        <select name="plan_id" class="form-control">
                            <option value="">— No Plan —</option>
                            @foreach($plans as $plan)
                                <option value="{{ $plan->id }}" {{ old('plan_id', $order->plan_id) == $plan->id ? 'selected' : '' }}>
                                    {{ $plan->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('plan_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Amount (₹) *</label>
                        <input type="number" name="amount" class="form-control" step="0.01" min="0" value="{{ old('amount', $order->amount) }}" required>
                        @error('amount')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Order Status *</label>
                        <select name="status" class="form-control" required>
                            @foreach(['pending','active','completed','cancelled'] as $s)
                                <option value="{{ $s }}" {{ old('status', $order->status) === $s ? 'selected' : '' }}>
                                    {{ ucfirst($s) }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" class="form-control" placeholder="Add any order notes...">{{ old('notes', $order->notes) }}</textarea>
                    @error('notes')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-gold"><i class="fas fa-save"></i> Update Order</button>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@extends('admin.layouts.app')
@section('title', 'Create Order')
@section('page-title', 'Create New Order')

@section('content')
<div class="page-header">
    <div>
        <h1>Create Order</h1>
        <div class="breadcrumb">Admin / <a href="{{ route('admin.orders.index') }}" style="color:var(--text-muted);text-decoration:none">Orders</a> / <span>Create</span></div>
    </div>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back</a>
</div>

<div style="max-width:720px">
    <div class="card">
        <div class="card-header">
            <div class="card-title"><i class="fas fa-cart-plus" style="margin-right:8px;color:var(--gold)"></i>Order Information</div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.orders.store') }}">
                @csrf
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Customer *</label>
                        <select name="customer_id" class="form-control" required>
                            <option value="">— Select Customer —</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->name }} ({{ $customer->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('customer_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Plan (Optional)</label>
                        <select name="plan_id" class="form-control">
                            <option value="">— Manual / Other Plan —</option>
                            @foreach($plans as $plan)
                                <option value="{{ $plan->id }}" {{ old('plan_id') == $plan->id ? 'selected' : '' }}>
                                    {{ $plan->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('plan_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Total Amount (₹) *</label>
                        <input type="number" name="amount" class="form-control" step="0.01" min="0" placeholder="0.00" value="{{ old('amount') }}" required>
                        @error('amount')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Order Status *</label>
                        <select name="status" class="form-control" required>
                            <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                            <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>⚡ Active</option>
                            <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>✅ Completed</option>
                            <option value="cancelled" {{ old('status') === 'cancelled' ? 'selected' : '' }}>❌ Cancelled</option>
                        </select>
                        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Order Notes</label>
                    <textarea name="notes" class="form-control" placeholder="Add any details or instructions...">{{ old('notes') }}</textarea>
                    @error('notes')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-gold"><i class="fas fa-save"></i> Create Order</button>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

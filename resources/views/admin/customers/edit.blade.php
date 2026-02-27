@extends('admin.layouts.app')
@section('title', 'Edit Customer')
@section('page-title', 'Edit Customer')

@section('content')
<div class="page-header">
    <div>
        <h1>Edit Customer</h1>
        <div class="breadcrumb">Admin / <a href="{{ route('admin.customers.index') }}" style="color:var(--text-muted);text-decoration:none">Customers</a> / <span>{{ $customer->name }}</span></div>
    </div>
    <a href="{{ route('admin.customers.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back</a>
</div>

<div style="max-width:720px">
    <div class="card">
        <div class="card-header">
            <div class="card-title"><i class="fas fa-user-edit" style="margin-right:8px;color:var(--gold)"></i>Customer Details</div>
            <span class="badge {{ $customer->status === 'active' ? 'badge-success' : 'badge-danger' }}">{{ ucfirst($customer->status) }}</span>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.customers.update', $customer) }}">
                @csrf @method('PUT')

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Full Name *</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $customer->name) }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email Address *</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $customer->email) }}" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $customer->phone) }}" placeholder="+91 00000 00000">
                        @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Assigned Plan</label>
                        <select name="plan_id" class="form-control">
                            <option value="">— No Plan —</option>
                            @foreach($plans as $plan)
                                <option value="{{ $plan->id }}" {{ old('plan_id', $customer->plan_id) == $plan->id ? 'selected' : '' }}>
                                    {{ $plan->name }} (₹{{ number_format($plan->discounted_price ?? $plan->actual_price, 2) }})
                                </option>
                            @endforeach
                        </select>
                        @error('plan_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Address</label>
                    <textarea name="address" class="form-control" placeholder="Customer address...">{{ old('address', $customer->address) }}</textarea>
                    @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Account Status</label>
                    <select name="status" class="form-control" required>
                        <option value="active"   {{ old('status', $customer->status) === 'active'   ? 'selected' : '' }}>✅ Active</option>
                        <option value="inactive" {{ old('status', $customer->status) === 'inactive' ? 'selected' : '' }}>🚫 Inactive</option>
                    </select>
                    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-gold"><i class="fas fa-save"></i> Update Customer</button>
                    <a href="{{ route('admin.customers.index') }}" class="btn btn-outline">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

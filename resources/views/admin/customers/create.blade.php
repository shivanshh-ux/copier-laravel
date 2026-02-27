@extends('admin.layouts.app')
@section('title', 'Create Customer')
@section('page-title', 'Add New Customer')

@section('content')
<div class="page-header">
    <div>
        <h1>Add New Customer</h1>
        <div class="breadcrumb">Admin / <a href="{{ route('admin.customers.index') }}" style="color:var(--text-muted);text-decoration:none">Customers</a> / <span>Create</span></div>
    </div>
    <a href="{{ route('admin.customers.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back</a>
</div>

<div style="max-width:720px">
    <div class="card">
        <div class="card-header">
            <div class="card-title"><i class="fas fa-user-plus" style="margin-right:8px;color:var(--gold)"></i>Customer Information</div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.customers.store') }}">
                @csrf
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Full Name *</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. John Doe" value="{{ old('name') }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email Address *</label>
                        <input type="email" name="email" class="form-control" placeholder="john@example.com" value="{{ old('email') }}" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-control" placeholder="+91 00000 00000" value="{{ old('phone') }}">
                        @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Assign Plan</label>
                        <select name="plan_id" class="form-control">
                            <option value="">— No Plan Assigned —</option>
                            @foreach($plans as $plan)
                                <option value="{{ $plan->id }}" {{ old('plan_id') == $plan->id ? 'selected' : '' }}>
                                    {{ $plan->name }} (₹{{ number_format($plan->effective_price, 2) }})
                                </option>
                            @endforeach
                        </select>
                        @error('plan_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Address</label>
                    <textarea name="address" class="form-control" placeholder="Physical address...">{{ old('address') }}</textarea>
                    @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Initial Status</label>
                    <select name="status" class="form-control">
                        <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>✅ Active</option>
                        <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>🚫 Inactive</option>
                    </select>
                    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-gold"><i class="fas fa-plus-circle"></i> Create Customer</button>
                    <a href="{{ route('admin.customers.index') }}" class="btn btn-outline">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

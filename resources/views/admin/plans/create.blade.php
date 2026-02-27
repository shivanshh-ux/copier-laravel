@extends('admin.layouts.app')
@section('title', 'Create Plan')
@section('page-title', 'Create Plan')

@section('content')
<div class="page-header">
    <div>
        <h1>Create New Plan</h1>
        <div class="breadcrumb">Admin / <a href="{{ route('admin.plans.index') }}" style="color:var(--text-muted);text-decoration:none">Plans</a> / <span>Create</span></div>
    </div>
    <a href="{{ route('admin.plans.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back</a>
</div>

<div style="max-width:680px">
    <div class="card">
        <div class="card-header"><div class="card-title"><i class="fas fa-layer-group" style="margin-right:8px;color:var(--gold)"></i>Plan Details</div></div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.plans.store') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label">Plan Name *</label>
                    <input type="text" name="name" class="form-control" placeholder="e.g. Basic, Pro, Enterprise" value="{{ old('name') }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" placeholder="Describe what this plan includes...">{{ old('description') }}</textarea>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Actual Price (₹) *</label>
                        <input type="number" name="actual_price" class="form-control" step="0.01" min="0" placeholder="0.00" value="{{ old('actual_price') }}" required id="actualPrice">
                        <div style="font-size:.72rem;color:var(--text-muted);margin-top:4px">Original / MRP price</div>
                        @error('actual_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Discounted Price (₹)</label>
                        <input type="number" name="discounted_price" class="form-control" step="0.01" min="0" placeholder="Leave blank if none" value="{{ old('discounted_price') }}" id="discountPrice">
                        <div style="font-size:.72rem;color:var(--text-muted);margin-top:4px">Price after discount (optional)</div>
                        @error('discounted_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- Live discount preview --}}
                <div id="discountPreview" style="display:none;background:rgba(16,185,129,.08);border:1px solid rgba(16,185,129,.25);border-radius:10px;padding:12px 16px;margin-bottom:20px;font-size:.85rem">
                    <span class="text-muted">Savings: </span>
                    <span id="savingsAmt" class="text-success fw-600"></span>
                    &nbsp;&nbsp;
                    <span class="text-muted">Discount: </span>
                    <span id="discountPct" class="badge badge-success"></span>
                </div>

                <div class="form-group">
                    <label class="form-label">Duration (Days) *</label>
                    <input type="number" name="duration_days" class="form-control" min="1" placeholder="30" value="{{ old('duration_days', 30) }}" required>
                    @error('duration_days')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="is_active" class="form-control">
                        <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>✅ Active</option>
                        <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>🚫 Inactive</option>
                    </select>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-gold"><i class="fas fa-save"></i> Create Plan</button>
                    <a href="{{ route('admin.plans.index') }}" class="btn btn-outline">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const ap = document.getElementById('actualPrice');
    const dp = document.getElementById('discountPrice');
    const preview = document.getElementById('discountPreview');
    function calcDiscount() {
        const a = parseFloat(ap.value), d = parseFloat(dp.value);
        if (a > 0 && d > 0 && d < a) {
            preview.style.display = 'block';
            document.getElementById('savingsAmt').textContent = '₹' + (a-d).toFixed(2);
            document.getElementById('discountPct').textContent = Math.round(((a-d)/a)*100) + '% OFF';
        } else { preview.style.display = 'none'; }
    }
    ap.addEventListener('input', calcDiscount);
    dp.addEventListener('input', calcDiscount);
</script>
@endpush

@extends('admin.layouts.app')
@section('title', 'Edit Offer')
@section('page-title', 'Edit Offer')

@section('content')
<div class="page-header">
    <div>
        <h1>Edit Offer</h1>
        <div class="breadcrumb">Admin / <a href="{{ route('admin.offers.index') }}" style="color:var(--text-muted);text-decoration:none">Offers</a> / <span>Edit</span></div>
    </div>
    <a href="{{ route('admin.offers.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back</a>
</div>

<div style="max-width:680px">
    <div class="card">
        <div class="card-header"><div class="card-title"><i class="fas fa-tags" style="margin-right:8px;color:var(--gold)"></i>Edit: {{ $offer->title }}</div></div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.offers.update', $offer) }}">
                @csrf @method('PUT')

                <div class="form-group">
                    <label class="form-label">Offer Title *</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $offer->title) }}" required>
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control">{{ old('description', $offer->description) }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Target Plan (Optional)</label>
                    <select name="plan_id" class="form-control">
                        <option value="">— General Offer (No Specific Plan) —</option>
                        @foreach($plans as $plan)
                            <option value="{{ $plan->id }}" {{ old('plan_id', $offer->plan_id) == $plan->id ? 'selected' : '' }}>{{ $plan->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Actual Price (₹) *</label>
                        <input type="number" name="actual_price" class="form-control" step="0.01" min="0" value="{{ old('actual_price', $offer->actual_price) }}" required id="actualPrice">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Offer Price (₹) *</label>
                        <input type="number" name="discounted_price" class="form-control" step="0.01" min="0" value="{{ old('discounted_price', $offer->discounted_price) }}" required id="discountPrice">
                    </div>
                </div>

                <div id="discountPreview" style="{{ ($offer->actual_price > $offer->discounted_price) ? '' : 'display:none;' }}background:rgba(16,185,129,.08);border:1px solid rgba(16,185,129,.25);border-radius:10px;padding:12px 16px;margin-bottom:20px;font-size:.85rem">
                    <span class="text-muted">Savings: </span>
                    <span id="savingsAmt" class="text-success fw-600">₹{{ number_format($offer->actual_price - $offer->discounted_price, 2) }}</span>
                    &nbsp;&nbsp;
                    <span class="text-muted">Discount: </span>
                    <span id="discountPct" class="badge badge-success">{{ $offer->discount_percent }}% OFF</span>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Valid Until</label>
                        <input type="date" name="valid_until" class="form-control" value="{{ old('valid_until', $offer->valid_until ? $offer->valid_until->format('Y-m-d') : '') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select name="is_active" class="form-control">
                            <option value="1" {{ old('is_active', $offer->is_active ? '1' : '0') == '1' ? 'selected' : '' }}>✅ Active</option>
                            <option value="0" {{ old('is_active', $offer->is_active ? '1' : '0') == '0' ? 'selected' : '' }}>🚫 Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-gold"><i class="fas fa-save"></i> Update Offer</button>
                    <a href="{{ route('admin.offers.index') }}" class="btn btn-outline">Cancel</a>
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

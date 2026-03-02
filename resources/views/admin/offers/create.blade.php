@extends('admin.layouts.app')
@section('title', 'Create Offer')
@section('page-title', 'Create New Offer')

@section('content')
<div class="page-header">
    <div>
        <h1>Create Offer</h1>
        <div class="breadcrumb">Admin / <a href="{{ route('admin.offers.index') }}" style="color:var(--text-muted);text-decoration:none">Offers</a> / <span>Create</span></div>
    </div>
    <a href="{{ route('admin.offers.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back</a>
</div>

<div style="max-width:680px">
    <div class="card">
        <div class="card-header"><div class="card-title"><i class="fas fa-tags" style="margin-right:8px;color:var(--gold)"></i>Offer Details</div></div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.offers.store') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label">Offer Title *</label>
                    <input type="text" name="title" class="form-control" placeholder="e.g. Summer Special 50% Off" value="{{ old('title') }}" required>
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" placeholder="Describe the offer details...">{{ old('description') }}</textarea>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Target Plan (Optional)</label>
                    <select name="plan_id" class="form-control" id="planSelector">
                        <option value="" data-currency="INR">— General Offer (No Specific Plan) —</option>
                        @foreach($plans as $plan)
                            <option value="{{ $plan->id }}" {{ old('plan_id') == $plan->id ? 'selected' : '' }} data-currency="{{ $plan->currency }}">{{ $plan->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Actual Price (<span class="currency-symbol">₹</span>) *</label>
                        <input type="number" name="actual_price" class="form-control" step="0.01" min="0" value="{{ old('actual_price') }}" required id="actualPrice">
                        @error('actual_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Offer Price (<span class="currency-symbol">₹</span>) *</label>
                        <input type="number" name="discounted_price" class="form-control" step="0.01" min="0" value="{{ old('discounted_price') }}" required id="discountPrice">
                        @error('discounted_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div id="discountPreview" style="display:none;background:rgba(16,185,129,.08);border:1px solid rgba(16,185,129,.25);border-radius:10px;padding:12px 16px;margin-bottom:20px;font-size:.85rem">
                    <span class="text-muted">Savings: </span>
                    <span id="savingsAmt" class="text-success fw-600"></span>
                    &nbsp;&nbsp;
                    <span class="text-muted">Discount: </span>
                    <span id="discountPct" class="badge badge-success"></span>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Valid Until</label>
                        <input type="date" name="valid_until" class="form-control" value="{{ old('valid_until') }}">
                        @error('valid_until')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select name="is_active" class="form-control">
                            <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>✅ Active</option>
                            <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>🚫 Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-gold"><i class="fas fa-save"></i> Create Offer</button>
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
    const planSelector = document.getElementById('planSelector');
    const currencySymbols = document.querySelectorAll('.currency-symbol');

    const symbols = {
        'INR': '₹',
        'USD': '$',
        'EUR': '€',
        'GBP': '£'
    };

    function updateSymbols() {
        const selectedOption = planSelector.options[planSelector.selectedIndex];
        const currencyCode = selectedOption.getAttribute('data-currency') || 'INR';
        const symbol = symbols[currencyCode] || '₹';
        currencySymbols.forEach(el => el.textContent = symbol);
        calcDiscount();
    }

    function calcDiscount() {
        const a = parseFloat(ap.value), d = parseFloat(dp.value);
        const selectedOption = planSelector.options[planSelector.selectedIndex];
        const currencyCode = selectedOption.getAttribute('data-currency') || 'INR';
        const symbol = symbols[currencyCode] || '₹';
        
        if (a > 0 && d > 0 && d < a) {
            preview.style.display = 'block';
            document.getElementById('savingsAmt').textContent = symbol + (a-d).toFixed(2);
            document.getElementById('discountPct').textContent = Math.round(((a-d)/a)*100) + '% OFF';
        } else { preview.style.display = 'none'; }
    }

    ap.addEventListener('input', calcDiscount);
    dp.addEventListener('input', calcDiscount);
    planSelector.addEventListener('change', updateSymbols);

    // Initial check
    updateSymbols();
</script>
@endpush

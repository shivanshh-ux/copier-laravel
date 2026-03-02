@extends('admin.layouts.app')
@section('title', 'Edit Plan')
@section('page-title', 'Edit Plan')

@push('styles')
<style>
    /* CKEditor Dark Theme Overrides */
    .ck-editor__notifier, .ck-editor__notifier__item { background: var(--navy-2) !important; color: var(--text) !important; border-color: var(--border) !important; }
    .ck-reset_all :not(.ck-reset_all-excluded) { color: var(--text) !important; }
    .ck.ck-editor__main>.ck-editor__editable { background: rgba(255,255,255,.03) !important; border-color: var(--border) !important; color: var(--text) !important; min-height: 200px; }
    .ck.ck-editor__main>.ck-editor__editable.ck-focused { border-color: var(--gold) !important; box-shadow: 0 0 0 3px var(--gold-glow) !important; }
    .ck.ck-toolbar { background: var(--navy-3) !important; border-color: var(--border) !important; }
    .ck.ck-button { color: var(--text) !important; cursor: pointer; }
    .ck.ck-button:hover { background: var(--navy-4) !important; }
    .ck.ck-button.ck-on { background: var(--navy-2) !important; color: var(--gold) !important; }
    .ck.ck-toolbar__separator { background: var(--border) !important; }
    .ck.ck-dropdown__panel { background: var(--navy-2) !important; border-color: var(--border) !important; }

    /* Emoji Picker Styles */
    .emoji-section { margin-bottom: 20px; background: rgba(255,255,255,.03); border: 1px solid var(--border); border-radius: 12px; padding: 16px; }
    .emoji-section-title { font-size: .75rem; font-weight: 700; color: var(--gold); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px; display: flex; align-items: center; gap: 8px; }
    .emoji-grid { display: flex; flex-wrap: wrap; gap: 8px; }
    .emoji-btn { 
        width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; 
        background: rgba(255,255,255,.05); border: 1px solid var(--border); border-radius: 8px; 
        cursor: pointer; font-size: 1.2rem; transition: all .2s;
    }
    .emoji-btn:hover { background: var(--gold-glow); border-color: var(--gold); transform: scale(1.1); }
</style>
@endpush

@section('content')
<div class="page-header">
    <div>
        <h1>Edit Plan</h1>
        <div class="breadcrumb">Admin / <a href="{{ route('admin.plans.index') }}" style="color:var(--text-muted);text-decoration:none">Plans</a> / <span>{{ $plan->name }}</span></div>
    </div>
    <a href="{{ route('admin.plans.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back</a>
</div>

<div style="max-width:800px"> {{-- Widened for CKEditor --}}
    <div class="card">
        <div class="card-header"><div class="card-title"><i class="fas fa-layer-group" style="margin-right:8px;color:var(--gold)"></i>Edit: {{ $plan->name }}</div></div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.plans.update', $plan) }}">
                @csrf @method('PUT')

                <div class="form-group">
                    <label class="form-label">Plan Name *</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $plan->name) }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>

                    {{-- Emoji Picker Section --}}
                    <div class="emoji-section">
                        <div class="emoji-section-title"><i class="far fa-smile"></i> Quick Emojis</div>
                        <div class="emoji-grid">
                            @php
                                $emojis = ['✨', '🚀', '⭐', '✅', '🔥', '💎', '🎁', '💡', '⚡', '📊', '🛡️', '🌍', '📱', '💻', '💰', '🎯', '📢', '🤝', '🕒', '♾️'];
                            @endphp
                            @foreach($emojis as $emoji)
                                <button type="button" class="emoji-btn" onclick="insertEmoji('{{ $emoji }}')">{{ $emoji }}</button>
                            @endforeach
                        </div>
                    </div>

                    <textarea name="description" id="description" class="form-control">{{ old('description', $plan->description) }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Choose Currency Type *</label>
                    <select name="currency" class="form-control" id="currencySelector" required>
                        <option value="INR" {{ old('currency', $plan->currency) == 'INR' ? 'selected' : '' }}>Indian Rupee (₹)</option>
                        <option value="USD" {{ old('currency', $plan->currency) == 'USD' ? 'selected' : '' }}>US Dollar ($)</option>
                        <option value="EUR" {{ old('currency', $plan->currency) == 'EUR' ? 'selected' : '' }}>Euro (€)</option>
                        <option value="GBP" {{ old('currency', $plan->currency) == 'GBP' ? 'selected' : '' }}>British Pound (£)</option>
                    </select>
                    @error('currency')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Actual Price (<span class="currency-symbol">₹</span>) *</label>
                        <input type="number" name="actual_price" class="form-control" step="0.01" min="0" value="{{ old('actual_price', $plan->actual_price) }}" required id="actualPrice">
                        <div style="font-size:.72rem;color:var(--text-muted);margin-top:4px">Original / MRP price</div>
                        @error('actual_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Discounted Price (<span class="currency-symbol">₹</span>)</label>
                        <input type="number" name="discounted_price" class="form-control" step="0.01" min="0" placeholder="Leave blank if none" value="{{ old('discounted_price', $plan->discounted_price) }}" id="discountPrice">
                        <div style="font-size:.72rem;color:var(--text-muted);margin-top:4px">Price after discount (optional)</div>
                        @error('discounted_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div id="discountPreview" style="{{ ($plan->discounted_price && $plan->actual_price > 0) ? '' : 'display:none;' }}background:rgba(16,185,129,.08);border:1px solid rgba(16,185,129,.25);border-radius:10px;padding:12px 16px;margin-bottom:20px;font-size:.85rem">
                    <span class="text-muted">Savings: </span>
                    <span id="savingsAmt" class="text-success fw-600"></span>
                    &nbsp;&nbsp;
                    <span class="text-muted">Discount: </span>
                    <span id="discountPct" class="badge badge-success">{{ $plan->discount_percent }}% OFF</span>
                </div>

                <div class="form-group">
                    <label class="form-label">Duration (Days) *</label>
                    <input type="number" name="duration_days" class="form-control" min="1" value="{{ old('duration_days', $plan->duration_days) }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="is_active" class="form-control">
                        <option value="1" {{ old('is_active', $plan->is_active ? '1' : '0') == '1' ? 'selected' : '' }}>✅ Active</option>
                        <option value="0" {{ old('is_active', $plan->is_active ? '1' : '0') == '0' ? 'selected' : '' }}>🚫 Inactive</option>
                    </select>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-gold"><i class="fas fa-save"></i> Update Plan</button>
                    <a href="{{ route('admin.plans.index') }}" class="btn btn-outline">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<script>
    let editorInstance;

    // Initialize CKEditor
    ClassicEditor
        .create(document.querySelector('#description'), {
            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo'],
        })
        .then(editor => {
            editorInstance = editor;
        })
        .catch(error => {
            console.error(error);
        });

    // Function to insert emoji into CKEditor
    function insertEmoji(emoji) {
        if (editorInstance) {
            editorInstance.model.change(writer => {
                const insertPosition = editorInstance.model.document.selection.getFirstPosition();
                writer.insertText(emoji, insertPosition);
            });
            editorInstance.editing.view.focus();
        }
    }

    const ap = document.getElementById('actualPrice');
    const dp = document.getElementById('discountPrice');
    const preview = document.getElementById('discountPreview');
    const currencySelector = document.getElementById('currencySelector');
    const currencySymbols = document.querySelectorAll('.currency-symbol');

    const symbols = {
        'INR': '₹',
        'USD': '$',
        'EUR': '€',
        'GBP': '£'
    };

    function updateSymbols() {
        const selected = currencySelector.value;
        const symbol = symbols[selected] || '₹';
        currencySymbols.forEach(el => el.textContent = symbol);
        calcDiscount();
    }

    function calcDiscount() {
        const a = parseFloat(ap.value), d = parseFloat(dp.value);
        const symbol = symbols[currencySelector.value] || '₹';
        if (a > 0 && d > 0 && d < a) {
            preview.style.display = 'block';
            document.getElementById('savingsAmt').textContent = symbol + (a-d).toFixed(2);
            document.getElementById('discountPct').textContent = Math.round(((a-d)/a)*100) + '% OFF';
        } else { preview.style.display = 'none'; }
    }

    ap.addEventListener('input', calcDiscount);
    dp.addEventListener('input', calcDiscount);
    currencySelector.addEventListener('change', updateSymbols);

    // Initialize symbols
    updateSymbols();
</script>
@endpush

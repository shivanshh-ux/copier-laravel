@extends('admin.layouts.app')
@section('title', 'Offers')
@section('page-title', 'Special Offers')

@section('content')
<div class="page-header">
    <div>
        <h1>Offers</h1>
        <div class="breadcrumb">Admin / <span>Offers</span></div>
    </div>
    <div style="display:flex;gap:12px;align-items:center">
        <button id="bulkDeleteBtn" class="btn btn-danger" style="display:none"><i class="fas fa-trash-alt"></i> Delete Selected (<span id="selectedCount">0</span>)</button>
        <a href="{{ route('admin.offers.create') }}" class="btn btn-gold"><i class="fas fa-plus"></i> New Offer</a>
    </div>
</div>

@if($offers->isEmpty())
    <div class="card"><div class="empty-state"><i class="fas fa-tags"></i><p>No special offers yet. <a href="{{ route('admin.offers.create') }}" class="text-gold">Create the first offer</a></p></div></div>
@else
<div class="grid-3">
    @foreach($offers as $offer)
    <div class="card" style="position:relative">
        <div style="position:absolute;top:14px;left:14px;z-index:2">
            <input type="checkbox" class="row-checkbox" value="{{ $offer->id }}" style="width:18px;height:18px;cursor:pointer">
        </div>
        <div style="position:absolute;top:14px;right:14px">
            <span class="badge {{ $offer->is_active ? 'badge-success' : 'badge-danger' }}">
                {{ $offer->is_active ? 'Active' : 'Inactive' }}
            </span>
        </div>
        <div class="card-body" style="padding-top:40px">
            <div style="font-size:1.1rem;font-weight:700;margin-bottom:8px">{{ $offer->title }}</div>
            <div class="text-muted" style="font-size:.82rem;margin-bottom:16px;line-height:1.5">{{ Str::limit($offer->description, 80) }}</div>

            <div style="margin-bottom:12px">
                @php
                    $symbols = ['INR' => '₹', 'USD' => '$', 'EUR' => '€', 'GBP' => '£'];
                    $symbol = ($offer->plan && isset($symbols[$offer->plan->currency])) ? $symbols[$offer->plan->currency] : '₹';
                @endphp
                <div style="display:flex;align-items:baseline;gap:8px">
                    <span style="font-size:1.6rem;font-weight:800;color:var(--gold)">{{ $symbol }}{{ number_format($offer->discounted_price, 2) }}</span>
                    <del class="text-muted">{{ $symbol }}{{ number_format($offer->actual_price, 2) }}</del>
                    <span class="badge badge-success">{{ $offer->discount_percent }}% OFF</span>
                </div>
                @if($offer->valid_until)
                    <div class="text-muted" style="font-size:.78rem;margin-top:4px">
                        <i class="fas fa-clock"></i> Valid until: {{ $offer->valid_until->format('d M Y') }}
                    </div>
                @endif
                @if($offer->plan)
                    <div class="text-muted" style="font-size:.78rem;margin-top:4px">
                        <i class="fas fa-layer-group"></i> Linked Plan: {{ $offer->plan->name }}
                    </div>
                @endif
            </div>

            <div class="card-actions" style="display:flex;gap:8px">
                <a href="{{ route('admin.offers.edit', $offer) }}" class="btn btn-gold btn-sm" style="flex:1;justify-content:center"><i class="fas fa-edit"></i> Edit</a>
                <form method="POST" action="{{ route('admin.offers.destroy', $offer) }}">
                    @csrf @method('DELETE')
                    <button type="button" class="btn btn-danger btn-sm confirm-delete" data-confirm="You are about to delete the offer: {{ $offer->title }}"><i class="fas fa-trash"></i></button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.row-checkbox');
    const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
    const selectedCount = document.getElementById('selectedCount');

    function updateBulkButton() {
        const checked = document.querySelectorAll('.row-checkbox:checked');
        bulkDeleteBtn.style.display = checked.length > 0 ? 'inline-flex' : 'none';
        selectedCount.textContent = checked.length;
    }

    checkboxes.forEach(cb => cb.addEventListener('change', updateBulkButton));

    bulkDeleteBtn.addEventListener('click', function() {
        const checked = document.querySelectorAll('.row-checkbox:checked');
        const ids = Array.from(checked).map(cb => cb.value);

        Swal.fire({
            title: 'Are you sure?',
            text: `You are about to delete ${ids.length} offers. This action cannot be undone!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: 'rgba(255,255,255,0.1)',
            confirmButtonText: 'Yes, delete them!',
            background: '#0d1526',
            color: '#e2e8f0'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch("{{ route('admin.offers.bulk-delete') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ ids: ids })
                }).then(res => res.json()).then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        Toast.fire({ icon: 'error', title: 'Something went wrong!' });
                    }
                });
            }
        });
    });
});
</script>
@endpush

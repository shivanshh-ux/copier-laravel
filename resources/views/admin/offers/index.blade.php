@extends('admin.layouts.app')
@section('title', 'Offers')
@section('page-title', 'Special Offers')

@section('content')
<div class="page-header">
    <div>
        <h1>Offers</h1>
        <div class="breadcrumb">Admin / <span>Offers</span></div>
    </div>
    <a href="{{ route('admin.offers.create') }}" class="btn btn-gold"><i class="fas fa-plus"></i> New Offer</a>
</div>

@if($offers->isEmpty())
    <div class="card"><div class="empty-state"><i class="fas fa-tags"></i><p>No special offers yet. <a href="{{ route('admin.offers.create') }}" class="text-gold">Create the first offer</a></p></div></div>
@else
<div class="grid-3">
    @foreach($offers as $offer)
    <div class="card" style="position:relative">
        <div style="position:absolute;top:14px;right:14px">
            <span class="badge {{ $offer->is_active ? 'badge-success' : 'badge-danger' }}">
                {{ $offer->is_active ? 'Active' : 'Inactive' }}
            </span>
        </div>
        <div class="card-body">
            <div style="font-size:1.1rem;font-weight:700;margin-bottom:8px">{{ $offer->title }}</div>
            <div class="text-muted" style="font-size:.82rem;margin-bottom:16px;line-height:1.5">{{ Str::limit($offer->description, 80) }}</div>

            <div style="margin-bottom:12px">
                <div style="display:flex;align-items:baseline;gap:8px">
                    <span style="font-size:1.6rem;font-weight:800;color:var(--gold)">₹{{ number_format($offer->discounted_price, 2) }}</span>
                    <del class="text-muted">₹{{ number_format($offer->actual_price, 2) }}</del>
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

            <div style="display:flex;gap:8px;margin-top:14px">
                <a href="{{ route('admin.offers.edit', $offer) }}" class="btn btn-gold btn-sm" style="flex:1;justify-content:center"><i class="fas fa-edit"></i> Edit</a>
                <form method="POST" action="{{ route('admin.offers.destroy', $offer) }}" onsubmit="return confirm('Delete this offer?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif
@endsection

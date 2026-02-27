@extends('admin.layouts.app')
@section('title', 'Plans')
@section('page-title', 'Plans')

@section('content')
<div class="page-header">
    <div>
        <h1>Plans</h1>
        <div class="breadcrumb">Admin / <span>Plans</span></div>
    </div>
    <a href="{{ route('admin.plans.create') }}" class="btn btn-gold"><i class="fas fa-plus"></i> New Plan</a>
</div>

@if($plans->isEmpty())
    <div class="card"><div class="empty-state"><i class="fas fa-layer-group"></i><p>No plans yet. <a href="{{ route('admin.plans.create') }}" class="text-gold">Create the first plan</a></p></div></div>
@else
<div class="grid-3">
    @foreach($plans as $plan)
    <div class="card" style="position:relative">
        @if(!$plan->is_active)
            <div style="position:absolute;top:14px;right:14px"><span class="badge badge-danger">Inactive</span></div>
        @else
            <div style="position:absolute;top:14px;right:14px"><span class="badge badge-success">Active</span></div>
        @endif
        <div class="card-body">
            <div style="font-size:1.1rem;font-weight:700;margin-bottom:8px">{{ $plan->name }}</div>
            <div class="text-muted" style="font-size:.82rem;margin-bottom:16px;line-height:1.5">{{ Str::limit($plan->description, 80) }}</div>

            <div style="margin-bottom:12px">
                @if($plan->discounted_price)
                    <div style="display:flex;align-items:baseline;gap:8px">
                        <span style="font-size:1.6rem;font-weight:800;color:var(--gold)">₹{{ number_format($plan->discounted_price,2) }}</span>
                        <del class="text-muted">₹{{ number_format($plan->actual_price,2) }}</del>
                        <span class="badge badge-success">{{ $plan->discount_percent }}% OFF</span>
                    </div>
                @else
                    <span style="font-size:1.6rem;font-weight:800;color:var(--gold)">₹{{ number_format($plan->actual_price,2) }}</span>
                @endif
                <div class="text-muted" style="font-size:.78rem;margin-top:4px"><i class="fas fa-calendar-alt"></i> {{ $plan->duration_days }} days</div>
            </div>

            <div style="display:flex;gap:8px;padding-top:4px;border-top:1px solid var(--border);margin-top:12px">
                <span class="text-muted" style="font-size:.78rem"><i class="fas fa-users"></i> {{ $plan->customers_count }} customers</span>
                <span class="text-muted" style="font-size:.78rem;margin-left:auto"><i class="fas fa-shopping-bag"></i> {{ $plan->orders_count }} orders</span>
            </div>

            <div style="display:flex;gap:8px;margin-top:14px">
                <a href="{{ route('admin.plans.edit', $plan) }}" class="btn btn-gold btn-sm" style="flex:1;justify-content:center"><i class="fas fa-edit"></i> Edit</a>
                <form method="POST" action="{{ route('admin.plans.destroy', $plan) }}" onsubmit="return confirm('Delete this plan?')">
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

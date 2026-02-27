@extends('admin.layouts.app')
@section('title', 'Reviews')
@section('page-title', 'Reviews')

@section('content')
<div class="page-header">
    <div>
        <h1>Reviews</h1>
        <div class="breadcrumb">Admin / <span>Reviews</span></div>
    </div>
    <div style="display:flex;gap:12px;align-items:center">
        <button id="bulkDeleteBtn" class="btn btn-danger" style="display:none"><i class="fas fa-trash-alt"></i> Delete Selected (<span id="selectedCount">0</span>)</button>
        <a href="{{ route('admin.reviews.create') }}" class="btn btn-gold"><i class="fas fa-plus"></i> New Review</a>
    </div>
</div>

@if($reviews->isEmpty())
    <div class="card"><div class="empty-state"><i class="fas fa-comment-dots"></i><p>No reviews yet. <a href="{{ route('admin.reviews.create') }}" class="text-gold">Create the first review</a></p></div></div>
@else
<div class="grid-3">
    @foreach($reviews as $review)
    <div class="card" style="position:relative">
        <div style="position:absolute;top:14px;left:14px;z-index:2">
            <input type="checkbox" class="row-checkbox" value="{{ $review->id }}" style="width:18px;height:18px;cursor:pointer">
        </div>
        <div style="position:absolute;top:14px;right:14px">
            @if($review->is_active)
                <span class="badge badge-success">Active</span>
            @else
                <span class="badge badge-danger">Inactive</span>
            @endif
        </div>
        <div class="card-body" style="padding-top:40px">
            <div style="display:flex;align-items:center;gap:12px;margin-bottom:16px">
                <div style="width:48px;height:48px;border-radius:50%;overflow:hidden;background:var(--navy-3);border:1px solid var(--border)">
                    @if($review->avatar)
                        <img src="{{ asset($review->avatar) }}" style="width:100%;height:100%;object-fit:cover">
                    @else
                        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:var(--gold);font-weight:bold">
                            {{ substr($review->name, 0, 1) }}
                        </div>
                    @endif
                </div>
                <div>
                    <div style="font-weight:700;color:var(--text)">{{ $review->name }}</div>
                    <div class="text-muted" style="font-size:0.75rem">{{ $review->role }}</div>
                </div>
            </div>
            
            <div style="color:var(--gold);margin-bottom:8px">
                @for($i = 0; $i < 5; $i++)
                    <i class="{{ $i < $review->rating ? 'fas' : 'far' }} fa-star" style="font-size:0.8rem"></i>
                @endfor
            </div>

            <div class="text-muted" style="font-size:0.82rem;margin-bottom:16px;line-height:1.5">
                "{{ Str::limit($review->content, 120) }}"
            </div>

            <div class="card-actions" style="display:flex;gap:8px">
                <a href="{{ route('admin.reviews.edit', $review) }}" class="btn btn-gold btn-sm" style="flex:1;justify-content:center"><i class="fas fa-edit"></i> Edit</a>
                <form method="POST" action="{{ route('admin.reviews.destroy', $review) }}">
                    @csrf @method('DELETE')
                    <button type="button" class="btn btn-danger btn-sm confirm-delete" data-confirm="You are about to delete the review from: {{ $review->name }}"><i class="fas fa-trash"></i></button>
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
            text: `You are about to delete ${ids.length} reviews. This action cannot be undone!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: 'rgba(255,255,255,0.1)',
            confirmButtonText: 'Yes, delete them!',
            background: '#0d1526',
            color: '#e2e8f0'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch("{{ route('admin.reviews.bulk-delete') }}", {
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

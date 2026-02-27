@extends('admin.layouts.app')
@section('title', 'Media Library')
@section('page-title', 'Media Library')

@section('content')
<div class="page-header">
    <div>
        <h1>Video & PDF</h1>
        <div class="breadcrumb">Admin / <span>Media Library</span></div>
    </div>
    <div style="display:flex;gap:12px;align-items:center">
        <button id="bulkDeleteBtn" class="btn btn-danger" style="display:none"><i class="fas fa-trash-alt"></i> Delete Selected (<span id="selectedCount">0</span>)</button>
        <a href="{{ route('admin.media.create') }}" class="btn btn-gold"><i class="fas fa-upload"></i> Upload Media</a>
    </div>
</div>

@if($media->isEmpty())
    <div class="card"><div class="empty-state"><i class="fas fa-photo-film"></i><p>No media files uploaded yet. <a href="{{ route('admin.media.create') }}" class="text-gold">Upload your first file</a></p></div></div>
@else
<div class="grid-4">
    @foreach($media as $item)
    <div class="card" style="position:relative">
        <div style="position:absolute;top:14px;left:14px;z-index:2">
            <input type="checkbox" class="row-checkbox" value="{{ $item->id }}" style="width:18px;height:18px;cursor:pointer">
        </div>
        <div style="height:120px;display:flex;align-items:center;justify-content:center;background:rgba(255,255,255,.03);border-bottom:1px solid var(--border)">
            @if($item->type === 'video')
                <i class="fas fa-file-video" style="font-size:3rem;color:var(--gold);opacity:.6"></i>
            @else
                <i class="fas fa-file-pdf" style="font-size:3rem;color:#ef4444;opacity:.6"></i>
            @endif
        </div>
        <div class="card-body" style="padding:16px">
            <div style="font-weight:600;font-size:.9rem;margin-bottom:4px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis" title="{{ $item->title }}">{{ $item->title }}</div>
            <div class="text-muted" style="font-size:.72rem;margin-bottom:12px">
                <span class="badge {{ $item->type === 'video' ? 'badge-info' : 'badge-danger' }}" style="padding:2px 6px;font-size:.65rem">{{ strtoupper($item->type) }}</span>
                • {{ $item->created_at->format('d M Y') }}
            </div>
            
            <div class="card-actions" style="display:flex;gap:8px">
                <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank" class="btn btn-outline btn-sm" style="flex:1;justify-content:center"><i class="fas fa-external-link-alt"></i> View</a>
                <form method="POST" action="{{ route('admin.media.destroy', $item) }}">
                    @csrf @method('DELETE')
                    <button type="button" class="btn btn-danger btn-sm confirm-delete" data-confirm="You are about to delete this file permanently: {{ $item->title }}"><i class="fas fa-trash"></i></button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="pagination-wrap">
    {{ $media->links() }}
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
            text: `You are about to delete ${ids.length} media files permanently. This action cannot be undone!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: 'rgba(255,255,255,0.1)',
            confirmButtonText: 'Yes, delete them!',
            background: '#0d1526',
            color: '#e2e8f0'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch("{{ route('admin.media.bulk-delete') }}", {
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

@extends('admin.layouts.app')
@section('title', 'Media Library')
@section('page-title', 'Media Library')

@section('content')
<div class="page-header">
    <div>
        <h1>Video & PDF</h1>
        <div class="breadcrumb">Admin / <span>Media Library</span></div>
    </div>
    <a href="{{ route('admin.media.create') }}" class="btn btn-gold"><i class="fas fa-upload"></i> Upload Media</a>
</div>

@if($media->isEmpty())
    <div class="card"><div class="empty-state"><i class="fas fa-photo-film"></i><p>No media files uploaded yet. <a href="{{ route('admin.media.create') }}" class="text-gold">Upload your first file</a></p></div></div>
@else
<div class="grid-4">
    @foreach($media as $item)
    <div class="card">
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
            
            <div style="display:flex;gap:8px">
                <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank" class="btn btn-outline btn-sm" style="flex:1;justify-content:center"><i class="fas fa-external-link-alt"></i> View</a>
                <form method="POST" action="{{ route('admin.media.destroy', $item) }}" onsubmit="return confirm('Delete this file permanently?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
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

@extends('admin.layouts.app')
@section('title', 'Upload Media')
@section('page-title', 'Upload Video or PDF')

@section('content')
<div class="page-header">
    <div>
        <h1>Upload Media</h1>
        <div class="breadcrumb">Admin / <a href="{{ route('admin.media.index') }}" style="color:var(--text-muted);text-decoration:none">Media Library</a> / <span>Upload</span></div>
    </div>
    <a href="{{ route('admin.media.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Back</a>
</div>

<div style="max-width:600px">
    <div class="card">
        <div class="card-header"><div class="card-title"><i class="fas fa-cloud-upload-alt" style="margin-right:8px;color:var(--gold)"></i>File Upload</div></div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.media.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label class="form-label">Title *</label>
                    <input type="text" name="title" class="form-control" placeholder="e.g. Software Tutorial Video" value="{{ old('title') }}" required>
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" placeholder="Optional description...">{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Media Type *</label>
                    <select name="type" class="form-control" required>
                        <option value="video" {{ old('type') == 'video' ? 'selected' : '' }}>🎬 Video File</option>
                        <option value="pdf"   {{ old('type') == 'pdf'   ? 'selected' : '' }}>📄 PDF Document</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Choose File *</label>
                    <div style="position:relative;background:rgba(255,255,255,.03);border:2px dashed var(--border);border-radius:12px;padding:30px;text-align:center;transition:border-color .2s" id="dropZone">
                        <i class="fas fa-file-upload" style="font-size:2rem;color:var(--text-muted);margin-bottom:12px;display:block"></i>
                        <span class="text-muted" style="font-size:.85rem" id="fileName">Drag and drop or click to browse</span>
                        <input type="file" name="file" id="fileInput" style="position:absolute;inset:0;opacity:0;cursor:pointer" required>
                    </div>
                    <div class="text-muted" style="font-size:.7rem;margin-top:8px">Maximum file size: 100MB</div>
                    @error('file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-actions" style="margin-top:10px">
                    <button type="submit" class="btn btn-gold"><i class="fas fa-cloud-upload-alt"></i> Start Upload</button>
                    <a href="{{ route('admin.media.index') }}" class="btn btn-outline">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const input = document.getElementById('fileInput');
    const label = document.getElementById('fileName');
    const zone = document.getElementById('dropZone');

    input.addEventListener('change', () => {
        if(input.files.length > 0) {
            label.textContent = input.files[0].name;
            label.classList.remove('text-muted');
            label.classList.add('text-gold');
            zone.style.borderColor = 'var(--gold)';
        }
    });

    zone.addEventListener('dragover', (e) => { e.preventDefault(); zone.style.borderColor = 'var(--gold)'; });
    zone.addEventListener('dragleave', () => { zone.style.borderColor = 'var(--border)'; });
</script>
@endpush

@extends('admin.layouts.app')
@section('title', 'Edit Review')
@section('page-title', 'Edit Review')

@section('content')
<div class="page-header">
    <div>
        <h1>Edit Review</h1>
        <div class="breadcrumb">Admin / Reviews / <span>Edit</span></div>
    </div>
    <a href="{{ route('admin.reviews.index') }}" class="btn btn-navy"><i class="fas fa-arrow-left"></i> Back to Reviews</a>
</div>

<div class="card">
    <form action="{{ route('admin.reviews.update', $review) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid-2">
            <div class="form-group">
                <label>Reviewer Name</label>
                <input type="text" name="name" class="form-control" value="{{ $review->name }}" required placeholder="John Doe">
            </div>
            <div class="form-group">
                <label>Role / Designation</label>
                <input type="text" name="role" class="form-control" value="{{ $review->role }}" placeholder="Professional Trader">
            </div>
        </div>

        <div class="grid-2">
            <div class="form-group">
                <label>Rating (1-5)</label>
                <select name="rating" class="form-control" required>
                    @for($i=5; $i>=1; $i--)
                        <option value="{{ $i }}" {{ $review->rating == $i ? 'selected' : '' }}>{{ $i }} Stars</option>
                    @endfor
                </select>
            </div>
            <div class="form-group">
                <label>Avatar (Optional)</label>
                <input type="file" name="avatar" class="form-control">
                @if($review->avatar)
                    <div style="margin-top:8px">
                        <img src="{{ asset($review->avatar) }}" style="width:50px;height:50px;border-radius:50%;object-fit:cover">
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label>Review Content</label>
            <textarea name="content" class="form-control" rows="5" required placeholder="Write the review content here...">{{ $review->content }}</textarea>
        </div>

        <div class="form-group">
            <label class="switch-label">
                <input type="checkbox" name="is_active" {{ $review->is_active ? 'checked' : '' }} value="1">
                <span class="switch-text">Review is Visible on Website</span>
            </label>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-gold btn-lg"><i class="fas fa-save"></i> Update Review</button>
        </div>
    </form>
</div>
@endsection

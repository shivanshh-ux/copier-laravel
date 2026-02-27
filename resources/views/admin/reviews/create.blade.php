@extends('admin.layouts.app')
@section('title', 'New Review')
@section('page-title', 'New Review')

@section('content')
<div class="page-header">
    <div>
        <h1>New Review</h1>
        <div class="breadcrumb">Admin / Reviews / <span>New</span></div>
    </div>
    <a href="{{ route('admin.reviews.index') }}" class="btn btn-navy"><i class="fas fa-arrow-left"></i> Back to Reviews</a>
</div>

<div class="card">
    <form action="{{ route('admin.reviews.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid-2">
            <div class="form-group">
                <label>Reviewer Name</label>
                <input type="text" name="name" class="form-control" required placeholder="John Doe">
            </div>
            <div class="form-group">
                <label>Role / Designation</label>
                <input type="text" name="role" class="form-control" placeholder="Professional Trader">
            </div>
        </div>

        <div class="grid-2">
            <div class="form-group">
                <label>Rating (1-5)</label>
                <select name="rating" class="form-control" required>
                    <option value="5">5 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="2">2 Stars</option>
                    <option value="1">1 Star</option>
                </select>
            </div>
            <div class="form-group">
                <label>Avatar (Optional)</label>
                <input type="file" name="avatar" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label>Review Content</label>
            <textarea name="content" class="form-control" rows="5" required placeholder="Write the review content here..."></textarea>
        </div>

        <div class="form-group">
            <label class="switch-label">
                <input type="checkbox" name="is_active" checked value="1">
                <span class="switch-text">Review is Visible on Website</span>
            </label>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-gold btn-lg"><i class="fas fa-save"></i> Save Review</button>
        </div>
    </form>
</div>
@endsection

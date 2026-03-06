@extends('admin.layouts.app')

@section('title', "Message Detail")
@section('page-title', "Message Detail")

@section('content')
<div class="page-header">
    <div>
        <a href="{{ route('admin.help-messages.index') }}" class="btn btn-outline btn-sm mb-4">
            <i class="fas fa-arrow-left"></i> Back to Messages
        </a>
    </div>
</div>

<div class="grid-3">
    <div class="card" style="grid-column: span 2;">
        <div class="card-header">
            <h3 class="card-title">Message Content</h3>
        </div>
        <div class="card-body">
            <div class="mb-4">
                <label class="form-label">Subject</label>
                <div class="p-3 rounded-lg bg-white/5 border border-white/10 fw-600">
                    {{ $help_message->subject }}
                </div>
            </div>
            <div>
                <label class="form-label">Message</label>
                <div class="p-4 rounded-lg bg-white/5 border border-white/10 leading-relaxed">
                    {!! nl2br(e($help_message->message)) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Sender Information</h3>
        </div>
        <div class="card-body">
            <div class="mb-4">
                <label class="form-label text-xs opacity-50">Full Name</label>
                <div class="fw-600">{{ $help_message->name }}</div>
            </div>
            <div class="mb-4">
                <label class="form-label text-xs opacity-50">Email Address</label>
                <div class="text-gold">{{ $help_message->email }}</div>
            </div>
            <div class="mb-4">
                <label class="form-label text-xs opacity-50">Received Date</label>
                <div>{{ $help_message->created_at->format('d F, Y') }}</div>
                <div class="text-xs text-muted">{{ $help_message->created_at->format('h:i A') }}</div>
            </div>
            <div>
                <label class="form-label text-xs opacity-50">Status</label>
                <form action="{{ route('admin.help-messages.updateStatus', $help_message->id) }}" method="POST" class="mt-1">
                    @csrf
                    @method('PATCH')
                    <select name="status" class="form-control text-xs" onchange="this.form.submit()" style="padding: 4px 8px; height: auto;">
                        <option value="pending" {{ $help_message->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="replied" {{ $help_message->status == 'replied' ? 'selected' : '' }}>Replied</option>
                        <option value="closed" {{ $help_message->status == 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                </form>
                <div class="mt-2">
                    @if($help_message->status == 'pending')
                        <span class="badge badge-warning">Pending</span>
                    @elseif($help_message->status == 'replied')
                        <span class="badge badge-success">Replied</span>
                    @else
                        <span class="badge badge-muted">Closed</span>
                    @endif
                </div>
            </div>
            
            <hr class="my-4 border-white/10">
            
            <div class="flex flex-col gap-2">
                <a href="mailto:{{ $help_message->email }}" class="btn btn-gold w-full">
                    <i class="fas fa-reply"></i> Reply via Email
                </a>
                <form action="{{ route('admin.help-messages.destroy', $help_message->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger w-full confirm-delete">
                        <i class="fas fa-trash"></i> Delete Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

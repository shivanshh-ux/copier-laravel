@extends('admin.layouts.app')

@section('title', "Customer's Messages")
@section('page-title', "Customer's Messages")

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">All Messages</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.help-messages.index') }}" method="GET" class="search-bar">
            <div class="search-input-wrap">
                <i class="fas fa-search"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or email..." class="form-control">
            </div>
            
            <div style="width: 150px;">
                <select name="status" class="form-control" onchange="this.form.submit()">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="replied" {{ request('status') == 'replied' ? 'selected' : '' }}>Replied</option>
                    <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                </select>
            </div>

            <div style="width: 200px;">
                <select name="subject" class="form-control" onchange="this.form.submit()">
                    <option value="">All Subjects</option>
                    <option value="General Inquiry" {{ request('subject') == 'General Inquiry' ? 'selected' : '' }}>General Inquiry</option>
                    <option value="Technical Support" {{ request('subject') == 'Technical Support' ? 'selected' : '' }}>Technical Support</option>
                    <option value="Billing & Subscriptions" {{ request('subject') == 'Billing & Subscriptions' ? 'selected' : '' }}>Billing & Subscriptions</option>
                    <option value="MetaTrader Setup" {{ request('subject') == 'MetaTrader Setup' ? 'selected' : '' }}>MetaTrader Setup</option>
                    <option value="Strategy Questions" {{ request('subject') == 'Strategy Questions' ? 'selected' : '' }}>Strategy Questions</option>
                    <option value="Partnership" {{ request('subject') == 'Partnership' ? 'selected' : '' }}>Partnership</option>
                </select>
            </div>

            <a href="{{ route('admin.help-messages.index') }}" class="btn btn-outline">
                <i class="fas fa-undo"></i>
            </a>
        </form>
    </div>
    <div class="card-body p-0">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messages as $msg)
                        <tr>
                            <td>{{ $msg->created_at->format('d M, Y h:i A') }}</td>
                            <td class="fw-600">{{ $msg->name }}</td>
                            <td>{{ $msg->email }}</td>
                            <td>{{ $msg->subject }}</td>
                            <td>
                                @if($msg->status == 'pending')
                                    <span class="badge badge-warning">Pending</span>
                                @elseif($msg->status == 'replied')
                                    <span class="badge badge-success">Replied</span>
                                @else
                                    <span class="badge badge-muted">Closed</span>
                                @endif
                            </td>
                            <td>
                                <div style="display: flex; gap: 8px;">
                                    <a href="{{ route('admin.help-messages.show', $msg->id) }}" class="btn btn-outline btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.help-messages.destroy', $msg->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm confirm-delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty-state">
                                <i class="fas fa-envelope-open"></i>
                                <p>No messages found.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($messages->hasPages())
        <div class="pagination-wrap">
            {{ $messages->links() }}
        </div>
    @endif
</div>
@endsection

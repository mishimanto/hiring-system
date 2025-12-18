@extends('layouts.admin')

@section('title', 'Message Details - ' . config('app.name'))

@section('page-title', 'Message Details')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.contact.index') }}">Contact Messages</a></li>
    <li class="breadcrumb-item active">Message Details</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Message Details</h6>
                <div>
                    {!! $message->status_badge !!}
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>From:</strong><br>
                        {{ $message->name }}<br>
                        <a href="mailto:{{ $message->email }}">{{ $message->email }}</a>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <strong>Date:</strong><br>
                        {{ $message->created_at->format('d M Y, h:i A') }}<br>
                        <small>({{ $message->created_at->diffForHumans() }})</small>
                    </div>
                </div>

                <div class="mb-3">
                    <strong>Subject:</strong><br>
                    <h5>{{ $message->subject }}</h5>
                </div>

                <div class="mb-4">
                    <strong>Message:</strong><br>
                    <div class="border p-3 rounded bg-light">
                        {!! nl2br(e($message->message)) !!}
                    </div>
                </div>

                <div class="mb-4">
                    <strong>Technical Info:</strong><br>
                    <small class="text-muted">
                        IP Address: {{ $message->ip_address ?? 'N/A' }}<br>
                        User Agent: {{ $message->user_agent ?? 'N/A' }}
                    </small>
                </div>
            </div>
        </div>

        <!-- Reply Section -->
        <div class="card mt-4" id="reply-section">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Reply to Message</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.contact.reply', $message) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">To:</label>
                        <input type="text" class="form-control" value="{{ $message->name }} <{{ $message->email }}>" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Reply Message:</label>
                        <textarea name="reply_message" class="form-control" rows="5" 
                                  placeholder="Type your reply here..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-paper-plane me-1"></i> Send Reply
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Update Status and Notes -->
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Update Status & Notes</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.contact.update', $message) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Status:</label>
                        <select name="status" class="form-control" required>
                            <option value="unread" {{ $message->status === 'unread' ? 'selected' : '' }}>Unread</option>
                            <option value="read" {{ $message->status === 'read' ? 'selected' : '' }}>Read</option>
                            <option value="replied" {{ $message->status === 'replied' ? 'selected' : '' }}>Replied</option>
                            <option value="spam" {{ $message->status === 'spam' ? 'selected' : '' }}>Spam</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Admin Notes:</label>
                        <textarea name="admin_notes" class="form-control" rows="4" 
                                  placeholder="Add any notes here...">{{ $message->admin_notes }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-save me-1"></i> Update
                    </button>
                </form>

                <hr class="my-4">

                <!-- Admin Notes Display -->
                @if($message->admin_notes)
                    <div class="mt-3">
                        <strong>Current Admin Notes:</strong>
                        <div class="border p-3 rounded bg-light mt-2">
                            {!! nl2br(e($message->admin_notes)) !!}
                        </div>
                    </div>
                @endif

                <!-- Delete Form -->
                <form action="{{ route('admin.contact.destroy', $message) }}" method="POST" 
                      class="mt-4" onsubmit="return confirm('Are you sure you want to delete this message?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger w-100">
                        <i class="fas fa-trash me-1"></i> Delete Message
                    </button>
                </form>
            </div>
        </div>

        <!-- Message Actions -->
        <div class="card mt-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
            </div>
            <div class="card-body">
                <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" 
                   class="btn btn-outline-primary w-100 mb-2" target="_blank">
                    <i class="fas fa-envelope me-1"></i> Compose Email
                </a>
                <a href="{{ route('admin.contact.index') }}" class="btn btn-outline-secondary w-100 mb-2">
                    <i class="fas fa-arrow-left me-1"></i> Back to List
                </a>
                @if($message->status !== 'replied')
                    <a href="#reply-section" class="btn btn-outline-success w-100 mb-2">
                        <i class="fas fa-reply me-1"></i> Reply to Message
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
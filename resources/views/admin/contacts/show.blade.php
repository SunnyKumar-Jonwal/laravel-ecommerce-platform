@extends('layouts.admin')

@section('title', 'Contact Details')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-0">Contact Details</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.contacts.index') }}">Contact Forms</a></li>
                            <li class="breadcrumb-item active">Contact #{{ $contact->id }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="btn-group">
                    <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                    <button type="button" class="btn btn-danger" onclick="deleteContact({{ $contact->id }})">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </div>
            </div>

            <div class="row">
                <!-- Contact Information -->
                <div class="col-md-8">
                    <div class="card shadow mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-envelope me-2"></i>Contact Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Name:</label>
                                    <p class="mb-0">{{ $contact->name }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Email:</label>
                                    <p class="mb-0">
                                        <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                                    </p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Phone:</label>
                                    <p class="mb-0">
                                        @if($contact->phone)
                                            <a href="tel:{{ $contact->phone }}">{{ $contact->phone }}</a>
                                        @else
                                            <span class="text-muted">Not provided</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Subject:</label>
                                    <p class="mb-0">{{ $contact->subject }}</p>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label fw-bold">Message:</label>
                                    <div class="p-3 bg-light rounded">
                                        {!! nl2br(e($contact->message)) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Submitted:</label>
                                    <p class="mb-0">{{ $contact->created_at->format('M d, Y h:i A') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Status:</label>
                                    <p class="mb-0">
                                        <span class="{{ $contact->status_badge }}">
                                            {{ ucfirst($contact->status) }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Admin Reply Section -->
                    <div class="card shadow">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0"><i class="fas fa-reply me-2"></i>Admin Reply</h5>
                        </div>
                        <div class="card-body">
                            @if($contact->admin_reply)
                                <div class="alert alert-success">
                                    <strong>Reply sent on {{ $contact->replied_at->format('M d, Y h:i A') }} 
                                    by {{ $contact->repliedBy->name ?? 'Admin' }}</strong>
                                    <hr>
                                    {!! nl2br(e($contact->admin_reply)) !!}
                                </div>
                            @endif

                            <form id="replyForm">
                                @csrf
                                <div class="mb-3">
                                    <label for="admin_reply" class="form-label fw-bold">
                                        {{ $contact->admin_reply ? 'Update Reply:' : 'Send Reply:' }}
                                    </label>
                                    <textarea class="form-control" id="admin_reply" name="admin_reply" rows="6" 
                                              placeholder="Type your reply here..." required>{{ $contact->admin_reply }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-paper-plane me-2"></i>
                                    {{ $contact->admin_reply ? 'Update Reply' : 'Send Reply' }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Status and Actions -->
                <div class="col-md-4">
                    <!-- Status Management -->
                    <div class="card shadow mb-4">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0"><i class="fas fa-cog me-2"></i>Status Management</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Current Status:</label>
                                <div>
                                    <span class="{{ $contact->status_badge }}">
                                        {{ ucfirst($contact->status) }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="status" class="form-label fw-bold">Change Status:</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="new" {{ $contact->status === 'new' ? 'selected' : '' }}>New</option>
                                    <option value="read" {{ $contact->status === 'read' ? 'selected' : '' }}>Read</option>
                                    <option value="replied" {{ $contact->status === 'replied' ? 'selected' : '' }}>Replied</option>
                                    <option value="resolved" {{ $contact->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                                </select>
                            </div>
                            
                            <button type="button" class="btn btn-primary w-100" onclick="updateStatus()">
                                <i class="fas fa-save me-2"></i>Update Status
                            </button>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="card shadow mb-4">
                        <div class="card-header bg-warning text-dark">
                            <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Quick Actions</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <button type="button" class="btn btn-outline-primary" onclick="sendEmail()">
                                    <i class="fas fa-envelope me-2"></i>Send Email
                                </button>
                                <button type="button" class="btn btn-outline-success" onclick="markResolved()">
                                    <i class="fas fa-check me-2"></i>Mark as Resolved
                                </button>
                                <button type="button" class="btn btn-outline-danger" onclick="deleteContact({{ $contact->id }})">
                                    <i class="fas fa-trash me-2"></i>Delete Contact
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Timeline -->
                    <div class="card shadow">
                        <div class="card-header bg-secondary text-white">
                            <h5 class="mb-0"><i class="fas fa-clock me-2"></i>Timeline</h5>
                        </div>
                        <div class="card-body">
                            <div class="timeline">
                                <div class="timeline-item">
                                    <div class="timeline-marker bg-primary"></div>
                                    <div class="timeline-content">
                                        <h6 class="mb-1">Contact Submitted</h6>
                                        <small class="text-muted">{{ $contact->created_at->format('M d, Y h:i A') }}</small>
                                    </div>
                                </div>
                                
                                @if($contact->status !== 'new')
                                    <div class="timeline-item">
                                        <div class="timeline-marker bg-warning"></div>
                                        <div class="timeline-content">
                                            <h6 class="mb-1">Status: {{ ucfirst($contact->status) }}</h6>
                                            <small class="text-muted">{{ $contact->updated_at->format('M d, Y h:i A') }}</small>
                                        </div>
                                    </div>
                                @endif
                                
                                @if($contact->replied_at)
                                    <div class="timeline-item">
                                        <div class="timeline-marker bg-success"></div>
                                        <div class="timeline-content">
                                            <h6 class="mb-1">Reply Sent</h6>
                                            <small class="text-muted">{{ $contact->replied_at->format('M d, Y h:i A') }}</small>
                                            <div class="mt-1">
                                                <small>by {{ $contact->repliedBy->name ?? 'Admin' }}</small>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #dee2e6;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
}

.timeline-marker {
    position: absolute;
    left: -22px;
    top: 5px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 2px solid #fff;
    box-shadow: 0 0 0 2px #dee2e6;
}

.timeline-content {
    background: #f8f9fa;
    padding: 10px 15px;
    border-radius: 5px;
}
</style>

<script>
// Update status
function updateStatus() {
    const status = document.getElementById('status').value;
    
    fetch(`{{ route('admin.contacts.status', $contact) }}`, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({ status: status })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire('Success!', data.message, 'success').then(() => {
                location.reload();
            });
        } else {
            Swal.fire('Error!', data.message, 'error');
        }
    })
    .catch(error => {
        Swal.fire('Error!', 'Something went wrong.', 'error');
    });
}

// Send reply
document.getElementById('replyForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch(`{{ route('admin.contacts.reply', $contact) }}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire('Success!', data.message, 'success').then(() => {
                location.reload();
            });
        } else {
            Swal.fire('Error!', data.message, 'error');
        }
    })
    .catch(error => {
        Swal.fire('Error!', 'Something went wrong.', 'error');
    });
});

// Send email
function sendEmail() {
    window.location.href = `mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}`;
}

// Mark as resolved
function markResolved() {
    document.getElementById('status').value = 'resolved';
    updateStatus();
}

// Delete contact
function deleteContact(contactId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/admin/contacts/${contactId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Deleted!', data.message, 'success').then(() => {
                        window.location.href = '{{ route("admin.contacts.index") }}';
                    });
                } else {
                    Swal.fire('Error!', data.message, 'error');
                }
            })
            .catch(error => {
                Swal.fire('Error!', 'Something went wrong.', 'error');
            });
        }
    });
}
</script>
@endsection

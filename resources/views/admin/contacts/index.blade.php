@extends('layouts.admin')

@section('title', 'Contact Form Submissions')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-0">Contact Form Submissions</h1>
                    <p class="text-muted">Manage customer inquiries and support requests</p>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-danger" id="bulkDeleteBtn" style="display: none;">
                        <i class="fas fa-trash"></i> Delete Selected
                    </button>
                    <button type="button" class="btn btn-warning" id="bulkReadBtn" style="display: none;">
                        <i class="fas fa-eye"></i> Mark as Read
                    </button>
                    <button type="button" class="btn btn-success" id="bulkResolvedBtn" style="display: none;">
                        <i class="fas fa-check"></i> Mark as Resolved
                    </button>
                </div>
            </div>

            <!-- Filters and Search -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.contacts.index') }}" class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Status Filter</label>
                            <select name="status" class="form-select">
                                <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All Status</option>
                                <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>New ({{ $statusCounts['new'] }})</option>
                                <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Read ({{ $statusCounts['read'] }})</option>
                                <option value="replied" {{ request('status') == 'replied' ? 'selected' : '' }}>Replied ({{ $statusCounts['replied'] }})</option>
                                <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Resolved ({{ $statusCounts['resolved'] }})</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Search</label>
                            <input type="text" class="form-control" name="search" value="{{ request('search') }}" 
                                   placeholder="Search by name, email, subject, or message...">
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary me-2">
                                <i class="fas fa-search"></i> Search
                            </button>
                            <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-refresh"></i> Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="card-title">Total Contacts</h6>
                                    <h3 class="mb-0">{{ $statusCounts['all'] }}</h3>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-envelope fa-2x opacity-75"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="card-title">New Contacts</h6>
                                    <h3 class="mb-0">{{ $statusCounts['new'] }}</h3>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-bell fa-2x opacity-75"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="card-title">Pending</h6>
                                    <h3 class="mb-0">{{ $statusCounts['read'] }}</h3>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-clock fa-2x opacity-75"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="card-title">Resolved</h6>
                                    <h3 class="mb-0">{{ $statusCounts['resolved'] }}</h3>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-check-circle fa-2x opacity-75"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contacts Table -->
            <div class="card shadow">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Contact Submissions</h5>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="selectAll">
                            <label class="form-check-label" for="selectAll">
                                Select All
                            </label>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($contacts->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th width="50">
                                            <input type="checkbox" id="selectAllHeader" class="form-check-input">
                                        </th>
                                        <th>Contact Info</th>
                                        <th>Subject</th>
                                        <th>Message Preview</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th width="120">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($contacts as $contact)
                                        <tr class="contact-row {{ $contact->status === 'new' ? 'table-warning' : '' }}">
                                            <td>
                                                <input type="checkbox" class="form-check-input contact-checkbox" 
                                                       value="{{ $contact->id }}">
                                            </td>
                                            <td>
                                                <div>
                                                    <strong>{{ $contact->name }}</strong>
                                                    <br><small class="text-muted">{{ $contact->email }}</small>
                                                    @if($contact->phone)
                                                        <br><small class="text-muted">{{ $contact->phone }}</small>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <span class="fw-bold">{{ $contact->subject }}</span>
                                            </td>
                                            <td>
                                                <div class="message-preview">
                                                    {{ Str::limit($contact->message, 100) }}
                                                </div>
                                            </td>
                                            <td>
                                                <span class="{{ $contact->status_badge }}">
                                                    {{ ucfirst($contact->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <small class="text-muted">
                                                    {{ $contact->formatted_date }}
                                                </small>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{ route('admin.contacts.show', $contact) }}" 
                                                       class="btn btn-outline-primary btn-sm" title="View Details">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-outline-danger btn-sm delete-contact" 
                                                            data-id="{{ $contact->id }}" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="card-footer">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-muted">
                                    Showing {{ $contacts->firstItem() }} to {{ $contacts->lastItem() }} of {{ $contacts->total() }} results
                                </div>
                                <div>
                                    {{ $contacts->appends(request()->query())->links() }}
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No contact submissions found</h5>
                            <p class="text-muted">There are no contact form submissions matching your criteria.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Select all functionality
    const selectAll = document.getElementById('selectAll');
    const selectAllHeader = document.getElementById('selectAllHeader');
    const checkboxes = document.querySelectorAll('.contact-checkbox');
    const bulkButtons = document.querySelectorAll('[id^="bulk"]');

    [selectAll, selectAllHeader].forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            checkboxes.forEach(cb => cb.checked = this.checked);
            updateBulkButtons();
            if (this.id === 'selectAll') {
                selectAllHeader.checked = this.checked;
            } else {
                selectAll.checked = this.checked;
            }
        });
    });

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateBulkButtons);
    });

    function updateBulkButtons() {
        const checkedCount = document.querySelectorAll('.contact-checkbox:checked').length;
        bulkButtons.forEach(btn => {
            btn.style.display = checkedCount > 0 ? 'inline-block' : 'none';
        });
    }

    // Individual delete
    document.querySelectorAll('.delete-contact').forEach(btn => {
        btn.addEventListener('click', function() {
            const contactId = this.dataset.id;
            deleteContact(contactId);
        });
    });

    // Bulk actions
    document.getElementById('bulkDeleteBtn').addEventListener('click', function() {
        const selectedIds = Array.from(document.querySelectorAll('.contact-checkbox:checked'))
                                .map(cb => cb.value);
        bulkAction('delete', selectedIds);
    });

    document.getElementById('bulkReadBtn').addEventListener('click', function() {
        const selectedIds = Array.from(document.querySelectorAll('.contact-checkbox:checked'))
                                .map(cb => cb.value);
        bulkAction('mark_read', selectedIds);
    });

    document.getElementById('bulkResolvedBtn').addEventListener('click', function() {
        const selectedIds = Array.from(document.querySelectorAll('.contact-checkbox:checked'))
                                .map(cb => cb.value);
        bulkAction('mark_resolved', selectedIds);
    });

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
                        Swal.fire('Deleted!', data.message, 'success');
                        location.reload();
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

    function bulkAction(action, contactIds) {
        if (contactIds.length === 0) return;

        const actionText = action === 'delete' ? 'delete' : 
                          action === 'mark_read' ? 'mark as read' : 'mark as resolved';

        Swal.fire({
            title: 'Are you sure?',
            text: `This will ${actionText} ${contactIds.length} contact(s).`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: action === 'delete' ? '#d33' : '#3085d6',
            cancelButtonColor: '#6c757d',
            confirmButtonText: `Yes, ${actionText}!`
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('/admin/contacts/bulk-action', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        action: action,
                        contact_ids: contactIds
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire('Success!', data.message, 'success');
                        location.reload();
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
});
</script>
@endsection

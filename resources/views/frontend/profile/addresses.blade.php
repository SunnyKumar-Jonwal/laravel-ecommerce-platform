@extends('layouts.app')

@section('title', 'My Addresses')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>My Addresses</h2>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAddressModal">
                    <i class="fas fa-plus"></i> Add New Address
                </button>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row">
                @forelse($addresses as $address)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h5 class="card-title">
                                        {{ ucfirst($address->type) }} Address
                                        @if($address->is_default)
                                            <span class="badge bg-primary ms-2">Default</span>
                                        @endif
                                    </h5>
                                    <div class="dropdown">
                                        <button class="btn btn-link btn-sm" type="button" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <button class="dropdown-item" onclick="editAddress({{ $address }})">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                            </li>
                                            @if(!$address->is_default)
                                                <li>
                                                    <form action="{{ route('profile.address.update', $address) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="is_default" value="1">
                                                        <button type="submit" class="dropdown-item">
                                                            <i class="fas fa-star"></i> Make Default
                                                        </button>
                                                    </form>
                                                </li>
                                            @endif
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="{{ route('profile.address.delete', $address) }}" method="POST" 
                                                      onsubmit="return confirm('Are you sure you want to delete this address?')"
                                                      style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <p class="card-text">
                                    <strong>{{ $address->first_name }} {{ $address->last_name }}</strong>
                                    @if($address->company)
                                        <br>{{ $address->company }}
                                    @endif
                                    <br>{{ $address->address_line_1 }}
                                    @if($address->address_line_2)
                                        <br>{{ $address->address_line_2 }}
                                    @endif
                                    <br>{{ $address->city }}, {{ $address->state }} {{ $address->postal_code }}
                                    <br>{{ $address->country }}
                                    @if($address->phone)
                                        <br><i class="fas fa-phone"></i> {{ $address->phone }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="fas fa-map-marker-alt fa-3x text-muted mb-3"></i>
                            <h4>No addresses found</h4>
                            <p class="text-muted">Add your first address to get started with shipping.</p>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAddressModal">
                                <i class="fas fa-plus"></i> Add Address
                            </button>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Add Address Modal -->
<div class="modal fade" id="addAddressModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('profile.address.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add New Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="first_name" class="form-label">First Name *</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="last_name" class="form-label">Last Name *</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="company" class="form-label">Company (Optional)</label>
                            <input type="text" class="form-control" id="company" name="company">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="address_line_1" class="form-label">Address Line 1 *</label>
                        <input type="text" class="form-control" id="address_line_1" name="address_line_1" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="address_line_2" class="form-label">Address Line 2 (Optional)</label>
                        <input type="text" class="form-control" id="address_line_2" name="address_line_2">
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="city" class="form-label">City *</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="state" class="form-label">State *</label>
                            <input type="text" class="form-control" id="state" name="state" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="postal_code" class="form-label">Postal Code *</label>
                            <input type="text" class="form-control" id="postal_code" name="postal_code" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="country" class="form-label">Country *</label>
                            <input type="text" class="form-control" id="country" name="country" value="India" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="type" class="form-label">Address Type *</label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="home">Home</option>
                                <option value="office">Office</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-check mt-4">
                                <input class="form-check-input" type="checkbox" id="is_default" name="is_default" value="1">
                                <label class="form-check-label" for="is_default">
                                    Make this my default address
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Address</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Address Modal -->
<div class="modal fade" id="editAddressModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editAddressForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_first_name" class="form-label">First Name *</label>
                            <input type="text" class="form-control" id="edit_first_name" name="first_name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_last_name" class="form-label">Last Name *</label>
                            <input type="text" class="form-control" id="edit_last_name" name="last_name" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_phone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="edit_phone" name="phone">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_company" class="form-label">Company (Optional)</label>
                            <input type="text" class="form-control" id="edit_company" name="company">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_address_line_1" class="form-label">Address Line 1 *</label>
                        <input type="text" class="form-control" id="edit_address_line_1" name="address_line_1" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_address_line_2" class="form-label">Address Line 2 (Optional)</label>
                        <input type="text" class="form-control" id="edit_address_line_2" name="address_line_2">
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_city" class="form-label">City *</label>
                            <input type="text" class="form-control" id="edit_city" name="city" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_state" class="form-label">State *</label>
                            <input type="text" class="form-control" id="edit_state" name="state" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_postal_code" class="form-label">Postal Code *</label>
                            <input type="text" class="form-control" id="edit_postal_code" name="postal_code" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_country" class="form-label">Country *</label>
                            <input type="text" class="form-control" id="edit_country" name="country" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_type" class="form-label">Address Type *</label>
                            <select class="form-select" id="edit_type" name="type" required>
                                <option value="home">Home</option>
                                <option value="office">Office</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-check mt-4">
                                <input class="form-check-input" type="checkbox" id="edit_is_default" name="is_default" value="1">
                                <label class="form-check-label" for="edit_is_default">
                                    Make this my default address
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Address</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function editAddress(address) {
    // Populate the edit modal with address data
    document.getElementById('edit_first_name').value = address.first_name || '';
    document.getElementById('edit_last_name').value = address.last_name || '';
    document.getElementById('edit_phone').value = address.phone || '';
    document.getElementById('edit_company').value = address.company || '';
    document.getElementById('edit_address_line_1').value = address.address_line_1 || '';
    document.getElementById('edit_address_line_2').value = address.address_line_2 || '';
    document.getElementById('edit_city').value = address.city || '';
    document.getElementById('edit_state').value = address.state || '';
    document.getElementById('edit_postal_code').value = address.postal_code || '';
    document.getElementById('edit_country').value = address.country || '';
    document.getElementById('edit_type').value = address.type || '';
    document.getElementById('edit_is_default').checked = address.is_default || false;
    
    document.getElementById('editAddressForm').action = `/profile/address/${address.id}`;
    
    new bootstrap.Modal(document.getElementById('editAddressModal')).show();
}
</script>
@endpush

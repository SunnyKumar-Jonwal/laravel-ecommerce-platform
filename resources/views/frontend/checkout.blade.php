@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('cart.index') }}">Cart</a></li>
                    <li class="breadcrumb-item active">Checkout</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-shipping-fast"></i> Shipping Information</h5>
                </div>
                <div class="card-body">
                    <form id="checkout-form" action="{{ route('checkout.process') }}" method="POST">
                        @csrf
                        
                        <!-- Existing Addresses -->
                        @if($addresses && $addresses->count() > 0)
                        <div class="mb-4">
                            <h6>Select Existing Address</h6>
                            @foreach($addresses as $address)
                            <div class="form-check address-option mb-3">
                                <input class="form-check-input" type="radio" name="address_id" 
                                       value="{{ $address->id }}" id="address{{ $address->id }}"
                                       {{ $loop->first ? 'checked' : '' }}>
                                <label class="form-check-label w-100" for="address{{ $address->id }}">
                                    <div class="border rounded p-3">
                                        <strong>{{ $address->full_name }}</strong><br>
                                        {{ $address->address_line_1 }}<br>
                                        @if($address->address_line_2)
                                            {{ $address->address_line_2 }}<br>
                                        @endif
                                        {{ $address->city }}, {{ $address->state }} - {{ $address->postal_code }}<br>
                                        {{ $address->country }}<br>
                                        <small class="text-muted">Phone: {{ $address->phone }}</small>
                                    </div>
                                </label>
                            </div>
                            @endforeach
                            
                            <div class="form-check address-option">
                                <input class="form-check-input" type="radio" name="address_id" 
                                       value="new" id="addressNew">
                                <label class="form-check-label" for="addressNew">
                                    <strong>Add New Address</strong>
                                </label>
                            </div>
                        </div>
                        @endif

                        <!-- New Address Form -->
                        <div id="new-address-form" class="{{ $addresses && $addresses->count() > 0 ? 'd-none' : '' }}">
                            <h6>{{ $addresses && $addresses->count() > 0 ? 'New Address' : 'Shipping Address' }}</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="full_name" class="form-label">Full Name *</label>
                                        <input type="text" class="form-control" id="full_name" name="full_name" 
                                               value="{{ old('full_name', auth()->user()->name) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone Number *</label>
                                        <input type="tel" class="form-control" id="phone" name="phone" 
                                               value="{{ old('phone', auth()->user()->phone) }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="address_line_1" class="form-label">Address Line 1 *</label>
                                <input type="text" class="form-control" id="address_line_1" name="address_line_1" 
                                       value="{{ old('address_line_1') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="address_line_2" class="form-label">Address Line 2</label>
                                <input type="text" class="form-control" id="address_line_2" name="address_line_2" 
                                       value="{{ old('address_line_2') }}">
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="city" class="form-label">City *</label>
                                        <input type="text" class="form-control" id="city" name="city" 
                                               value="{{ old('city') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="state" class="form-label">State *</label>
                                        <input type="text" class="form-control" id="state" name="state" 
                                               value="{{ old('state') }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="postal_code" class="form-label">Postal Code *</label>
                                        <input type="text" class="form-control" id="postal_code" name="postal_code" 
                                               value="{{ old('postal_code') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="country" class="form-label">Country *</label>
                                        <select class="form-select" id="country" name="country" required>
                                            <option value="India" {{ old('country', 'India') == 'India' ? 'selected' : '' }}>India</option>
                                            <option value="USA" {{ old('country') == 'USA' ? 'selected' : '' }}>USA</option>
                                            <option value="UK" {{ old('country') == 'UK' ? 'selected' : '' }}>UK</option>
                                            <option value="Canada" {{ old('country') == 'Canada' ? 'selected' : '' }}>Canada</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="save_address" name="save_address" value="1">
                                <label class="form-check-label" for="save_address">
                                    Save this address for future orders
                                </label>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="mt-4">
                            <h6><i class="fas fa-credit-card"></i> Payment Method</h6>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="payment_method" 
                                       value="razorpay" id="razorpay" checked>
                                <label class="form-check-label" for="razorpay">
                                    <img src="https://razorpay.com/assets/razorpay-logo.svg" alt="Razorpay" height="20" class="me-2">
                                    Credit Card / Debit Card / UPI / Net Banking
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="payment_method" 
                                       value="cod" id="cod">
                                <label class="form-check-label" for="cod">
                                    <i class="fas fa-money-bill-wave me-2"></i>
                                    Cash on Delivery (₹50 extra charges)
                                </label>
                            </div>
                        </div>

                        <!-- Order Notes -->
                        <div class="mt-4">
                            <label for="order_notes" class="form-label">Order Notes (Optional)</label>
                            <textarea class="form-control" id="order_notes" name="order_notes" rows="3" 
                                      placeholder="Any special instructions for your order...">{{ old('order_notes') }}</textarea>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-shopping-cart"></i> Order Summary</h5>
                </div>
                <div class="card-body">
                    @foreach($cartItems as $item)
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                        <div class="d-flex">
                            <img src="{{ $item->product->featured_image }}" alt="{{ $item->product->name }}" 
                                 class="rounded me-3" style="width: 60px; height: 60px; object-fit: cover;">
                            <div>
                                <h6 class="mb-1">{{ Str::limit($item->product->name, 30) }}</h6>
                                <small class="text-muted">Qty: {{ $item->quantity }}</small>
                            </div>
                        </div>
                        <div class="text-end">
                            <strong>₹{{ number_format($item->subtotal, 2) }}</strong>
                        </div>
                    </div>
                    @endforeach

                    <div class="border-top pt-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal:</span>
                            <span>₹{{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tax (18% GST):</span>
                            <span>₹{{ number_format($tax, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping:</span>
                            <span id="shipping-cost">
                                @if($shipping > 0)
                                    ₹{{ number_format($shipping, 2) }}
                                @else
                                    Free
                                @endif
                            </span>
                        </div>
                        <div id="cod-charges" class="d-flex justify-content-between mb-2 d-none">
                            <span>COD Charges:</span>
                            <span>₹50.00</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between h5">
                            <strong>Total:</strong>
                            <strong id="total-amount">₹{{ number_format($total, 2) }}</strong>
                        </div>
                    </div>

                    <button type="submit" form="checkout-form" class="btn btn-primary btn-lg w-100 mt-3">
                        <i class="fas fa-lock"></i> Place Order
                    </button>

                    <div class="text-center mt-3">
                        <small class="text-muted">
                            <i class="fas fa-shield-alt"></i> 
                            Your payment information is secure and encrypted
                        </small>
                    </div>
                </div>
            </div>

            <!-- Promo Code -->
            <div class="card mt-3">
                <div class="card-body">
                    <h6>Have a Promo Code?</h6>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Enter promo code" id="promo-code">
                        <button class="btn btn-outline-secondary" type="button" onclick="applyPromoCode()">Apply</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Handle address selection
    $('input[name="address_id"]').change(function() {
        if ($(this).val() === 'new') {
            $('#new-address-form').removeClass('d-none');
        } else {
            $('#new-address-form').addClass('d-none');
        }
    });

    // Handle payment method change
    $('input[name="payment_method"]').change(function() {
        updateTotal();
    });

    function updateTotal() {
        let baseTotal = {{ $total }};
        let codCharges = 0;
        
        if ($('#cod').is(':checked')) {
            codCharges = 50;
            $('#cod-charges').removeClass('d-none');
        } else {
            $('#cod-charges').addClass('d-none');
        }
        
        let newTotal = baseTotal + codCharges;
        $('#total-amount').text('₹' + newTotal.toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
    }
});

function applyPromoCode() {
    const promoCode = document.getElementById('promo-code').value;
    if (promoCode.trim() === '') {
        alert('Please enter a promo code');
        return;
    }
    
    // TODO: Implement promo code functionality
    alert('Promo code functionality will be implemented soon!');
}
</script>
@endpush

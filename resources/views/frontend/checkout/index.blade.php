@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Checkout</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('checkout.process') }}" method="POST">
                        @csrf
                        
                        <!-- Shipping Address -->
                        <div class="mb-4">
                            <h5>Shipping Address</h5>
                            @if($addresses->count() > 0)
                                @foreach($addresses as $address)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="address_id" value="{{ $address->id }}" id="address{{ $address->id }}" {{ $loop->first ? 'checked' : '' }}>
                                        <label class="form-check-label" for="address{{ $address->id }}">
                                            <strong>{{ $address->type }}</strong><br>
                                            {{ $address->address_line_1 }}<br>
                                            @if($address->address_line_2)
                                                {{ $address->address_line_2 }}<br>
                                            @endif
                                            {{ $address->city }}, {{ $address->state }} {{ $address->postal_code }}<br>
                                            {{ $address->country }}
                                        </label>
                                    </div>
                                @endforeach
                            @else
                                <div class="alert alert-warning">
                                    <p>No addresses found. <a href="{{ route('profile.addresses') }}">Add an address</a> to continue.</p>
                                </div>
                            @endif
                        </div>

                        <!-- Payment Method -->
                        <div class="mb-4">
                            <h5>Payment Method</h5>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="payment_method" value="cod" id="cod" checked>
                                <label class="form-check-label" for="cod">
                                    Cash on Delivery (COD)
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="payment_method" value="razorpay" id="razorpay">
                                <label class="form-check-label" for="razorpay">
                                    Razorpay (Credit/Debit Card, UPI, Net Banking)
                                </label>
                            </div>
                        </div>

                        @if($addresses->count() > 0)
                            <button type="submit" class="btn btn-primary btn-lg">Place Order</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Order Summary</h5>
                </div>
                <div class="card-body">
                    @foreach($cart->items as $item)
                        <div class="d-flex justify-content-between mb-2">
                            <span>{{ $item->product->name }} ({{ $item->quantity }}x)</span>
                            <span>₹{{ number_format($item->quantity * $item->product->current_price, 2) }}</span>
                        </div>
                    @endforeach
                    
                    <hr>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal:</span>
                        <span>₹{{ number_format($subtotal, 2) }}</span>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span>Shipping:</span>
                        <span>₹{{ number_format($shipping, 2) }}</span>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span>Tax (18%):</span>
                        <span>₹{{ number_format($tax, 2) }}</span>
                    </div>
                    
                    <hr>
                    
                    <div class="d-flex justify-content-between fw-bold">
                        <span>Total:</span>
                        <span>₹{{ number_format($total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

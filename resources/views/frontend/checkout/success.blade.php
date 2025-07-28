@extends('layouts.app')

@section('title', 'Order Successful')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body text-center">
                    <div class="mb-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                    </div>
                    
                    <h2 class="mb-3">Order Placed Successfully!</h2>
                    <p class="text-muted mb-4">Thank you for your order. We'll send you a confirmation email shortly.</p>
                    
                    <div class="mb-4">
                        <h5>Order Details</h5>
                        <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
                        <p><strong>Total Amount:</strong> ₹{{ number_format($order->total_amount, 2) }}</p>
                        <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
                        <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                        <a href="{{ route('home') }}" class="btn btn-primary">Continue Shopping</a>
                        <a href="{{ route('profile.orders') }}" class="btn btn-outline-primary">View Orders</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

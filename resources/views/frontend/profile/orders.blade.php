@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">My Orders</h2>

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

            @forelse($orders as $order)
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h5 class="mb-0">Order #{{ $order->order_number }}</h5>
                                <small class="text-muted">Placed on {{ $order->created_at->format('M d, Y') }}</small>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <span class="badge bg-{{ $order->status == 'delivered' ? 'success' : ($order->status == 'pending' ? 'warning' : 'info') }} me-2">
                                    {{ ucfirst($order->status) }}
                                </span>
                                <span class="badge bg-{{ $order->payment_status == 'completed' ? 'success' : ($order->payment_status == 'pending' ? 'warning' : 'danger') }}">
                                    Payment: {{ ucfirst($order->payment_status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h6>Items ({{ $order->items->count() }})</h6>
                                <div class="row">
                                    @foreach($order->items->take(3) as $item)
                                        <div class="col-auto">
                                            <img src="{{ $item->product->featured_image ?? 'https://via.placeholder.com/60x60' }}" 
                                                 alt="{{ $item->product->name }}" 
                                                 class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                        </div>
                                    @endforeach
                                    @if($order->items->count() > 3)
                                        <div class="col-auto d-flex align-items-center">
                                            <span class="text-muted">+{{ $order->items->count() - 3 }} more</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-md-end">
                                    <h5 class="mb-2">₹{{ number_format($order->total_amount, 2) }}</h5>
                                    <div class="d-flex gap-2 justify-content-md-end">
                                        <a href="{{ route('orders.show', $order) }}" class="btn btn-outline-primary btn-sm">
                                            View Details
                                        </a>
                                        @if($order->status === 'delivered')
                                            <a href="{{ route('orders.invoice', $order) }}" class="btn btn-outline-success btn-sm">
                                                Download Invoice
                                            </a>
                                        @endif
                                        @if(in_array($order->status, ['pending', 'processing']))
                                            <form action="{{ route('orders.cancel', $order) }}" method="POST" style="display: inline;"
                                                  onsubmit="return confirm('Are you sure you want to cancel this order?')">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger btn-sm">Cancel</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-5">
                    <i class="fas fa-shopping-bag fa-3x text-muted mb-3"></i>
                    <h4>No orders found</h4>
                    <p class="text-muted">You haven't placed any orders yet.</p>
                    <a href="{{ route('shop') }}" class="btn btn-primary">
                        <i class="fas fa-shopping-cart"></i> Start Shopping
                    </a>
                </div>
            @endforelse

            <!-- Pagination -->
            @if($orders->hasPages())
                <div class="d-flex justify-content-center">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@extends('layouts.admin')

@section('title', 'Order Details - #' . $order->order_number)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Order Details - #{{ $order->order_number }}</h2>
                <div>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Orders
                    </a>
                    <button class="btn btn-primary" onclick="printInvoice({{ $order->id }})">
                        <i class="fas fa-print"></i> Print Invoice
                    </button>
                </div>
            </div>

            @if(session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: '{{ session('success') }}',
                        timer: 3000,
                        showConfirmButton: false
                    });
                </script>
            @endif

            <div class="row">
                <!-- Order Info Card -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Order Information</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Order Number:</strong></td>
                                    <td>#{{ $order->order_number }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Order Date:</strong></td>
                                    <td>{{ $order->created_at->format('M d, Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                        <form action="{{ route('admin.orders.status', $order) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                <option value="refunded" {{ $order->status == 'refunded' ? 'selected' : '' }}>Refunded</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Payment Status:</strong></td>
                                    <td>
                                        <form action="{{ route('admin.orders.payment-status', $order) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('PATCH')
                                            <select name="payment_status" class="form-select form-select-sm" onchange="this.form.submit()">
                                                <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="completed" {{ $order->payment_status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="failed" {{ $order->payment_status == 'failed' ? 'selected' : '' }}>Failed</option>
                                                <option value="refunded" {{ $order->payment_status == 'refunded' ? 'selected' : '' }}>Refunded</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Payment Method:</strong></td>
                                    <td>{{ ucfirst($order->payment_method ?? 'Not specified') }}</td>
                                </tr>
                                @if($order->shipped_at)
                                <tr>
                                    <td><strong>Shipped At:</strong></td>
                                    <td>{{ $order->shipped_at->format('M d, Y H:i') }}</td>
                                </tr>
                                @endif
                                @if($order->delivered_at)
                                <tr>
                                    <td><strong>Delivered At:</strong></td>
                                    <td>{{ $order->delivered_at->format('M d, Y H:i') }}</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Customer Info Card -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Customer Information</h5>
                        </div>
                        <div class="card-body">
                            @if($order->user)
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Name:</strong></td>
                                    <td>{{ $order->user->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email:</strong></td>
                                    <td>{{ $order->user->email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Phone:</strong></td>
                                    <td>{{ $order->user->phone ?? 'Not provided' }}</td>
                                </tr>
                            </table>
                            @else
                            <p>Guest Order - No customer account</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Address Information -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Shipping Address</h5>
                        </div>
                        <div class="card-body">
                            @if($order->shipping_address)
                                @php $shipping = is_array($order->shipping_address) ? $order->shipping_address : json_decode($order->shipping_address, true) @endphp
                                <address>
                                    <strong>{{ $shipping['name'] ?? 'N/A' }}</strong><br>
                                    {{ $shipping['address'] ?? 'N/A' }}<br>
                                    {{ $shipping['city'] ?? 'N/A' }}, {{ $shipping['state'] ?? 'N/A' }} {{ $shipping['postal_code'] ?? 'N/A' }}<br>
                                    {{ $shipping['country'] ?? 'N/A' }}<br>
                                    @if(isset($shipping['phone']))
                                        Phone: {{ $shipping['phone'] }}
                                    @endif
                                </address>
                            @else
                                <p>No shipping address provided</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Billing Address</h5>
                        </div>
                        <div class="card-body">
                            @if($order->billing_address)
                                @php $billing = is_array($order->billing_address) ? $order->billing_address : json_decode($order->billing_address, true) @endphp
                                <address>
                                    <strong>{{ $billing['name'] ?? 'N/A' }}</strong><br>
                                    {{ $billing['address'] ?? 'N/A' }}<br>
                                    {{ $billing['city'] ?? 'N/A' }}, {{ $billing['state'] ?? 'N/A' }} {{ $billing['postal_code'] ?? 'N/A' }}<br>
                                    {{ $billing['country'] ?? 'N/A' }}<br>
                                    @if(isset($billing['phone']))
                                        Phone: {{ $billing['phone'] }}
                                    @endif
                                </address>
                            @else
                                <p>Same as shipping address</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Order Items</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($order->items as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($item->product && $item->product->images->count() > 0)
                                                        <img src="{{ asset('storage/' . $item->product->images->first()->image) }}" 
                                                             alt="{{ $item->product_name }}" 
                                                             class="img-thumbnail me-3" 
                                                             style="width: 50px; height: 50px; object-fit: cover;">
                                                    @endif
                                                    <div>
                                                        <h6 class="mb-0">{{ $item->product ? $item->product->name : 'Product Not Found' }}</h6>
                                                        @if($item->product)
                                                            <small class="text-muted">SKU: {{ $item->product->sku }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>₹{{ number_format($item->price, 2) }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>₹{{ number_format($item->subtotal, 2) }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No items found</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" class="text-end">Subtotal:</th>
                                            <th>₹{{ number_format($order->total_amount - $order->tax_amount - $order->shipping_amount + $order->discount_amount, 2) }}</th>
                                        </tr>
                                        @if($order->discount_amount > 0)
                                        <tr>
                                            <th colspan="3" class="text-end">Discount:</th>
                                            <th class="text-success">-₹{{ number_format($order->discount_amount, 2) }}</th>
                                        </tr>
                                        @endif
                                        @if($order->tax_amount > 0)
                                        <tr>
                                            <th colspan="3" class="text-end">Tax:</th>
                                            <th>₹{{ number_format($order->tax_amount, 2) }}</th>
                                        </tr>
                                        @endif
                                        @if($order->shipping_amount > 0)
                                        <tr>
                                            <th colspan="3" class="text-end">Shipping:</th>
                                            <th>₹{{ number_format($order->shipping_amount, 2) }}</th>
                                        </tr>
                                        @endif
                                        <tr class="table-primary">
                                            <th colspan="3" class="text-end">Total:</th>
                                            <th>₹{{ number_format($order->total_amount, 2) }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Notes -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Order Notes</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.orders.note', $order) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="mb-3">
                                    <textarea name="notes" class="form-control" rows="3" placeholder="Add internal notes about this order...">{{ $order->notes }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Update Notes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function printInvoice(orderId) {
    window.open(`/admin/orders/${orderId}/invoice`, '_blank');
}
</script>
@endpush

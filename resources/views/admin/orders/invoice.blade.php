<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $order->order_number }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print { display: none !important; }
            .page-break { page-break-after: always; }
        }
        
        .invoice-header {
            border-bottom: 2px solid #007bff;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        
        .company-info {
            text-align: right;
        }
        
        .invoice-details {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        
        .invoice-table th {
            background-color: #007bff;
            color: white;
            border: none;
        }
        
        .invoice-table td {
            border-bottom: 1px solid #dee2e6;
            padding: 12px;
        }
        
        .total-section {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
        }
        
        .signature-section {
            margin-top: 50px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <!-- Print Button -->
        <div class="row no-print">
            <div class="col-12 text-end mb-3">
                <button class="btn btn-primary" onclick="window.print()">
                    <i class="fas fa-print"></i> Print Invoice
                </button>
                <button class="btn btn-secondary" onclick="window.close()">
                    <i class="fas fa-times"></i> Close
                </button>
            </div>
        </div>

        <!-- Invoice Header -->
        <div class="row invoice-header">
            <div class="col-md-6">
                <h1 class="text-primary">INVOICE</h1>
                <h4>E-Commerce Store</h4>
                <p class="mb-0">123 Business Street<br>
                   Business City, State 12345<br>
                   Phone: +91 9876543210<br>
                   Email: info@ecommerce.com</p>
            </div>
            <div class="col-md-6 company-info">
                <h3>Invoice #{{ $order->order_number }}</h3>
                <p class="mb-1"><strong>Date:</strong> {{ $order->created_at->format('F d, Y') }}</p>
                <p class="mb-1"><strong>Status:</strong> 
                    <span class="badge bg-{{ $order->status == 'delivered' ? 'success' : ($order->status == 'pending' ? 'warning' : 'info') }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </p>
                <p class="mb-0"><strong>Payment Status:</strong> 
                    <span class="badge bg-{{ $order->payment_status == 'completed' ? 'success' : ($order->payment_status == 'pending' ? 'warning' : 'danger') }}">
                        {{ ucfirst($order->payment_status) }}
                    </span>
                </p>
            </div>
        </div>

        <!-- Customer Information -->
        <div class="row invoice-details">
            <div class="col-md-6">
                <h5>Bill To:</h5>
                @if($order->user)
                    <p class="mb-1"><strong>{{ $order->user->name }}</strong></p>
                    <p class="mb-1">{{ $order->user->email }}</p>
                @endif
                @if($order->billing_address)
                    <p class="mb-0">
                        {{ $order->billing_address['address'] ?? '' }}<br>
                        {{ $order->billing_address['city'] ?? '' }}, {{ $order->billing_address['state'] ?? '' }} {{ $order->billing_address['postal_code'] ?? '' }}<br>
                        {{ $order->billing_address['country'] ?? '' }}
                        @if(!empty($order->billing_address['phone']))
                            <br>Phone: {{ $order->billing_address['phone'] }}
                        @endif
                    </p>
                @endif
            </div>
            <div class="col-md-6">
                <h5>Ship To:</h5>
                @if($order->shipping_address)
                    <p class="mb-0">
                        {{ $order->shipping_address['name'] ?? ($order->user ? $order->user->name : '') }}<br>
                        {{ $order->shipping_address['address'] ?? '' }}<br>
                        {{ $order->shipping_address['city'] ?? '' }}, {{ $order->shipping_address['state'] ?? '' }} {{ $order->shipping_address['postal_code'] ?? '' }}<br>
                        {{ $order->shipping_address['country'] ?? '' }}
                        @if(!empty($order->shipping_address['phone']))
                            <br>Phone: {{ $order->shipping_address['phone'] }}
                        @endif
                    </p>
                @endif
            </div>
        </div>

        <!-- Order Items -->
        <div class="row">
            <div class="col-12">
                <h5>Order Items</h5>
                <table class="table invoice-table">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-end">Unit Price</th>
                            <th class="text-end">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <td>
                                    <h6 class="mb-0">{{ $item->product ? $item->product->name : 'Product Not Found' }}</h6>
                                    @if($item->product && $item->product->sku)
                                        <small class="text-muted">SKU: {{ $item->product->sku }}</small>
                                    @endif
                                </td>
                                <td class="text-center">{{ $item->quantity }}</td>
                                <td class="text-end">₹{{ number_format($item->price, 2) }}</td>
                                <td class="text-end">₹{{ number_format($item->subtotal, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Totals -->
        <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4">
                <div class="total-section">
                    <table class="table table-borderless">
                        <tr>
                            <td><strong>Subtotal:</strong></td>
                            <td class="text-end">₹{{ number_format($order->total_amount - $order->tax_amount - $order->shipping_amount + $order->discount_amount, 2) }}</td>
                        </tr>
                        @if($order->discount_amount > 0)
                            <tr>
                                <td><strong>Discount:</strong></td>
                                <td class="text-end text-success">-₹{{ number_format($order->discount_amount, 2) }}</td>
                            </tr>
                        @endif
                        @if($order->tax_amount > 0)
                            <tr>
                                <td><strong>Tax:</strong></td>
                                <td class="text-end">₹{{ number_format($order->tax_amount, 2) }}</td>
                            </tr>
                        @endif
                        @if($order->shipping_amount > 0)
                            <tr>
                                <td><strong>Shipping:</strong></td>
                                <td class="text-end">₹{{ number_format($order->shipping_amount, 2) }}</td>
                            </tr>
                        @endif
                        <tr class="border-top">
                            <td><h5><strong>Total Amount:</strong></h5></td>
                            <td class="text-end"><h5><strong>₹{{ number_format($order->total_amount, 2) }}</strong></h5></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Payment Information -->
        @if($order->payments && $order->payments->count() > 0)
            <div class="row mt-4">
                <div class="col-12">
                    <h5>Payment Information</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Payment Method</th>
                                <th>Transaction ID</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->payments as $payment)
                                <tr>
                                    <td>{{ ucfirst($payment->payment_method) }}</td>
                                    <td>{{ $payment->transaction_id ?? 'N/A' }}</td>
                                    <td>₹{{ number_format($payment->amount, 2) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $payment->status == 'completed' ? 'success' : ($payment->status == 'pending' ? 'warning' : 'danger') }}">
                                            {{ ucfirst($payment->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $payment->created_at->format('M d, Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="row mt-4">
                <div class="col-12">
                    <div class="alert alert-info">
                        <strong>Payment Method:</strong> {{ ucfirst($order->payment_method ?? 'Not specified') }}
                        @if($order->payment_id)
                            <br><strong>Payment ID:</strong> {{ $order->payment_id }}
                        @endif
                    </div>
                </div>
            </div>
        @endif

        <!-- Order Notes -->
        @if($order->notes)
            <div class="row mt-4">
                <div class="col-12">
                    <h5>Order Notes</h5>
                    <div class="alert alert-secondary">
                        {{ $order->notes }}
                    </div>
                </div>
            </div>
        @endif

        <!-- Shipping Information -->
        @if($order->shipped_at || $order->delivered_at)
            <div class="row mt-4">
                <div class="col-12">
                    <h5>Shipping Information</h5>
                    <div class="row">
                        @if($order->shipped_at)
                            <div class="col-md-6">
                                <p><strong>Shipped Date:</strong> {{ $order->shipped_at->format('F d, Y H:i') }}</p>
                            </div>
                        @endif
                        @if($order->delivered_at)
                            <div class="col-md-6">
                                <p><strong>Delivered Date:</strong> {{ $order->delivered_at->format('F d, Y H:i') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        <!-- Footer -->
        <div class="row mt-5 signature-section">
            <div class="col-12">
                <div class="text-end">
                    <p class="mb-1">Thank you for your business!</p>
                    <p class="text-muted">For any queries, contact us at info@ecommerce.com</p>
                </div>
            </div>
        </div>

        <!-- Terms and Conditions -->
        <div class="row mt-4 no-print">
            <div class="col-12">
                <small class="text-muted">
                    <strong>Terms & Conditions:</strong> Payment is due within 30 days. 
                    Please include the invoice number on your payment. 
                    Returns are accepted within 30 days of delivery in original condition.
                </small>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js"></script>
</body>
</html>

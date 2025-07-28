<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Order #{{ $order->order_number }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            body { -webkit-print-color-adjust: exact; }
            .no-print { display: none !important; }
            .page-break { page-break-after: always; }
        }
        
        body {
            font-family: 'Arial', sans-serif;
            font-size: 14px;
        }
        
        .order-header {
            border-bottom: 2px solid #000;
            margin-bottom: 20px;
            padding-bottom: 15px;
        }
        
        .company-logo {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
        
        .order-info {
            background-color: #f8f9fa;
            padding: 15px;
            border: 1px solid #ddd;
            margin-bottom: 20px;
        }
        
        .customer-info {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
        }
        
        .order-table {
            border-collapse: collapse;
            width: 100%;
        }
        
        .order-table th,
        .order-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        
        .order-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        
        .total-section {
            margin-top: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
        }
        
        .signature-area {
            margin-top: 40px;
            text-align: right;
        }
    </style>
</head>
<body onload="window.print(); window.close();">
    <div class="container-fluid">
        <!-- Order Header -->
        <div class="row order-header">
            <div class="col-8">
                <div class="company-logo">E-Commerce Store</div>
                <p class="mb-0">
                    123 Business Street<br>
                    Business City, State 12345<br>
                    Phone: +91 9876543210 | Email: info@ecommerce.com
                </p>
            </div>
            <div class="col-4 text-right">
                <h3>ORDER RECEIPT</h3>
                <p class="mb-0">
                    <strong>Order #:</strong> {{ $order->order_number }}<br>
                    <strong>Date:</strong> {{ $order->created_at->format('F d, Y H:i') }}<br>
                    <strong>Status:</strong> {{ ucfirst($order->status) }}
                </p>
            </div>
        </div>

        <!-- Customer Information -->
        <div class="row">
            <div class="col-6">
                <div class="customer-info">
                    <h5>Customer Information</h5>
                    @if($order->user)
                        <p class="mb-1"><strong>{{ $order->user->name }}</strong></p>
                        <p class="mb-1">{{ $order->user->email }}</p>
                    @endif
                    @if($order->billing_address)
                        <p class="mb-0">
                            <strong>Billing Address:</strong><br>
                            {{ $order->billing_address['address'] ?? '' }}<br>
                            {{ $order->billing_address['city'] ?? '' }}, {{ $order->billing_address['state'] ?? '' }} {{ $order->billing_address['postal_code'] ?? '' }}<br>
                            {{ $order->billing_address['country'] ?? '' }}
                            @if(!empty($order->billing_address['phone']))
                                <br>Phone: {{ $order->billing_address['phone'] }}
                            @endif
                        </p>
                    @endif
                </div>
            </div>
            <div class="col-6">
                <div class="customer-info">
                    <h5>Shipping Information</h5>
                    @if($order->shipping_address)
                        <p class="mb-0">
                            <strong>Ship To:</strong><br>
                            {{ $order->shipping_address['name'] ?? ($order->user ? $order->user->name : '') }}<br>
                            {{ $order->shipping_address['address'] ?? '' }}<br>
                            {{ $order->shipping_address['city'] ?? '' }}, {{ $order->shipping_address['state'] ?? '' }} {{ $order->shipping_address['postal_code'] ?? '' }}<br>
                            {{ $order->shipping_address['country'] ?? '' }}
                            @if(!empty($order->shipping_address['phone']))
                                <br>Phone: {{ $order->shipping_address['phone'] }}
                            @endif
                        </p>
                    @endif
                    
                    @if($order->shipped_at)
                        <p class="mt-2 mb-0"><strong>Shipped:</strong> {{ $order->shipped_at->format('M d, Y H:i') }}</p>
                    @endif
                    @if($order->delivered_at)
                        <p class="mt-1 mb-0"><strong>Delivered:</strong> {{ $order->delivered_at->format('M d, Y H:i') }}</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="row">
            <div class="col-12">
                <h5>Order Items</h5>
                <table class="order-table">
                    <thead>
                        <tr>
                            <th width="50%">Product</th>
                            <th width="15%" class="text-center">Qty</th>
                            <th width="17%" class="text-right">Unit Price</th>
                            <th width="18%" class="text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <td>
                                    <strong>{{ $item->product ? $item->product->name : 'Product Not Found' }}</strong>
                                    @if($item->product && $item->product->sku)
                                        <br><small>SKU: {{ $item->product->sku }}</small>
                                    @endif
                                </td>
                                <td class="text-center">{{ $item->quantity }}</td>
                                <td class="text-right">₹{{ number_format($item->price, 2) }}</td>
                                <td class="text-right">₹{{ number_format($item->subtotal, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Order Totals -->
        <div class="row">
            <div class="col-7"></div>
            <div class="col-5">
                <div class="total-section">
                    <table style="width: 100%; border: none;">
                        <tr>
                            <td style="border: none; padding: 5px;"><strong>Subtotal:</strong></td>
                            <td style="border: none; padding: 5px;" class="text-right">₹{{ number_format($order->total_amount - $order->tax_amount - $order->shipping_amount + $order->discount_amount, 2) }}</td>
                        </tr>
                        @if($order->discount_amount > 0)
                            <tr>
                                <td style="border: none; padding: 5px;"><strong>Discount:</strong></td>
                                <td style="border: none; padding: 5px;" class="text-right">-₹{{ number_format($order->discount_amount, 2) }}</td>
                            </tr>
                        @endif
                        @if($order->tax_amount > 0)
                            <tr>
                                <td style="border: none; padding: 5px;"><strong>Tax:</strong></td>
                                <td style="border: none; padding: 5px;" class="text-right">₹{{ number_format($order->tax_amount, 2) }}</td>
                            </tr>
                        @endif
                        @if($order->shipping_amount > 0)
                            <tr>
                                <td style="border: none; padding: 5px;"><strong>Shipping:</strong></td>
                                <td style="border: none; padding: 5px;" class="text-right">₹{{ number_format($order->shipping_amount, 2) }}</td>
                            </tr>
                        @endif
                        <tr style="border-top: 2px solid #000;">
                            <td style="border: none; padding: 10px 5px 5px 5px;"><strong>TOTAL:</strong></td>
                            <td style="border: none; padding: 10px 5px 5px 5px;" class="text-right"><strong>₹{{ number_format($order->total_amount, 2) }}</strong></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Payment Information -->
        <div class="row" style="margin-top: 20px;">
            <div class="col-12">
                <div class="order-info">
                    <h5>Payment Information</h5>
                    <p class="mb-1"><strong>Payment Method:</strong> {{ ucfirst($order->payment_method ?? 'Not specified') }}</p>
                    <p class="mb-1"><strong>Payment Status:</strong> {{ ucfirst($order->payment_status) }}</p>
                    @if($order->payment_id)
                        <p class="mb-0"><strong>Payment ID:</strong> {{ $order->payment_id }}</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Order Notes -->
        @if($order->notes)
            <div class="row" style="margin-top: 20px;">
                <div class="col-12">
                    <div class="order-info">
                        <h5>Order Notes</h5>
                        <p class="mb-0">{{ $order->notes }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Signature Section -->
        <div class="signature-area">
            <p>
                Authorized Signature<br><br>
                _________________________<br>
                E-Commerce Store
            </p>
        </div>

        <!-- Footer -->
        <div style="margin-top: 30px; text-align: center; font-size: 12px; color: #666;">
            <p class="mb-0">Thank you for your business! | For support: info@ecommerce.com | +91 9876543210</p>
        </div>
    </div>
</body>
</html>

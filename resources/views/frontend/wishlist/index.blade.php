@extends('layouts.app')

@section('title', 'My Wishlist')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>My Wishlist</h2>
                @if($wishlistItems->count() > 0)
                    <button class="btn btn-outline-danger" onclick="clearWishlist()">
                        <i class="fas fa-trash"></i> Clear All
                    </button>
                @endif
            </div>
        </div>
    </div>

    @if($wishlistItems->count() > 0)
        <div class="row">
            @foreach($wishlistItems as $item)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4" id="wishlist-item-{{ $item->product->id }}">
                    <div class="card product-card h-100">
                        <div class="position-relative">
                            <a href="{{ route('product.detail', $item->product->slug) }}">
                                <img src="{{ $item->product->featured_image }}" 
                                     class="card-img-top" 
                                     alt="{{ $item->product->name }}"
                                     style="height: 250px; object-fit: cover;">
                            </a>
                            @if($item->product->featured)
                                <span class="badge bg-warning position-absolute top-0 end-0 m-2">Featured</span>
                            @endif
                            @if($item->product->sale_price && $item->product->sale_price < $item->product->price)
                                @php
                                    $discount = round((($item->product->price - $item->product->sale_price) / $item->product->price) * 100);
                                @endphp
                                <span class="badge bg-danger position-absolute top-0 start-0 m-2">-{{ $discount }}%</span>
                            @endif
                            <button class="btn btn-sm btn-outline-danger position-absolute" 
                                    style="top: 10px; right: 50px;"
                                    onclick="removeFromWishlist({{ $item->product->id }})"
                                    title="Remove from wishlist">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div class="mb-2">
                                <small class="text-muted">{{ $item->product->category->name ?? 'N/A' }}</small>
                                @if($item->product->brand)
                                    <small class="text-muted"> • {{ $item->product->brand->name }}</small>
                                @endif
                            </div>
                            <h6 class="card-title">
                                <a href="{{ route('product.detail', $item->product->slug) }}" class="text-decoration-none text-dark">
                                    {{ $item->product->name }}
                                </a>
                            </h6>
                            @if($item->product->short_description)
                                <p class="card-text text-muted small">{{ Str::limit($item->product->short_description, 80) }}</p>
                            @endif
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="price">
                                        @if($item->product->sale_price && $item->product->sale_price < $item->product->price)
                                            <span class="fw-bold text-danger h6">₹{{ number_format($item->product->sale_price, 2) }}</span>
                                            <small class="text-muted text-decoration-line-through ms-1">₹{{ number_format($item->product->price, 2) }}</small>
                                        @else
                                            <span class="fw-bold text-primary h6">₹{{ number_format($item->product->price, 2) }}</span>
                                        @endif
                                    </div>
                                    @if($item->product->average_rating > 0)
                                        <div class="rating">
                                            <small class="text-warning">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= $item->product->average_rating)
                                                        ★
                                                    @else
                                                        ☆
                                                    @endif
                                                @endfor
                                            </small>
                                            <small class="text-muted">({{ $item->product->reviews_count }})</small>
                                        </div>
                                    @endif
                                </div>
                                @if($item->product->stock_quantity <= 0)
                                    <button class="btn btn-outline-secondary w-100 mb-2" disabled>Out of Stock</button>
                                @else
                                    <button class="btn btn-primary w-100 mb-2 add-to-cart-btn" 
                                            data-product-id="{{ $item->product->id }}"
                                            data-product-name="{{ $item->product->name }}"
                                            data-product-price="{{ $item->product->sale_price ?: $item->product->price }}"
                                            onclick="addToCartFromWishlist({{ $item->product->id }})">
                                        <i class="fas fa-cart-plus"></i> Add to Cart
                                    </button>
                                @endif
                                <button class="btn btn-outline-success w-100 btn-sm" 
                                        onclick="moveToCart({{ $item->product->id }})">
                                    <i class="fas fa-exchange-alt"></i> Move to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination if needed -->
        @if($wishlistItems instanceof \Illuminate\Pagination\LengthAwarePaginator && $wishlistItems->hasPages())
            <div class="row mt-4">
                <div class="col-12">
                    <div class="d-flex justify-content-center">
                        {{ $wishlistItems->links() }}
                    </div>
                </div>
            </div>
        @endif
    @else
        <div class="row">
            <div class="col-12 text-center">
                <div class="py-5">
                    <i class="far fa-heart fa-5x text-muted mb-4"></i>
                    <h3>Your wishlist is empty</h3>
                    <p class="text-muted mb-4">Save your favorite items to your wishlist and never lose track of them.</p>
                    <a href="{{ route('shop') }}" class="btn btn-primary btn-lg">Start Shopping</a>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

@push('styles')
<style>
    .product-card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        border: 1px solid #e0e0e0;
    }
    
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .rating {
        font-size: 14px;
    }
    
    .price .fw-bold {
        font-size: 1.1rem;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});

function removeFromWishlist(productId) {
    Swal.fire({
        title: 'Remove from Wishlist?',
        text: 'Are you sure you want to remove this item from your wishlist?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, remove it!'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('{{ route("wishlist.remove") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    product_id: productId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Remove the item from the page
                    const itemElement = document.getElementById('wishlist-item-' + productId);
                    if (itemElement) {
                        itemElement.remove();
                    }
                    
                    // Update wishlist count in header if exists
                    updateWishlistCount();
                    
                    // Show success message
                    showSuccessAlert(data.message);
                    
                    // Check if wishlist is empty
                    const remainingItems = document.querySelectorAll('[id^="wishlist-item-"]');
                    if (remainingItems.length === 0) {
                        location.reload(); // Reload to show empty state
                    }
                } else {
                    showErrorAlert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showErrorAlert('An error occurred while removing the item.');
            });
        }
    });
}

function clearWishlist() {
    Swal.fire({
        title: 'Clear Wishlist?',
        text: 'Are you sure you want to remove all items from your wishlist? This action cannot be undone.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, clear all!'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('{{ route("wishlist.clear") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showSuccessAlert('Wishlist cleared successfully!');
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    showErrorAlert('An error occurred while clearing the wishlist.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showErrorAlert('An error occurred while clearing the wishlist.');
            });
        }
    });
}

function addToCartFromWishlist(productId) {
    const button = document.querySelector(`[data-product-id="${productId}"]`);
    const originalText = button.innerHTML;
    
    // Show loading state
    button.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Adding...';
    button.disabled = true;
    
    fetch('{{ route("cart.add") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: 1
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Show success state
            button.innerHTML = '<i class="fas fa-check me-1"></i>Added!';
            button.classList.remove('btn-primary');
            button.classList.add('btn-success');
            
            // Update cart count in header if exists
            updateCartCount();
            
            showSuccessAlert('Product added to cart successfully!');
            
            // Reset button after 2 seconds
            setTimeout(() => {
                button.innerHTML = originalText;
                button.classList.remove('btn-success');
                button.classList.add('btn-primary');
                button.disabled = false;
            }, 2000);
        } else {
            showErrorAlert(data.message || 'Failed to add product to cart');
            button.innerHTML = originalText;
            button.disabled = false;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showErrorAlert('An error occurred while adding to cart');
        button.innerHTML = originalText;
        button.disabled = false;
    });
}

function moveToCart(productId) {
    Swal.fire({
        title: 'Move to Cart?',
        text: 'This will remove the item from your wishlist and add it to your cart.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, move it!'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('{{ route("wishlist.move-to-cart") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: 1
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Remove the item from the page
                    const itemElement = document.getElementById('wishlist-item-' + productId);
                    if (itemElement) {
                        itemElement.remove();
                    }
                    
                    // Update counts
                    updateWishlistCount();
                    updateCartCount();
                    
                    showSuccessAlert(data.message);
                    
                    // Check if wishlist is empty
                    const remainingItems = document.querySelectorAll('[id^="wishlist-item-"]');
                    if (remainingItems.length === 0) {
                        location.reload(); // Reload to show empty state
                    }
                } else {
                    showErrorAlert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showErrorAlert('An error occurred while moving the item.');
            });
        }
    });
}

function updateWishlistCount() {
    fetch('{{ route("wishlist.count") }}')
        .then(response => response.json())
        .then(data => {
            const countElements = document.querySelectorAll('.wishlist-count');
            countElements.forEach(element => {
                element.textContent = data.count;
                if (data.count === 0) {
                    element.style.display = 'none';
                } else {
                    element.style.display = 'inline';
                }
            });
        })
        .catch(error => console.error('Error updating wishlist count:', error));
}

function updateCartCount() {
    fetch('{{ route("cart.count") }}')
        .then(response => response.json())
        .then(data => {
            const countElements = document.querySelectorAll('.cart-count');
            countElements.forEach(element => {
                element.textContent = data.count;
                if (data.count === 0) {
                    element.style.display = 'none';
                } else {
                    element.style.display = 'inline';
                }
            });
        })
        .catch(error => console.error('Error updating cart count:', error));
}
</script>
@endpush

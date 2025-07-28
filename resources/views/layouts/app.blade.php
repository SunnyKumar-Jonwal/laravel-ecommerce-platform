<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'E-Commerce Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #007bff;
            --secondary-color: #6c757d;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
            --info-color: #17a2b8;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
        }

        body {
            font-family: 'Figtree', sans-serif;
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 1.5rem;
        }

        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }

        .product-image {
            height: 250px;
            object-fit: cover;
        }

        .btn-cart {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
            transition: all 0.3s ease;
        }

        .btn-cart:hover {
            background-color: #0056b3;
            border-color: #0056b3;
            transform: translateY(-2px);
        }

        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: var(--danger-color);
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 0.75rem;
            min-width: 20px;
            text-align: center;
        }

        .footer {
            background-color: var(--dark-color);
            color: white;
            padding: 3rem 0 1rem 0;
            margin-top: 5rem;
        }

        .price-original {
            text-decoration: line-through;
            color: var(--secondary-color);
        }

        .price-sale {
            color: var(--danger-color);
            font-weight: 600;
        }

        .discount-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: var(--danger-color);
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .loading {
            opacity: 0.6;
            pointer-events: none;
        }

        @media (max-width: 768px) {
            .product-image {
                height: 200px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-store text-primary"></i>
                {{ config('app.name', 'E-Commerce') }}
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about.us') }}">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('shop') }}">Shop</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Legal
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('legal.terms') }}">Terms & Conditions</a></li>
                            <li><a class="dropdown-item" href="{{ route('legal.privacy') }}">Privacy Policy</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact.us') }}">Contact Us</a>
                    </li>
                </ul>

                <!-- Search Form -->
                <form class="d-flex me-3" action="{{ route('search') }}" method="GET">
                    <input class="form-control" type="search" name="q" placeholder="Search products..." value="{{ request('q') }}">
                    <button class="btn btn-outline-primary ms-2" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>

                <ul class="navbar-nav">
                    <!-- Wishlist -->
                    @auth
                    <li class="nav-item">
                        <a class="nav-link position-relative" href="{{ route('wishlist.index') }}">
                            <i class="far fa-heart"></i>
                            <span class="cart-badge wishlist-count" id="wishlist-count" style="display: none;">0</span>
                        </a>
                    </li>
                    @endauth

                    <!-- Cart -->
                    <li class="nav-item">
                        <a class="nav-link position-relative" href="{{ route('cart.index') }}">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="cart-badge cart-count" id="cart-count">0</span>
                        </a>
                    </li>

                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('orders.index') }}">My Orders</a></li>
                                <li><a class="dropdown-item" href="{{ route('wishlist.index') }}">My Wishlist</a></li>
                                <li><a class="dropdown-item" href="{{ route('profile.index') }}">Profile</a></li>
                                @if(Auth::user()->hasRole('admin'))
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show m-0" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show m-0" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5>{{ config('app.name', 'E-Commerce') }}</h5>
                    <p>Your one-stop shop for all your needs. We provide quality products at competitive prices.</p>
                    <div class="social-links">
                        <a href="#" class="text-light me-3"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-light me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-light me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-light"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6>Quick Links</h6>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}" class="text-light">Home</a></li>
                        <li><a href="{{ route('about.us') }}" class="text-light">About Us</a></li>
                        <li><a href="{{ route('shop') }}" class="text-light">Shop</a></li>
                        <li><a href="{{ route('contact.us') }}" class="text-light">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6>Legal</h6>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('legal.terms') }}" class="text-light">Terms & Conditions</a></li>
                        <li><a href="{{ route('legal.privacy') }}" class="text-light">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6>Contact Info</h6>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-phone"></i> +91 12345 67890</li>
                        <li><i class="fas fa-envelope"></i> info@ecommerce.com</li>
                        <li><i class="fas fa-map-marker-alt"></i> New Delhi, India</li>
                    </ul>
                </div>
            </div>
            <hr class="my-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-end">
                    <p class="mb-0">Welcome <i class="fas fa-heart text-danger"></i> Kashish World</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Global JavaScript -->
    <script>
        // Update cart count on page load
        $(document).ready(function() {
            updateCartCount();

            // Display Laravel session messages with SweetAlert2
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '{{ session('error') }}',
                    timer: 5000,
                    showConfirmButton: true
                });
            @endif

            @if(session('warning'))
                Swal.fire({
                    icon: 'warning',
                    title: 'Warning!',
                    text: '{{ session('warning') }}',
                    timer: 4000,
                    showConfirmButton: true
                });
            @endif

            @if(session('info'))
                Swal.fire({
                    icon: 'info',
                    title: 'Information',
                    text: '{{ session('info') }}',
                    timer: 3000,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            @endif
        });

        function updateCartCount() {
            $.get('{{ route("cart.count") }}', function(data) {
                $('#cart-count').text(data.count);
            });
        }

        // Add to cart function
        function addToCart(productId, quantity = 1) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.post('{{ route("cart.add") }}', {
                product_id: productId,
                quantity: quantity
            }, function(response) {
                if (response.success) {
                    updateCartCount();
                    showToast('success', response.message);
                } else {
                    showToast('error', response.message);
                }
            }).fail(function() {
                showToast('error', 'Something went wrong. Please try again.');
            });
        }

        // Show notification using SweetAlert2
        function showToast(type, message) {
            Swal.fire({
                icon: type === 'success' ? 'success' : 'error',
                title: type === 'success' ? 'Success!' : 'Error!',
                text: message,
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        }

        // Global SweetAlert functions for frontend
        function showSuccessAlert(title, text = '', timer = 3000) {
            Swal.fire({
                icon: 'success',
                title: title,
                text: text,
                timer: timer,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        }

        function showErrorAlert(title, text = '') {
            Swal.fire({
                icon: 'error',
                title: title,
                text: text,
                showConfirmButton: true
            });
        }

        function showWarningAlert(title, text = '') {
            Swal.fire({
                icon: 'warning',
                title: title,
                text: text,
                showConfirmButton: true
            });
        }

        function showInfoAlert(title, text = '') {
            Swal.fire({
                icon: 'info',
                title: title,
                text: text,
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        }

        function confirmAction(message = 'Are you sure you want to continue?', confirmButtonText = 'Yes, continue!') {
            return Swal.fire({
                title: 'Are you sure?',
                text: message,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: confirmButtonText,
                cancelButtonText: 'Cancel'
            });
        }

        // Initialize counts on page load
        @auth
        document.addEventListener('DOMContentLoaded', function() {
            // Update cart count
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
                .catch(error => console.error('Error loading cart count:', error));

            // Update wishlist count
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
                .catch(error => console.error('Error loading wishlist count:', error));
        });
        @endauth
    </script>

    @stack('scripts')
</body>
</html>

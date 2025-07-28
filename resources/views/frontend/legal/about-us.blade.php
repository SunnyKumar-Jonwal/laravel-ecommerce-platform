@extends('layouts.app')

@section('title', 'About Us - Kashish World')

@section('content')
<div class="container py-5">
    <!-- Hero Section -->
    <div class="row align-items-center mb-5">
        <div class="col-lg-6">
            <div class="about-content">
                <h1 class="display-4 fw-bold text-primary mb-4">Meet Kashish Singhal</h1>
                <h3 class="text-secondary mb-4">Tech Queen & Founder of Kashish World</h3>
                <p class="lead text-muted">
                    Welcome to Kashish World - where technology meets affordability, and innovation drives excellence. 
                    Founded by the visionary entrepreneur Kashish Singhal, we're revolutionizing the e-commerce landscape 
                    with unbeatable prices and exceptional service.
                </p>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="founder-image text-center">
                <img src="{{ asset('images/Pic_3.jpg') }}" 
                     alt="Kashish Singhal - Founder" 
                     class="img-fluid rounded-circle shadow-lg"
                     style="max-width: 350px;">
            </div>
        </div>
    </div>

    <!-- About Kashish World Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-5">
                    <div class="text-center mb-5">
                        <h2 class="h1 text-primary mb-3">About Kashish World</h2>
                        <div class="divider mx-auto" style="width: 100px; height: 3px; background: linear-gradient(45deg, #007bff, #28a745);"></div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <p class="fs-5 text-center text-muted mb-4">
                                Kashish World isn't just an e-commerce platform—it's a revolution in online shopping. 
                                We believe that quality products shouldn't come with premium price tags, and exceptional 
                                service should be the standard, not the exception.
                            </p>
                        </div>
                    </div>

                    <div class="row g-4 mt-4">
                        <div class="col-md-4">
                            <div class="feature-box text-center p-4">
                                <div class="feature-icon mb-3">
                                    <i class="fas fa-tag fa-3x text-primary"></i>
                                </div>
                                <h4 class="h5 mb-3">Unbeatable Prices</h4>
                                <p class="text-muted">We offer products at incredibly low prices without compromising on quality. Your savings are our priority.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="feature-box text-center p-4">
                                <div class="feature-icon mb-3">
                                    <i class="fas fa-shipping-fast fa-3x text-success"></i>
                                </div>
                                <h4 class="h5 mb-3">Free Shipping</h4>
                                <p class="text-muted">Enjoy free shipping on all orders. We deliver your products right to your doorstep at no extra cost.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="feature-box text-center p-4">
                                <div class="feature-icon mb-3">
                                    <i class="fas fa-heart fa-3x text-danger"></i>
                                </div>
                                <h4 class="h5 mb-3">Customer First</h4>
                                <p class="text-muted">Our customers are at the heart of everything we do. Your satisfaction drives our innovation.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Founder Story Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="founder-story">
                <div class="text-center mb-5">
                    <h2 class="h1 text-primary mb-3">The Visionary Behind Kashish World</h2>
                    <div class="divider mx-auto" style="width: 100px; height: 3px; background: linear-gradient(45deg, #007bff, #28a745);"></div>
                </div>

                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="story-content">
                            <h3 class="h4 text-secondary mb-4">Tech Queen & Entrepreneurial Pioneer</h3>
                            <p class="mb-4">
                                Kashish Singhal stands as a beacon of innovation in the digital commerce world. 
                                Dubbed the "Tech Queen" by industry peers, she has redefined what it means to be 
                                an entrepreneur in the 21st century. With an unwavering commitment to excellence 
                                and a passion for making quality products accessible to everyone, Kashish has 
                                built Kashish World from the ground up.
                            </p>
                            <p class="mb-4">
                                Her journey began with a simple yet powerful vision: to create an e-commerce platform 
                                that puts customers first, offers unmatched value, and leverages cutting-edge technology 
                                to deliver exceptional experiences. Today, she leads a team of dedicated professionals 
                                who share her commitment to innovation and customer satisfaction.
                            </p>
                            <p class="mb-4">
                                As a leading entrepreneur, Kashish continues to push boundaries, explore new technologies, 
                                and set industry standards. Her leadership style combines strategic thinking with 
                                compassionate leadership, making her not just a successful business owner, but an 
                                inspiration to aspiring entrepreneurs worldwide.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="achievements">
                            <h4 class="h5 text-primary mb-4">Key Achievements</h4>
                            <div class="achievement-list">
                                <div class="achievement-item d-flex align-items-center mb-3">
                                    <i class="fas fa-crown text-warning me-3"></i>
                                    <span>Recognized as "Tech Queen" in the e-commerce industry</span>
                                </div>
                                <div class="achievement-item d-flex align-items-center mb-3">
                                    <i class="fas fa-rocket text-primary me-3"></i>
                                    <span>Founded and scaled Kashish World to thousands of satisfied customers</span>
                                </div>
                                <div class="achievement-item d-flex align-items-center mb-3">
                                    <i class="fas fa-award text-success me-3"></i>
                                    <span>Leading entrepreneur in digital commerce innovation</span>
                                </div>
                                <div class="achievement-item d-flex align-items-center mb-3">
                                    <i class="fas fa-users text-info me-3"></i>
                                    <span>Built a customer-centric organization focused on value delivery</span>
                                </div>
                                <div class="achievement-item d-flex align-items-center mb-3">
                                    <i class="fas fa-globe text-secondary me-3"></i>
                                    <span>Pioneered affordable luxury in online retail</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Connect With Us Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card bg-primary text-white">
                <div class="card-body p-5 text-center">
                    <h2 class="h1 mb-4">Connect With Kashish Singhal</h2>
                    <p class="lead mb-5">
                        Follow Kashish's journey and stay updated with the latest from Kashish World. 
                        Connect with her on social media and discover insights from a true industry leader.
                    </p>
                    
                    <div class="social-links d-flex justify-content-center flex-wrap gap-4">
                        <a href="https://www.facebook.com/kashishsinghal" target="_blank" class="btn btn-light btn-lg social-btn">
                            <i class="fab fa-facebook-f me-2"></i>Facebook
                        </a>
                        <a href="https://www.instagram.com/kashishsinghal" target="_blank" class="btn btn-light btn-lg social-btn">
                            <i class="fab fa-instagram me-2"></i>Instagram
                        </a>
                        <a href="https://www.linkedin.com/in/kashishsinghal" target="_blank" class="btn btn-light btn-lg social-btn">
                            <i class="fab fa-linkedin-in me-2"></i>LinkedIn
                        </a>
                        <a href="https://www.twitter.com/kashishsinghal" target="_blank" class="btn btn-light btn-lg social-btn">
                            <i class="fab fa-twitter me-2"></i>Twitter
                        </a>
                        <a href="https://www.kashishsinghal.com" target="_blank" class="btn btn-outline-light btn-lg social-btn">
                            <i class="fas fa-globe me-2"></i>Personal Website
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Our Mission & Values -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="text-center mb-5">
                <h2 class="h1 text-primary mb-3">Our Mission & Values</h2>
                <div class="divider mx-auto" style="width: 100px; height: 3px; background: linear-gradient(45deg, #007bff, #28a745);"></div>
            </div>

            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="value-card h-100 p-4 border rounded-3 shadow-sm">
                        <div class="value-icon text-center mb-3">
                            <i class="fas fa-bullseye fa-3x text-primary"></i>
                        </div>
                        <h4 class="h5 text-center mb-3">Our Mission</h4>
                        <p class="text-muted text-center">
                            To democratize access to quality products by offering unbeatable prices, 
                            exceptional service, and innovative shopping experiences that exceed customer expectations.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="value-card h-100 p-4 border rounded-3 shadow-sm">
                        <div class="value-icon text-center mb-3">
                            <i class="fas fa-eye fa-3x text-success"></i>
                        </div>
                        <h4 class="h5 text-center mb-3">Our Vision</h4>
                        <p class="text-muted text-center">
                            To become the world's most trusted and customer-centric e-commerce platform, 
                            where technology and human values create magical shopping experiences.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="value-card h-100 p-4 border rounded-3 shadow-sm">
                        <div class="value-icon text-center mb-3">
                            <i class="fas fa-heart fa-3x text-danger"></i>
                        </div>
                        <h4 class="h5 text-center mb-3">Our Values</h4>
                        <p class="text-muted text-center">
                            Customer obsession, innovation, integrity, and excellence drive everything we do. 
                            We believe in building long-term relationships based on trust and value.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Why Choose Kashish World -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-lg bg-light">
                <div class="card-body p-5">
                    <div class="text-center mb-5">
                        <h2 class="h1 text-primary mb-3">Why Choose Kashish World?</h2>
                        <div class="divider mx-auto" style="width: 100px; height: 3px; background: linear-gradient(45deg, #007bff, #28a745);"></div>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6 col-lg-3">
                            <div class="benefit-item text-center">
                                <div class="benefit-icon mb-3">
                                    <i class="fas fa-percentage fa-2x text-primary"></i>
                                </div>
                                <h5 class="mb-2">Lowest Prices</h5>
                                <p class="text-muted small">Get the best deals on quality products with our unbeatable pricing strategy.</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="benefit-item text-center">
                                <div class="benefit-icon mb-3">
                                    <i class="fas fa-truck fa-2x text-success"></i>
                                </div>
                                <h5 class="mb-2">Free Delivery</h5>
                                <p class="text-muted small">Enjoy free shipping on all orders, delivered safely to your doorstep.</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="benefit-item text-center">
                                <div class="benefit-icon mb-3">
                                    <i class="fas fa-shield-alt fa-2x text-info"></i>
                                </div>
                                <h5 class="mb-2">Secure Shopping</h5>
                                <p class="text-muted small">Your data and transactions are protected with enterprise-grade security.</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="benefit-item text-center">
                                <div class="benefit-icon mb-3">
                                    <i class="fas fa-headset fa-2x text-warning"></i>
                                </div>
                                <h5 class="mb-2">24/7 Support</h5>
                                <p class="text-muted small">Our dedicated support team is always ready to assist you.</p>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-5">
                        <a href="{{ route('shop') }}" class="btn btn-primary btn-lg px-5 py-3">
                            <i class="fas fa-shopping-bag me-2"></i>Start Shopping Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.feature-box:hover {
    transform: translateY(-5px);
    transition: all 0.3s ease;
}

.social-btn {
    min-width: 150px;
    transition: all 0.3s ease;
}

.social-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}

.achievement-item {
    padding: 10px;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.achievement-item:hover {
    background-color: #f8f9fa;
    transform: translateX(10px);
}

.value-card:hover {
    transform: translateY(-10px);
    transition: all 0.3s ease;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

.benefit-item:hover {
    transform: scale(1.05);
    transition: all 0.3s ease;
}

.divider {
    border-radius: 2px;
}

@media (max-width: 768px) {
    .social-links {
        gap: 1rem !important;
    }
    
    .social-btn {
        min-width: 120px;
        padding: 0.5rem 1rem !important;
    }
    
    .display-4 {
        font-size: 2.5rem;
    }
}
</style>
@endsection

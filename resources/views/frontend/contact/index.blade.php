@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<div class="container py-5">
    <!-- Header Section -->
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1 class="display-4 fw-bold text-primary mb-3">Get In Touch</h1>
            <p class="lead text-muted">We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
            <div class="divider mx-auto" style="width: 100px; height: 3px; background: linear-gradient(45deg, #007bff, #28a745);"></div>
        </div>
    </div>

    <div class="row">
        <!-- Contact Information -->
        <div class="col-lg-4 mb-5">
            <div class="contact-info">
                <h3 class="h4 text-primary mb-4">Contact Information</h3>
                
                <div class="contact-item d-flex align-items-start mb-4">
                    <div class="contact-icon me-3">
                        <i class="fas fa-map-marker-alt fa-2x text-primary"></i>
                    </div>
                    <div class="contact-details">
                        <h5 class="mb-1">Our Address</h5>
                        <p class="text-muted mb-0">123 Business Street<br>New Delhi, India 110001</p>
                    </div>
                </div>

                <div class="contact-item d-flex align-items-start mb-4">
                    <div class="contact-icon me-3">
                        <i class="fas fa-phone fa-2x text-success"></i>
                    </div>
                    <div class="contact-details">
                        <h5 class="mb-1">Phone Number</h5>
                        <p class="text-muted mb-0">+91 123 456 7890</p>
                    </div>
                </div>

                <div class="contact-item d-flex align-items-start mb-4">
                    <div class="contact-icon me-3">
                        <i class="fas fa-envelope fa-2x text-info"></i>
                    </div>
                    <div class="contact-details">
                        <h5 class="mb-1">Email Address</h5>
                        <p class="text-muted mb-0">support@kashishworld.com</p>
                    </div>
                </div>

                <div class="contact-item d-flex align-items-start mb-4">
                    <div class="contact-icon me-3">
                        <i class="fas fa-clock fa-2x text-warning"></i>
                    </div>
                    <div class="contact-details">
                        <h5 class="mb-1">Business Hours</h5>
                        <p class="text-muted mb-0">
                            Monday - Friday: 9:00 AM - 6:00 PM<br>
                            Saturday: 10:00 AM - 4:00 PM<br>
                            Sunday: Closed
                        </p>
                    </div>
                </div>

                <!-- Social Media Links -->
                <div class="social-links mt-4">
                    <h5 class="mb-3">Follow Us</h5>
                    <div class="d-flex gap-3">
                        <a href="https://www.facebook.com/kashishsinghal" target="_blank" class="btn btn-outline-primary btn-sm social-btn">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.instagram.com/kashishsinghal" target="_blank" class="btn btn-outline-danger btn-sm social-btn">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/kashishsinghal" target="_blank" class="btn btn-outline-info btn-sm social-btn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="https://www.twitter.com/kashishsinghal" target="_blank" class="btn btn-outline-secondary btn-sm social-btn">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h3 class="h4 mb-0"><i class="fas fa-paper-plane me-2"></i>Send us a Message</h3>
                </div>
                <div class="card-body p-5">
                    <form id="contactForm" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="name" class="form-label fw-bold">Full Name <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-user text-primary"></i></span>
                                    <input type="text" class="form-control" id="name" name="name" required placeholder="Enter your full name">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="email" class="form-label fw-bold">Email Address <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-envelope text-primary"></i></span>
                                    <input type="email" class="form-control" id="email" name="email" required placeholder="Enter your email address">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="phone" class="form-label fw-bold">Phone Number</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-phone text-primary"></i></span>
                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="subject" class="form-label fw-bold">Subject <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-tag text-primary"></i></span>
                                    <select class="form-select" id="subject" name="subject" required>
                                        <option value="">Select a subject</option>
                                        <option value="General Inquiry">General Inquiry</option>
                                        <option value="Product Support">Product Support</option>
                                        <option value="Order Issue">Order Issue</option>
                                        <option value="Return/Refund">Return/Refund</option>
                                        <option value="Technical Support">Technical Support</option>
                                        <option value="Partnership">Partnership</option>
                                        <option value="Feedback">Feedback</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="message" class="form-label fw-bold">Message <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light align-self-start pt-3"><i class="fas fa-comment text-primary"></i></span>
                                <textarea class="form-control" id="message" name="message" rows="6" required 
                                          placeholder="Please describe your inquiry in detail..."></textarea>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="form-text">Maximum 2000 characters</div>
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="privacy" required>
                                <label class="form-check-label" for="privacy">
                                    I agree to the <a href="{{ route('legal.terms') }}" target="_blank">Terms & Conditions</a> 
                                    and <a href="{{ route('legal.privacy') }}" target="_blank">Privacy Policy</a> <span class="text-danger">*</span>
                                </label>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg py-3" id="submitBtn">
                                <span class="btn-text">
                                    <i class="fas fa-paper-plane me-2"></i>Send Message
                                </span>
                                <span class="btn-loading d-none">
                                    <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                                    Sending...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="row mt-5 pt-5">
        <div class="col-12">
            <div class="text-center mb-5">
                <h2 class="h1 text-primary mb-3">Frequently Asked Questions</h2>
                <div class="divider mx-auto" style="width: 100px; height: 3px; background: linear-gradient(45deg, #007bff, #28a745);"></div>
            </div>

            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="faq-item p-4 h-100 border rounded-3 shadow-sm">
                        <h5 class="text-primary mb-3"><i class="fas fa-question-circle me-2"></i>How long does shipping take?</h5>
                        <p class="text-muted mb-0">We offer free shipping on all orders! Delivery typically takes 3-7 business days depending on your location.</p>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="faq-item p-4 h-100 border rounded-3 shadow-sm">
                        <h5 class="text-primary mb-3"><i class="fas fa-question-circle me-2"></i>What is your return policy?</h5>
                        <p class="text-muted mb-0">We offer a 30-day return policy. Items must be in original condition with all packaging and tags.</p>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="faq-item p-4 h-100 border rounded-3 shadow-sm">
                        <h5 class="text-primary mb-3"><i class="fas fa-question-circle me-2"></i>How can I track my order?</h5>
                        <p class="text-muted mb-0">Once your order ships, you'll receive a tracking number via email. You can also check your order status in your account.</p>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="faq-item p-4 h-100 border rounded-3 shadow-sm">
                        <h5 class="text-primary mb-3"><i class="fas fa-question-circle me-2"></i>Do you offer customer support?</h5>
                        <p class="text-muted mb-0">Yes! Our customer support team is available Monday-Friday 9AM-6PM. Contact us anytime and we'll respond within 24 hours.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.contact-icon {
    width: 60px;
    text-align: center;
}

.contact-item:hover {
    transform: translateX(10px);
    transition: all 0.3s ease;
}

.social-btn {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.social-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}

.form-control:focus, .form-select:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.input-group-text {
    border-color: #dee2e6;
}

.btn-primary {
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
}

.faq-item:hover {
    transform: translateY(-5px);
    transition: all 0.3s ease;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

.divider {
    border-radius: 2px;
}

@media (max-width: 768px) {
    .contact-item {
        margin-bottom: 2rem;
    }
    
    .social-links .d-flex {
        justify-content: center;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    const submitBtn = document.getElementById('submitBtn');
    const btnText = submitBtn.querySelector('.btn-text');
    const btnLoading = submitBtn.querySelector('.btn-loading');

    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        // Reset previous validation states
        clearValidation();

        // Show loading state
        submitBtn.disabled = true;
        btnText.classList.add('d-none');
        btnLoading.classList.remove('d-none');

        const formData = new FormData(form);

        try {
            const response = await fetch('{{ route("contact.store") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            const data = await response.json();

            if (data.success) {
                // Show success message
                Swal.fire({
                    icon: 'success',
                    title: 'Message Sent!',
                    text: data.message,
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#007bff'
                });

                // Reset form
                form.reset();
            } else {
                if (data.errors) {
                    showValidationErrors(data.errors);
                } else {
                    throw new Error(data.message || 'Something went wrong');
                }
            }
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message || 'Something went wrong. Please try again.',
                confirmButtonText: 'OK',
                confirmButtonColor: '#dc3545'
            });
        } finally {
            // Reset button state
            submitBtn.disabled = false;
            btnText.classList.remove('d-none');
            btnLoading.classList.add('d-none');
        }
    });

    function showValidationErrors(errors) {
        for (const [field, messages] of Object.entries(errors)) {
            const input = document.querySelector(`[name="${field}"]`);
            if (input) {
                input.classList.add('is-invalid');
                const feedback = input.parentElement.querySelector('.invalid-feedback');
                if (feedback) {
                    feedback.textContent = messages[0];
                }
            }
        }
    }

    function clearValidation() {
        const inputs = form.querySelectorAll('.form-control, .form-select, .form-check-input');
        inputs.forEach(input => {
            input.classList.remove('is-invalid');
            const feedback = input.parentElement.querySelector('.invalid-feedback');
            if (feedback) {
                feedback.textContent = '';
            }
        });
    }

    // Real-time validation
    const inputs = form.querySelectorAll('.form-control, .form-select, .form-check-input');
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            if (this.classList.contains('is-invalid')) {
                this.classList.remove('is-invalid');
                const feedback = this.parentElement.querySelector('.invalid-feedback');
                if (feedback) {
                    feedback.textContent = '';
                }
            }
        });
    });
});
</script>
@endsection

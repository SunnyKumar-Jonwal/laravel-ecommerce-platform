@extends('layouts.app')

@section('title', 'Terms & Conditions')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h1 class="h3 mb-0">Terms & Conditions</h1>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4"><strong>Last updated:</strong> {{ date('F d, Y') }}</p>
                    
                    <div class="legal-content">
                        <section class="mb-4">
                            <h2 class="h4 text-primary">1. Acceptance of Terms</h2>
                            <p>By accessing and using our e-commerce website, you accept and agree to be bound by the terms and provision of this agreement. These Terms and Conditions govern your use of our website, products, and services.</p>
                        </section>

                        <section class="mb-4">
                            <h2 class="h4 text-primary">2. Use License</h2>
                            <p>Permission is granted to temporarily download one copy of the materials on our website for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title, and under this license you may not:</p>
                            <ul>
                                <li>modify or copy the materials</li>
                                <li>use the materials for any commercial purpose or for any public display (commercial or non-commercial)</li>
                                <li>attempt to decompile or reverse engineer any software contained on our website</li>
                                <li>remove any copyright or other proprietary notations from the materials</li>
                            </ul>
                        </section>

                        <section class="mb-4">
                            <h2 class="h4 text-primary">3. User Accounts</h2>
                            <p>When you create an account with us, you must provide information that is accurate, complete, and current at all times. You are responsible for safeguarding the password and for all activities that occur under your account.</p>
                            <ul>
                                <li>You must be at least 18 years old to create an account</li>
                                <li>You are responsible for maintaining the confidentiality of your account credentials</li>
                                <li>You agree to immediately notify us of any unauthorized use of your account</li>
                                <li>We reserve the right to suspend or terminate accounts that violate these terms</li>
                            </ul>
                        </section>

                        <section class="mb-4">
                            <h2 class="h4 text-primary">4. Products and Services</h2>
                            <p>All products and services are subject to availability. We reserve the right to discontinue any product at any time. Prices for our products are subject to change without notice.</p>
                            <ul>
                                <li>Product descriptions and images are for informational purposes and may vary</li>
                                <li>We do not warrant that product descriptions or other content is accurate, complete, reliable, current, or error-free</li>
                                <li>We reserve the right to limit quantities purchased per person, per household, or per order</li>
                            </ul>
                        </section>

                        <section class="mb-4">
                            <h2 class="h4 text-primary">5. Orders and Payment</h2>
                            <p>By placing an order, you agree to provide current, complete, and accurate purchase and account information for all purchases made through our website.</p>
                            <ul>
                                <li>All orders are subject to acceptance by us</li>
                                <li>We reserve the right to refuse or cancel any order for any reason</li>
                                <li>Payment must be received by us before shipment of any products</li>
                                <li>Prices are listed in INR and include applicable taxes unless stated otherwise</li>
                            </ul>
                        </section>

                        <section class="mb-4">
                            <h2 class="h4 text-primary">6. Shipping and Delivery</h2>
                            <p>We will make every effort to deliver products within the timeframe specified, but delivery times are estimates and not guaranteed.</p>
                            <ul>
                                <li>Shipping costs are calculated at checkout based on your location and order value</li>
                                <li>Risk of loss and title for products pass to you upon delivery to the carrier</li>
                                <li>You are responsible for providing accurate shipping information</li>
                                <li>We are not responsible for delays caused by shipping carriers or customs</li>
                            </ul>
                        </section>

                        <section class="mb-4">
                            <h2 class="h4 text-primary">7. Returns and Refunds</h2>
                            <p>We want you to be satisfied with your purchase. Our return policy allows returns within 30 days of purchase for most items.</p>
                            <ul>
                                <li>Items must be returned in original condition with all packaging and tags</li>
                                <li>Custom or personalized items may not be returned</li>
                                <li>Return shipping costs are the responsibility of the customer unless the item was defective</li>
                                <li>Refunds will be processed within 5-10 business days after we receive your return</li>
                            </ul>
                        </section>

                        <section class="mb-4">
                            <h2 class="h4 text-primary">8. Privacy Policy</h2>
                            <p>Your privacy is important to us. Please review our Privacy Policy, which also governs your use of the website, to understand our practices.</p>
                        </section>

                        <section class="mb-4">
                            <h2 class="h4 text-primary">9. Prohibited Uses</h2>
                            <p>You may not use our website for any unlawful purpose or to solicit others to perform unlawful acts. You may not transmit any worms or viruses or any code of a destructive nature.</p>
                            <ul>
                                <li>Violate any applicable laws or regulations</li>
                                <li>Infringe upon or violate our intellectual property rights or the intellectual property rights of others</li>
                                <li>Submit false or misleading information</li>
                                <li>Engage in any conduct that restricts or inhibits anyone's use or enjoyment of the website</li>
                            </ul>
                        </section>

                        <section class="mb-4">
                            <h2 class="h4 text-primary">10. Intellectual Property</h2>
                            <p>The website and its original content, features, and functionality are and will remain the exclusive property of our company and its licensors. The website is protected by copyright, trademark, and other laws.</p>
                        </section>

                        <section class="mb-4">
                            <h2 class="h4 text-primary">11. Disclaimer</h2>
                            <p>The information on this website is provided on an "as is" basis. To the fullest extent permitted by law, this company:</p>
                            <ul>
                                <li>excludes all representations and warranties relating to this website and its contents</li>
                                <li>excludes all liability for damages arising out of or in connection with your use of this website</li>
                            </ul>
                        </section>

                        <section class="mb-4">
                            <h2 class="h4 text-primary">12. Limitation of Liability</h2>
                            <p>In no event shall our company, nor its directors, employees, partners, agents, suppliers, or affiliates, be liable for any indirect, incidental, special, consequential, or punitive damages, including without limitation, loss of profits, data, use, goodwill, or other intangible losses, resulting from your use of the website or services.</p>
                        </section>

                        <section class="mb-4">
                            <h2 class="h4 text-primary">13. Governing Law</h2>
                            <p>These Terms shall be interpreted and governed by the laws of India, without regard to its conflict of law provisions. Our failure to enforce any right or provision of these Terms will not be considered a waiver of those rights.</p>
                        </section>

                        <section class="mb-4">
                            <h2 class="h4 text-primary">14. Changes to Terms</h2>
                            <p>We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a revision is material, we will try to provide at least 30 days notice prior to any new terms taking effect.</p>
                        </section>

                        <section class="mb-4">
                            <h2 class="h4 text-primary">15. Contact Information</h2>
                            <p>If you have any questions about these Terms & Conditions, please contact us:</p>
                            <ul class="list-unstyled">
                                <li><strong>Email:</strong> support@yourstore.com</li>
                                <li><strong>Phone:</strong> +91 123 456 7890</li>
                                <li><strong>Address:</strong> 123 Business Street, City, State 12345, India</li>
                            </ul>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.legal-content {
    line-height: 1.6;
}

.legal-content h2 {
    margin-top: 2rem;
    margin-bottom: 1rem;
    border-bottom: 2px solid #007bff;
    padding-bottom: 0.5rem;
}

.legal-content ul {
    margin-bottom: 1rem;
}

.legal-content li {
    margin-bottom: 0.5rem;
}

.legal-content section:first-child h2 {
    margin-top: 0;
}
</style>
@endsection

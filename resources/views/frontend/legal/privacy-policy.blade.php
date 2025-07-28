@extends('layouts.app')

@section('title', 'Privacy Policy')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h1 class="h3 mb-0">Privacy Policy</h1>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4"><strong>Last updated:</strong> {{ date('F d, Y') }}</p>
                    
                    <div class="legal-content">
                        <section class="mb-4">
                            <h2 class="h4 text-primary">1. Introduction</h2>
                            <p>We respect your privacy and are committed to protecting your personal data. This privacy policy will inform you about how we look after your personal data when you visit our website and tell you about your privacy rights and how the law protects you.</p>
                            <p>This privacy policy is provided in a layered format so you can click through to the specific areas set out below.</p>
                        </section>

                        <section class="mb-4">
                            <h2 class="h4 text-primary">2. Important Information and Who We Are</h2>
                            <h3 class="h5">Purpose of this Privacy Policy</h3>
                            <p>This privacy policy aims to give you information on how we collect and process your personal data through your use of this website, including any data you may provide through this website when you sign up to our newsletter, purchase a product or service, or take part in a competition.</p>
                            
                            <h3 class="h5">Controller</h3>
                            <p>We are the controller and responsible for your personal data (collectively referred to as "we", "us" or "our" in this privacy policy).</p>
                            
                            <h3 class="h5">Contact Details</h3>
                            <ul class="list-unstyled">
                                <li><strong>Email address:</strong> privacy@yourstore.com</li>
                                <li><strong>Postal address:</strong> 123 Business Street, City, State 12345, India</li>
                                <li><strong>Telephone number:</strong> +91 123 456 7890</li>
                            </ul>
                        </section>

                        <section class="mb-4">
                            <h2 class="h4 text-primary">3. The Data We Collect About You</h2>
                            <p>Personal data, or personal information, means any information about an individual from which that person can be identified. We may collect, use, store and transfer different kinds of personal data about you which we have grouped together as follows:</p>
                            
                            <ul>
                                <li><strong>Identity Data:</strong> includes first name, maiden name, last name, username or similar identifier, marital status, title, date of birth and gender</li>
                                <li><strong>Contact Data:</strong> includes billing address, delivery address, email address and telephone numbers</li>
                                <li><strong>Financial Data:</strong> includes bank account and payment card details</li>
                                <li><strong>Transaction Data:</strong> includes details about payments to and from you and other details of products and services you have purchased from us</li>
                                <li><strong>Technical Data:</strong> includes internet protocol (IP) address, your login data, browser type and version, time zone setting and location, browser plug-in types and versions, operating system and platform, and other technology on the devices you use to access this website</li>
                                <li><strong>Profile Data:</strong> includes your username and password, purchases or orders made by you, your interests, preferences, feedback and survey responses</li>
                                <li><strong>Usage Data:</strong> includes information about how you use our website, products and services</li>
                                <li><strong>Marketing and Communications Data:</strong> includes your preferences in receiving marketing from us and our third parties and your communication preferences</li>
                            </ul>
                        </section>

                        <section class="mb-4">
                            <h2 class="h4 text-primary">4. How Is Your Personal Data Collected?</h2>
                            <p>We use different methods to collect data from and about you including through:</p>
                            
                            <h3 class="h5">Direct interactions</h3>
                            <p>You may give us your Identity, Contact and Financial Data by filling in forms or by corresponding with us by post, phone, email or otherwise. This includes personal data you provide when you:</p>
                            <ul>
                                <li>apply for our products or services</li>
                                <li>create an account on our website</li>
                                <li>subscribe to our service or publications</li>
                                <li>request marketing to be sent to you</li>
                                <li>enter a competition, promotion or survey</li>
                                <li>give us feedback or contact us</li>
                            </ul>
                            
                            <h3 class="h5">Automated technologies or interactions</h3>
                            <p>As you interact with our website, we will automatically collect Technical Data about your equipment, browsing actions and patterns. We collect this personal data by using cookies, server logs and other similar technologies.</p>
                            
                            <h3 class="h5">Third parties or publicly available sources</h3>
                            <p>We will receive personal data about you from various third parties and public sources as set out below:</p>
                            <ul>
                                <li>Technical Data from analytics providers such as Google based outside the EU</li>
                                <li>Contact, Financial and Transaction Data from providers of technical, payment and delivery services</li>
                                <li>Identity and Contact Data from data brokers or aggregators</li>
                                <li>Identity and Contact Data from publicly available sources</li>
                            </ul>
                        </section>

                        <section class="mb-4">
                            <h2 class="h4 text-primary">5. How We Use Your Personal Data</h2>
                            <p>We will only use your personal data when the law allows us to. Most commonly, we will use your personal data in the following circumstances:</p>
                            <ul>
                                <li>Where we need to perform the contract we are about to enter into or have entered into with you</li>
                                <li>Where it is necessary for our legitimate interests (or those of a third party) and your interests and fundamental rights do not override those interests</li>
                                <li>Where we need to comply with a legal obligation</li>
                            </ul>
                            
                            <h3 class="h5">Purposes for which we will use your personal data:</h3>
                            <ul>
                                <li><strong>To register you as a new customer:</strong> Identity, Contact</li>
                                <li><strong>To process and deliver your order:</strong> Identity, Contact, Financial, Transaction, Marketing and Communications</li>
                                <li><strong>To manage our relationship with you:</strong> Identity, Contact, Profile, Marketing and Communications</li>
                                <li><strong>To enable you to partake in a prize draw, competition or complete a survey:</strong> Identity, Contact, Profile, Usage, Marketing and Communications</li>
                                <li><strong>To administer and protect our business and this website:</strong> Identity, Contact, Technical</li>
                                <li><strong>To deliver relevant website content and advertisements to you and measure or understand the effectiveness of the advertising we serve to you:</strong> Identity, Contact, Profile, Usage, Marketing and Communications, Technical</li>
                                <li><strong>To use data analytics to improve our website, products/services, marketing, customer relationships and experiences:</strong> Technical, Usage</li>
                                <li><strong>To make suggestions and recommendations to you about goods or services that may be of interest to you:</strong> Identity, Contact, Technical, Usage, Profile, Marketing and Communications</li>
                            </ul>
                        </section>

                        <section class="mb-4">
                            <h2 class="h4 text-primary">6. Disclosures of Your Personal Data</h2>
                            <p>We may share your personal data with the parties set out below for the purposes set out in the table above:</p>
                            <ul>
                                <li>Internal Third Parties</li>
                                <li>External Third Parties including:
                                    <ul>
                                        <li>Service providers who provide IT and system administration services</li>
                                        <li>Professional advisers including lawyers, bankers, auditors and insurers</li>
                                        <li>Government bodies that require reporting of processing activities</li>
                                        <li>Payment processors</li>
                                        <li>Shipping and logistics providers</li>
                                    </ul>
                                </li>
                                <li>Third parties to whom we may choose to sell, transfer or merge parts of our business or our assets</li>
                            </ul>
                            
                            <p>We require all third parties to respect the security of your personal data and to treat it in accordance with the law. We do not allow our third-party service providers to use your personal data for their own purposes and only permit them to process your personal data for specified purposes and in accordance with our instructions.</p>
                        </section>

                        <section class="mb-4">
                            <h2 class="h4 text-primary">7. International Transfers</h2>
                            <p>We share your personal data within our group of companies. This will involve transferring your data outside India. Many of our external third parties are also based outside India so their processing of your personal data will involve a transfer of data outside India.</p>
                            <p>Whenever we transfer your personal data out of India, we ensure a similar degree of protection is afforded to it by ensuring appropriate safeguards are implemented.</p>
                        </section>

                        <section class="mb-4">
                            <h2 class="h4 text-primary">8. Data Security</h2>
                            <p>We have put in place appropriate security measures to prevent your personal data from being accidentally lost, used or accessed in an unauthorised way, altered or disclosed. In addition, we limit access to your personal data to those employees, agents, contractors and other third parties who have a business need to know.</p>
                            <p>We have put in place procedures to deal with any suspected personal data breach and will notify you and any applicable regulator of a breach where we are legally required to do so.</p>
                        </section>

                        <section class="mb-4">
                            <h2 class="h4 text-primary">9. Data Retention</h2>
                            <p>We will only retain your personal data for as long as reasonably necessary to fulfil the purposes we collected it for, including for the purposes of satisfying any legal, regulatory, tax, accounting or reporting requirements.</p>
                            <p>To determine the appropriate retention period for personal data, we consider the amount, nature and sensitivity of the personal data, the potential risk of harm from unauthorised use or disclosure of your personal data, the purposes for which we process your personal data and whether we can achieve those purposes through other means, and the applicable legal, regulatory, tax, accounting or other requirements.</p>
                        </section>

                        <section class="mb-4">
                            <h2 class="h4 text-primary">10. Your Legal Rights</h2>
                            <p>Under certain circumstances, you have rights under data protection laws in relation to your personal data:</p>
                            <ul>
                                <li><strong>Request access</strong> to your personal data</li>
                                <li><strong>Request correction</strong> of your personal data</li>
                                <li><strong>Request erasure</strong> of your personal data</li>
                                <li><strong>Object to processing</strong> of your personal data</li>
                                <li><strong>Request restriction of processing</strong> your personal data</li>
                                <li><strong>Request transfer</strong> of your personal data</li>
                                <li><strong>Right to withdraw consent</strong></li>
                            </ul>
                            
                            <p>If you wish to exercise any of the rights set out above, please contact us using the details provided in section 2.</p>
                        </section>

                        <section class="mb-4">
                            <h2 class="h4 text-primary">11. Cookies</h2>
                            <p>Our website uses cookies to distinguish you from other users of our website. This helps us to provide you with a good experience when you browse our website and also allows us to improve our site.</p>
                            <p>A cookie is a small file of letters and numbers that we store on your browser or the hard drive of your computer if you agree. Cookies contain information that is transferred to your computer's hard drive.</p>
                            
                            <h3 class="h5">We use the following cookies:</h3>
                            <ul>
                                <li><strong>Strictly necessary cookies:</strong> These are cookies that are required for the operation of our website</li>
                                <li><strong>Analytical/performance cookies:</strong> They allow us to recognise and count the number of visitors and to see how visitors move around our website when they are using it</li>
                                <li><strong>Functionality cookies:</strong> These are used to recognise you when you return to our website</li>
                                <li><strong>Targeting cookies:</strong> These cookies record your visit to our website, the pages you have visited and the links you have followed</li>
                            </ul>
                        </section>

                        <section class="mb-4">
                            <h2 class="h4 text-primary">12. Changes to the Privacy Policy</h2>
                            <p>We keep our privacy policy under regular review and will place any updates on this web page. This privacy policy was last updated on {{ date('F d, Y') }}.</p>
                        </section>

                        <section class="mb-4">
                            <h2 class="h4 text-primary">13. Contact Us</h2>
                            <p>If you have any questions about this privacy policy or our privacy practices, please contact us:</p>
                            <ul class="list-unstyled">
                                <li><strong>Email:</strong> privacy@yourstore.com</li>
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

.legal-content h3 {
    margin-top: 1.5rem;
    margin-bottom: 1rem;
    color: #495057;
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

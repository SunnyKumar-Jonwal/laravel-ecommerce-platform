<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LegalController extends Controller
{
    /**
     * Display the Terms & Conditions page.
     */
    public function termsAndConditions()
    {
        return view('frontend.legal.terms-and-conditions');
    }

    /**
     * Display the Privacy Policy page.
     */
    public function privacyPolicy()
    {
        return view('frontend.legal.privacy-policy');
    }

    /**
     * Display the About Us page.
     */
    public function aboutUs()
    {
        return view('frontend.legal.about-us');
    }

    /**
     * Display the Contact Us page.
     */
    public function contactUs()
    {
        return view('frontend.contact.index');
    }
}

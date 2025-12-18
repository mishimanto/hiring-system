<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\OpenJob;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
// use App\Mail\ContactMessage;
use App\Models\ContactMessage;

class PageController extends Controller
{
    /**
     * Show About Us page
     */
    public function about()
    {
        $settings = Setting::whereIn('key', [
            'site_name',
            'about_us',
            'meta_title',
            'meta_description',
            'meta_keywords'
        ])->pluck('value', 'key');
        
        return view('pages.about', [
            'site_name' => $settings['site_name'] ?? config('app.name'),
            'content' => $settings['about_us'] ?? '',
            'meta_title' => $settings['meta_title'] ?? 'About Us',
            'meta_description' => $settings['meta_description'] ?? '',
            'meta_keywords' => $settings['meta_keywords'] ?? ''
        ], $this->sharedData());
    }

    /**
     * Show Terms & Conditions page
     */
    public function terms()
    {
        $settings = Setting::whereIn('key', [
            'site_name',
            'terms_conditions',
            'meta_title',
            'meta_description',
            'meta_keywords'
        ])->pluck('value', 'key');
        
        return view('pages.terms', [
            'site_name' => $settings['site_name'] ?? config('app.name'),
            'content' => $settings['terms_conditions'] ?? '',
            'meta_title' => $settings['meta_title'] ?? 'Terms & Conditions',
            'meta_description' => $settings['meta_description'] ?? '',
            'meta_keywords' => $settings['meta_keywords'] ?? ''
        ]);
    }

    /**
     * Show Privacy Policy page
     */
public function privacy()
{
    $settings = Setting::whereIn('key', [
        'site_name',
        'privacy_policy',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'contact_email',  // যোগ করুন
        'contact_phone'   // যোগ করুন
    ])->pluck('value', 'key');
    
    return view('pages.privacy', [
        'site_name' => $settings['site_name'] ?? config('app.name'),
        'privacy_policy' => $settings['privacy_policy'] ?? '',
        'content' => $settings['privacy_policy'] ?? '',
        'contact_email' => $settings['contact_email'] ?? '',  // যোগ করুন
        'contact_phone' => $settings['contact_phone'] ?? '',  // যোগ করুন
        'meta_title' => $settings['meta_title'] ?? 'Privacy Policy',
        'meta_description' => $settings['meta_description'] ?? '',
        'meta_keywords' => $settings['meta_keywords'] ?? ''
    ]);
}

    /**
     * Show Contact Us page
     */
    public function contact()
    {
        $settings = Setting::whereIn('key', [
            'site_name',
            'contact_phone',
            'contact_email',
            'contact_address',
            'meta_title',
            'meta_description',
            'meta_keywords',
            'facebook_url',
            'twitter_url',
            'instagram_url',
            'linkedin_url'
        ])->pluck('value', 'key');

        return view('pages.contact', [
            'site_name'        => $settings['site_name'] ?? config('app.name'),
            'contact_phone'    => $settings['contact_phone'] ?? '',
            'contact_email'    => $settings['contact_email'] ?? '',
            'contact_address'  => $settings['contact_address'] ?? '',
            'meta_title'       => $settings['meta_title'] ?? 'Contact Us',
            'meta_description' => $settings['meta_description'] ?? '',
            'meta_keywords'    => $settings['meta_keywords'] ?? '',
            'social_links' => [
                'facebook'  => $settings['facebook_url'] ?? '',
                'twitter'   => $settings['twitter_url'] ?? '',
                'instagram' => $settings['instagram_url'] ?? '',
                'linkedin'  => $settings['linkedin_url'] ?? '',
            ],
        ]);
    }


    /**
     * Handle contact form submission
     */
    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10'
        ]);

        // Save to database
        ContactMessage::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
            'status' => 'unread'
        ]);

        // Optional: Send email notification
        // $this->sendEmailNotification($validated);

        return redirect()->route('contact')
            ->with('success', 'Thank you for your message! We have received it and will get back to you soon.');
    }

    private function sharedData()
    {
        return [
            'activeJobsCount' => OpenJob::where('status', 'approved')
                ->where('is_active', 1)
                ->whereDate('deadline', '>=', now())
                ->count(),

            'usersCount' => User::where('is_active', 1)    // active users
                ->where('role', '!=', 'admin') // exclude admin
                ->count(),

            'companiesCount' => User::whereNotNull('company_name') 
                ->where('is_active', 1)     
                ->where('role', '!=', 'admin') 
                ->count()

        ];
    }

}
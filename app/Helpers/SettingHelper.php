<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

if (!function_exists('setting')) {
    function setting($key, $default = null)
    {
        try {
            return Cache::rememberForever('setting_' . $key, function () use ($key, $default) {
                $setting = Setting::where('key', $key)->first();
                return $setting ? $setting->value : $default;
            });
        } catch (\Exception $e) {
            return $default;
        }
    }
}

if (!function_exists('site_name')) {
    function site_name()
    {
        return setting('site_name', 'Job Portal');
    }
}

if (!function_exists('site_logo')) {
    function site_logo()
    {
        $logo = setting('site_logo');
        return $logo ? asset('storage/' . $logo) : asset('images/logo.png');
    }
}

if (!function_exists('site_favicon')) {
    function site_favicon()
    {
        $favicon = setting('site_favicon');
        return $favicon ? asset('storage/' . $favicon) : asset('images/favicon.ico');
    }
}

if (!function_exists('contact_info')) {
    function contact_info()
    {
        return [
            'phone' => setting('contact_phone'),
            'email' => setting('contact_email'),
            'address' => setting('contact_address')
        ];
    }
}

if (!function_exists('social_links')) {
    function social_links()
    {
        return [
            'facebook' => setting('facebook_url'),
            'twitter' => setting('twitter_url'),
            'linkedin' => setting('linkedin_url'),
            'instagram' => setting('instagram_url')
        ];
    }
}
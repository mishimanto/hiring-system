<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('text'); // text, textarea, image, email, phone, address
            $table->string('group')->default('general');
            $table->text('description')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // ডিফল্ট সেটিংস ইনসার্ট
        $this->insertDefaultSettings();
    }

    private function insertDefaultSettings(): void
    {
        $settings = [
            [
                'key' => 'site_name',
                'value' => 'Job Portal',
                'type' => 'text',
                'group' => 'general',
                'description' => 'Website Name',
                'order' => 1
            ],
            [
                'key' => 'site_logo',
                'value' => null,
                'type' => 'image',
                'group' => 'general',
                'description' => 'Website Logo',
                'order' => 2
            ],
            [
                'key' => 'site_favicon',
                'value' => null,
                'type' => 'image',
                'group' => 'general',
                'description' => 'Website Favicon',
                'order' => 3
            ],
            [
                'key' => 'contact_phone',
                'value' => '+8801XXXXXXXXX',
                'type' => 'phone',
                'group' => 'contact',
                'description' => 'Contact Phone Number',
                'order' => 4
            ],
            [
                'key' => 'contact_email',
                'value' => 'info@example.com',
                'type' => 'email',
                'group' => 'contact',
                'description' => 'Contact Email Address',
                'order' => 5
            ],
            [
                'key' => 'contact_address',
                'value' => 'Dhaka, Bangladesh',
                'type' => 'textarea',
                'group' => 'contact',
                'description' => 'Physical Address',
                'order' => 6
            ],
            [
                'key' => 'terms_conditions',
                'value' => '<h3>Terms & Conditions</h3><p>Please read these terms carefully...</p>',
                'type' => 'textarea',
                'group' => 'legal',
                'description' => 'Terms and Conditions Content',
                'order' => 7
            ],
            [
                'key' => 'privacy_policy',
                'value' => '<h3>Privacy Policy</h3><p>Your privacy is important to us...</p>',
                'type' => 'textarea',
                'group' => 'legal',
                'description' => 'Privacy Policy Content',
                'order' => 8
            ],
            [
                'key' => 'about_us',
                'value' => '<h3>About Us</h3><p>Welcome to our job portal...</p>',
                'type' => 'textarea',
                'group' => 'general',
                'description' => 'About Us Content',
                'order' => 9
            ],
            [
                'key' => 'facebook_url',
                'value' => 'https://facebook.com',
                'type' => 'text',
                'group' => 'social',
                'description' => 'Facebook Page URL',
                'order' => 10
            ],
            [
                'key' => 'twitter_url',
                'value' => 'https://twitter.com',
                'type' => 'text',
                'group' => 'social',
                'description' => 'Twitter Profile URL',
                'order' => 11
            ],
            [
                'key' => 'linkedin_url',
                'value' => 'https://linkedin.com',
                'type' => 'text',
                'group' => 'social',
                'description' => 'LinkedIn Profile URL',
                'order' => 12
            ],
            [
                'key' => 'instagram_url',
                'value' => 'https://instagram.com',
                'type' => 'text',
                'group' => 'social',
                'description' => 'Instagram Profile URL',
                'order' => 13
            ],
            [
                'key' => 'meta_title',
                'value' => 'Job Portal - Find Your Dream Job',
                'type' => 'text',
                'group' => 'seo',
                'description' => 'Website Meta Title',
                'order' => 14
            ],
            [
                'key' => 'meta_description',
                'value' => 'Find your dream job with our job portal',
                'type' => 'textarea',
                'group' => 'seo',
                'description' => 'Website Meta Description',
                'order' => 15
            ],
            [
                'key' => 'meta_keywords',
                'value' => 'job, career, employment, bangladesh',
                'type' => 'text',
                'group' => 'seo',
                'description' => 'Website Meta Keywords',
                'order' => 16
            ]
        ];

        DB::table('settings')->insert($settings);
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
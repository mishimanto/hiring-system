<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@jobportal.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Create sample employer
        User::create([
            'name' => 'Tech Solutions Inc.',
            'email' => 'employer@tech.com',
            'password' => Hash::make('password'),
            'role' => 'employer',
            'company_name' => 'Tech Solutions Inc.',
            'industry' => 'Information Technology',
            'website' => 'https://techsolutions.com',
            'phone' => '+1 234 567 8900',
            'email_verified_at' => now(),
        ]);

        // Create sample job seeker
        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'role' => 'job_seeker',
            'phone' => '+1 234 567 8901',
            'skills' => json_encode(['PHP', 'Laravel', 'MySQL', 'JavaScript']),
            'experience' => '5 years of web development experience',
            'education' => 'Bachelor of Computer Science',
            'email_verified_at' => now(),
        ]);
    }
}
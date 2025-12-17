<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\JobSeekerProfileController;
use App\Http\Controllers\SettingController; 
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;


// Public routes
Route::get('/', function () {
    $featuredJobs = \App\Models\OpenJob::where('status', 'approved')
        ->where('is_active', true)
        ->where('deadline', '>=', now())
        ->with('employer')
        ->latest()
        ->take(6)
        ->get();
    
    $categories = \App\Models\OpenJob::distinct('category')->pluck('category');

    $activeJobsCount = \App\Models\OpenJob::where('status', 'approved')
            ->where('is_active', 1)
            ->whereDate('deadline', '>=', now()->format('Y-m-d'))
            ->count();
    
    return view('home', compact('featuredJobs', 'categories', 'activeJobsCount'));
})->name('home');

// Public pages - এই ৩টি রাউট যোগ করুন
Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/terms', function () {
    return view('pages.terms');
})->name('terms');

Route::get('/privacy', function () {
    return view('pages.privacy');
})->name('privacy');

// Authentication routes (from Breeze)
require __DIR__.'/auth.php';

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/resume', [ProfileController::class, 'updateResume'])->name('profile.resume');
    Route::post('/profile/details', [ProfileController::class, 'updateProfileDetails'])->name('profile.details');
    
    // Applications
    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/{application}', [ApplicationController::class, 'show'])->name('applications.show');
    Route::patch('/applications/{application}/status', [ApplicationController::class, 'updateStatus'])->name('applications.status');
});

// Job Seeker specific routes
Route::middleware(['auth', 'role:job_seeker'])->group(function () {
    Route::post('/jobs/{openjob}/apply', [JobController::class, 'apply'])->name('jobs.apply');
    
});

// Employer specific routes
Route::middleware(['auth', 'role:employer'])->group(function () {
    Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/{openjob}/edit', [JobController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{openjob}', [JobController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{openjob}', [JobController::class, 'destroy'])->name('jobs.destroy');
    Route::get('/my-jobs', [JobController::class, 'myJobs'])->name('jobs.my-jobs');
    Route::get('/employer/applications', [ApplicationController::class, 'index'])->name('employer.applications');
});

// Admin specific routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::post('/jobs/{openjob}/approve', [JobController::class, 'approve'])->name('jobs.approve');
    Route::post('/jobs/{openjob}/reject', [JobController::class, 'reject'])->name('jobs.reject');
    
    // Admin management routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::get('/jobs', [AdminController::class, 'jobs'])->name('jobs');
        Route::put('/users/{user}/toggle', [AdminController::class, 'toggleUser'])->name('users.toggle');
        Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
        Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
        Route::post('/settings/clear-cache', [SettingController::class, 'clearCache'])->name('settings.clear-cache');
    });
});

// Job Seeker Profile Routes
Route::middleware(['auth', 'role:job_seeker'])->group(function () {
    // Profile Dashboard
    Route::get('/job-seeker/dashboard', [JobSeekerProfileController::class, 'dashboard'])
        ->name('job-seeker.dashboard');
    
    // Profile Management
    Route::prefix('/profile')->group(function () {
        // Basic Profile
        Route::get('/edit', [JobSeekerProfileController::class, 'edit'])
            ->name('job-seeker.profile.edit');
        
        Route::post('/basic', [JobSeekerProfileController::class, 'updateBasic'])
            ->name('job-seeker.profile.basic.update');
        
        Route::post('/preferences', [JobSeekerProfileController::class, 'updatePreferences'])
            ->name('job-seeker.profile.preferences.update');
        
        Route::post('/social-links', [JobSeekerProfileController::class, 'updateSocialLinks'])
            ->name('job-seeker.profile.social.update');
        
        Route::post('/visibility', [JobSeekerProfileController::class, 'updateVisibility'])
            ->name('job-seeker.profile.visibility.update');
        
        // Education CRUD
        Route::post('/education', [JobSeekerProfileController::class, 'storeEducation'])
            ->name('job-seeker.education.store');
        
        Route::put('/education/{education}', [JobSeekerProfileController::class, 'updateEducation'])
            ->name('job-seeker.education.update');
        
        Route::delete('/education/{education}', [JobSeekerProfileController::class, 'destroyEducation'])
            ->name('job-seeker.education.destroy');
        
        // Experience CRUD
        Route::post('/experience', [JobSeekerProfileController::class, 'storeExperience'])
            ->name('job-seeker.experience.store');
        
        Route::put('/experience/{experience}', [JobSeekerProfileController::class, 'updateExperience'])
            ->name('job-seeker.experience.update');
        
        Route::delete('/experience/{experience}', [JobSeekerProfileController::class, 'destroyExperience'])
            ->name('job-seeker.experience.destroy');
        
        // Project CRUD
        Route::post('/project', [JobSeekerProfileController::class, 'storeProject'])
            ->name('job-seeker.project.store');
        
        Route::put('/project/{project}', [JobSeekerProfileController::class, 'updateProject'])
            ->name('job-seeker.project.update');
        
        Route::delete('/project/{project}', [JobSeekerProfileController::class, 'destroyProject'])
            ->name('job-seeker.project.destroy');
        
        // Certification CRUDs
        Route::post('/certifications', [JobSeekerProfileController::class, 'storeCertification'])
            ->name('job-seeker.certification.store');

        Route::put('/certifications/{certification}', [JobSeekerProfileController::class, 'updateCertification'])
            ->name('job-seeker.certification.update');

        Route::delete('/certifications/{certification}', [JobSeekerProfileController::class, 'destroyCertification'])
            ->name('job-seeker.certification.destroy');
            
        // Profile Completion
        Route::get('/completion', [JobSeekerProfileController::class, 'getCompletion'])
            ->name('job-seeker.profile.completion');
    });
});

// Public profile view
Route::get('/job-seeker/{user}/profile', [JobSeekerProfileController::class, 'showPublic'])
    ->name('job-seeker.profile.public');

// Static Pages
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{openjob}', [JobController::class, 'show'])->name('jobs.show');


Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/terms', [PageController::class, 'terms'])->name('terms');
Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'submitContact'])->name('contact.submit');
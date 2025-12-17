<?php

namespace App\Http\Controllers;

use App\Models\JobSeekerProfile;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Certification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JobSeekerProfileController extends Controller
{
    // Show profile dashboard
    public function dashboard()
    {
        $user = Auth::user();
        $profile = $user->jobSeekerProfile;
        
        if (!$profile) {
            $profile = JobSeekerProfile::create([
                'user_id' => $user->id,
                'profile_completion' => 0
            ]);
        }

        return view('job-seeker.dashboard', compact('user', 'profile'));
    }

    // Show profile edit form
    public function edit()
    {
        $user = Auth::user();
        $profile = $user->jobSeekerProfile ?? new JobSeekerProfile();
        
        return view('job-seeker.profile.edit', compact('user', 'profile'));
    }

    // Update basic profile
    public function updateBasic(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'professional_title' => 'nullable|string|max:255',
            'summary' => 'nullable|string|max:1000',
            'experience_level' => 'nullable|in:fresher,junior,mid,senior',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'languages' => 'nullable|string',
        ]);

        $profile = $user->jobSeekerProfile ?? new JobSeekerProfile();
        
        if (!$profile->exists) {
            $profile->user_id = $user->id;
        }

        $profile->professional_title = $request->professional_title;
        $profile->summary = $request->summary;
        $profile->experience_level = $request->experience_level;
        $profile->date_of_birth = $request->date_of_birth;
        $profile->gender = $request->gender;
        
        // Parse languages
        if ($request->languages) {
            $languages = array_map('trim', explode(',', $request->languages));
            $profile->languages = $languages;
        }

        $profile->save();
        
        // Update profile completion
        $profile->calculateCompletionPercentage();

        return back()->with('success', 'Basic profile updated successfully!');
    }

    // Update job preferences
    public function updatePreferences(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'preferred_job_title' => 'nullable|string|max:255',
            'job_type_preference' => 'nullable|in:full_time,part_time,remote,hybrid',
            'expected_salary' => 'nullable|string|max:100',
            'preferred_location' => 'nullable|string|max:255',
            'availability' => 'nullable|in:immediate,notice_1_month,notice_2_months,notice_3_months',
        ]);

        $profile = $user->jobSeekerProfile ?? new JobSeekerProfile();
        
        if (!$profile->exists) {
            $profile->user_id = $user->id;
        }

        $profile->preferred_job_title = $request->preferred_job_title;
        $profile->job_type_preference = $request->job_type_preference;
        $profile->expected_salary = $request->expected_salary;
        $profile->preferred_location = $request->preferred_location;
        $profile->availability = $request->availability;
        
        $profile->save();
        
        // Update profile completion
        $profile->calculateCompletionPercentage();

        return back()->with('success', 'Job preferences updated successfully!');
    }

    // Update social links
    public function updateSocialLinks(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'github' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'portfolio' => 'nullable|url',
            'portfolio_website' => 'nullable|url',
        ]);

        $profile = $user->jobSeekerProfile ?? new JobSeekerProfile();
        
        if (!$profile->exists) {
            $profile->user_id = $user->id;
        }

        $socialLinks = [
            'github' => $request->github,
            'linkedin' => $request->linkedin,
            'portfolio' => $request->portfolio,
        ];

        $profile->social_links = $socialLinks;
        $profile->portfolio_website = $request->portfolio_website;
        $profile->save();

        return back()->with('success', 'Social links updated successfully!');
    }

    // Update profile visibility
    public function updateVisibility(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'is_public' => 'boolean',
        ]);

        $profile = $user->jobSeekerProfile;
        
        if ($profile) {
            $profile->is_public = $request->has('is_public');
            $profile->save();
        }

        return back()->with('success', 'Profile visibility updated!');
    }

    // CRUD for Educations
    public function storeEducation(Request $request)
    {
        $request->validate([
            'degree' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'field_of_study' => 'nullable|string|max:255',
            'start_year' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'end_year' => 'nullable|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'is_current' => 'boolean',
            'result' => 'nullable|string|max:50',
            'description' => 'nullable|string',
        ]);

        $education = Education::create([
            'user_id' => Auth::id(),
            'degree' => $request->degree,
            'institution' => $request->institution,
            'field_of_study' => $request->field_of_study,
            'start_year' => $request->start_year,
            'end_year' => $request->is_current ? null : $request->end_year,
            'is_current' => $request->has('is_current'),
            'result' => $request->result,
            'description' => $request->description,
        ]);

        // Update profile completion
        Auth::user()->jobSeekerProfile?->calculateCompletionPercentage();

        return back()->with('success', 'Education added successfully!');
    }

    public function updateEducation(Request $request, Education $education)
    {
        if ($education->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'degree' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'field_of_study' => 'nullable|string|max:255',
            'start_year' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'end_year' => 'nullable|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'is_current' => 'boolean',
            'result' => 'nullable|string|max:50',
            'description' => 'nullable|string',
        ]);

        $education->update([
            'degree' => $request->degree,
            'institution' => $request->institution,
            'field_of_study' => $request->field_of_study,
            'start_year' => $request->start_year,
            'end_year' => $request->is_current ? null : $request->end_year,
            'is_current' => $request->has('is_current'),
            'result' => $request->result,
            'description' => $request->description,
        ]);

        return back()->with('success', 'Education updated successfully!');
    }

    public function destroyEducation(Education $education)
    {
        if ($education->user_id !== Auth::id()) {
            abort(403);
        }

        $education->delete();
        
        // Update profile completion
        Auth::user()->jobSeekerProfile?->calculateCompletionPercentage();

        return back()->with('success', 'Education deleted successfully!');
    }

    // CRUD for Experiences
    public function storeExperience(Request $request)
    {
        $request->validate([
            'job_title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'employment_type' => 'nullable|in:full_time,part_time,contract,internship',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_current' => 'boolean',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'skills_used' => 'nullable|string',
        ]);

        $experience = Experience::create([
            'user_id' => Auth::id(),
            'job_title' => $request->job_title,
            'company_name' => $request->company_name,
            'employment_type' => $request->employment_type,
            'start_date' => $request->start_date,
            'end_date' => $request->is_current ? null : $request->end_date,
            'is_current' => $request->has('is_current'),
            'location' => $request->location,
            'description' => $request->description,
            'skills_used' => $request->skills_used ? array_map('trim', explode(',', $request->skills_used)) : null,
        ]);

        // Update profile completion
        Auth::user()->jobSeekerProfile?->calculateCompletionPercentage();

        return back()->with('success', 'Experience added successfully!');
    }

    public function updateExperience(Request $request, Experience $experience)
    {
        if ($experience->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'job_title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'employment_type' => 'nullable|in:full_time,part_time,contract,internship',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_current' => 'boolean',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'skills_used' => 'nullable|string',
        ]);

        $experience->update([
            'job_title' => $request->job_title,
            'company_name' => $request->company_name,
            'employment_type' => $request->employment_type,
            'start_date' => $request->start_date,
            'end_date' => $request->is_current ? null : $request->end_date,
            'is_current' => $request->has('is_current'),
            'location' => $request->location,
            'description' => $request->description,
            'skills_used' => $request->skills_used ? array_map('trim', explode(',', $request->skills_used)) : null,
        ]);

        return back()->with('success', 'Experience updated successfully!');
    }

    public function destroyExperience(Experience $experience)
    {
        if ($experience->user_id !== Auth::id()) {
            abort(403);
        }

        $experience->delete();
        
        // Update profile completion
        Auth::user()->jobSeekerProfile?->calculateCompletionPercentage();

        return back()->with('success', 'Experience deleted successfully!');
    }

    // CRUD for Projects
    public function storeProject(Request $request)
    {
        $request->validate([
            'project_name' => 'required|string|max:255',
            'description' => 'required|string|min:50',
            'technologies' => 'required|string',
            'github_link' => 'nullable|url',
            'live_link' => 'nullable|url',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_ongoing' => 'boolean',
        ]);

        $project = Project::create([
            'user_id' => Auth::id(),
            'project_name' => $request->project_name,
            'description' => $request->description,
            'technologies' => array_map('trim', explode(',', $request->technologies)),
            'github_link' => $request->github_link,
            'live_link' => $request->live_link,
            'start_date' => $request->start_date,
            'end_date' => $request->is_ongoing ? null : $request->end_date,
            'is_ongoing' => $request->has('is_ongoing'),
        ]);

        // Update profile completion
        Auth::user()->jobSeekerProfile?->calculateCompletionPercentage();

        return back()->with('success', 'Project added successfully!');
    }

    public function updateProject(Request $request, Project $project)
    {
        if ($project->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'project_name' => 'required|string|max:255',
            'description' => 'required|string|min:50',
            'technologies' => 'required|string',
            'github_link' => 'nullable|url',
            'live_link' => 'nullable|url',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_ongoing' => 'boolean',
        ]);

        $project->update([
            'project_name' => $request->project_name,
            'description' => $request->description,
            'technologies' => array_map('trim', explode(',', $request->technologies)),
            'github_link' => $request->github_link,
            'live_link' => $request->live_link,
            'start_date' => $request->start_date,
            'end_date' => $request->is_ongoing ? null : $request->end_date,
            'is_ongoing' => $request->has('is_ongoing'),
        ]);

        return back()->with('success', 'Project updated successfully!');
    }

    public function destroyProject(Project $project)
    {
        if ($project->user_id !== Auth::id()) {
            abort(403);
        }

        $project->delete();
        
        // Update profile completion
        Auth::user()->jobSeekerProfile?->calculateCompletionPercentage();

        return back()->with('success', 'Project deleted successfully!');
    }

    // CRUD for Certifications
    public function storeCertification(Request $request)
    {
        $request->validate([
            'certification_name' => 'required|string|max:255',
            'issuing_organization' => 'required|string|max:255',
            'credential_id' => 'nullable|string|max:100',
            'credential_url' => 'nullable|url',
            'issue_date' => 'required|date',
            'expiration_date' => 'nullable|date|after_or_equal:issue_date',
            'does_not_expire' => 'boolean',
            'description' => 'nullable|string',
        ]);

        $certification = Certification::create([
            'user_id' => Auth::id(),
            'certification_name' => $request->certification_name,
            'issuing_organization' => $request->issuing_organization,
            'credential_id' => $request->credential_id,
            'credential_url' => $request->credential_url,
            'issue_date' => $request->issue_date,
            'expiration_date' => $request->does_not_expire ? null : $request->expiration_date,
            'does_not_expire' => $request->has('does_not_expire'),
            'description' => $request->description,
        ]);

        // Update profile completion
        Auth::user()->jobSeekerProfile?->calculateCompletionPercentage();

        return back()->with('success', 'Certification added successfully!');
    }

    public function updateCertification(Request $request, Certification $certification)
    {
        if ($certification->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'certification_name' => 'required|string|max:255',
            'issuing_organization' => 'required|string|max:255',
            'credential_id' => 'nullable|string|max:100',
            'credential_url' => 'nullable|url',
            'issue_date' => 'required|date',
            'expiration_date' => 'nullable|date|after_or_equal:issue_date',
            'does_not_expire' => 'boolean',
            'description' => 'nullable|string',
        ]);

        $certification->update([
            'certification_name' => $request->certification_name,
            'issuing_organization' => $request->issuing_organization,
            'credential_id' => $request->credential_id,
            'credential_url' => $request->credential_url,
            'issue_date' => $request->issue_date,
            'expiration_date' => $request->does_not_expire ? null : $request->expiration_date,
            'does_not_expire' => $request->has('does_not_expire'),
            'description' => $request->description,
        ]);

        return back()->with('success', 'Certification updated successfully!');
    }

    public function destroyCertification(Certification $certification)
    {
        if ($certification->user_id !== Auth::id()) {
            abort(403);
        }

        $certification->delete();
        
        // Update profile completion
        Auth::user()->jobSeekerProfile?->calculateCompletionPercentage();

        return back()->with('success', 'Certification deleted successfully!');
    }

    // Public profile view
    public function showPublic($id)
    {
        $user = User::findOrFail($id);
        
        if (!$user->isJobSeeker()) {
            abort(404);
        }

        $profile = $user->jobSeekerProfile;
        
        if (!$profile || !$profile->is_public) {
            abort(404);
        }

        return view('job-seeker.profile.public', compact('user', 'profile'));
    }

    // Get profile completion
    public function getCompletion()
    {
        $profile = Auth::user()->jobSeekerProfile;
        
        if (!$profile) {
            return response()->json(['completion' => 0]);
        }

        return response()->json([
            'completion' => $profile->profile_completion,
            'next_steps' => $this->getNextSteps($profile)
        ]);
    }

    private function getNextSteps($profile)
    {
        $steps = [];
        
        if (empty($profile->professional_title)) {
            $steps[] = 'Add your professional title';
        }
        
        if (empty($profile->summary)) {
            $steps[] = 'Write a professional summary';
        }
        
        if (Auth::user()->educations()->count() === 0) {
            $steps[] = 'Add your education';
        }
        
        if (!Auth::user()->resume_path) {
            $steps[] = 'Upload your resume';
        }
        
        return array_slice($steps, 0, 3);
    }
}
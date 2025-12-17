<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'current_password' => 'nullable|required_with:password',
            'password' => 'nullable|min:8|confirmed',
        ]);

        // Update basic info
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'];
        $user->address = $validated['address'];

        // Update password if provided
        if ($request->filled('password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect']);
            }
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }

    public function updateResume(Request $request)
    {
        $request->validate([
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $user = Auth::user();

        // Delete old resume if exists
        if ($user->resume_path) {
            Storage::disk('public')->delete($user->resume_path);
        }

        // Store new resume
        $path = $request->file('resume')->store('resumes', 'public');
        $user->resume_path = $path;
        $user->save();

        return back()->with('success', 'Resume uploaded successfully!');
    }

    public function updateProfileDetails(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'skills' => 'nullable|string',
            'experience' => 'nullable|string',
            'education' => 'nullable|string',
            'company_name' => 'nullable|required_if:role,employer|string|max:255',
            'website' => 'nullable|url|max:255',
            'industry' => 'nullable|string|max:100',
        ]);

        // Convert skills to array if provided
        if ($request->has('skills')) {
            $skillsArray = array_map('trim', explode(',', $request->skills));
            $validated['skills'] = json_encode($skillsArray);
        }

        $user->update($validated);

        return back()->with('success', 'Profile details updated successfully!');
    }
}
<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'certification_name' => 'required|string|max:255',
            'issuing_organization' => 'required|string|max:255',
            'issue_date' => 'required|date',
            'expiration_date' => 'nullable|date|after:issue_date',
            'does_not_expire' => 'boolean',
            'credential_id' => 'nullable|string|max:100',
            'credential_url' => 'nullable|url|max:500',
            'description' => 'nullable|string',
        ]);

        $certification = new Certification();
        $certification->user_id = Auth::id();
        $certification->certification_name = $request->certification_name;
        $certification->issuing_organization = $request->issuing_organization;
        $certification->issue_date = $request->issue_date;
        
        if ($request->filled('expiration_date') && !$request->boolean('does_not_expire')) {
            $certification->expiration_date = $request->expiration_date;
        }
        
        $certification->does_not_expire = $request->boolean('does_not_expire');
        $certification->credential_id = $request->credential_id;
        $certification->credential_url = $request->credential_url;
        $certification->description = $request->description;
        
        $certification->save();

        return redirect()->back()->with('success', 'Certification added successfully!');
    }

    public function update(Request $request, Certification $certification)
    {
        // Check if the certification belongs to the authenticated user
        if ($certification->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'certification_name' => 'required|string|max:255',
            'issuing_organization' => 'required|string|max:255',
            'issue_date' => 'required|date',
            'expiration_date' => 'nullable|date|after:issue_date',
            'does_not_expire' => 'boolean',
            'credential_id' => 'nullable|string|max:100',
            'credential_url' => 'nullable|url|max:500',
            'description' => 'nullable|string',
        ]);

        $certification->certification_name = $request->certification_name;
        $certification->issuing_organization = $request->issuing_organization;
        $certification->issue_date = $request->issue_date;
        
        if ($request->filled('expiration_date') && !$request->boolean('does_not_expire')) {
            $certification->expiration_date = $request->expiration_date;
        } else {
            $certification->expiration_date = null;
        }
        
        $certification->does_not_expire = $request->boolean('does_not_expire');
        $certification->credential_id = $request->credential_id;
        $certification->credential_url = $request->credential_url;
        $certification->description = $request->description;
        
        $certification->save();

        return redirect()->back()->with('success', 'Certification updated successfully!');
    }

    public function destroy(Certification $certification)
    {
        // Check if the certification belongs to the authenticated user
        if ($certification->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $certification->delete();

        return redirect()->back()->with('success', 'Certification deleted successfully!');
    }
}
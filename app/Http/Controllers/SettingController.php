<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display settings page
     */
    public function index()
    {
        $settings = Setting::getAllGrouped();
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update settings
     */
    public function update(Request $request)
    {
        foreach ($request->except('_token') as $key => $value) {
            $setting = Setting::where('key', $key)->first();
            
            if ($setting) {
                // Handle file uploads
                if ($setting->type === 'image' && $request->hasFile($key)) {
                    // Delete old file if exists
                    if ($setting->value) {
                        Storage::disk('public')->delete($setting->value);
                    }
                    
                    // Store new file
                    $path = $request->file($key)->store('settings', 'public');
                    $value = $path;
                }
                
                $setting->update(['value' => $value ?? '']);
            }
        }

        // Clear settings cache
        Cache::forget('settings');

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully.');
    }

    /**
     * Clear cache
     */
    public function clearCache()
    {
        Cache::flush();
        return redirect()->back()->with('success', 'Cache cleared successfully.');
    }
}
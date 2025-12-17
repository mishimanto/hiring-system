<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\OpenJob;
use Illuminate\Http\Request;    

class HomeController extends Controller
{
    public function index()
    {
        // Active jobs count
        $activeJobsCount = OpenJob::where('status', 'approved')
            ->where('is_active', 1)
            ->whereDate('deadline', '>=', now()->format('Y-m-d'))
            ->count();


        // Get active categories with job counts
        $categories = Category::where('is_active', true)
            ->orderBy('jobs_count', 'desc')
            ->take(8)
            ->get()
            ->map(function($category) {
                return [
                    'icon' => $category->icon,
                    'name' => $category->name,
                    'count' => $category->jobs_count,
                    'slug' => $category->slug
                ];
            })->toArray();
            

        // Get featured jobs with employer and category
        $featuredJobs = OpenJob::with(['employer', 'category'])
            ->where('is_featured', true)
            ->where('status', 'approved')
            ->whereDate('deadline', '>=', now()->format('Y-m-d'))
            ->latest()
            ->take(6)
            ->get();

        return view('home', compact('categories', 'featuredJobs', 'activeJobsCount'));
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSeekerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'professional_title',
        'summary',
        'experience_level',
        'preferred_job_title',
        'job_type_preference',
        'expected_salary',
        'preferred_location',
        'availability',
        'date_of_birth',
        'gender',
        'languages',
        'social_links',
        'profile_completion',
        'is_public',
        'portfolio_website'
    ];

    protected $casts = [
        'languages' => 'array',
        'social_links' => 'array',
        'is_public' => 'boolean',
        'date_of_birth' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Calculate profile completion percentage
    public function calculateCompletionPercentage()
    {
        $totalPoints = 0;
        $earnedPoints = 0;

        $fields = [
            'professional_title' => 10,
            'summary' => 15,
            'experience_level' => 5,
            'preferred_job_title' => 5,
            'expected_salary' => 5,
            'preferred_location' => 5,
            'date_of_birth' => 5,
            'gender' => 5,
            'languages' => 5,
            'portfolio_website' => 5,
        ];

        foreach ($fields as $field => $points) {
            $totalPoints += $points;
            if (!empty($this->$field)) {
                $earnedPoints += $points;
            }
        }

        // Add points from related models
        if ($this->user->skills) {
            $earnedPoints += 10;
        }
        if ($this->user->educations()->count() > 0) {
            $earnedPoints += 10;
        }
        if ($this->user->experiences()->count() > 0) {
            $earnedPoints += 10;
        }
        if ($this->user->resume_path) {
            $earnedPoints += 10;
        }

        $totalPoints += 40; // For related models and resume

        $percentage = ($totalPoints > 0) ? round(($earnedPoints / $totalPoints) * 100) : 0;
        
        $this->profile_completion = min($percentage, 100);
        $this->save();

        return $this->profile_completion;
    }

    // Get social links
    public function getSocialLink($platform)
    {
        $links = $this->social_links ?? [];
        return $links[$platform] ?? null;
    }
}
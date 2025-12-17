<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OpenJob extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'openjobs';

    protected $fillable = [
        'employer_id',
        'title',
        'description',
        'requirements',
        'category',
        'location',
        'job_type',
        'salary_min',
        'salary_max',
        'salary_type',
        'deadline',
        'vacancy',
        'status',
        'is_active',
        'is_featured',
        'views'
    ];

    protected $casts = [
        'deadline' => 'date',
        'salary_min' => 'decimal:2',
        'salary_max' => 'decimal:2',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'views' => 'integer'
    ];

    // Relationships
    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }

    public function applications()
    {
        return $this->hasMany(JobApplication::class, 'job_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Accessor for salary_range
    public function getSalaryRangeAttribute()
    {
        if ($this->salary_min && $this->salary_max) {
            return number_format($this->salary_min) . ' - ' . number_format($this->salary_max) . ' ' . $this->salary_type;
        } elseif ($this->salary_min) {
            return 'From ' . number_format($this->salary_min) . ' ' . $this->salary_type;
        } elseif ($this->salary_max) {
            return 'Up to ' . number_format($this->salary_max) . ' ' . $this->salary_type;
        }
        
        return 'Negotiable';
    }

    // Scopes
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->where('deadline', '>=', now());
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('title', 'LIKE', "%{$search}%")
              ->orWhere('description', 'LIKE', "%{$search}%")
              ->orWhere('location', 'LIKE', "%{$search}%")
              ->orWhere('category', 'LIKE', "%{$search}%");
        });
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeByLocation($query, $location)
    {
        return $query->where('location', $location);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('job_type', $type);
    }

    // Helpers
    public function isActive()
    {
        return $this->is_active && $this->deadline >= now();
    }

    public function incrementViews()
    {
        $this->increment('views');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'job_title',
        'company_name',
        'employment_type',
        'start_date',
        'end_date',
        'is_current',
        'location',
        'description',
        'skills_used',
        'sort_order'
    ];

    protected $casts = [
        'is_current' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
        'skills_used' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Get employment period
    public function getPeriodAttribute()
    {
        $start = $this->start_date ? $this->start_date->format('M Y') : '';
        $end = $this->is_current ? 'Present' : ($this->end_date ? $this->end_date->format('M Y') : '');
        
        return $start . ' - ' . $end;
    }

    // Get duration in years/months
    public function getDurationAttribute()
    {
        if (!$this->start_date) return '';

        $start = $this->start_date;
        $end = $this->is_current ? now() : $this->end_date;

        $years = $end->diffInYears($start);
        $months = $end->diffInMonths($start) % 12;

        $duration = '';
        if ($years > 0) {
            $duration .= $years . ' year' . ($years > 1 ? 's' : '');
        }
        if ($months > 0) {
            if ($years > 0) $duration .= ' ';
            $duration .= $months . ' month' . ($months > 1 ? 's' : '');
        }

        return $duration ?: 'Less than a month';
    }
}
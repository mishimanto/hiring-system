<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'project_name',
        'description',
        'technologies',
        'github_link',
        'live_link',
        'start_date',
        'end_date',
        'is_ongoing',
        'sort_order'
    ];

    protected $casts = [
        'is_ongoing' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
        'technologies' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Get project period
    public function getPeriodAttribute()
    {
        if (!$this->start_date) return '';

        $start = $this->start_date->format('M Y');
        $end = $this->is_ongoing ? 'Present' : ($this->end_date ? $this->end_date->format('M Y') : '');

        return $start . ' - ' . $end;
    }
}
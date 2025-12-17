<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'degree',
        'institution',
        'field_of_study',
        'start_year',
        'end_year',
        'result',
        'is_current',
        'description',
        'sort_order'
    ];

    protected $casts = [
        'is_current' => 'boolean',
        'start_year' => 'integer',
        'end_year' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Get education period
    public function getPeriodAttribute()
    {
        if ($this->is_current) {
            return $this->start_year . ' - Present';
        }
        return $this->start_year . ' - ' . $this->end_year;
    }
}
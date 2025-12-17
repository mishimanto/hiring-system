<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'job_seeker_id',
        'cover_letter',
        'resume_path',
        'status',
        'applied_at',
        'reviewed_at',
        'notes'
    ];

    protected $casts = [
        'applied_at' => 'datetime',
        'reviewed_at' => 'datetime'
    ];

    // Relationships
    public function job()
    {
        return $this->belongsTo(OpenJob::class, 'job_id');
    }

    public function jobSeeker()
    {
        return $this->belongsTo(User::class, 'job_seeker_id');
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeShortlisted($query)
    {
        return $query->where('status', 'shortlisted');
    }

    public function scopeHired($query)
    {
        return $query->where('status', 'hired');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    // Helpers
    public function markAsReviewed()
    {
        $this->update([
            'status' => 'reviewed',
            'reviewed_at' => now()
        ]);
    }

    public function shortlist()
    {
        $this->update(['status' => 'shortlisted']);
    }

    public function reject()
    {
        $this->update(['status' => 'rejected']);
    }

    public function hire()
    {
        $this->update(['status' => 'hired']);
    }
}
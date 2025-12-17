<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'certification_name',
        'issuing_organization',
        'credential_id',
        'credential_url',
        'issue_date',
        'expiration_date',
        'does_not_expire',
        'description',
        'sort_order'
    ];

    protected $casts = [
        'does_not_expire' => 'boolean',
        'issue_date' => 'date',
        'expiration_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Check if certification is valid
    public function getIsValidAttribute()
    {
        if ($this->does_not_expire) {
            return true;
        }

        if (!$this->expiration_date) {
            return true;
        }

        return now()->lte($this->expiration_date);
    }
}
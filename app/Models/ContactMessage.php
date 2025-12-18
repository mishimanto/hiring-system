<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'ip_address',
        'user_agent',
        'status',
        'admin_notes'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the status badge
     */
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'unread' => 'badge bg-warning',
            'read' => 'badge bg-info',
            'replied' => 'badge bg-success',
            'spam' => 'badge bg-danger'
        ];

        return '<span class="' . ($badges[$this->status] ?? 'badge bg-secondary') . '">' . ucfirst($this->status) . '</span>';
    }

    /**
     * Scope for unread messages
     */
    public function scopeUnread($query)
    {
        return $query->where('status', 'unread');
    }

    /**
     * Scope for read messages
     */
    public function scopeRead($query)
    {
        return $query->where('status', 'read');
    }

    /**
     * Scope for replied messages
     */
    public function scopeReplied($query)
    {
        return $query->where('status', 'replied');
    }

    /**
     * Scope for spam messages
     */
    public function scopeSpam($query)
    {
        return $query->where('status', 'spam');
    }

    /**
     * Format created at time
     */
    public function getFormattedTimeAttribute()
    {
        return $this->created_at->format('d M Y, h:i A');
    }
}
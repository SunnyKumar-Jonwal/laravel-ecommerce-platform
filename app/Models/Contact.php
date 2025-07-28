<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
        'admin_reply',
        'replied_at',
        'replied_by'
    ];

    protected $casts = [
        'replied_at' => 'datetime',
    ];

    /**
     * Get the admin who replied to this contact
     */
    public function repliedBy()
    {
        return $this->belongsTo(User::class, 'replied_by');
    }

    /**
     * Scope for new contacts
     */
    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    /**
     * Scope for unread contacts
     */
    public function scopeUnread($query)
    {
        return $query->whereIn('status', ['new']);
    }

    /**
     * Get formatted created date
     */
    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('M d, Y h:i A');
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'new' => 'badge bg-primary',
            'read' => 'badge bg-warning',
            'replied' => 'badge bg-info',
            'resolved' => 'badge bg-success',
            default => 'badge bg-secondary'
        };
    }
}

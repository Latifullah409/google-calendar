<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $casts = [
        'date_time' => 'datetime', // Ensure 'date_time' is cast to a DateTime object
    ];

    protected $fillable = [
        'subject',
        'date_time',
        'creator_id',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function attendees()
    {
        return $this->belongsToMany(User::class, 'meeting_attendees', 'meeting_id', 'user_id');
    }
    
}

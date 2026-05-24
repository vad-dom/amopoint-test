<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'visitor_hash',
        'ip',
        'city',
        'country',
        'device',
        'browser',
        'platform',
        'user_agent',
        'page_url',
        'referer',
        'visited_at',
    ];

    protected $casts = [
        'visited_at' => 'datetime',
    ];
}

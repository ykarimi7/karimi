<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isOnline()
    {
        return $this->online_at && $this->online_at->diffInMinutes(now()) < 5;
    }

    public function incrementFullTimeOnlined()
    {
        $this->full_time_onlined = now();
    }
}
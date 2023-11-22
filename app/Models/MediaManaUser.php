<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaManaUser extends Model
{
    protected $guarded = [];
    
    public function Manauser()
    {
        return $this->belongsTo(Manauser::class);
    }
}
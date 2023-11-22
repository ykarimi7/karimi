<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manauser extends Model
{
    protected $fillable = [
        'id',
        'manager_id',
        'user_id',
        'state',
    ];

    protected $table = "manausers";

    public function multiFiles()
    {
        return $this->hasMany(MediaManaUser::class);
    }
}
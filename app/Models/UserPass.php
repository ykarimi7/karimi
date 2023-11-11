<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPass extends Model
{
    protected $fillable=[
       'id',
       'userid',
       'pass',
    ];
}

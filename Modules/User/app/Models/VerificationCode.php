<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerificationCode extends Model
{
    protected $fillable = ['email' , 'code' , 'expire_at' , 'purpose' , 'verify_token'] ;
    protected $casts = [
    'expire_at' => 'datetime', 
];
}




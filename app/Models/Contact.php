<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    /*
    * Check whether the email or phone has already been taken
    * and later this function will be called on the controller
    */ 

    public function scopeEmailOrPhoneTaken($query, $email, $phone)
    {
        return $query->where('email', $email)
                     ->orWhere('phone', $phone);
    }
}

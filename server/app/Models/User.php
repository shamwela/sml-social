<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory;
    protected $fillable = ['name', 'email', 'password', 'profile_picture_url'];
    protected $hidden = ['password'];

    public function posts()
    {
        return $this->hasMany('Post');
    }

    public function savedposts()
    {
        return $this->hasMany('SavedPost');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'password', 'profile_picture_name'];
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

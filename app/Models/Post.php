<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['text', 'image_url', 'user_id'];

    public function user()
    {
        return $this->belongsTo('User');
    }
}

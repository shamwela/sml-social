<?php

use Illuminate\Support\Facades\Cookie;
use App\Models\Like;

function is_logged_in()
{
  return Cookie::get('user_id') and Cookie::get('email') and Cookie::get('password');
}


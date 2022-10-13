<?php

use Illuminate\Support\Facades\Cookie;

function isLoggedIn()
{
  return Cookie::get('user_id') and Cookie::get('email') and Cookie::get('password');
}

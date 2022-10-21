<?php

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

function isLoggedIn(Request $request)
{
  $userId = $request->userId;
  $password = $request->password;
  $user = User::find($userId);
  if (!Hash::check($password, $user->password)) {
    return false;
  }
  return true;
}

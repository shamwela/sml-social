<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private static $email_validation = 'required|email|min:5|max:50';
    private static $password_validation = 'required|string|min:8|max:100';

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:50',
            // Only when register, the email should be unique
            'email' => self::$email_validation . '|unique:users',
            'password' => self::$password_validation
        ]);

        // If the database is hacked, the hacker won't know the passwords
        $hashed_password = Hash::make($request->password);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $hashed_password
        ]);
        return response()->json('success', 200);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => self::$email_validation,
            'password' => self::$password_validation
        ]);
        $email = $request->email;
        $password = $request->password;
        $user = User::where('email', $email)->first();
        if (!$user) {
            // return error
            return;
        }
        if (!Hash::check($password, $user->password)) {
            // Wrong password
            return;
        }
        return response()->json('success', 200);
    }
}

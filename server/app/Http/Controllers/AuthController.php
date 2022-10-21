<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private static $emailValidation = 'required|email|min:5|max:50';
    private static $passwordValidation = 'required|string|min:8|max:100';

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:50',
            // Only when register, the email should be unique
            'email' => self::$emailValidation . '|unique:users',
            'password' => self::$passwordValidation
        ]);

        // If the database is hacked, the hacker won't know the passwords
        $hashedPassword = Hash::make($request->password);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $hashedPassword
        ]);
        $userId = $user->id;
        return response()->json($userId, 200);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => self::$emailValidation,
            'password' => self::$passwordValidation
        ]);
        $email = $request->email;
        $password = $request->password;
        $user = User::where('email', $email)->first();
        if (!$user) {
            // return error
            return;
        }
        if (!Hash::check($password, $user->password)) { // Wrong password
            return;
        }
        $userId = $user->id;
        return response()->json($userId, 200);
    }
}

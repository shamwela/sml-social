<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    private static $email_validation = 'required|string|min:5|max:50|email';
    private static $password_validation = 'required|string|min:8|max:100';

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:50',
            // Only when register, the email should be unique
            'email' => self::$email_validation . '|unique:users',
            'password' => self::$password_validation
        ]);

        $hashed_password = Hash::make($request->password);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $hashed_password
        ]);

        return response()->json([
            'status' => true,
            'message' => 'User Created Successfully',
            'token' => $user->createToken('API TOKEN')->plainTextToken
        ], 200);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => self::$email_validation,
            'password' => self::$password_validation
        ]);
        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => [
                    __('auth.failed')
                ]
            ]);
        }

        return $request->user();
    }

    public function logout()
    {
        return Auth::logout();
    }
}

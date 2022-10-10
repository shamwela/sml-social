<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private static $email_validation = 'required|min:5|max:50|unique:users|email';
    private static $password_validation = 'required|min:8|max:100';

    public function register(Request $request)
    {
        $valid = $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => self::$email_validation,
            'password' => self::$password_validation
        ]);
        if (!$valid) {
            // Later, show errors in an easy-to-understand way
            return redirect()->route('auth.register.show');
        }
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        return redirect()->route('home');
    }

    public function login(Request $request)
    {
        $valid = $request->validate([
            'email' => self::$email_validation,
            'password' => self::$password_validation
        ]);
        if (!$valid) {
            return redirect()->route('auth.login.show');
        }
        // more here later...
    }
}

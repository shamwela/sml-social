<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    private static $email_validation = 'required|min:5|max:50|email';
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
        $existing_user = User::firstWhere('email', $request->email);
        if ($existing_user) {
            // Improve UX here later
            abort(400);
        }
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('home')
            ->withCookie(cookie()->forever('email', $request->email))
            ->withCookie(cookie()->forever('password', $request->password));
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

        $existing_user = User::firstWhere('email', $request->email);
        if (!$existing_user) {
            // Improve UX here later
            // No account with that email
            abort(400);
        }
        if (!Hash::check($request->password, $existing_user->password)) {
            // Wrong password
            abort(400);
        }

        return redirect()->route('home')
            ->withCookie(cookie()->forever('email', $request->email))
            ->withCookie(cookie()->forever('password', $request->password));
    }
}

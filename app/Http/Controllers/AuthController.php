<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    private static $email_validation = 'required|min:5|max:50|email';
    private static $password_validation = 'required|min:8|max:100';

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:50',
            // Only when register, the email should be unique
            'email' => self::$email_validation . '|unique:users',
            'password' => self::$password_validation
        ]);

        $existing_user = User::firstWhere('email', $request->email);
        if ($existing_user) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(
                    ['email' => 'You already have an account with the email ' . $request->email . '. Please login instead.']
                );
        }
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('home')
            ->withCookie(cookie()->forever('user_id', $user->id))
            ->withCookie(cookie()->forever('email', $request->email))
            ->withCookie(cookie()->forever('password', $request->password));
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => self::$email_validation,
            'password' => self::$password_validation
        ]);

        $existing_user = User::firstWhere('email', $request->email);
        if (!$existing_user) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['email' => 'No account with the email ' . $request->email . '.']);
        }
        if (!Hash::check($request->password, $existing_user->password)) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['password' => 'Wrong password.']);
        }

        return redirect()->route('home')
            ->withCookie(cookie()->forever('user_id', $existing_user->id))
            ->withCookie(cookie()->forever('email', $request->email))
            ->withCookie(cookie()->forever('password', $request->password));
    }

    public function logout()
    {
        // Queue the cookies to send with the response
        // The response will tell the browser to delete the cookies
        Cookie::queue(Cookie::forget('user_id'));
        Cookie::queue(Cookie::forget('email'));
        Cookie::queue(Cookie::forget('password'));
        return redirect()->route('home');
    }
}

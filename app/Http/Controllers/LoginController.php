<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        // Render the login form view
        return view('logins.index');
    }

    /**
     * Handle the login request.
     */
    public function processLogin(Request $request)
    {
        // Validate the request
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'captcha' => 'required',
        ]);

        // Check if the captcha is correct
        // $captchaValue = $request->session()->get('captcha_value');
        // if (!$captchaValue || $request->captcha != $captchaValue) {
        //     return back()->withErrors(['captcha' => 'Captcha is incorrect.'])->withInput();
        // }

        // Dummy check for username and password
        if ($request->username === 'admin' && $request->password === 'password') {
            // Store user information in the session or authenticate
            $request->session()->put('user', ['username' => $request->username]);

            // Redirect to dashboard
            return redirect()->route('dashboards.show', ['page' => 'index']);
        } else {
            // Return with error if credentials are invalid
            return back()->withErrors(['login' => 'Invalid username or password.'])->withInput();
        }
    }
    public function logout(Request $request)
    {
        // Clear the session and log out the user
        Auth::logout();

        // Redirect to login page
        return redirect()->route('login.form');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Show Registration Form
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Register a new user
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            //'name' => 'required|string|max:255',  // Removed name validation
            'phone' => 'required|numeric|digits_between:9,10|unique:users',
            'password' => 'required|string|min:8',
            'confirmPassword' => 'required|string|min:8|same:password',
            'terms' => 'required|accepted'
        ], [
            'terms.required' => 'You must agree to the terms and conditions.',
            'terms.accepted' => 'You must agree to the terms and conditions.',
            'phone.digits_between' => 'The phone number must be between 9 and 10 digits.',
            'phone.unique' => 'This phone number is already registered.',
            'password.min' => 'The password must be at least 8 character long.',
            'confirmPassword.same' => 'The passwords do not match.',
            'confirmPassword.required' => 'Please confirm your password.',
            'password.required' => 'Please enter a password.',
            'phone.required' => 'Please enter a phone number.',
            'phone.numeric' => 'The phone number must be numeric.',
        ]);

        if ($validator->fails()) {
            // dd($validator->errors()); // Add this line temporarily
            return redirect('register')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect('/home')->with('success', 'Registration successful!');
    }


    // Show Login Form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Login an existing user
    public function login(Request $request)
    {
        $credentials = [
            'phone' => trim($request->phone),
            'password' => trim($request->password)
        ];

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $request->session()->regenerate();  // Prevent session fixation attacks

            return redirect('/home')->with('success', 'Login successful!');
        }

        return back()
            ->withErrors(['phone' => 'Invalid credentials.'])
            ->withInput();
    }
    // Logout User
    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();   // Invalidate session on logout
        request()->session()->regenerateToken(); // Regenerate token for extra security

        return redirect('/login');
    }
}

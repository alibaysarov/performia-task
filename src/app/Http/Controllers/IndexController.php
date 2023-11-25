<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function index()
    {
        return Inertia::render('Home', [
            'title' => 'Todo List',
            'des' => 'lorem ipsum'
        ]);
        //return to_route('login');
    }

    public function login()
    {
        return Inertia::render('Login');
    }

    public function register()
    {
        return Inertia::render('Register');
    }

    public function registerUser(Request $request)
    {

        try {
            $validated = $request->validate([
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'email' => 'required|email|unique:users,email', // Unique validation rule for the 'email' field
                'password' => 'required',
            ]);
            $body = $request->all();
            $firstName = $validated['first_name'];
            $lastName = $validated['last_name'];
            $email = $validated['email'];
            $password = $validated['password'];
            $candidate = User::query()->where('email','=',$email)->get();
            if($candidate->count()) {
                return response()->json(['message'=>"User with this email already exists"],403);
            }
            $newUser = User::create([
                'name' => "$firstName $lastName",
                'email' => $email,
                'password' => Hash::make($password)
            ]);
                Auth::login($newUser);
             return to_route('home');

        } catch (\Exception $exc) {
            return response()->json(['error' => $exc->getMessage()], 500);
        }
    }

    public function loginUser(Request $request)
    {

        try {
            $validated = $request->validate([
                'email' => 'required|email', // Unique validation rule for the 'email' field
                'password' => 'required|string',
            ]);
            $candidate = User::query()->where('email','=',$validated['email'])->first();
            if($candidate) {
                $candidate->makeVisible('password');
                if(!Hash::check($validated['password'], $candidate->password)) {
                    return response()->json(['error' => "Incorrect login data"], 400);
                }
                $candidate->makeHidden('password');
                Auth::login($candidate);
                return to_route('home');
            }

        } catch (\Exception $exc) {
            return response()->json(['error' => $exc->getMessage()], 500);

        }

    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function create() {
        return view('auth.register');
    }

    public function store(RegistrationRequest $request) {
        $user = User::create($request->all());
        Auth::login($user);
        return redirect('contact')->with('success', 'Welcome, You are now registered!');
    }
}

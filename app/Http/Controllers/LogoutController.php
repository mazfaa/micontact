<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        Auth::logout();
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->withHeaders([
            'Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate', 
            'Pragma' => 'no-cache', 'Expires' => 'Fri, 01 Jan 1990 00:00:00 GMT'
        ]);
    }
}

<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index() {
        return response()
        ->view('index')
        ->header('Cache-control', 'no-cache, no-store, must-revalidate');
    }
}

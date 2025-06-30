<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index()
    {
        return auth::check() ? redirect('/hotel') : view('auth.login');
    }
}

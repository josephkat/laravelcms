<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    public function index() {
        return view('admin.login');
    }

    public function authenticate() {
        return view('admin.login');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }
}
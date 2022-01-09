<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    public function index() {
        return view('admin.login');
    }

    public function authenticate(Request $request) {
        $data = $request->only([
            'email',
            'password',
            'remember'
        ]);
        $validator = $this->validator($data);

        if($validator->fails()) {
            return redirect()->route('login')
            ->withErros($validator)
            ->withInput();
        }

        if(Auth::attempt($data)) {
            return redirect()->route('admin');
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }

    protected function validator(array $data) {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:100'],
            'password' => ['required', 'string', 'min:4']
        ]);
    }
}
<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function store(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($request->only('email', 'password'))) {
        $request->session()->regenerate();
        return redirect('/attendance');
        }
        return back()->withErrors([
            'email' => 'ログイン情報が登録されていません',
        ]);
    }
}
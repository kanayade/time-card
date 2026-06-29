<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function index()
    {
        return view('admin_login');
    }
    public function store(LoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            if (Auth::user()->role !== 'admin') {
                Auth::logout();
                return back()->withErrors([
                    'email' => '管理者アカウントではありません',
                ]);
            }
            $request->session()->regenerate();
            return redirect('/admin/attendance/list');
        }
        return back()->withErrors([
            'email' => 'ログイン情報が登録されていません',
        ]);
    }
}

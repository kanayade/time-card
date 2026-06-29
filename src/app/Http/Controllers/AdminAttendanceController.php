<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminAttendanceController extends Controller
{
    public function index()
    {
        return view('admin_attendance_list');
    }
    public function list(Request $request)
    {
        return view('admin_staff_list');
    }
    public function detail($id)
    {
        return view('admin_attendance_staff');
    }
    public function request()
    {
        return view('admin_request_list');
    }
}
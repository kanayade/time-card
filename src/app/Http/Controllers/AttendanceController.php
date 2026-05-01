<?php

namespace App\Http\Controllers;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AttendanceController extends Controller
{
    public function index()
    {
        $attendance = Attendance::where('user_id', Auth::id())->whereDate('date',today())->first();
        return view('/attendance', compact('attendance'));
    }
    public function start()
    {
        Attendance::create([
            'user_id' => Auth::id(),
            'date' => today(),
            'start_time' => now(),
            'status' => 'working',
        ]);
    }
}

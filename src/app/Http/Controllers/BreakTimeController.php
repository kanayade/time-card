<?php

namespace App\Http\Controllers;
use App\Models\Attendance;
use App\Models\BreakTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BreakTimeController extends Controller
{
    public function breakStart()
    {
        $attendance = Attendance::where('user_id',Auth::id())->whereDate('date',today())->first();

        BreakTime::create([
            'attendance_id' => $attendance->id,
            'start_time' => now(),
        ]);
        return redirect('/attendance');
    }
    public function breakEnd()
    {
        $attendance = Attendance::where('user_id',Auth::id())->whereDate('date',today())->first();

        $break = BreakTime::where('attendance_id',$attendance->id)
        ->whereNull('end_time')
            ->latest()
            ->first();
        $break->update([
            'end_time' => now(),
        ]);
        return redirect('/attendance');
    }
}

<?php

namespace App\Http\Controllers;
use App\Models\Attendance;
use App\Models\BreakTime;
use App\Models\AttendanceCorrection;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AttendanceController extends Controller
{
    public function index()
    {
        $attendance = Attendance::where('user_id', Auth::id())->whereDate('date',today())->first();
        if (!$attendance) {
            $status = 'off';
        } elseif ($attendance->end_time) {
            $status = 'done';
        } else {
            $onBreak = BreakTime::where('attendance_id',$attendance->id)->whereNull('end_time')->exists();
            $status = $onBreak ? 'break' : 'working';
        }
        return view('/attendance', compact('attendance', 'status'));
    }
    public function start()
    {
        Attendance::create([
            'user_id' => Auth::id(),
            'date' => today(),
            'start_time' => now(),
            'status' => 'working',
        ]);
        return redirect('/attendance');
    }
    public function breakTimes()
    {
        return $this->hasMany(BreakTime::class);
    }
    public function done()
    {
        $attendance = Attendance::where('user_id',Auth::id())->whereDate('date',today())->first();

        $attendance->update([
            'end_time' => now(),
        ]);
        return redirect('/attendance');
    }
    public function list(Request $request)
    {
        $month = $request->month
            ? Carbon::parse($request->month)
            : Carbon::now();
        $attendances = Attendance::with('breakTimes')
            ->where('user_id', Auth::id())
            ->whereYear('date', $month->year)
            ->whereMonth('date', $month->month)
            ->orderBy('date')
            ->get();
        foreach ($attendances as $attendance) {
        $week = ['日', '月', '火', '水', '木', '金', '土'
        ];
        $date = Carbon::parse($attendance->date);
        $attendance->date_format = $date->format('m/d') . '(' . $week[$date->dayOfWeek] . ')';
        $attendance->start_time = $attendance->start_time ? Carbon::parse($attendance->start_time)->format('H:i') : '';
        $attendance->end_time = $attendance->end_time ? Carbon::parse($attendance->end_time)->format('H:i') : '';

        $breakMinutes = 0;
            foreach ($attendance->breakTimes as $break) {
            if ($break->end_time) {
                $breakMinutes += Carbon::parse($break->start_time)->diffInMinutes(Carbon::parse($break->end_time));
                    }
            }
            $attendance->break_time = sprintf(
                '%d:%02d',
                floor($breakMinutes / 60),
                $breakMinutes % 60
            );
            if ($attendance->start_time && $attendance->end_time) {
                $workMinutes =
                Carbon::parse($attendance->start_time)->diffInMinutes(Carbon::parse($attendance->end_time)) - $breakMinutes;
                $attendance->work_time = sprintf(
                    '%d:%02d',
                    floor($workMinutes / 60),
                    $workMinutes % 60
                );
            } else {
                $attendance->work_time = '';
            }
        }
        return view('attendance_list', compact('attendances', 'month'));
    }
    public function detail($id)
    {
        $attendance = Attendance::with('user', 'breakTimes')->findOrFail($id);
        $attendance->start = $attendance->start_time ? date('H:i', strtotime($attendance->start_time)) : '';
        $attendance->end = $attendance->end_time ? date('H:i', strtotime($attendance->end_time)) : '';
        $breaks = [];
        foreach ($attendance->breakTimes as $break) {
            $breaks[] = [
                'start' => $break->start_time ? date('H:i', strtotime($break->start_time)) : '',
                'end' => $break->end_time ? date('H:i', strtotime($break->end_time)) : '',
            ];
        }
        $breaks[] = [
            'start' => '',
            'end' => '',
        ];
        // 承認待ちの申請があるか
        $pending = AttendanceCorrection::where('attendance_id', $id)
        ->where('status', '承認待ち')
        ->exists();
        return view('attendance_detail', compact('attendance','breaks', 'pending'));
    }
}

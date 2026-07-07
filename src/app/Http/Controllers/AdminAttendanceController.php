<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateRequest;
use App\Models\Attendance;
use App\Models\BreakTime;
use App\Models\User;
use App\Models\AttendanceCorrection;
use Carbon\Carbon;

class AdminAttendanceController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->date ?? today()->toDateString();
        $attendances = Attendance::with(['user','breakTimes'])
        ->whereDate('date', $date)
        ->get();
    foreach ($attendances as $attendance) {
        // 出勤
        $attendance->start_time = $attendance->start_time
            ? Carbon::parse($attendance->start_time)->format('H:i')
            : '';
        // 退勤
        $attendance->end_time = $attendance->end_time
            ? Carbon::parse($attendance->end_time)->format('H:i')
            : '';
        // 休憩時間
        $breakMinutes = 0;
        foreach ($attendance->breakTimes as $break) {
            if ($break->start_time && $break->end_time) {
                $breakMinutes += Carbon::parse($break->end_time)
                    ->diffInMinutes(Carbon::parse($break->start_time));
            }
        }
        $attendance->break_time = sprintf(
            '%d:%02d',
            floor($breakMinutes / 60),
            $breakMinutes % 60
        );
        // 勤務時間
        if ($attendance->start_time && $attendance->end_time) {
            $workMinutes = Carbon::parse($attendance->end_time)
                ->diffInMinutes(Carbon::parse($attendance->start_time));
            $workMinutes -= $breakMinutes;
            $attendance->work_time = sprintf(
                '%d:%02d',
                floor($workMinutes / 60),
                $workMinutes % 60
            );
        } else {
            $attendance->work_time = '';
        }
    }
        return view('admin_attendance_list', compact('attendances', 'date'));
    }
    public function list()
    {
        $staffs = User::where('role', 'user')->get();
        return view('admin_staff_list', compact('staffs'));
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
        return view('attendance_detail', [
            'attendance' => $attendance,
            'breaks' => $breaks,
            'isAdmin' => true,
        ]);
    }
    public function update(UpdateRequest $request,$id)
    {
        $validated = $request->validated();
        $attendance = Attendance::findOrFail($id);
        DB::transaction(function () use ($validated, $id) {
            $attendance = Attendance::findOrFail($id);
            $attendance->update([
                'start_time' => $validated['start_time'],
                'end_time' => $validated['end_time'],
            ]);
            BreakTime::where('attendance_id', $attendance->id)->delete();
        foreach ($validated['break_start'] as $index => $start) {
            $end = $validated['break_end'][$index];
            // 空欄（追加用）は保存しない
            if (empty($start) && empty($end)) {
                continue;
            }
            BreakTime::create([
                'attendance_id' => $attendance->id,
                'start_time' => $start,
                'end_time' => $end,
            ]);
        };
    });
        return redirect('/admin/attendance/staff/' . $attendance->user_id);
    }
    public function staff(Request $request,$id)
    {
        $staff = User::findOrFail($id);
        $month = $request->month ? Carbon::parse($request->month) : now();
        $attendances = Attendance::with('breakTimes')
            ->where('user_id', $id)
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
                if ($break->start_time && $break->end_time) {
                    $breakMinutes += Carbon::parse($break->end_time)->diffInMinutes(Carbon::parse($break->start_time));
                }
            }
            $attendance->break_time = sprintf(
                '%d:%02d',
                floor($breakMinutes / 60),
                $breakMinutes % 60
            );
            if ($attendance->start_time && $attendance->end_time) {
                $workMinutes = Carbon::parse($attendance->end_time)->diffInMinutes(Carbon::parse($attendance->start_time)) - $breakMinutes;
                $attendance->work_time = sprintf(
                    '%d:%02d',
                    floor($workMinutes / 60),
                    $workMinutes % 60
                );
            } else {
                $attendance->work_time = '';
            }
        }
        return view('admin_attendance_staff', compact('staff', 'attendances', 'month'));
    }
}
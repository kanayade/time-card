<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\BreakTime;
use App\Models\AttendanceCorrection;
use App\Models\BreakTimeCorrection;

class ApprovalController extends Controller
{
    public function detail($id)
    {
        $correction = AttendanceCorrection::with(
            'attendance.user',
            'breakTimeCorrections'
        )->findOrFail($id);
        $attendance = $correction->attendance;
        $attendance->start_time = $correction->corrected_start_time;
        $attendance->end_time = $correction->corrected_end_time;
        $attendance->reason = $correction->reason;
        $breaks = [];
        foreach ($correction->breakTimeCorrections as $break) {
            $breaks[] = [
                'start' => date('H:i', strtotime($break->start_time)),
                'end' => date('H:i', strtotime($break->end_time)),
            ];
        }
        return view('attendance_detail', [
            'attendance' => $attendance,
            'breaks' => $breaks,
            'isApproval' => Auth::user()->role === 'admin',
            'correction' => $correction,
        ]);
    }
    public function approve($id)
    {
        DB::transaction(function () use ($id) {
        $correction = AttendanceCorrection::with('breakTimeCorrections')
            ->findOrFail($id);
        $attendance = Attendance::findOrFail($correction->attendance_id);
        $attendance->update([
            'start_time' => $correction->corrected_start_time,
            'end_time'   => $correction->corrected_end_time,
            'reason'     => $correction->reason,
        ]);
        BreakTime::where('attendance_id', $attendance->id)->delete();
        foreach ($correction->breakTimeCorrections as $break) {
            BreakTime::create([
                'attendance_id' => $attendance->id,
                'start_time' => $break->start_time,
                'end_time' => $break->end_time,
            ]);
        }
        $correction->update([
            'status' => '承認済み',
        ]);
    });
        return redirect('/stamp_correction_request/list');
    }
}

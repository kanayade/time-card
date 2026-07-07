<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\AttendanceCorrection;
use App\Models\BreakTimeCorrection;
use App\Http\Requests\UpdateRequest;
use Illuminate\Http\Request;

class CorrectionController extends Controller
{
    public function store(UpdateRequest $request, $id)
    {
        $validated = $request->validated();
        DB::transaction(function () use ($validated, $id) {
        $correction = AttendanceCorrection::create([
            'attendance_id' => $id,
            'user_id' => Auth::id(),
            'corrected_start_time' => $validated['start_time'],
            'corrected_end_time' => $validated['end_time'],
            'reason' => $validated['reason'],
            'status' => '承認待ち',
        ]);
        foreach ($validated['break_start'] as $index => $start) {
            $end = $validated['break_end'][$index];
            // 空欄（追加用）は保存しない
            if (empty($start) && empty($end)) {
                continue;
            }
            BreakTimeCorrection::create([
                'attendance_correction_id' => $correction->id,
                'start_time' => $start,
                'end_time' => $end,
            ]);
        }
    });
        return redirect('/stamp_correction_request/list');
    }
    public function request(Request $request)
    {
        $status = $request->status ?? '承認待ち';
        $query = AttendanceCorrection::with('attendance', 'user')
        ->where('status', $status);
        // 一般ユーザーなら自分の申請だけ
        if (Auth::user()->role === 'user') {
            $query->where('user_id', Auth::id());
        }
        // 管理者なら全件取得（条件を追加しない）
        $corrections = $query->orderBy('created_at', 'desc')->get();
        return view('request_list', compact('corrections', 'status'));
    }

}
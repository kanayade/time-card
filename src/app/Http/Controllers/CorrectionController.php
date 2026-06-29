<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateRequest;
use Illuminate\Http\Request;

class CorrectionController extends Controller
{
    public function store(UpdateRequest $request, $id)
    {
        $validatedData = $request->validated();

        AttendanceCorrection::create([
            'user_id' => Auth::id(),
            'attendance_id' => $id,
            'corrected_start_time' => $validatedData['start_time'],
            'corrected_end_time' => $validatedData['end_time'],
            'reason' => $validatedData['reason'],
            'status' => '承認待ち',
        ]);
        return redirect('/stamp_correction_request/list');
    }
}
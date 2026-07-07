@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin_attendance_staff.css') }}">
<link rel="stylesheet" href="{{ asset('css/header.css') }}">
@endsection

@section('content')
<div class="staff-attendance">

    <h1 class="staff-attendance__title">
        {{ $staff->name }}さんの勤怠
    </h1>
    <div class="month-nav">
        <a href="/admin/attendance/staff/{{ $staff->id }}?month={{ $month->copy()->subMonth()->format('Y-m') }}">← 前月</a>
    <div class="month-nav__current">📅 {{ $month->format('Y/m') }}</div>
        <a href="/admin/attendance/staff/{{ $staff->id }}?month={{ $month->copy()->addMonth()->format('Y-m') }}">翌月 →</a>
    </div>
    <table class="attendance-table">
        <thead>
            <tr>
                <th>日付</th>
                <th>出勤</th>
                <th>退勤</th>
                <th>休憩</th>
                <th>合計</th>
                <th>詳細</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->date_format }}</td>
                    <td>{{ $attendance->start_time }}</td>
                    <td>{{ $attendance->end_time }}</td>
                    <td>{{ $attendance->break_time }}</td>
                    <td>{{ $attendance->work_time }}</td>
                    <td><a href="/admin/attendance/{{ $attendance->id }}">詳細</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="csv-button-area">
            <a href="/admin/attendance/staff/{{ $staff->id }}/export?month={{ $month->format('Y-m') }}" class="csv-button">CSV出力</a>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance_list.css') }}">
<link rel="stylesheet" href="{{ asset('css/header.css') }}">

@endsection

@section('content')
<div class="attendance-list-page">
    <div class="attendance-list-card">
        <h2 class="page-title">勤怠一覧</h2>
        <div class="month-nav">
            <a href="/attendance/list?month={{ $month->copy()->subMonth()->format('Y-m') }}" class="month-link">
                ← 前月
            </a>
            <div class="month-current">
                📅 {{ $month->format('Y/m') }}
            </div>
            <a href="/attendance/list?month={{ $month->copy()->addMonth()->format('Y-m') }}" class="month-link">
                翌月 →
            </a>
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
                    <td><a href="/attendance/detail/{{ $attendance->id }}">詳細</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
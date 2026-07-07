@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin_attendance_list.css') }}">
<link rel="stylesheet" href="{{ asset('css/header.css') }}">
@endsection

@section('content')
<div class="attendance-list">
    <h1 class="attendance-list__title">
        {{ date('Y年m月d日', strtotime($date)) }}の勤怠一覧
    </h1>
    <div class="attendance-list__date-nav">
        <a href="/admin/attendance/list?date={{ \Carbon\Carbon::parse($date)->subDay()->toDateString() }}" class="date-nav__button">← 前日</a>
        <div class="date-nav__current">📅 {{ date('Y/m/d', strtotime($date)) }}</div>
        <a href="/admin/attendance/list?date={{ \Carbon\Carbon::parse($date)->addDay()->toDateString() }}" class="date-nav__button">翌日 →</a>
    </div>
    <table class="attendance-table">
        <thead>
            <tr>
                <th>名前</th>
                <th>出勤</th>
                <th>退勤</th>
                <th>休憩</th>
                <th>合計</th>
                <th>詳細</th>
            </tr>
        </thead>
        <tbody>
        @foreach($attendances as $attendance)
            <tr>
                <td>{{ $attendance->user->name }}</td>
                <td>{{ $attendance->start_time }}</td>
                <td>{{ $attendance->end_time }}</td>
                <td>{{ $attendance->break_time }}</td>
                <td>{{ $attendance->work_time }}</td>
                <td>
                    <a href="/admin/attendance/{{ $attendance->id }}">詳細</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
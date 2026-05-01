@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance-list.css') }}">
@endsection

@section('content')
<div class="attendance-list-page">
    <div class="attendance-list-card">
        <h2 class="page-title">勤怠一覧</h2>
            <div class="month-nav">
                <a href="#" class="month-link">← 前月</a>
            <div class="month-current">
                <span class="calendar-icon">📅</span>
                {{ now()->format('Y/m') }}
            </div>
            <a href="#" class="month-link">翌月 →</a>
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
                @for ($day = 1; $day <= dayInMonth(); $day++)
                <tr>
                    <td>{{ sprintf('%02d', $day) }}/{{ sprintf('%02d', rand(1,28)) }}({{ ['日','月','火','水','木','金','土'][rand(0,6)] }})</td>
                    <td>09:00</td>
                    <td>18:00</td>
                    <td>1:00</td>
                    <td>8:00</td>
                    <td>
                        <a href="#" class="detail-link">詳細</a>
                    </td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>
@endsection
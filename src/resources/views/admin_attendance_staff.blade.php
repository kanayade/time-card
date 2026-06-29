@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin_attendance_staff.css') }}">
<link rel="stylesheet" href="{{ asset('css/header.css') }}">
@endsection

@section('content')
<div class="staff-attendance">

    <h1 class="staff-attendance__title">
        西伶奈さんの勤怠
    </h1>
    <div class="month-nav">
        <button class="month-nav__button">
            ← 前月
        </button>
        <div class="month-nav__current">
            📅 2023/06
        </div>
        <button class="month-nav__button">
            翌月 →
        </button>
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
            <tr>
                <td>06/01(木)</td>
                <td>09:00</td>
                <td>18:00</td>
                <td>1:00</td>
                <td>8:00</td>
                <td><a href="#">詳細</a></td>
            </tr>
            <tr>
                <td>06/02(金)</td>
                <td>09:00</td>
                <td>18:00</td>
                <td>1:00</td>
                <td>8:00</td>
                <td><a href="#">詳細</a></td>
            </tr>
            <tr>
                <td>06/03(土)</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><a href="#">詳細</a></td>
            </tr>
        </tbody>
    </table>
    <div class="csv-button-area">
        <button class="csv-button">
            CSV出力
        </button>
    </div>
</div>
@endsection
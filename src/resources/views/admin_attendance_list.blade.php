@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin_attendance_list.css') }}">
<link rel="stylesheet" href="{{ asset('css/header.css') }}">
@endsection

@section('content')
<div class="attendance-list">
    <h1 class="attendance-list__title">
        2023年6月1日の勤怠
    </h1>
    <div class="attendance-list__date-nav">
        <button class="date-nav__button">
            ← 前日
        </button>
        <div class="date-nav__current">
            📅 2023/06/01
        </div>
        <button class="date-nav__button">
            翌日 →
        </button>
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
            <tr>
                <td>山田 太郎</td>
                <td>09:00</td>
                <td>18:00</td>
                <td>1:00</td>
                <td>8:00</td>
                <td><a href="#">詳細</a></td>
            </tr>
            <tr>
                <td>西 伶奈</td>
                <td>09:00</td>
                <td>18:00</td>
                <td>1:00</td>
                <td>8:00</td>
                <td><a href="#">詳細</a></td>
            </tr>
            <tr>
                <td>増田 一世</td>
                <td>09:00</td>
                <td>18:00</td>
                <td>1:00</td>
                <td>8:00</td>
                <td><a href="#">詳細</a></td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
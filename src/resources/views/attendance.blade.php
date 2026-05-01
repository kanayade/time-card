@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/header.css') }}">
<link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
@endsection

@section('content')
<div class="attendance-page">
    <div class="attendance-card">
        <div class="attendance-status">
            @if (!isset($status) || $status === 'off')
                勤務外
            @elseif ($status === 'working')
                勤務中
            @elseif ($status === 'break')
                休憩中
            @elseif ($status === 'done')
                退勤済
            @endif
        </div>
        <p class="attendance-date">
            {{ now()->format('Y年n月j日(D)') }}
        </p>
        <h1 class="attendance-time">
            {{ now()->format('H:i') }}
        </h1>
        <div class="attendance-buttons">
        @if (!isset($status) || $status === 'off')
            <form action="/attendance/start" method="post">
                @csrf
                <button class="btn-black" type="submit">
                    出勤
                </button>
            </form>
        @elseif ($status === 'working')
            <form action="/attendance/done" method="post">
                @csrf
                <button class="btn-black" type="submit">
                    退勤
                </button>
            </form>
        <form action="/attendance/break/start" method="post">
            @csrf
            <button class="btn-white" type="submit">
                休憩入
            </button>
        </form>
        @elseif ($status === 'break')
        <form action="/attendance/done" method="post">
            @csrf
            <button class="btn-white" type="submit">
                退勤
            </button>
        </form>
        <form action="/attendance/break/end" method="post">
            @csrf
            <button class="btn-white" type="submit">
                休憩戻
            </button>
        </form>
        @elseif ($status === 'done')
        <p class="attendance-message">
            お疲れ様でした。
        </p>
        @endif
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance_detail.css') }}">
<link rel="stylesheet" href="{{ asset('css/header.css') }}">
@endsection

@section('content')
<div class="attendance-detail-page">
    <div class="attendance-detail-card">
        <h2 class="page-title">勤怠詳細</h2>
        <div class="detail-table">
            <div class="detail-row">
                <div class="detail-label">名前</div>
                <div class="detail-value">{{ $attendance->user->name }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">日付</div>
                <div class="detail-value">
                    <span>{{ $attendance->date->format('Y年') }}</span>
                    <span class="ml">{{ $attendance->date->format('m月d日') }}</span>
                </div>
            </div>
            <div class="detail-row">
                <div class="detail-label">出勤・退勤</div>
                <div class="detail-value">
                    <input type="time" value="{{ $attendance->start_time }}">
                    <span class="between">〜</span>
                    <input type="time" value="{{ $attendance->end_time }}">
                </div>
            </div>
            <div class="detail-row">
                <div class="detail-label">休憩</div>
                <div class="detail-value">
                    <input type="time" value="{{ $attendance->break_time_1 }}">
                    <span class="between">〜</span>
                    <input type="time" value="{{ $attendance->break_time_2 }}">
                </div>
            </div>
            <div class="detail-row">
                <div class="detail-label">休憩2</div>
                <div class="detail-value">
                    <input type="time" value="{{ $attendance->break_time_3 }}">
                    <span class="between">〜</span>
                    <input type="time" value="{{ $attendance->break_time_4 }}">
                </div>
            </div>
            <div class="detail-row">
                <div class="detail-label">備考</div>
                <div class="detail-value">
                    <textarea rows="3">{{ $attendance->reason }}</textarea>
                </div>
            </div>
        </div>
        <div class="detail-button">
            <button class="btn-black">修正</button>
        </div>
    </div>
</div>
@endsection
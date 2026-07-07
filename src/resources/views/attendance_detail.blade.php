@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance_detail.css') }}">
<link rel="stylesheet" href="{{ asset('css/header.css') }}">
@endsection
@section('content')
<div class="attendance-detail-page">
    <div class="attendance-detail-card">
        <h2 class="page-title">勤怠詳細</h2>
            <form action="
                @if(isset($isApproval))
                /stamp_correction_request/approve/{{ $correction->id }}
                @else
                /attendance/correction/{{ $attendance->id }}
                @endif
                " method="post">
            @csrf
            <div class="detail-table">
                <div class="detail-row">
                    <div class="detail-label">名前</div>
                    <div class="detail-value">{{ $attendance->user->name }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">日付</div>
                    <div class="detail-value">
                        <span>{{ date('Y年', strtotime($attendance->date)) }}</span>
                        <span class="ml">{{ date('m月d日', strtotime($attendance->date)) }}</span>
                    </div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">出勤・退勤</div>
                    <div class="detail-value">
                        <input type="text" name="start_time" value="{{ old('start_time',date('H:i', strtotime($attendance->start_time))) }}"{{ ($pending ?? false) || isset($isApproval) ? ' readonly' : '' }}>
                        <span class="between">〜</span>
                        <input type="text" name="end_time" value="{{ old('end_time',date('H:i', strtotime($attendance->end_time))) }}"{{ ($pending ?? false) || isset($isApproval) ? ' readonly' : '' }}>
                    @error('start_time')
                        <div class="form__error">
                            {{ $message }}
                        </div>
                    @enderror
                    @error('end_time')
                        <div class="form__error">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                </div>
                @foreach ($breaks as $index => $break)
                <div class="detail-row">
                    <div class="detail-label">
                        {{ $index == 0 ? '休憩' : '休憩' . ($index + 1) }}
                    </div>
                    <div class="detail-value">
                        <input type="text" name="break_start[]" value="{{ old('break_start.' . $index, $break['start']) }}"{{ ($pending ?? false) || isset($isApproval) ? ' readonly' : '' }}>
                        <span class="between">〜</span>
                        <input type="text" name="break_end[]" value="{{ old('break_end.' . $index, $break['end']) }}"{{ ($pending ?? false) || isset($isApproval) ? ' readonly' : '' }}>
                        @error('break_start.' . $index)
                        <div class="form__error">
                            {{ $message }}
                        </div>
                        @enderror
                        @error('break_end.' . $index)
                        <div class="form__error">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                @endforeach
                <div class="detail-row">
                    <div class="detail-label">備考</div>
                    <div class="detail-value">
                        <textarea name="reason" rows="3"{{ ($pending ?? false) || isset($isApproval) ? ' readonly' : '' }}>{{ old('reason', $attendance->reason) }}</textarea>
                        @error('reason')
                        <div class="form__error">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="detail-button">
                @if($isApproval ?? false)
                    @if($correction->status === '承認待ち')
                        <button type="submit" class="btn-black">承認</button>
                    @else
                        <button type="button" class="btn-gray" disabled>承認済み</button>
                    @endif
                @elseif(isset($correction))
                    @if($correction->status === '承認待ち')
                        <div class="pending-message">
                            ※承認待ちのため修正できません
                        </div>
                    @endif
                @elseif($isAdmin ?? false)
                        <button type="submit" class="btn-black">修正</button>
                @elseif($pending ?? false)
                    <div class="pending-message">
                        ※承認待ちのため修正できません
                    </div>
                @else
                    <button type="submit" class="btn-black">修正</button>
                @endif
            </div>
        </form>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/request_list.css') }}">
<link rel="stylesheet" href="{{ asset('css/header.css') }}">
@endsection

@section('content')
<div class="request-page">
    <div class="request-card">
        <h2 class="page-title">申請一覧</h2>
        <div class="request-tabs">
            <a href="/stamp_correction_request/list?status=承認待ち" class="tab {{ $status == '承認待ち' ? 'active' : '' }}">承認待ち</a>
            <a href="/stamp_correction_request/list?status=承認済み" class="tab {{ $status == '承認済み' ? 'active' : '' }}">承認済み</a>
        </div>
        <table class="request-table">
            <thead>
                <tr>
                    <th>状態</th>
                    <th>名前</th>
                    <th>対象日時</th>
                    <th>申請理由</th>
                    <th>申請日時</th>
                    <th>詳細</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($corrections as $correction)
                <tr>
                    <td>{{ $correction->status }}</td>
                    <td>{{ $correction->user->name }}</td>
                    <td>{{ date('Y/m/d', strtotime($correction->attendance->date)) }}</td>
                    <td>{{ $correction->reason }}</td>
                    <td>{{ date('Y/m/d', strtotime($correction->created_at)) }}</td>
                    <td>
                        @if(Auth::user()->role === 'admin')
                            <a class="detail-link" href="/stamp_correction_request/approve/{{ $correction->id }}">詳細</a>
                        @else
                            <a class="detail-link" href="/stamp_correction_request/detail/{{ $correction->id }}">詳細</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
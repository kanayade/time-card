@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin_staff_list.css') }}">
<link rel="stylesheet" href="{{ asset('css/header.css') }}">
@endsection

@section('content')
<div class="staff-list">
    <h1 class="staff-list__title">
        スタッフ一覧
    </h1>
    <table class="staff-table">
        <thead>
            <tr>
                <th>名前</th>
                <th>メールアドレス</th>
                <th>月次勤怠</th>
            </tr>
        </thead>
        <tbody>
            @foreach($staffs as $staff)
                <tr>
                    <td>{{ $staff->name }}</td>
                    <td>{{ $staff->email }}</td>
                    <td><a href="/admin/attendance/staff/{{ $staff->id }}">詳細</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
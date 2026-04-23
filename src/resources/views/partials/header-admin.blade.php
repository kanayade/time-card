@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/header.css') }}"/>
@endsection

@section('content')
<header class="header_time-card">
    <div class="header__inner">
        <img src="{{ asset('storage/images/COACHTECHヘッダーロゴ.png') }}" alt="COACHTECH">
    </div>
    <nav class="header__nav">
        <a class="header__link" href="/admin/attendance/list">勤怠一覧</a>
        <a class="header__link" href="/admin/staff/list">スタッフ一覧</a>
        <a class="header__link" href="/admin/request/list">申請一覧</a>
        <a class="header__link" href="/logout">ログアウト</a>
    </nav>
</header>
@endsection
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
<link rel="stylesheet" href="{{ asset('css/header.css') }}">
@endsection

@section('content')
<div class="welcome">

    <h1 class="welcome__title">
        COACHTECH 勤怠管理システム
    </h1>
    <p class="welcome__text">
        ログインするユーザーを選択してください
    </p>
    <div class="welcome__buttons">
        <a href="/login" class="welcome__button">
            一般ユーザーはこちら
        </a>
        <a href="/admin/login" class="welcome__button admin">
            管理者はこちら
        </a>
    </div>
</div>
@endsection
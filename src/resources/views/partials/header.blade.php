<header class="header_time-card">
    <div class="header__inner">
        <img src="{{ asset('storage/images/COACHTECHヘッダーロゴ.png') }}" alt="COACHTECH">
    </div>
    @auth
        <nav class="header__nav">
            @if(Auth::user()->role === 'admin')
                <a href="/admin/attendance/list">勤怠一覧</a>
                <a href="/admin/staff/list">スタッフ一覧</a>
                <a href="/admin/request/list">申請一覧</a>
            @else
                <a href="/attendance">勤怠</a>
                <a href="/attendance/list">勤怠一覧</a>
                <a href="/request/list">申請</a>
            @endif
            <a href="/logout">ログアウト</a>
        </nav>
    @endauth
</header>
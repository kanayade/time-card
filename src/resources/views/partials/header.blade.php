<header class="header_time-card">
    <div class="header__inner">
        <a href="/" class="header__logo"><img src="{{ asset('storage/images/COACHTECHヘッダーロゴ.png') }}" alt="COACHTECH">
        </a>
    </div>
    @auth
        <nav class="header__nav">
            @if(Auth::user()->role === 'admin')
                <a class="header__link" href="/admin/attendance/list">勤怠一覧</a>
                <a class="header__link" href="/admin/staff/list">スタッフ一覧</a>
                <a class="header__link" href="/stamp_correction_request/list">申請一覧</a>
            @else
                <a class="header__link" href="/attendance">勤怠</a>
                <a class="header__link" href="/attendance/list">勤怠一覧</a>
                <a class="header__link" href="/stamp_correction_request/list">申請</a>
            @endif
            <form method="post" action="/logout">
                @csrf
                <button class="header__link header__logout" type="submit">ログアウト</button>
            </form>
        </nav>
    @endauth
</header>
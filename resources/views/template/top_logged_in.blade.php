@extends('template.default')

@section('header')
<header class="header">
    <div class="header_login_state">
        <p class="header_login_user">こんにちは。{{Auth::user()->name}}さん!</p>
        @if (auth()->id())
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <div class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                this.closest('form').submit(); " role="button">
                    <i class="fas fa-sign-out-alt"></i>
                    {{ __('Log Out') }}
                </a>
            </div>
        </form>
        @else
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}" role="button">
                <i class="fas fa-sign-in-alt"></i>
                Login
            </a>
        </li>
        @endif
    </div>
    <nav class="header_nav">
        <p class="header_heading">Memorize</p>
        <div class="header_menu_btn sp">
            <i class="fa-solid fa-bars fa-3x  sp"  aria-hidden="true"></i>
        </div>
        <ul class="header_list">
            <!-- <li class="header_item">
                <a href="">
                    <p class="header_topic">お気に入り投稿</p>
                    <img src="{{asset('images/file_icon.png')}}" alt="お気に入りアイコン" class="header_icon">
                </a>
            </li> -->
            <div class="header_menu_cansel_btn sp">
                <i class="fa-solid fa-xmark fa-3x sp"></i>
            </div>
            <li class="header_item">
                <a href="{{route('follower.index')}}">
                    <p class="header_topic">フォロワー一覧</p>
                    <img src="{{asset('images/follower_icon.png')}}" alt="フォロワー一覧アイコン" class="header_icon">
                </a>
            </li>
            <li class="header_item">
                <a href="{{route('profile.show')}}">
                    <p class="header_topic">マイページ</p>
                    <img src="{{asset('images/mypage_icon.png')}}" alt="マイページアイコン" class="header_icon">
                </a>
            </li>
        </ul>
    </nav>
</header>
@endsection
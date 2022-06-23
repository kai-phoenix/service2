@extends('template.default')

@section('header')
<header class="header">
    <p class="header_heading">Memorize</p>
    <nav class="header_nav">
        <div>
            <p>こんにちは。{{Auth::user()->name}}さん!</p>
        </div>
        <ul class="header_list">
            <li class="header_item">
                <p class="header_topic">お気に入り投稿</p>
                <img src="{{asset('images/file_icon.png')}}" alt="お気に入りアイコン" class="header_icon">
            </li>
            <li class="header_item">
                <p class="header_topic">フォロワー一覧</p>
                <img src="{{asset('images/follower_icon.png')}}" alt="フォロワー一覧アイコン" class="header_icon">
            </li>
            <li class="header_item">
                <p class="header_topic">マイページ</p>
                <img src="{{asset('images/mypage_icon.png')}}" alt="マイページアイコン" class="header_icon2">
            </li>
        </ul>
    <nav>
</header>
@endsection
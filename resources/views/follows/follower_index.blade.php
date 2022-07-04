@extends('template.logged_in')

@section('title',$title)
@section('content')
<main class="main_contents">
<h1>{{$title}}</h1>
@forelse($followers as $follower)
<div class="follower_list">
    <img class="follower_image" src="{{ $follower->profile_photo_url }}" alt="{{ Auth::user()->name }}">
    <p class="follower_title">{{$follower->name}}</p>
</div>
@empty
<p>フォロワーはいません。</p>
@endforelse
</main>
@endsection
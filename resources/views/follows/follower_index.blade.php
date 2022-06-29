@extends('template.logged_in')

@section('title',$title)
@section('content')
<main class="main_contents">
<h1>{{$title}}</h1>
@forelse($followers as $follower)
<img class="h-8 w-8 rounded-full object-cover" src="{{ $follower->profile_photo_url }}" alt="{{ Auth::user()->name }}"/>
<p>{{$follower->name}}</p>
@empty
<p>フォロワーはいません。</p>
@endforelse
</main>
@endsection
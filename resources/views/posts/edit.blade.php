@extends('template.logged_in')

@section('title',$title)

@section('content')
<h1>{{$title}}</h1>
<section class="contents_section">
    <div class="contents_area">
        <i class="fa-solid fa-heart"></i>
        <form method="post" action="{{route('posts.edit',$post)}}"  class="contents_list">
            @csrf
            <div class="contents_video_form">
                @if($post->movie !=='')
                <video controls width="250" src="{{asset('storage/'.$post->movie)}}" muted>
                </video>
                @else
                <img src="{{asset('images/no_image.png')}}">
                <p>ファイルはありません。</p>
                @endif
            </div>
            <div class="contents_body_list">
                @csrf
                <p>{{$post->name}}</p>
                <p>{{$post->description}}</p>
                <input type="button" value="投稿編集" class="contents_button">
            </div>
        </form>
        <div class="contents_information">
            <p>投稿者:{{$post->user->name}}</p>
            <p>カテゴリー:{{$post->category_id}}</p>
            <p>投稿時間:{{$post->created_at}}</p>
        </div>
    </div>
</section>

<section class="posts_section">
    <div class="posts_area">
        <form method="post" action="{{route('posts.update',$post)}}" class="posts_form" enctype="multipart/form-data">
            @csrf
            <div class="posts_item">
                <label for="name">タイトル:</label> 
                <input type="text" id="name" name="name" value="{{$post->name}}">
            </div>
            <div class="posts_item">
                <label for="description">本文:</label>
                <textarea id="description" name="description">{{$post->description}}</textarea>
            </div>
            <div class="posts_item">
                <label for="category">カテゴリー:</label>
                <select id="category" name="category">
                    <option value="{{$category->id}}">{{$category->category}}</option>
                </select>
            </div>
            <div>
                <p>ファイル投稿:</p>
                <div class="posts_file_list">
                    <label class="posts_file_input">
                        <input type="file" name="movie">
                        ファイルを選択
                    </label>
                    <p class="posts_filename">選択されていません</p>
                </div>
            </div>
            <button type="button" value="" onclick="window.open('{{route('posts.preview',$post)}}','_blank')">プレビュー</button>
            <input type="submit" value="新規投稿" class="posts_submit">
        </form>
    </div>
</section>
@endsection
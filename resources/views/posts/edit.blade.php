@extends('template.logged_in')

@section('title',$title)

@section('content')
<main class="main_contents">
<h1>{{$title}}</h1>
<section class="contents_section">
    <div class="contents_area">
        <div class="contents_list">
            @csrf
            <div class="contents_video_form">
                @if($post->movie !==''&&$post->filename($post)==='mp4'||$post->filename($post)==='mov'||$post->filename($post)==='x-ms-wmv'||$post->filename($post)==='mpeg')
                <video controls width="250" src="{{asset('storage/'.$post->movie)}}" muted class="contents_width">
                </video>
                @elseif($post->filename($post)==='jpg'||$post->filename($post)==='jpeg'||$post->filename($post)==='png')
                <img src="{{asset('storage/'.$post->movie)}}" class="contents_width">
                @else
                <img src="{{asset('images/no_image.png')}}">
                <p>ファイルはありません。</p>
                @endif
            </div>
            <div class="contents_body_list">
                <p class="contents_title">{{$post->name}}</p>
                <p>{{$post->description}}</p>
            </div>
        </div>
        <div class="contents_info">
            <span class="contents_post_info">
                <p>投稿者:{{$post->user->name}}</p>
                <p>カテゴリー:{{$post->category->category}}</p>
            </span>
            <p class="contents_time">投稿時間:{{$post->created_at}}</p>
        </div>
    </div>
</section>

<section class="posts_section">
    <div class="posts_area">
        <form method="post" action="{{route('posts.update',$post)}}" class="posts_form" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="posts_item">
                <label for="name">タイトル:</label> 
                <input type="text" id="name" name="name" value="{{$post->name}}">
            </div>
            <div class="posts_item">
                <label for="description">投稿説明:</label>
                <textarea id="description" name="description">{{$post->description}}</textarea>
            </div>
            <div class="posts_item">
                <label for="category">カテゴリー:</label>
                <select id="category" name="category">
                    <option value="{{$category->id}}">{{$category->category}}</option>
                </select>
            </div>
            <div class="posts_item">
                <p>ファイル投稿:<br>(上限:1GB)</p>
                <div class="posts_file_list">
                    <label class="posts_file_input">
                        <input type="file" name="movie">
                        ファイルを選択
                    </label>
                    <p class="posts_filename">選択されていません</p>
                </div>
            </div>
            <!-- <button type="button" value="" onclick="window.open('{{route('posts.preview',$post)}}','_blank')">プレビュー</button> -->
            <input type="submit" value="新規投稿" class="posts_submit">
        </form>
    </div>
</section>
</main>
@endsection
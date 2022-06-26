@extends('template.top_logged_in')

@section('title',$title)

@section('content')
<main class="main_contents">
<h1>{{$title}}</h1>
<section class="terms_list">
    <div class="search_area">
        <p>絞り込み</p>
        <form method="GET">
            <div class="search_item">
                <label for="span">期間:</label> 
                <input type="date" id="span" class="search_input">~<input type="date" class="search_input">
            </div>
            <div class="search_item">
                <label for="category">カテゴリー:</label>
                <input type="text" id="category">
            </div>
            <div class="search_item">
                <input type="text" placeholder="タイトル及び本文検索" class="search_word" name="keyword">
                <input type="submit" value="検索" class="search_submit">
            </div>
        </form>
        <a href="{{route('posts.index')}}">絞り込み解除</a>
    </div>
    <div class="follow_area">
        <p>おすすめユーザー</p>
        <p></p>
    </div>
</section>
<div class="sort_list">
    <p>並び替え:</p>
    <div>
        <a href="" class="sort_link">投稿日時</a>
        <a href="">カテゴリー</a>
    </div>
</div>

@forelse($posts as $post)
<section class="contents_section">
    <div class="contents_area">
        <i class="fa-solid fa-heart"></i>
        <div class="contents_list">
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
                <p>{{$post->name}}</p>
                <p>{{$post->description}}</p>
                <button type="button" class="contents_button" onclick="location.href='{{route('posts.edit',$post)}}'">投稿編集へ</button>
                <!-- <input type="button" value="プレビュー" onclick="window.open('{{route('posts.edit',$post)}}','_blank')"> -->
                <!-- <button name="action" value="update" pnclick="this.form.target='_top'">更新</button> -->
            </div>
        </div>
        <div class="contents_information">
            <p>投稿者:{{$post->user->name}}</p>
            <p>カテゴリー:{{$post->category_id}}</p>
            <p>投稿時間:{{$post->created_at}}</p>
        </div>
    </div>
    <img src="{{asset('images/post_remove.png')}}" alt=""投稿削除マーク" class="contents_remove">
</section>
@empty
<p>投稿はありません。</p>
@endforelse

<section class="posts_section">
    <img src="{{asset('images/post_add.png')}}" alt=""新規投稿マーク" class="posts_add">
    <div class="posts_area">
        <form method="post" action="{{route('posts.store')}}" class="posts_form" enctype="multipart/form-data">
            @csrf
            <div class="posts_item">
                <label for="name">タイトル:</label> 
                <input type="text" id="name" name="name">
            </div>
            <div class="posts_item">
                <label for="description">本文:</label>
                <textarea id="description" name="description"></textarea>
            </div>
            <div class="posts_item">
                <label for="category">カテゴリー:</label>
                <select id="category" name="category">
                    <option value="1">日常</option>
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
            <input type="submit" value="新規投稿" class="posts_submit">
        </form>
    </div>
</section>
</main>
@endsection
@extends('template.top_logged_in')

@section('title',$title)

@section('content')
<main class="main_contents">
<h1>{{$title}}</h1>
<div>
    <p>絞り込み</p>
    <form method="post" action="">
        @csrf
        <div class="search_item">
            <label for="span">期間:</label> 
            <input type="date" id="span" class="search_input">~<input type="date" class="search_input">
        </div>
        <div class="search_item">
            <label for="favarite">お気に入り:</label>
            <input type="text" id="favarite">
        </div>
        <div class="search_item">
            <label for="category">カテゴリー:</label>
            <input type="text" id="category">
        </div>
        <div class="search_item">
            <input type="text" placeholder="検索ワードを入力" class="search_word">
            <input type="submit" value="検索" class="search_submit">
        </div>
    </form>
</div>
<div class="sort_list">
    <p>並び替え:</p>
    <div>
        <a href="" class="sort_link">投稿日時</a>
        <a href="">カテゴリー</a>
    </div>
</div>

<section class="contents_section">
    <div class="contents_area">
        <i class="fa-solid fa-heart"></i>
        <div class="contents_list">
            <form method="post" action="" class="contents_video_form">
                @csrf
                <video controls width="250" src="{{asset('videos/Ocean.mp4')}}" muted>
                </video>
                <input type="submit" value="ファイル編集" class="contents_button">
            </form>
            <div class="contents_body_list">
                <p>タイトル</p>
                <textarea></textarea>
                <input type="submit" value="投稿編集" class="contents_button">
            </div>
        </div>
        <div class="contents_information">
            <p>カテゴリー:</p>
            <p>投稿時間:</p>
        </div>
    </div>
    <img src="{{asset('images/post_remove.png')}}" alt=""投稿削除マーク" class="contents_remove">
</section>

<section class="posts_section">
    <img src="{{asset('images/post_add.png')}}" alt=""新規投稿マーク" class="posts_add">
    <div class="posts_area">
        <form method="post" action="route{{" class="posts_form">
            @csrf
            <div class="posts_item">
                <label for="title">タイトル:</label> 
                <input type="text" id="title">
            </div>
            <div class="posts_item">
                <label for="body">本文:</label>
                <textarea id="body"></textarea>
            </div>
            <div class="posts_item">
                <label for="category">カテゴリー:</label>
                <select id="category">
                    <option>日常</option>
                </select>
            </div>
            <div>
                <p>ファイル投稿:</p>
                <div class="posts_file_list">
                    <label class="posts_file_input">
                        <input type="file">
                        ファイルを選択
                    </label>
                    <p>選択されていません</p>
                </div>
            </div>
            <input type="submit" value="新規投稿" class="posts_submit">
        </form>
    </div>
</section>
</main>
@endsection
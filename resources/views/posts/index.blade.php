@extends('template.top_logged_in')

@section('title',$title)
@section('content')
<main class="main_contents">
<h1>{{$title}}</h1>
<section class="terms_list">
    <div class="search_area">
        <p class="search_title">絞り込み</p>
        <form method="GET">
            <!-- <div class="search_item">
                <label for="span">期間:</label>
                <span>
                <input type="date" id="span" class="search_input">~<input type="date" class="search_input">
                </span>
            </div>
            <div class="search_item">
                <label for="category">カテゴリー:</label>
                <input type="text" id="category">
            </div> -->
            <div class="search_item">
                <input type="text" placeholder="タイトル及び本文検索" class="search_word" name="keyword">
                <input type="submit" value="検索" class="search_submit">
            </div>
        </form>
        <a href="{{route('posts.index')}}">絞り込み解除</a>
    </div>
    <div class="follow_area">
        <p class="follow_title">おすすめユーザー</p>
        <ul>
            @forelse($recommended_users as $recommended_user)
            <li>
                <p>{{$recommended_user->name}}</p>

                @if(Auth::user()->isFollowing($recommended_user))
                <form method="post" action="{{route('follows.destroy',$recommended_user)}}">
                    @csrf
                    @method('delete')
                    <input type="submit" value="フォロー解除">
                </form>
                @else
                <form method="post" action="{{route('follows.store',$recommended_user)}}">
                    @csrf
                    <input type="hidden" name="follow_id" value="{{$recommended_user->id}}">
                    <input type="submit" value="フォロー">
                </form>
                @endif
            </li>
            @empty
            <li>おすすめユーザーはいません。</li>
            @endforelse
        </ul>
    </div>
</section>
<div class="sort_list">
    <p>並び替え:</p>
    <div>
        <a href="./posts?sort=time" class="sort_link">投稿日時</a>
        <a href="./posts?sort=category">カテゴリー</a>
    </div>
</div>

@forelse($posts as $post)
<section class="contents_section">
    <div class="contents_area">
        <a class="like_button">
        <i class="fa-solid fa-heart"></i>
            {{--$post->isLikedBy(Auth::user())--}}
        </a>
        <!-- <form method="post" class="like" action="{{-- route('posts.toggle_like', $post) --}}">
            @csrf
            @method('patch')
        </form> -->
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
                <button type="button" class="contents_button" onclick="location.href='{{route('posts.edit',$post)}}'">投稿編集へ</button>
                <!-- <input type="button" value="プレビュー" onclick="window.open('{{route('posts.edit',$post)}}','_blank')"> -->
                <!-- <button name="action" value="update" pnclick="this.form.target='_top'">更新</button> -->
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
    <form method="post" action="{{route('posts.destroy',$post)}}">
    @csrf
    @method('delete')
    @if($post->user_id===Auth::user()->id)
    <button type="submit">
    <img src="{{asset('images/post_remove.png')}}" alt=""投稿削除マーク" class="contents_remove">
    </button>
    @else
    @endif
    </form>
</section>
@empty
<p>投稿はありません。</p>
@endforelse

<section class="posts_section">
    <img src="{{asset('images/post_add.png')}}" alt="新規投稿マーク" class="posts_add">
    <div class="posts_area">
        <form method="post" action="{{route('posts.store')}}" class="posts_form" enctype="multipart/form-data">
            @csrf
            <div class="posts_item">
                <label for="name">タイトル:</label> 
                <input type="text" id="name" name="name">
            </div>
            <div class="posts_item">
                <label for="description">投稿説明:</label>
                <textarea id="description" name="description"></textarea>
            </div>
            <div class="posts_item">
                <label for="category">カテゴリー:</label>
                <select id="category" name="category">
                    @forelse($categories as $category)
                    <option value="{{$category->id}}">{{$category->category}}</option>
                    @empty
                    <p>カテゴリーがありません。</p>
                    @endforelse
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
            <button type="submit" class="posts_submit">新規投稿</button>
        </form>
    </div>
</section>
</main>
@endsection
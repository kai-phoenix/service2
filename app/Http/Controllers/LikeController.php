<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Modell
use App\Http\Models\User; 

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //ログインユーザー情報の取得
        $user=\Auth::user();
        //いいねしている投稿内容の取得
        $like_posts=$user->likePosts;
        return view('likes.index',[
            'title'=>'お気に入り投稿',
            'like_posts'=>$like_posts,
        ]);
    }
}
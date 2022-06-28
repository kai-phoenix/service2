<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Follow;

class FollowController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        $follow_user_ids = $user->follow_users->pluck('id');
        $user_posts = $user->posts()->orWhereIn('user_id', $follow_user_ids )->latest()->get();
        return view('posts.index', [
          'title' => '投稿一覧',
          'posts' => $user_posts,
          'recommended_users' => User::recommend($user->id)->get()
        ]);
    }
    // フォロー追加処理
    public function store(Request $request)
    {
        $user = \Auth::user();
        Follow::create([
           'user_id' => $user->id,
           'follow_id' => $request->follow_id,
        ]);
        \Session::flash('success', 'フォローしました');
        return redirect()->route('posts.index');
    }
 
    // フォロー削除処理
    public function destroy($id)
    {
        $follow = \Auth::user()->follows->where('follow_id', $id)->first();
        $follow->delete();
        \Session::flash('success', 'フォロー解除しました');
        return redirect()->route('posts.index');
    }

    public function followerIndex()
    {
        $followers=\Auth::user()->followers;
        return view('follows.follower_index',[
            'title'=>'フォロワー一覧',
            'followers'=>$followers,
        ]);
    }
}

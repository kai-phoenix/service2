<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// 作成Request
use App\Http\Requests\PostRequest;
use App\Http\Requests\PostImageRequest;

// Model
use App\Models\User;
use App\Models\Post;
use App\Models\Category;
class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        // ログインユーザー情報の取得
        $user = \Auth::user();
        // 全カテゴリーの取得
        $categories=Category::latest()->get();
        // フォローユーザー情報の取得
        $follow_user_ids=$user->follow_users->pluck('id');
        // $posts=$user->posts()->orWhereIn('user_id',$follow_user_ids);
        $posts=Post::whereIn('user_id',$follow_user_ids->concat([$user->id]));
        // キーワード取得
        if($request->input('keyword')!=='' && $request->input('keyword')!==NULL)
        {
            $keyword=$request->input('keyword');
            // キーワード検索
            $posts->where('name','LiKE',"%{$keyword}%")->orWhere('description','LiKE',"%{$keyword}%");
        }
        $user_posts=$posts->latest()->get();
        // 並び替えの設定
        $sort=$request->sort;
        $user_posts=$user_posts->sortByDesc($sort);
        $recommend_users=User::where('id','!=',$user->id)->get();
        return view('posts.index',[
            'title'=>'投稿一覧',
            'posts'=>$user_posts,
            'categories'=>$categories,
            'recommended_users' =>$recommend_users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    // 投稿動作の記述
    public function store(PostRequest $request)
    {
        //動画ファイル投稿用のパス
        $path='';
        $movie=$request->file('movie');
        if(isset($movie)===true)
        {
            //storage/app/public/videosにパスを保存
            $path=$movie->store('videos','public');
        }
        Post::create([
            'user_id'=>\Auth::user()->id,
            'category_id'=>$request->category,
            'name'=>$request->name,
            'description'=>$request->description,
            'movie'=>$path,
        ]);
        session()->flash('success','投稿しました。');
        return redirect()->route('posts.index');
    }

    public function show($id)
    {

    }

    // プレビュー表示
    public function preview($id)
    {
        $post=Post::find($id);
        return view('posts.preview',[
            'title'=>'プレビュー',
            'post'=>$post,
        ]);
    }

    public function edit($id)
    {
        $post=Post::find($id);
        // 全カテゴリーの取得
        $categories=Category::latest()->get();
        return view('posts.edit',[
            'title'=>'投稿編集',
            'post'=>$post,
            'categories'=>$categories,
        ]);
    }

    public function update(PostRequest $request, $id)
    {
        $path='';
        $movie=$request->file('movie');
        if(isset($movie)===true)
        {
            $path=$movie->store('videos','public');
        }
        $post=Post::find($id);
        if($post->movie!=='')
        {
            \Storage::disk('public')->delete(\Storage::url($post->movie));
        }
        $post->update([
            'name'=>$request->name,
            'description'=>$request->description,
            'movie'=>$path,
            'category_id'=>$request->category,
        ]);
        session()->flash('success','投稿情報を編集しました');
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::find($id);
        //投稿動画データの削除
        if($post->movie!=='')
        {
            \Storage::disk('public')->delete($post->movie);
        }
        $post->delete();
        session()->flash('success','投稿情報を削除しました。');
        return redirect()->route('posts.index');
    }
}

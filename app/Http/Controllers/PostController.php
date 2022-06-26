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
        // dd(\Auth::user());
        // キーワード取得
        if($request->input('keyword')!=='')
        {
            $keyword=$request->input('keyword');
            // キーワード検索
            $posts=Post::where('name','LiKE',"%{$keyword}%")->orwhere('description','LiKE',"%{$keyword}%")->latest()->get();
        }
        //$posts=Post::latest()->get();
        return view('posts.index',[
            'title'=>'投稿一覧',
            'posts'=>$posts,
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
    public function store(Request $request)
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
        $category=Category::find($post->pluck('category_id'))->first();
        return view('posts.edit',[
            'title'=>'投稿編集',
            'post'=>$post,
            'category'=>$category,
        ]);
    }

    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

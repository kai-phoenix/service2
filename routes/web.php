<?php
// 投稿画面をresourceで設定
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
Route::resource('posts',PostController::class);
// プレビュー用ルート
Route::get('/posts/edit/preview',[PostController::class,'preview'])->name('posts.preview');
use App\Http\Controllers\LikeController;
Route::get('/likes',[LikeController::class,'index']);
// フォロー用ルート
use App\Http\Controllers\FollowController;
Route::resource('follows','FollowController::class')->only([
    'index','store','destroy'
]);
Route::post('/follows',[FollowController::class,'store'])->name('follows.store');
Route::delete('/follows/{follow}',[FollowController::class,'destroy'])->name('follows.destroy');
Route::get('/follower',[FollowController::class,'followerIndex'])->name('follower.index');
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
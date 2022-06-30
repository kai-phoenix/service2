<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Like;

class Post extends Model
{
    use HasFactory;
    protected $fillable=['user_id','category_id','name','description','movie'];

    // ファイル判定用関数
    public function filename($filepath)
    {
        return pathinfo($filepath->movie,PATHINFO_EXTENSION);
    }
    // リレーション(users)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function likedUsers()
    {
        return $this->belongsToMany(User::class,'likes');
    }
    public function isLikedBy($user)
    {
        $liked_user_ids=$this->likedUsers->pluck('id');
        dd($liked_user_ids);
        $result=$liked_users_ids->contains($user->id);
        return $result;
    }
}

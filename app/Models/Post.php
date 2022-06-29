<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}

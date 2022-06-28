<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

// リレーション
use App\Models\Follow;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
    // スコープ
    public function scopeRecommend($query,$self_id)
    {
        return $query->where('id','!=','self_id')->latest()->limit(3);
    }
    // リレーション
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function follows()
    {
        return $this->hasMany('App\Models\Follow');
    }
    public function follow_users()
    {
        return $this->belongsToMany('App\Models\User','follows','user_id','follow_id');
    }
    public function followers()
    {
        return $this->belongsToMany('App\Models\User','follows','follow_id','user_id');
    }
    // フォローチェック
    public function isFollowing($user)
    {
        $result=$this->follow_users->pluck('id')->contains($user->id);
        return $result;
    }
}
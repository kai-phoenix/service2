<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>['required','max:300'],
            'body'=>['required','max:1000'],
            'category'=>['required'],
            // 画像、動画ファイル(mp4,mov,wnv,mpeg,avi,jpg,png,jpeg)をチェック
            'movie'=>['required','file','mimes:mp4,mov,x-ms-wmv,mpeg,avi,jpeg,jpg,png',
            'dimensions:min_width=50,min_height=50,max_width=10000,max_width=10000'],
        ];
    }
}

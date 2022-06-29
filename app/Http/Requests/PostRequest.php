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
            'description'=>['required','max:1000'],
            'category'=>['required','exists:categories,id'],
            // 画像、動画ファイル(mp4,mov,wnv,mpeg,avi,jpg,png,jpeg)をチェック
            'movie'=>['required','file','mimes:mp4,mov,x-ms-wmv,mpeg,avi,jpeg,jpg,png',
            'max:1000000'],
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MypageRequest extends FormRequest
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
            'name' => 'required|string|max:25',
            'nickname' => 'required|string|max:50',
            'email' => 'nique:users|required|email|max:50',
            'password' => 'required|min:6|',
            'age' => 'required|integer|between:0,99',
            'gender' => 'required',
            'introduction' => 'required|string|max:1000',
            'github_url' => 'nullable',
            'facebook_url' => 'nullable',
            'qita_url'=> 'nullable', 
            'icon_image' => 'image|mimes:jpg,jpeg,png|max:2048'
        ];
    }
}

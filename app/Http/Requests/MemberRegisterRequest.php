<?php

namespace App\Http\Requests;

use App\Rules\test;
use Illuminate\Foundation\Http\FormRequest;

class MemberRegisterRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|email|unique:members',
            'password' => 'required|string|min:6|max:18',
            'avatar' =>  'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}

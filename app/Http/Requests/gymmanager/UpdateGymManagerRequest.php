<?php

namespace App\Http\Requests\gymmanager;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGymManagerRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$this->user->id,
            'national_id' => 'required|string|max:255|unique:users,national_id,'.$this->user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'gym_id'=>'exists:gyms,id',
            'avatar' => 'file|mimes:jpeg,png'
        ];
    }
}

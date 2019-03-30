<?php

namespace App\Http\Requests\session;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSessionRequest extends FormRequest
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
            'name' => 'required|max:80',
            'starts_at' => 'required',
            'finishes_at' => 'required',
            'gym_id'=> 'required|exists:gyms,id',
        ];
    }
}

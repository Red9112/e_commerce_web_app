<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name'=>'string|required',
            'email'=>'required|unique:users,email,' . request()->route('user')->id,
            'password'=>'required|min:4',
           'picture'=>'image|mimes:jpeg,jpg,svg,png|max:2048|'
         ];
    }
}

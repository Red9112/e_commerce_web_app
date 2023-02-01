<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'code'=>'required|min:3',
            'name'=>'required',
            'type'=>'required|string',
            'value_percent'=>'required|integer',
         ];
    }
}

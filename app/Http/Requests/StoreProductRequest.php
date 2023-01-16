<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
           'sku'=>'required',
           'name'=>'required',
           'price'=>'required|integer',
           'qty_in_stock'=>'integer',
           'category_id'=>'required',
           'picture'=>'image|mimes:jpeg,jpg,svg,png|max:1024|'
        ];
    }
}

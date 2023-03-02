<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'shipping'=>'required',
            'products'=>'required',
            'quantity' =>'required',
        ];
        foreach ($this->input('quantity', []) as $product_id => $quantity) {
            $rules['quantity.'.$product_id] = [
                'required',
                function ($attribute, $value, $fail) use ($product_id) {
                    $product = Product::findOrFail($product_id);
                    if ($value > $product->quantity) {
                        $fail('The quantity for product ID '.$product_id.' is not available.');
                    }
                }
            ];
        }

    }
}

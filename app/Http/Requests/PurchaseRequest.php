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
    $rules = [
        'shipping' => 'required',
        'products' => 'required',
    ];
    $quantities = $this->input('quantity', []);
        foreach ($quantities as $productId => $quantity) {
            $product = Product::findOrfail($productId);
                $rules['quantity.'.$productId] = [
                    'required',
                    'integer',
                    'min:1',
                    'max:'.$product->qty_in_stock,
                ];
        }
        
        return $rules;
    }
    public function messages()
    {
        return [
            'quantity.*.max' => 'The chosen quantity is not available in stock',
        ];
    }
    
}


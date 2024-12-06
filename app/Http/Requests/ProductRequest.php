<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        if($this->isMethod('post')){

            return [
                'name'=>['required','string','min:3','max:255',
                        Rule::unique('products','name')],
                'price'=>['required','numeric','min:0'],
                'category_id'=>[ 'exists:categories,id'],
                'store_id'=>['exists:stores,id'],
                'image'=>['image','max:1048576','dimensions:min_width=100,min_height=100'],
                'status'=>'in:active,archived,draft'
            ];
        }else{

            $id=$this->route('product');
            return [
                'name'=>['required','string','min:3','max:255',
                        Rule::unique('products','name')->ignore($id)],
                'price'=>['required','numeric','gt:0'],
                'category_id'=>[ 'exists:categories,id'],
                'store_id'=>[ 'exists:stores,id'],
                'image'=>['image','max:1048576','dimensions:min_width=100,min_height=100'],
                'status'=>'in:active,archived,draft'
            ];
        }

    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
    {         //$this=request
            if($this->isMethod('post')){
                 return[
                    'name'=>['required','string','min:3','max:255',
                            Rule::unique('stores','name')],
                    'image'=>['image','max:1048576','dimensions:min_width=100,min_height=100'],
                    'status'=>['in:active,archived']
                 ];
            }else{
                $id=$this->route('store');
                return[
                    'name'=>['required','string','min:3','max:255',
                            Rule::unique('stores','name')->ignore($id)],
                    'image'=>['image','max:1048576','dimensions:min_width=100,min_height=100'],
                    'status'=>['in:active,archived']
                 ];
            }
    }
}

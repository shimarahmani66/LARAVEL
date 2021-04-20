<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
     * @return array
     */
    public function rules()
    {
        //dd($this->product->id);
        return [
            'title'=>'required|unique:products,title,'.$this->product->id,
            'price'=>'integer',
            'file'=>'mimes:jpeg,png|max:1024'

        ];
        
    }
    public function messages()
    {
        
        return [
            'title.required'=>'نام عنوان نمی تواند خالی باشد ',
        'title.unique'=>' نام عنوان نمی تواند تکراری باشد ',
        'price.integer'=>'قیمت باید عدد صحیح باشد',
        'file.mimes'=>'نوع فایل باید jpeg یا png باشد',
        'file.max'=>'حجم فایل نباید بیشتر از 1 مگا بایت باشد',
        ];  
    }
}

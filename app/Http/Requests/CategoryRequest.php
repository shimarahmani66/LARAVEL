<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Category;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    //اگر true
    //  باشد یعنی اگر اعتبار سنجی با خطا مواج شد نیز عمل redirect را انجام دهد.
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
         //dd($this->category->id);
        return [
            'cat_name'=>'required',
            'cat_ename'=>'required|unique:categories,cat_ename,'.$this->category->id,
            'parent_id'=>'required',
        ];
    }
    //  اگر در پوشه زبان ها به طور دستی پوشه 
    // fa
    // را ایجاد کنیم و در آنجا 
    // attribute
    //  را ندهیم میتوانیم به عنوان المان سوم
    // $validator=Validator::make($request->all(),[rules],[messagess],[attributes]); 
    //مقادیر زیر را  به فساد ولیدیتور بدهیم یا اینکه در متد زیر آنها را وارد کنیم
    // public function attributes()
    // {
    //     return [
    //         'cat_name'=>'نام دسته',
    //         'cat_ename'=>'نام انگلیسی دسته',
    //         'parent_id'=>'نام سر دسته',
    //     ];
    // }
    public function messages()
    {
        return ['cat_name.required'=>'نام دسته نمی تواند خالی باشد ',
        'cat_ename.required'=>' نام انگلیسی دسته نمی تواند خالی باشد ',
        'cat_ename.unique'=>'نام انگلیسی دسته نمی تواند تکراری باشد ',
        'parent_id.required'=>'نام سر دسته نمی تواند خالی باشد ',

        ];  
    }
}

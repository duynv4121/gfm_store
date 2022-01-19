<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChildCateRequest extends FormRequest
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
            'child_cate_name' => 'required|unique:child_category,name',
        ];
    }

    public function messages(){
        return [
            'child_cate_name.required' => 'Vui lòng nhập tên loại sản phẩm',
            'child_cate_name.unique' => 'Tên loại sản phẩm đã tồn tại',
        ];
    }
}
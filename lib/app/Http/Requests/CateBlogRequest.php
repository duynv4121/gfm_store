<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CateBlogRequest extends FormRequest
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
            'name' => 'required|unique:category_blog'
        ];
    }
    public function messages() {
        return [
             'name.required' => 'Tên danh mục bài viết không được bỏ trống',
             'name.unique' => 'Tên danh mục bài viết đã tồn tại ',
        ];
    }
}
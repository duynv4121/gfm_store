<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => 'required|unique:category',
            'img' => 'required|image',
        ];
    }
    public function messages() {
        return [
             'name.required' => 'Tên danh mục không được bỏ trống',
             'name.unique' => 'Tên danh mục đã tồn tại ',
             'img.required' => 'Vui lòng chọn ảnh cho danh mục',
             'img.image' => 'Ảnh không đúng định dạng',
        ];
    }
}
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'name' => 'required|unique:blog',
            'image' => 'required|image',
            'summary' => 'required',
            'content' => 'required',
            'post_day' => 'required',
           ];
    }
    public function messages() {
        return [
             'name.required' => 'Tiêu để bài viết không được bỏ trống',
             'name.unique' => 'Tiêu đề đã tồn tại',
             'image.required' => 'Vui lòng chọn ảnh',
             'image.image' => 'File ảnh không đúng định dạng',
             'summary.required' => 'Tóm tắt bài viết không được bỏ trống',
             'content.required' => 'Nội dung bài viết không được bỏ trống',
             'post_day.required' => 'Vui lòng chọn ngày đăng bài',
        ];
    }
}
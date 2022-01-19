<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SlideRequest extends FormRequest
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
            'slide_title' => 'required',
            'slide_description' => 'required',
            'slide_content' => 'required',
            'slide_image' => 'required|image',
        ];
    }
    public function messages() {
        return [
             'slide_title.required' => 'Vui lòng nhập tiêu đề',
             'slide_description.required' => 'Vui lòng nhập mô tả của ảnh',
             'slide_content.required' => 'Vui lòng nhập nội dung',
             'slide_image.required' => 'Vui lòng chọn ảnh banner',
             'slide_image.image' => 'Ảnh banner không đúng định dạng',
        ];
    }
}
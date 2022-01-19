<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentBlogRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email',
            'content' => 'required'
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập họ tên của bạn',
            'email.required' => 'Vui lòng nhập email của bạn',
            'email.email' => 'Email của bạn không đúng định dạng',
            'content.required' => 'Vui lòng nhập nội dung nếu muốn bình luận'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class loginRequest extends FormRequest
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
            'email' => ['email', 'ends_with:@gmail.com', 'required',],
            'password' => ['required', 'min:8'],
        ];
    }


    public function messages()
    {
        return [
            'email.required' => 'Hãy nhập email đăng nhập vào',
            'email.email' => 'Tài khoản đăng nhập là một email',
            'email.ends_with' => 'Định dạng email không hợp lệ',
           
            'password.required' => 'Hãy nhập mật khẩu đăng nhập của bạn vào',
            'password.min' => 'Mật khẩu đăng nhập ít nhất 8 kí tự',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class registerRequest extends FormRequest
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
            'email' => ['email', 'ends_with:@gmail.com', 'required', 'unique:customer,email'],
            'password' => ['required', 'min:8'],
            'fullname' => ['required', 'min:5', 'max:30'],
            're-password' => ['required', 'same:password']
        ];
    }


    public function messages()
    {
        return [
            'email.required' => 'Hãy nhập email đăng nhập vào',
            'email.email' => 'Tài khoản đăng nhập là một email',
            'email.ends_with' => 'Định dạng email không hợp lệ',
            'email.unique' => 'Email đăng kí đã tồn tại',

            'fullname.required' => 'Hãy nhập tên đầy đủ của bạn vào',
            'fullname.min' => 'Độ dài tên không họp lệ',
            'fullname.max' => 'Độ dài của tên không lệ',

            'password.required' => 'Hãy nhập mật khẩu đăng nhập của bạn vào',
            'password.min' => 'Mật khẩu đăng nhập ít nhất 8 kí tự',
            're-password.required' => 'Nhập lại mật khẩu của bạn',
            're-password.same' => 'Mật khẩu bạn nhập không khớp với nhau'

        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updatePassRequest extends FormRequest
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
            'password' => ['required', 'min:8'],
            're-password' => ['required', 'same:password']
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'Hãy nhập mật khẩu đăng nhập của bạn vào',
            'password.min' => 'Mật khẩu đăng nhập ít nhất 8 kí tự',
            're-password.required' => 'Nhập lại mật khẩu của bạn',
            're-password.same' => 'Mật khẩu bạn nhập không khớp với nhau'
        ];
    }
}

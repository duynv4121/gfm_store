<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class customerProfileRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        return [
            'fullname' => ['required', 'min:5', 'max:30'],
            'phone' => ['digits_between:9,10', 'integer'],
            'address' => ['min:10']
        ];
    }

    public function messages()
    {
        return [
            'fullname.required' => 'Hãy nhập tên đầy đủ của bạn vào',
            'fullname.min' => 'Độ dài tên không họp lệ',
            'fullname.max' => 'Độ dài của tên không lệ',

            'phone.digits_between' => 'Số điện thoại không hợp lệ',
            'digits_between.integer' => 'Số điện thoại không hợp lệ',

            'address.min' => 'Địa chỉ không hợp lệ',

        ];
    }
}

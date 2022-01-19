<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeeshipRequest extends FormRequest
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
            'district' => 'required',
            'village' => 'required',
            'feeship' => 'required|integer',
        ];
    }
    public function messages() {
        return [
             'district.required' => 'Vui lòng chọn tỉnh thành/thành phố',
             'village.required' => 'Vui lòng chọn quận/huyện',
             'feeship.required' => 'Vui lòng nhập phí vận chuyển',
             'feeship.integer' => 'Phí vận chuyển không hợp lệ',
        ];
    }
}
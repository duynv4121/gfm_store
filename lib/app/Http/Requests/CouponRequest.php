<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            'name' => 'required|unique:coupon,coupon_name',
            'code' => 'required|unique:coupon,coupon_code',
            'value' => 'required|integer',
            'quanlity' => 'required|integer',
            'date_start' => 'required',
            'date_end' => 'required',
            'status' => 'required',
        ];
    }
    public function messages() {
        return [
             'name.required' => 'Vui lòng nhập tên mã giảm giá',
             'name.unique' => 'Tên mã giảm giá đã tồn tại ',
             'code.required' => 'Vui lòng nhập mã giảm giá',
             'code.unique' => 'Mã giảm giá đã tồn tại',
             'value.required' => 'Vui lòng nhập giá trị',
             'value.integer' => 'Giá trị phải là số',
             'quanlity.required' => 'Vui lòng nhập số lượng',
             'quanlity.integer' => 'Giá trị phải là số',
             'date_start.required' => 'Vui lòng chọn ngày bắt đầu',
             'date_end.required' => 'Vui lòng chọn ngày kết thúc',
             'status.required' => 'Vui lòng chọn tình trạng',
        ];
    }
}

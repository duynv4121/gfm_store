<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|unique:product',
            'price_cost' => 'required|integer|max:price',
            'price' => 'required|integer',
            'price_sales' => 'integer',
            'quanlity' => 'required|integer',
            'add_day' => 'required',
            'expired_day' => 'required',
            'img' => 'required|image',
            'child_cate_id' => 'required'
        ];
    }
    public function messages() {
        return [
            'name.required' => 'Tên sản phẩm không được bỏ trống',
            'name.unique' => 'Tên sản phẩm đã tồn tại ',
            'price_cost.required' => 'Vui lòng nhập giá gốc',
            'price_cost.integer' => 'Giá gốc sản phẩm không hợp lệ',
            'price.required' => 'Vui lòng nhập giá bán',
            'price.integer' => 'Giá bán sản phẩm không hợp lệ',
            'price_sales.integer' => 'Giá khuyến mãi sản phẩm không hợp lệ',
            'quanlity.required' => 'Vui lòng nhập số lượng sản phẩm',
            'quanlity.integer' => 'Số lượng sản phẩm không hợp lệ',
            'add_day.required' =>'Vui lòng nhập ngày nhập sản phẩm',
            'expired_day.required' =>'Vui lòng nhập ngày hết hạn',
            'img.required' => 'Vui lòng chọn ảnh',
            'img.image' => 'File ảnh không đúng định dạng',
            'child_cate_id.required' => 'Vui lòng chọn loại sản phẩm'
        ];
    }
}
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class productsRequest extends FormRequest
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
            //
            'name' => 'required|unique:product,name',
            'cate_id' => 'required',
            'cost' => 'required',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'name.unique' => 'Tên sản phẩm không được trùng',
            'cate_id.required' => 'Vui lòng nhập mã loại',
            'cost.required' => 'vui lòng nhập đơn giá',
        ];
    }
}

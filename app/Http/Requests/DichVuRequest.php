<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DichVuRequest extends FormRequest
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
            'ten'=>'required|max:100:dichvu,TenDichVu',
            'mota'=>'max:200:dichvu,TenDichVu'
        ];
    }

    public function messages(){
        return [
            'ten.required'=>'Yêu cầu điền tên dịch vụ',
            'ten.max:100'=>'Tên dịch vụ quá dài',
            'mota.max:200'=>'Mô tả quá dài'
        ];
    }
}

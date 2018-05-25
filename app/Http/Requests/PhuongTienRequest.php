<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhuongTienRequest extends FormRequest
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
            'ten'=>'required|max:100:phuongtien,Ten',
            'mota'=>'max:200:phuongtien,MoTa'
        ];
    }

    public function messages(){
        return [
            'ten.required'=>"Vui lòng nhập tên phương tiện",
            'ten.max:100'=>"Tên phương tiện quá dài (dưới 50 ký tự)",
            'mota.max:200'=>"Mô tả phương tiện quá dài (dưới 200 ký tự)"
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NhomNguoiDungRequest extends FormRequest
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
            'ten'=>'required|max:200:nhomnguoidung,TenNhomNguoiDung',
            'mota'=>'max:1000:nhomnguoidung,MoTa'
        ];
    }

    public function messages(){
        return [
            'ten.required'=>"Vui lòng nhập tên nhóm người dùng",
            'ten.max:200'=>"Tên nhóm người dùng quá dài (dưới 200 ký tự)",
            'mota.max:1000'=>"Mô tả nhóm người dùng quá dài (dưới 1000 ký tự)"
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThanhPhoRequest extends FormRequest
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
            'ten'=>'required|max:100:thanhpho,TenThanhPho',
            'gioithieu'=>'max:200:thanhpho,GioiThieu'
        ];
    }

    public function messages(){
        return [
            'ten.required'=>'Yêu cầu nhập tên thành phố',
            'ten.max:100'=>'Tên thành phố nhập quá dài ,yêu cầu nhập lại',
            'gioithieu.max:200'=>'Giới thiệu thành phố quá dài , yêu cầu nhập lại'
        ];
    }
}

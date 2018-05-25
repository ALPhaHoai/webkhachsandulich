<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DangKyKhachSanRequest extends FormRequest
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
        'tenkhachsan'=>'required|max:200',
        'emailkhachsan'=>'required|max:200',
        'sdtkhachsan'=>'required|numeric',
        'tendaidien'=>'required|max:200',
        'emaildaidien'=>'required|max:200',
        'sdtdaidien'=>'required|numeric',          
        ];
    }
    public function messages(){

        return[
        'tenkhachsan.required'=>"Vui lòng điền tên khách sạn",
        'tenkhachsan.max:200'=>"Tên khách sạn quá dài",
        'emailkhachsan.required'=>"vui lòng điền email khách sạn",
        'emailkhachsan.max:200'=>'email khách sạn quá dài',
        'sdtkhachsan.required'=>"Vui lòng điền số điện thoại khách sạn",
        'sdtkhachsan.numeric'=>"Số điện thoại khách sạn không hợp lệ",
        'tendaidien.required'=>"Vui lòng điền tên người đại diện",
        'tendaidien.max:200'=>"Tên người đại diện quá dài",
        'emaildaidien.required'=>"vui lòng điền email người đại diện",
        'emaildaidien.max:200'=>'email người đại diện quá dài',
        'sdtdaidien.required'=>"Vui lòng điền số điện thoại người đại diện",
        'sdtdaidien.numeric'=>"Số điện thoại người đại diện không hợp lệ",

        ];
    }
}

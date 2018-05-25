<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class userrequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ];
    }
    public function messages(){
        return [
            'name.required'=>'Tên tài khoản không được để trống',
            'name.max'=>'Tên tài khoản vượt quá độ dài quy định',
            'email.required'=>'email không được để trống',
            'email.email'=>'Email không đúng định dạng',
            'email.max'=>'email dài quá độ dài cho phép',
            'email.unique'=>'email đã tồn tại,vui lòng đăng nhập',
            'password.required'=>'Mật khẩu không được bỏ trống',
            'password.min'=>'Mật khẩu tối thiểu dài 6 ký tự',
            'password.cnfirmed'=>'mật khẩu không khớp'
        ];
    }
}

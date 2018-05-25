<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class useradminrequest extends FormRequest
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
            'name'=>'required',
            'email'=>'required|unique:users,email',
            'password'=>'required|min:6',
            'confirmpassword'=>'required|same:password'
        ];
    }
    public function messages(){
        return [
        'name.required'=>'Vui lòng nhập tên',
        'email.required'=>'Vui lòng nhập email nhân viên',
        'email.unique'=>'Email bạn nhập đã tồn tại ',
        'password.required'=>'Vui lòng nhập password',
        'confirmpassword.required'=>'Vui lòng xác nhận password',
        'confirmpassword.same'=>'Mật khẩu xác nhân không đúng'
        ];
    }
}

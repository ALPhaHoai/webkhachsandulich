<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class khachsanrequest extends FormRequest
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
            'tenKS'=>'required',
            'diachi'=>'required',
            'thongtin'=>'required',
            'nhanphong'=>'required',
            'traphong'=>'required'
        ];
    }
    public function messages(){
        return[
        'tenKS.required'=>'Vui lòng điền tên khách sạn',
        'diachi.required'=>'Vui lòng điền địa chỉ khách sạn',
        'thongtin.required'=>'Vui lòng điền thông tin khách sạn',
        'nhanphong.required'=>'Vui lòng điền thời gian nhận phòng',
        'traphong.required'=>'Vui lòng điền thời gian trả phòng'

        ];
    }
}

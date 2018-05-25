<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class khuvucrequest extends FormRequest
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
            'tenkhuvuc'=>'required',
            'anhdaidien'=>'required'
        ];
    }
    public function messages(){
        return [
            'tenkhuvuc.required'=>'Tên khu vực không được để trống',
            'anhdaidien.required'=>'Vui lòng thêm ảnh đại diện khu vực'
        ];
    }
}

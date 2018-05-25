<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TourRequest extends FormRequest
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
            'ten'=>'required|max:100:tour,TenTour',
            'tongquan'=>'required:tour,TongQuan',
            'ngaykhoihanh'=>'required:tour,NgayKhoiHanh',
            'gia'=>'required:tour,Gia',
            'giakhuyenmai'=>'max:100',
            'anhdaidien'=>'required'
        ];
    }

    public function messages(){
        return [
            'ten.required'=>'Trường tên tour không được bỏ trống',
            'ten.max:100'=>'Trường tên tour vượt quá độ dài quy định',
            'tongquan.required'=>'Tổng quan không được bỏ trống',
            'ngaykhoihanh.required'=>'Ngày khởi hành không được bỏ trống',
            'gia.required'=>'Trường giá không được bỏ trống',
            'gia.GreaterThan'=>'Trường giá khuyến mãi phải nhỏ hơn Giá',
            'anhdaidien.required'=>'Vui lòng thêm ảnh đại diện cho tour'
        ];
    }
}

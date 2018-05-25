<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class baivietrequest extends FormRequest
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
            'tieude'=>'required|max:50:baiviet,TieuDe',
            'tomtat'=>'required|max:100:baiviet,TomTat',
            'noidung'=>'required:baiviet,NoiDung',
            'anhdaidien'=>'required'
        ];
    }

    public function messages(){
        return [
        'tieude.required'=>'Tiêu đề không được để trống',
        'tieude.max'=>'Tiêu đề quá dài ',
        'tomtat.required'=>'Tóm tắt không được để trống',
        'tomtat.max:100'=>'Phần tóm tắt quá dài',
        'noidung.required'=>'Phần nội dung không được bỏ trống',
        'anhdaidien.required'=>'Vui lòng thêm ảnh đại diện cho bài viết'
        ];
    }
}

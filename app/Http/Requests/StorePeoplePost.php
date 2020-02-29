<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePeoplePost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *是否授权
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
            'wname'=>'required|unique:people|max:12|min:2',
            'wage'=>'required|integer|min:1|max:3',
        ];
    }
    public function messages(){
        return [
                'wname.required'=>'名字不能为空',
                'wname.unique'=>'名字已存在',
                'wname.max'=>'名字长度不能超过12位',
                'wname.min'=>'名字不能不能少于2位',
                'wage.required'=>'年龄不能为空',
                'wage.integer'=>'年龄必须为数字',
                'wage.max'=>'年龄数据不合法',
                'wage.min'=>'年龄数据不合法',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLanguagesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required|string|min:3|max:100',
            'canonical'=>'min:2|max:100|required|unique:languages,canonical,'.$this->id.''
        ];
    }

    public function messages()
    {
        return [
            'name.string'=>'Tên phải là dạng ký tự',
            'name.required'=>'Vui lòng nhập tên ngôn ngữ',
            'name.min'=>'Tên quá ngắn,vui lòng nhập ít nhất 3 ký tự',
            'name.max'=>'Tên quá dài,vui lòng nhập ít hơn 100 ký tự',
            'canonical.required'=>'Vui lòng nhập từ khóa ngôn ngữ',
            'canonical.unique'=>'Từ khóa đã tồn tại',
            'canonical.min'=>'Tên quá ngắn,vui lòng nhập ít nhất 2 ký tự',
            'canonical.max'=>'Tên quá dài,vui lòng nhập ít hơn 100 ký tự'
        ];
    }
}

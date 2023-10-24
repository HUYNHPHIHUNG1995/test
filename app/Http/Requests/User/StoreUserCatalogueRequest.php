<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserCatalogueRequest extends FormRequest
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
        ];
    }

    public function messages()
    {
        return [
            'name.string'=>'Tên nhóm phải là dạng ký tự',
            'name.required'=>'Vui lòng nhập tên nhóm',
            'name.min'=>'Tên nhóm quá ngắn,vui lòng nhập ít nhất 3 ký tự',
            'name.max'=>'Tên nhóm quá dài,vui lòng nhập ít hơn 100 ký tự',
        ];
    }
}

<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email'=>'required|email:filter',
            'password'=>'required|min:4|max:100'
        ];
    }

    //tự tạo
    public function messages()
    {
        return [
            'email.required'=>'Vui lòng nhập email',
            'email.email'=>'Email không đúng định dạng',
            'password.required'=>'Vui lòng nhập mật khẩu',
            'password.min'=>'Mật khẩu quá ngắn,vui lòng nhập mật khẩu ít nhất 4 ký tự',
            'password.max'=>'Mật khẩu quá dài,vui lòng nhập mật khẩu ít hơn 100 ký tự'
        ];
    }
}

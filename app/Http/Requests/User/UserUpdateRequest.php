<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'email'=>'required|email:filter|string|unique:users,email,'.$this->id.'|max:255',
            'name'=>'required|string|min:4|max:255',
            'user_catalogue_id'=>'gt:0',
            'birthday'=>'date_format:Y-m-d|before:today|nullable'
        ];
    }

    public function messages()
    {
        return [
            'email.required'=>'Vui lòng nhập email',
            'email.email'=>'Email không đúng định dạng',
            'email.string'=>'Email phải là dạng ký tự',
            'email.unique'=>'Email đã tồn tại',
            'email.max'=>'Email quá dài',
            'name.string'=>'Tên phải là dạng ký tự',
            'name.required'=>'Vui lòng nhập tên tài khoản',
            'name.min'=>'Tên quá ngắn,vui lòng nhập mật khẩu ít nhất 6 ký tự',
            'name.max'=>'Tên quá dài,vui lòng nhập mật khẩu ít hơn 100 ký tự',
            'user_catalogue_id.required'=>'Vui lòng chọn quyền hạn cho thành viên',
            'user_catalogue_id.integer'=>'Quyền thành viên không hợp lệ',
            'user_catalogue_id.gt'=>'Vui lòng chọn quyền hạn cho thành viên',
            'birthday.date_format'=>'Ngày sinh không đúng định dạng',
            'birthday.before'=>'Ngày sinh phải sau ngày tạo tài khoản',
        ];
    }
}

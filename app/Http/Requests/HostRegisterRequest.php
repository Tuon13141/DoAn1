<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HostRegisterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'username' => 'required|max:20|min:3',
            'email' => 'required|email',
            'password' => 'required|min:4|max:20',
            'name' => 'required|max:20|min:3',
            'phone_number' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return[
            'username.required' => 'Username không thể bị bỏ trống!',
            'password.required' => 'Mật Khẩu không thể bị bỏ trống!',
            'name.required' => 'Tên không thể bị bỏ trống!',
            'email.required' => 'Email không thể bị bỏ trống!',
            'phone_number.required' => 'SĐT không thể bị bỏ trống',
            'username.min' => 'Username phải dài hơn 2 kí tự',
            'name.min' => 'Tên phải dài hơn 2 kí tự',
            'password.min' => 'Mật Khẩu phải dài hơn 3 kí tự',
            'username.max' => 'Username phải ít hơn 21 kí tự',
            'name.max' => 'Tên phải ít hơn 21 kí tự',
            'password.max' => 'Mật Khẩu phải ít hơn 21 kí tự',
            'email.email' => 'Email không hợp lệ',
            'phone_number.numeric' => 'SĐT phải là số',
        ];
    }
}

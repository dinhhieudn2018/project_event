<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|min:3|max:20',
            'email' => 'required|email|unique:users,email',
            'phone' =>  'required|numeric',
            'address' => 'required',
            'password' => 'required|min:3|max:20',
            'password_confirmation' => 'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên',
            'name.min' => 'Tên tối thiểu 3 kí tự',
            'name.max' => 'Tên tối đa 20 kí tự',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Địa chỉ email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại trong hệ thống',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.numeric' => 'Vui lòng nhập đúng số',
            'address.required' => 'Vui lòng nhập địa chỉ',
            'password.reuired' => 'Vui lòng nhập password',
            'password.min' => 'Password tối thiểu 3 kí tự',
            'password.max' => 'Password tối đa 20 kí tự',
            'password_confirmation.required' => 'Vui lòng nhập lại password',
            'password_confirmation.same' => '2 password không khớp',
        ];
    }
}

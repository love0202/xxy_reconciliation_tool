<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    /**
     * 判断用户是否有请求权限
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * 获取已定义验证规则的错误消息。
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required',
            'password' => 'required',
            'captcha' => 'required|captcha'
        ];
    }

    /**
     * 获取已定义验证规则的错误消息。
     *
     * @return array
     */
    public function messages()
    {
        return [
            'username.required' => '账户不能为空',
            'password.required' => '密码不能为空',
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '验证码错误',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

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
            'name' => 'required|max:30',
            'email' => 'required|email|unique:users,email|max:50',
            'tel' => 'required|regex:/^0[0-9]{9,10}$/',
            'password' => 'required|min:8|max:20',
        ];
    }
    protected function failedValidation(Validator $validator) {
        $res = response()->json([
            'status' => 400,
            'errors' => $validator->errors(),
        ], 400);
        throw new HttpResponseException($res);
    }
    public function messages()
    {
        return [
            'name.required' => '名前を入力してください',
            'name.max' => '名前は30文字以内で入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスの形式で入力してください',
            'email.unique'=> 'このメールアドレスは既に登録されています',
            'tel.required' => '電話番号を入力してください',
            'tel.regex' => '半角、ハイフンなしで入力してください',
            'password.required' => 'パスワードを入力してください',
            'password.min' => 'パスワードは８文字以上で入力してください',
            'password.max' => 'パスワードは20文字以内で入力してください',
        ];
    }
}

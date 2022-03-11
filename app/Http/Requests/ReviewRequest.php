<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Rules\hasBookingHistory;

class ReviewRequest extends FormRequest
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
            'comment' => 'required|max:500',
            'star' => 'required',
            //投稿時点で予約実績があり、かつその日時を経過しているかを確認
            'hasBookingHistory' =>[
                new hasBookingHistory(
                    $this->user_id,
                    $this->shop_id,
                )
            ],
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
            'comment.required' => 'コメントを入力してください',
            'star.required' => '評価を５段階で入力してください',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Rules\BookingRule;
use App\Rules\RemainingSeats;
use Illuminate\Support\Facades\Auth;

class BookingRequest extends FormRequest
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
        // $user_id = Auth::id();
        $startDate = date('Y-m-d', strtotime('1day'));
        $endDate = date('Y-m-d', strtotime('1month'));
        return [
            'date'=> 'required|date|after_or_equal:'.$startDate.'|before_or_equal:'.$endDate,
            'time' => 'required',
            'number_of_people' => 'required|max:100',
            'menu_id' => 'required',
            //同じ時間帯（前後３０分）に別の予約が入っていないかどうかを確認
            'hasOtherBooking' =>[
                new BookingRule(
                    $this->user_id,
                    $this->date,
                    $this->time,
                    $this->booking_id,
                )
            ],
            //席数に空きがあるかを確認
            'remainingSeats' =>[
                new RemainingSeats(
                    $this->shop_id,
                    $this->number_of_people,
                    $this->date,
                    $this->time,
                )
            ]
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
            'time.required' => '時間を入力してください',
            'date.required' => '日付を入力してください',
            'date.after_or_equal' => '明日以降の日付を選択してください',
            'date.before_or_equal' => '予約は１ヶ月前から可能となっております',
            'number_of_people.required' => '予約人数を入力してください',
            'menu_id.required' => 'メニューを選んでください'
        ];
    }
}

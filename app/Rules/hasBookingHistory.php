<?php

namespace App\Rules;

// use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\ImplicitRule;
use Illuminate\Support\Collection;
use App\Models\Booking;
use App\Models\Shop;

class hasBookingHistory implements ImplicitRule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($user_id, $shop_id)
    {
        $this->user_id = $user_id;
        $this->shop_id = $shop_id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $today = date('Y-m-d');
        $time = date('H:i:s',strtotime('1hour'));
        return Booking::where('user_id', $this->user_id)
        ->where('shop_id', $this->shop_id)
        ->where(function($query) use($today,$time){
            $query->where([
                ['date', '=', $today],
                ['time', '>', $time],
                ])
            ->orWhere('date', '<', $today);
        })
        ->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '口コミは本サイトより予約し、ご来店した方のみ投稿いただけます';
    }
}

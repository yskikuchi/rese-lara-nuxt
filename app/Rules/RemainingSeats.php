<?php

namespace App\Rules;

// use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\ImplicitRule;
use App\Models\Booking;
use App\Models\Shop;

class RemainingSeats implements ImplicitRule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($shop_id, $number_of_people, $date, $time)
    {
        $this->shop_id = $shop_id;
        $this->number_of_people = $number_of_people;
        $this->date = $date;
        $this->time = $time;
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
        $totalSeats = Shop::where('id', $this->shop_id)
        ->pluck('number_of_seats');

        $from_at = date('H:i', strtotime('-30 minute'. $this->time));
        $until_at = date('H:i',strtotime('+30 minute'. $this->time));
        $bookedSeats = Booking::where('shop_id', $this->shop_id)
        ->where('date', '=', $this->date)
        ->where('time','>=', $from_at)
        ->where('time','<=', $until_at)
        ->sum('number_of_people');

        return ($bookedSeats + $this->number_of_people) <= $totalSeats[0];
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '予約がいっぱいです';
    }
}

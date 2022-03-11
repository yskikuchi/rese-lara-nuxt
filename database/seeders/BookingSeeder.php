<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shop;
use App\Models\User;
use App\Models\Menu;
use App\Models\Booking;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shop_id = Shop::pluck('id')->first();
        $user_id = User::pluck('id')->first();
        $menu_id = Menu::pluck('id')->first();
        $nextWeek = date('Y-m-d',strtotime('+1week'));
        Booking::create([
            'user_id' => $user_id,
            'shop_id' => $shop_id,
            'menu_id' => $menu_id,
            'date' => $nextWeek,
            'time' => '12:00',
            'checked' => true,
            'number_of_people' => 5,
        ]);
        $yesterday = date('Y-m-d', strtotime('-1day'));
        Booking::create([
            'user_id' => $user_id,
            'shop_id' => $shop_id,
            'menu_id' => $menu_id,
            'date' => $yesterday,
            'time' => '19:00',
            'checked' => false,
            'number_of_people' => 2,
        ]);
    }
}

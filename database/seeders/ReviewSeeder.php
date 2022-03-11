<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Shop;
use App\Models\User;
use App\Models\Review;


class ReviewSeeder extends Seeder
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
        Review::create([
            'user_id' => $user_id,
            'shop_id' => $shop_id,
            'comment' => '値段が高いだけあって味・鮮度ともに抜群でした。また利用したいです。',
            'star' => 5,
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Shop;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'admin',
            'email' => 'admin@sample.com',
            'password' => Hash::make('adminpassword'),
            'role' => 1,
        ]);

        $shop_id = Shop::pluck('id')->first();
        Admin::create([
            'name' => 'testmanager',
            'email' => 'shop1@sample.com',
            'password' => Hash::make('shop1password'),
            'role' => 2,
            'shop_id' => $shop_id,
        ]);
    }
}

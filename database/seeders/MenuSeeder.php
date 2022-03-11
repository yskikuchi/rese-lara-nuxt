<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Shop;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shops = Shop::pluck('id')->all();
        $param = [
            'shop_id' => $shops[0],
            'name' => 'おまかせ15品コース',
            'price' => '8000',
        ];
        DB::table('menus')->insert($param);
        $param = [
            'shop_id' => $shops[0],
            'name' => '特上おまかせ15品コース',
            'price' => '12000',
        ];
        DB::table('menus')->insert($param);
        $param = [
            'shop_id' => $shops[1],
            'name' => 'とくとく食べ放題コース(120分飲み放題付き)',
            'price' => '6000',
        ];
        DB::table('menus')->insert($param);
        $param = [
            'shop_id' => $shops[1],
            'name' => '特選コース25品(120分飲み放題付き)',
            'price' => '10000',
        ];
        DB::table('menus')->insert($param);
        $param = [
            'shop_id' => $shops[2],
            'name' => '食べ飲み放題２時間',
            'price' => '5000',
        ];
        DB::table('menus')->insert($param);
        $param = [
            'shop_id' => $shops[2],
            'name' => '食べ飲み放題3時間',
            'price' => '6500',
        ];
        DB::table('menus')->insert($param);
        $param = [
            'shop_id' => $shops[3],
            'name' => 'カジュアルコース',
            'price' => '6000',
        ];
        DB::table('menus')->insert($param);
        $param = [
            'shop_id' => $shops[3],
            'name' => 'スペシャルコース',
            'price' => '9000',
        ];
        DB::table('menus')->insert($param);
        $param = [
            'shop_id' => $shops[4],
            'name' => '醤油ラーメン',
            'price' => '1000',
        ];
        DB::table('menus')->insert($param);
        $param = [
            'shop_id' => $shops[4],
            'name' => '味噌ラーメン',
            'price' => '1000',
        ];
        DB::table('menus')->insert($param);
        $param = [
            'shop_id' => $shops[5],
            'name' => 'とくとく食べ放題コース(120分飲み放題付き)',
            'price' => '6000',
        ];
        DB::table('menus')->insert($param);
        $param = [
            'shop_id' => $shops[5],
            'name' => '特選コース25品(120分飲み放題付き)',
            'price' => '10000',
        ];
        DB::table('menus')->insert($param);
        $param = [
            'shop_id' => $shops[6],
            'name' => 'カジュアルコース',
            'price' => '6000',
        ];
        DB::table('menus')->insert($param);
        $param = [
            'shop_id' => $shops[6],
            'name' => 'スペシャルコース',
            'price' => '9000',
        ];
        DB::table('menus')->insert($param);
        $param = [
            'shop_id' => $shops[7],
            'name' => '醤油ラーメン',
            'price' => '1000',
        ];
        DB::table('menus')->insert($param);
        $param = [
            'shop_id' => $shops[7],
            'name' => '味噌ラーメン',
            'price' => '1000',
        ];
        DB::table('menus')->insert($param);
        $param = [
            'shop_id' => $shops[8],
            'name' => '食べ飲み放題2時間',
            'price' => '5000',
        ];
        DB::table('menus')->insert($param);
        $param = [
            'shop_id' => $shops[8],
            'name' => '食べ飲み放題3時間',
            'price' => '6500',
        ];
        DB::table('menus')->insert($param);
        $param = [
            'shop_id' => $shops[9],
            'name' => 'おまかせ15品コース',
            'price' => '8000',
        ];
        DB::table('menus')->insert($param);
        $param = [
            'shop_id' => $shops[9],
            'name' => '特上おまかせ15品コース',
            'price' => '12000',
        ];
        DB::table('menus')->insert($param);
        $param = [
            'shop_id' => $shops[10],
            'name' => 'とくとく食べ放題コース(120分飲み放題付き)',
            'price' => '6000',
        ];
        DB::table('menus')->insert($param);
        $param = [
            'shop_id' => $shops[10],
            'name' => '特選コース25品(120分飲み放題付き)',
            'price' => '10000',
        ];
        DB::table('menus')->insert($param);
        $param = [
            'shop_id' => $shops[11],
            'name' => 'とくとく食べ放題コース(120分飲み放題付き)',
            'price' => '6000',
        ];
        DB::table('menus')->insert($param);
        $param = [
            'shop_id' => $shops[11],
            'name' => '特選コース25品(120分飲み放題付き)',
            'price' => '10000',
        ];
        DB::table('menus')->insert($param);
        $param = [
            'shop_id' => $shops[12],
            'name' => '食べ飲み放題2時間',
            'price' => '5500',
        ];
        DB::table('menus')->insert($param);
        $param = [
            'shop_id' => $shops[12],
            'name' => '食べ飲み放題3時間',
            'price' => '6500',
        ];
        DB::table('menus')->insert($param);
        $param = [
            'shop_id' => $shops[13],
            'name' => 'おまかせ15品コース',
            'price' => '8000',
        ];
        DB::table('menus')->insert($param);
        $param = [
            'shop_id' => $shops[13],
            'name' => '特上おまかせ15品コース',
            'price' => '12000',
        ];
        DB::table('menus')->insert($param);
        $param = [
            'shop_id' => $shops[14],
            'name' => '醤油ラーメン',
            'price' => '1000',
        ];
        DB::table('menus')->insert($param);
        $param = [
            'shop_id' => $shops[14],
            'name' => '味噌ラーメン',
            'price' => '1000',
        ];
        DB::table('menus')->insert($param);
        $param = [
            'shop_id' => $shops[15],
            'name' => '食べ飲み放題2時間',
            'price' => '5000',
        ];
        DB::table('menus')->insert($param);
        $param = [
            'shop_id' => $shops[15],
            'name' => '食べ飲み放題3時間',
            'price' => '6500',
        ];
        DB::table('menus')->insert($param);
        $param = [
            'shop_id' => $shops[16],
            'name' => 'おまかせ15品コース',
            'price' => '8000',
        ];
        DB::table('menus')->insert($param);
        $param = [
            'shop_id' => $shops[16],
            'name' => '特上おまかせ15品コース',
            'price' => '12000',
        ];
        DB::table('menus')->insert($param);
        $param = [
            'shop_id' => $shops[17],
            'name' => 'とくとく食べ放題コース(120分飲み放題付き)',
            'price' => '6000',
        ];
        DB::table('menus')->insert($param);
        $param = [
            'shop_id' => $shops[17],
            'name' => '特選コース25品(120分飲み放題付き)',
            'price' => '10000',
        ];
        DB::table('menus')->insert($param);
        $param = [
            'shop_id' => $shops[18],
            'name' => 'カジュアルコース',
            'price' => '5000',
        ];
        DB::table('menus')->insert($param);
        $param = [
            'shop_id' => $shops[18],
            'name' => 'スペシャルコース',
            'price' => '9000',
        ];
        DB::table('menus')->insert($param);
        $param = [
            'shop_id' => $shops[19],
            'name' => 'おまかせ15品コース',
            'price' => '8000',
        ];
        DB::table('menus')->insert($param);
        $param = [
            'shop_id' => $shops[19],
            'name' => '特上おまかせ15品コース',
            'price' => '12000',
        ];
        DB::table('menus')->insert($param);
    }
}
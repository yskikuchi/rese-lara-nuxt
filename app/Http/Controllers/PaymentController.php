<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use App\Models\Booking;
use App\Models\Menu;
use App\Models\Shop;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function session(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('stripe.secret_key'));

        $menu = Menu::find($request->menu_id);
        $shop = Shop::find($request->shop_id);
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items'           => [[
                'name'        => $shop->name,                           // 商品名
                'description' => $menu->name,        // 説明
                'amount'      => $menu->price,                                 // 金額
                'currency'    => 'jpy',                               // 単位
                'quantity'    => $request->number_of_people,           // 数量
            ]],
            'mode' => 'payment',
            'success_url'          => config('app.home').'/payment/success', // 成功時リダイレクトURL
            'cancel_url'           => config('app.home').'/payment/cancel',  // 失敗時リダイレクトURL
        ]);
        $payment_intent = [
            'payment_intent_id' => $session->payment_intent,
        ];
        Booking::find($request->booking_id)->update($payment_intent);
        return response()->json([
            'data' => $session
        ],200 );

    }

    public function webhook(Request $request)
    {

        if($request['type'] == 'payment_intent.succeeded'){
            Log::debug($request['data']['object']);
            $update = [
                'checked' => true,
            ];
            Booking::where('payment_intent_id', $request['data']['object']['id'])->update($update);
        }
        return response()->json('updated', 201);
    }
}

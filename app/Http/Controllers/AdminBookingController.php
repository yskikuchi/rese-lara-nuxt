<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Shop;


class AdminBookingController extends Controller
{
    public function index(Request $request)
    {
        $shop = Shop::where('id', $request->shop_id)->first();
        $bookings = Booking::with('user:id,name,email,tel')
        ->withTrashed()
        ->where('shop_id', $request->shop_id)
        ->orderBy('date','asc')
        ->orderBy('time','asc')
        ->get();
        return view('admin.booking', compact('shop','bookings'));
    }
    public function show($bookingId)
    {
        $booking = Booking::where('id', $bookingId)
        ->withTrashed()
        ->with('user', 'shop')
        ->first();
        return view('admin.bookingConfirm', compact('booking'));
    }
}

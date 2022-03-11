<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Favorite;
use App\Models\Booking;
use App\Http\Requests\BookingRequest;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        $bookings = Booking::with('shop:id,name','menu')
        ->where('user_id', $user_id)
        ->orderBy('date','asc')
        ->orderBy('time','asc')
        ->get();
        return response()->json([
            'data' => $bookings
        ],200 );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookingRequest $request)
    {
        $data = Booking::create($request->all());
        return response()->json([
            'data' => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_id = Auth::id();
        $booking = Booking::with('shop.menus','menu')
        ->where('id',$id)
        ->where('user_id', $user_id)
        ->first();
        if($booking){
            return response()->json([
                'data' => $booking
            ], 200);
        }else{
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookingRequest $request, $id)
    {
        $update=[
            'date' => $request -> date,
            'time' => $request -> time,
            'number_of_people' => $request -> number_of_people,
        ];
        $item = Booking::where('id', $id)->update($update);
        if ($item) {
            return response()->json([
                'message' => 'Updated successfully',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Booking::find($id)->delete();
        if ($item) {
            return response()->json([
            'message' => 'Deleted successfully',
        ], 200);
        } else {
            return response()->json([
            'message' => 'Not found',
        ], 404);
        }
    }
}

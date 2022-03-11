<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Favorite;
use App\Models\Booking;
use App\Models\Shop;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();
        $shops = Shop::with('favorites')
            ->whereHas('favorites', function($q) use($id){
                    $q -> where('user_id',$id);
                })
            ->with('images')
            ->get();
        return response()->json([
            'data' => $shops,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=[
            'user_id' => $request->user_id,
            'shop_id' => $request->shop_id,
        ];
        Favorite::create($data);
        return response()->json([
            'data' => $data
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Favorite::find($id)->delete();
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

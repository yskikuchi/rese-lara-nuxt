<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Shop;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class AdminShopController extends Controller
{
    public function index(Request $request)
    {
        $shop = Shop::where('id',$request->shop_id)->first();
        return view('admin.shop', compact('shop'));
    }

    public function create(Request $request)
    {
        Shop::where('id', $request->id)->update($request->except('_token','image'));
        $path = Storage::putFile('public/images',$request->image);
        $storage_path = str_replace('public', 'storage', $path);
        $data = [
            'shop_id' => $request->id,
            'type' => 'トップ',
            'path' => $storage_path,
        ];
        Image::create($data);
        return redirect()->route('admin.dashboard');
    }

    public function update(Request $request)
    {
        Shop::where('id', $request->id)->update($request->except('_method','_token','image'));
        if($request->image){
            $path = Storage::putFile('public/images',$request->image);
            $storage_path = str_replace('public', 'storage', $path);
            $data = [
                'path' => $storage_path,
            ];
            Image::where('shop_id',$request->id)->update($data);
        }
        return redirect()->route('admin.dashboard');
    }
}

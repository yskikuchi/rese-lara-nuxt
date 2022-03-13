<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Shop;
use Illuminate\Support\Facades\Storage;

class AdminImageController extends Controller
{
    public function index(Request $request)
    {
        $shop = Shop::where('id', $request->shop_id)->first();
        return view('admin.image', compact('shop'));
    }
    public function store(Request $request)
    {
        if(app()->isLocal()){
            $fullPath = Storage::putFile('public/images',$request->image);
            $storageName = str_replace('public/images/', '', $fullPath);
            $data = [
                'shop_id' => $request->shop_id,
                'type' => $request->type,
                'path' => $storageName,
            ];
            Image::create($data);
            $formatPath = str_replace('public','storage', $fullPath);
            $path = config('app.url').'/'.$formatPath;
            return view('admin.imagePosted', compact('path'));
        }else{
            $file = Storage::disk('s3')->putFile('public',$request->image);
            $path = Storage::disk('s3')->url($file);
            $storageName = str_replace('public/', '', $file);
            $data = [
                'shop_id' => $request->shop_id,
                'type' => $request->type,
                'path' => $storageName,
            ];
            Image::create($data);
            return view('admin.imagePosted', compact('path'));
        }
    }
}

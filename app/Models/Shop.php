<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;
use App\Models\Favorite;
use App\Models\Admin;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

class Shop extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'genre',
        'area',
        'detail',
        'number_of_seats',
    ];
    public function images(){
        return $this -> hasMany(Image::class);
    }
    public function favorites(){
        return $this -> hasMany(Favorite::class);
    }
    public function reviews(){
        return $this -> hasMany(Review::class);
    }
    public function menus(){
        return $this -> hasMany(Menu::class);
    }
    public function admin(){
        return $this -> hasMany(Admin::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable =[
        'user_id',
        'shop_id',
        'menu_id',
        'date',
        'time',
        'checked',
        'number_of_people',
        'payment_intent_id',
        'canceled_at',
        'deleted_at',
    ];


    public function user(){
        return $this -> belongsTo(User::class);
    }
    public function shop(){
        return $this -> belongsTo(Shop::class);
    }
    public function menu(){
        return $this -> belongsTo(Menu::class);
    }
    public function scopeWhereHasBooking($query, $date, $time, $id)
    {
        $from_at = date('H:i', strtotime('-30 minute'. $time));
        $until_at = date('H:i',strtotime('+30 minute'. $time));
        $query->where('id','<>',$id) //変更対象の予約を除外
        ->where('date','=',$date)
        ->where('time','>=', $from_at)
        ->where('time','<=', $until_at)
        ->get();
    }
}

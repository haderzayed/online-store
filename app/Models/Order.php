<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Order extends Model
{
    use HasFactory;


    protected $fillable=[
       'store_id','user_id','payment_method','status','payment_status'

    ];

    protected static function booted(){
       Static::creating(function(Order $order){
         $order->number = Order::getNextNumber();
        //  dd(  $order->number);
       });
    }
    public static function getNextNumber(){
        $year = Carbon::now()->year;
        $number =Order::whereYear('created_at',$year)->max('number');
        if($number){
            return  $number+1;
        }
        return  $number=$year.'0001';
    }
    public function store(){

        return $this->belongsTo(Store::class);
    }

    public function user(){

        return $this->belongsTo(User::class)->withDefault([
            'name'=>'Gest Customer',
        ]);
    }

    // public function products(){
    //     return $this->belongsToMany(
    //         Product::class,
    //         'product_items',
    //         'order_id',
    //         'product_id',
    //         'id',
    //         'id',
    // )
    // ->using(OrderItem::class)
    // ->withPivot(['product_name','price','quantity','options']);
    // }
    public function items(){
        return $this->hasMany(OrderItem::class,'order_id');
    }

    public function addresses(){

        return $this->hasMany(OrderAddress::class);
    }

    public function billingAddress(){

        return $this->hasOne(OrderAddress::class)
                ->where('type','billing');
    }

    public function shippinggAddress(){

        return $this->hasOne(OrderAddress::class)
                ->where('type','shipping');
    }


}

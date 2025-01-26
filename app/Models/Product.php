<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable=['id','store_id','category_id','name','slug','description',
                         'image','price','compare_price','options','rating',
                          'featured','status'];
                           // protected static function booted(){
    //    static::addGlobalScope('store',function(Builder $builder){
    //        $user=Auth::user();
    //        if($user->store_id){
    //          $builder->where('store_id',$user->store_id);
    //        }else{
    //         $builder->whereNull('store_id');
    //        }
    //    });
    // }
    protected static function booted(){
        static::addGlobalScope ('store',new StoreScope());
     }

     public function category(){
        return $this->belongsTo(Category::class);
     }
     public function store(){
        return $this->belongsTo(Store::class);
     }

     public function tags(){
       return $this->belongsToMany(Tag::class);
     }
       function cart(){
        return $this->belongsTo(Cart::class);
    }

     public function scopeActive(Builder $builder){
        $builder->where('status','=','active');
     }

     public function getImageUrlAttribute(){
        if(!$this->image){
           return asset('storage/default/download.jpg');
        }
           return asset('storage/'.$this->image);
     }

     public function getSalePersentAttribute(){
        if(! $this->compare_price){
           return 0 ;
        }

        return round(100 -(100 * $this->price/$this->compare_price),1);
     }

     public function in_cart(){
        // if(Cart::where('product_id',$this->id)->exists()){
        //     return true ;
        // }else{
        //     return false ;
        // }
        // dd(Cart::where('product_id',$this->id)->exists());
      return  Cart::where('product_id',$this->id)->exists()  ;
     }
}

<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;

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
    protected $fillable=['id','store_id','category_id','name','slug','description',
                         'image','price','compare_price','options','rating',
                          'featured','status'];
    // protected static function booted(){
    //     static::addGlobalScope ('sto re',new StoreScope());
    //  }

     public function category(){
        return $this->belongsTo(Category::class);
     }
     public function store(){
        return $this->belongsTo(Store::class);
     }

     public function tags(){
       return $this->belongsToMany(Tag::class);
     }
}

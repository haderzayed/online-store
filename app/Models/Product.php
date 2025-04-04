<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
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
    protected $hidden=['created_at','updated_at','deleted_at','image'];
    protected $appends=['image_url'];
    protected static function booted(){
        static::addGlobalScope ('store',new StoreScope());
        static::creating(function(Product $product){
            $product->slug = Str::slug($product->name);
        });
        static::updating(function(Product $product){
            $product->slug = Str::slug($product->name);
        });
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

           return 'data:image/png;base64,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';
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

     public function scopeFilter(Builder $builder,$filters){
          $options=array_merge([
               'store_id'=>null,
               'category_id'=>null,
               'tag_id'=>null,
               'status'=>'active',
          ],$filters);

          $builder->when($options['store_id'],function($builder,$value){
              $builder->where('store_id',$value);
          });

          $builder->when($options['category_id'],function($builder,$value){
              $builder->where('category_id',$value);
          });

          $builder->when($options['tag_id'],function($builder,$value){
             $builder->whereExsists(function($query) use($value){
                $query->select(1)
                      ->from('product_tag')
                      ->whereRaw('product_id = products.id')
                      ->where('tag_id',$value);
             });
          });

          $builder->when($options['status'],function($builder,$value){
             $builder->where('status',$value);
          });
     }
}

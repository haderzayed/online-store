<?php

namespace  App\Repositories\Cart;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartModelRepository implements CartRepository
{
   public function get() : Collection
   {
      return Cart::with('product')->get();
   }

   public function add(Product $product , $quantity = 1)
   {
      return Cart::updateOrCreate([
         'product_id' => $product->id,
        ],
        [
        'user_id' => Auth::id(),
        'quantity' => $quantity

      ]);
   }

   public function update($id , $quantity)
   {
        return Cart::where('id', '=' ,$id)
                     ->update([
                        'quantity' => $quantity,
                     ]);
   }

   public function delete(Product $product)
   {
        Cart::where('product_id', '=' ,$product->id)->delete();
   }

   public function empty()
   {
      Cart::query()->destroy();
   }

   public function total()
   {
     $items = Cart::with('product')->get();
      return $items->sum(function($item){
         return  $item->quantity * $item->product->price;
     });
   }

//    public function count(){

//    }

}

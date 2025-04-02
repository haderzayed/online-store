<?php

namespace App\Http\Controllers\Front;

use App\Events\OrderCreated;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;
use Symfony\Component\Intl\Countries;


class CheckoutController extends Controller
{
    public function create(CartRepository $cart){
        if($cart->get()->count()== 0){
           return redirect()->route('home');
        }
        $countries = Countries::getNames();

       return view('front.checkout',[
           'cart'=>$cart,
           'countries'=>$countries,
       ]);
    }

    public function store(Request $request , CartRepository $cart)
    {
        $request->validate([]);
        $items=$cart->get()->groupBy('product.store_id');
        // $items=$cart->get();
        // dd(  $items);
        DB::beginTransaction();
        try{
            // foreach( $items as $store_id => $cart_items){
                $order = Order::create([
                    // 'store_id'=> $store_id ,
                    'user_id' => Auth::id(),
                    'payment_method'=>'cod',
                 ]);
                foreach( $items as $store_id => $cart_items){

                 foreach($cart_items as $item){
                  $orderItems=  OrderItem::create([
                       'order_id'=>$order->id,
                       'store_id'=> $store_id ,
                       'product_id'=>$item->product_id,
                       'product_name'=>$item->product->name,
                       'price'=>$item->product->price,
                       'quantity'=>$item->quantity,
                     ]);
                 }

            }
            foreach($request->post('addr') as $type => $address){
                $address['type']=$type;
                $order->addresses()->create( $address);
           }

            // dd($order->items);
            //  $cart->get()->map->delete();
            //  event('order.created',$order,Auth::user());
            event(new OrderCreated($order));
             DB::commit();
             return redirect()->route('home');
        }catch(Throwable $e){
            DB::rollBack();
             throw $e;
        }

    }
}

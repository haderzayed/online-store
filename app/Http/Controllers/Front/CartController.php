<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\Cart\CartModelRepository;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Helpers\Currency;

class CartController extends Controller
{
    protected $cart;

    public function __construct(CartRepository $cart)
    {
         $this->cart=$cart;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $cart=$this->cart;
        return view('front.cart',compact('cart'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id'=>['required','exists:products,id'],
            'quantity'=>['nullable','int','min:1']
        ]);
        $product=Product::findOrFail($request->post('product_id'));
        $this->cart->add( $product,$request->post('quantity'));
        if($request->expectsJson()){
            return response()->json([
              'message'=>'item added to cart',
              'count'=> Cart::count(),
            ],201);
        }
        return redirect()->back()->with('success','product added to cart successfuly');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request , $id)
    {
        $request->validate([
            'quantity'=>['required','int','min:1']
        ]);
        // $product=Product::findOrFail($request->post('product_id'));
        $this->cart->update( $id ,$request->post('quantity'));
        return [
            'count'=> Cart::count(),
            'subtotal'=>Currency::format($this->cart->total()),
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $this->cart->delete($product);
        return [
          'message'=>'item deleted !',
          'count'=> Cart::count(),
          'subtotal'=>Currency::format($this->cart->total()),
        ];
    }
}

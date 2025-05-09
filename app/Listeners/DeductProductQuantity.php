<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Facades\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class DeductProductQuantity
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
         $items= $event->order->items;
         foreach($items as $item){
            // $item->decreament('quantity',$item->product->quantity);
          Product::where('id',$item->product_id)
                ->update([
                      'quantity'=>DB::raw("quantity - {$item->quantity}")
                ]);
        }
    }
}

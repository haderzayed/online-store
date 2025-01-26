@extends('layouts.front')
@section('title','Cart')
@section('breadcrumb')
    @parent
    <li><a href="{{ route('products.index') }}">Products</a></li>
    <li class="active">Cart</li>
@endsection

@section('content')
<div class="shopping-cart section">
    <div class="container">
        <div class="cart-list-head">
            <!-- Cart List Title -->
            <div class="cart-list-title">
                <div class="row">
                    <div class="col-lg-1 col-md-1 col-12">

                    </div>
                    <div class="col-lg-4 col-md-3 col-12">
                        <p>Product Name</p>
                    </div>
                    <div class="col-lg-2 col-md-2 col-12">
                        <p>Quantity</p>
                    </div>
                    <div class="col-lg-2 col-md-2 col-12">
                        <p>Subtotal</p>
                    </div>
                    <div class="col-lg-2 col-md-2 col-12">
                        <p>Discount</p>
                    </div>
                    <div class="col-lg-1 col-md-2 col-12">
                        <p>Remove</p>
                    </div>
                </div>
            </div>
            <!-- End Cart List Title -->
            @foreach ( $cart->get() as $item)
              <!-- Cart Single List list -->
            <div class="cart-single-list" id="{{ $item->product_id }}">
                <div class="row align-items-center">
                    <div class="col-lg-1 col-md-1 col-12">
                        <a href="{{route('product.show',$item->product->slug)}}"><img src="{{ $item->product->image_url }}" alt="#"></a>
                    </div>
                    <div class="col-lg-4 col-md-3 col-12">
                        <h5 class="product-name"><a href="{{route('product.show',$item->product->slug)}}">
                               {{$item->product->name}}</a></h5>
                        <p class="product-des">
                            <span><em>Type:</em> Mirrorless</span>
                            <span><em>Color:</em> Black</span>
                        </p>
                    </div>
                    <div class="col-lg-2 col-md-2 col-12">
                        <div class="count-input">
                            <input type="number" min="1" name="quantity" value="{{$item->quantity}}" data-id="{{ $item->id }}" class="form-control text-center item-quantity">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-12">
                        <p>{{Currency::format( $item->product->price) }}</p>
                    </div>
                    <div class="col-lg-2 col-md-2 col-12">
                        <p>{{Currency::format(0) }}</p>
                    </div>
                    <div class="col-lg-1 col-md-2 col-12">
                        <a class="remove-item"  data-id="{{ $item->product_id }}" ><i class="lni lni-close"></i></a>
                    </div>
                </div>
            </div>
            <!-- End Single List list -->
            @endforeach
        </div>
        <div class="row">
            <div class="col-12">
                <!-- Total Amount -->
                <div class="total-amount">
                    <div class="row">
                        <div class="col-lg-8 col-md-6 col-12">
                            <div class="left">
                                <div class="coupon">
                                    <form action="#" target="_blank">
                                        <input name="Coupon" placeholder="Enter Your Coupon">
                                        <div class="button">
                                            <button class="btn">Apply Coupon</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="right">
                                <ul>
                                    <li>Cart Subtotal<span class="subtotal">{{Currency::format($cart->total()) }}</span></li>
                                    <li>Shipping<span>Free</span></li>
                                    <li>You Save<span>$29.00</span></li>
                                    <li class="last">You Pay<span>$2531.00</span></li>
                                </ul>
                                <div class="button">
                                    <a href="checkout.html" class="btn">Checkout</a>
                                    <a href="product-grids.html" class="btn btn-alt">Continue shopping</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ End Total Amount -->
            </div>
        </div>
    </div>
</div>

{{-- @vite( 'resources/js/cart.js') --}}
@endsection


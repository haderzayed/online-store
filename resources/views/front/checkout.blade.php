@extends('layouts.front')
@section('title','Checkout')
@section('breadcrumb')
    @parent
    <li><a href="{{ route('products.index') }}">Shop</a></li>
    <li class="active">Checkout</li>
@endsection

@section('content')
<section class="checkout-wrapper section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
              <form action="{{ route('checkout') }}" method="POST">
                @csrf
                <div class="checkout-steps-form-style-1">
                    <ul id="accordionExample">
                        <li>
                            <h6 class="title" data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                aria-expanded="true" aria-controls="collapseThree">Your Personal Details </h6>
                            <section class="checkout-steps-form-content collapse show" id="collapseThree"
                                aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="single-form form-default">
                                            <label>User Name</label>
                                            <div class="row">
                                                <div class="col-md-6 form-input form">
                                                    <input name="addr[billing][first_name]" type="text" placeholder="First Name">
                                                </div>
                                                <div class="col-md-6 form-input form">
                                                    <input name="addr[billing][last_name]"  type="text" placeholder="Last Name">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-form form-default">
                                            <label>Email Address</label>
                                            <div class="form-input form">
                                                <input name="addr[billing][email]" type="email" placeholder="Email Address">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-form form-default">
                                            <label>Phone Number</label>
                                            <div class="form-input form">
                                                <input  name="addr[billing][phone_number]" type="text" placeholder="Phone Number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="single-form form-default">
                                            <label>Mailing Address</label>
                                            <div class="form-input form">
                                                <input name="addr[billing][street_addres]" type="text" placeholder="Mailing Address">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-form form-default">
                                            <label>City</label>
                                            <div class="form-input form">
                                                <input name="addr[billing][city]" type="text" placeholder="City">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-form form-default">
                                            <label>State</label>
                                            <div class="form-input form">
                                                <input name="addr[billing][state]" type="text" placeholder="State">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-form form-default">
                                            <label>Country</label>
                                            <div class="form-input form">
                                                <select name="addr[billing][country]" class="form-control @error('country') is-invalid @enderror" placeholder="Pick a country...">
                                                    <option value=" " > Select Country</option>
                                                    @foreach ($countries as $key => $value)
                                                <option value="{{$key}}" @selected(old('country',)== $key) >{{$value}}</option>
                                                  @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-form form-default">
                                            <label>Post Code </label>
                                            <div class="form-input form">
                                                <input name="addr[billing][postal_code]" type="text" placeholder="Post Code">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="single-checkbox checkbox-style-3">
                                            <input type="checkbox" id="checkbox-3">
                                            <label for="checkbox-3"><span></span></label>
                                            <p>My delivery and mailing addresses are the same.</p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="single-form button">
                                            <button class="btn" data-bs-toggle="collapse"
                                                data-bs-target="#collapseFour" aria-expanded="false"
                                                aria-controls="collapseFour">next
                                                step</button>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </li>
                        <li>
                            <h6 class="title collapsed" data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                aria-expanded="false" aria-controls="collapseFour">Shipping Address</h6>
                            <section class="checkout-steps-form-content collapse" id="collapseFour"
                                aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="single-form form-default">
                                            <label>User Name</label>
                                            <div class="row">
                                                <div class="col-md-6 form-input form">
                                                    <input name="addr[shipping][first_name]" type="text" placeholder="First Name">
                                                </div>
                                                <div class="col-md-6 form-input form">
                                                    <input name="addr[shipping][last_name]"  type="text" placeholder="Last Name">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-form form-default">
                                            <label>Email Address</label>
                                            <div class="form-input form">
                                                <input name="addr[shipping][email]" type="email" placeholder="Email Address">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-form form-default">
                                            <label>Phone Number</label>
                                            <div class="form-input form">
                                                <input  name="addr[shipping][phone_number]" type="text" placeholder="Phone Number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="single-form form-default">
                                            <label>Mailing Address</label>
                                            <div class="form-input form">
                                                <input name="addr[shipping][street_addres]" type="text" placeholder="Mailing Address">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-form form-default">
                                            <label>City</label>
                                            <div class="form-input form">
                                                <input name="addr[shipping][city]" type="text" placeholder="City">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-form form-default">
                                            <label>State</label>
                                            <div class="form-input form">
                                                <input name="addr[shipping][state]" type="text" placeholder="State">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-form form-default">
                                            <label>Country</label>
                                            <div class="form-input form">
                                                <select name="addr[shipping][country]" class="form-control @error('country') is-invalid @enderror" placeholder="Pick a country...">
                                                    <option value=" " > Select Country</option>
                                                    @foreach ($countries as $key => $value)
                                                <option value="{{$key}}" @selected(old('country',)== $key) >{{$value}}</option>
                                                  @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-form form-default">
                                            <label>Post Code </label>
                                            <div class="form-input form">
                                                <input name="addr[shipping][postal_code]" type="text" placeholder="Post Code">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="single-checkbox checkbox-style-3">
                                            <input type="checkbox" id="checkbox-3">
                                            <label for="checkbox-3"><span></span></label>
                                            <p>My delivery and mailing addresses are the same.</p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="single-form button">
                                            <button class="btn" data-bs-toggle="collapse"
                                                data-bs-target="#collapseFour" aria-expanded="false"
                                                aria-controls="collapseFour">next
                                                step</button>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </li>
                        <li>
                            <h6 class="title collapsed" data-bs-toggle="collapse" data-bs-target="#collapsefive"
                                aria-expanded="false" aria-controls="collapsefive">Payment Info</h6>
                            <section class="checkout-steps-form-content collapse" id="collapsefive"
                                aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="checkout-payment-form">
                                            <div class="single-form form-default">
                                                <label>Cardholder Name</label>
                                                <div class="form-input form">
                                                    <input type="text" placeholder="Cardholder Name">
                                                </div>
                                            </div>
                                            <div class="single-form form-default">
                                                <label>Card Number</label>
                                                <div class="form-input form">
                                                    <input id="credit-input" type="text"
                                                        placeholder="0000 0000 0000 0000">
                                                    <img src="assets/images/payment/card.png" alt="card">
                                                </div>
                                            </div>
                                            <div class="payment-card-info">
                                                <div class="single-form form-default mm-yy">
                                                    <label>Expiration</label>
                                                    <div class="expiration d-flex">
                                                        <div class="form-input form">
                                                            <input type="text" placeholder="MM">
                                                        </div>
                                                        <div class="form-input form">
                                                            <input type="text" placeholder="YYYY">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="single-form form-default">
                                                    <label>CVC/CVV <span><i
                                                                class="mdi mdi-alert-circle"></i></span></label>
                                                    <div class="form-input form">
                                                        <input type="text" placeholder="***">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="single-form form-default button">
                                                <button type="submit" class="btn">pay now</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </li>
                    </ul>
                </div>
            </form>
            </div>
            <div class="col-lg-4">
                <div class="checkout-sidebar">
                    <div class="checkout-sidebar-coupon">
                        <p>Appy Coupon to get discount!</p>
                        <form action="#">
                            <div class="single-form form-default">
                                <div class="form-input form">
                                    <input type="text" placeholder="Coupon Code">
                                </div>
                                <div class="button">
                                    <button class="btn">apply</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="checkout-sidebar-price-table mt-30">
                        <h5 class="title">Pricing Table</h5>

                        <div class="sub-total-price">
                            <div class="total-price">
                                <p class="value">Subotal Price:</p>
                                <p class="price">{{Currency::format($cart->total()) }}</p>
                            </div>
                            <div class="total-price shipping">
                                <p class="value">Subotal Price:</p>
                                <p class="price">$10.50</p>
                            </div>
                            <div class="total-price discount">
                                <p class="value">Subotal Price:</p>
                                <p class="price">{{Currency::format($cart->total()) }}</p>
                            </div>
                        </div>

                        <div class="total-payable">
                            <div class="payable-price">
                                <p class="value">Subotal Price:</p>
                                <p class="price">$164.50</p>
                            </div>
                        </div>
                        <div class="price-table-btn button">
                            <a href="javascript:void(0)" class="btn btn-alt">Checkout</a>
                        </div>
                    </div>
                    <div class="checkout-sidebar-banner mt-30">
                        <a href="product-grids.html">
                            <img src="https://via.placeholder.com/400x330" alt="#">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

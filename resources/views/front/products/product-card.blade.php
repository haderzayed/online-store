
<div class="col-lg-3 col-md-6 col-12">
    <!-- Start Single Product -->
    <div class="single-product">
        <div class="product-image">
            <img src="{{$product->image_url}}" alt="product" height="200">
            @if($product->sale_persent)
            <span class="sale-tag">-{{$product->sale_persent}}%</span>
            @endif
            @if($product->new)
            <span class="new-tag">New</span>
            @endif
            <div class="button">
                <a href="product-details.html" class="btn"><i class="lni lni-cart"></i> Add to Cart</a>
            </div>
        </div>
        <div class="product-info">
            <span class="category">{{ $product->category->name . $product->id}}</span>
            <h4 class="title">
                <a href="{{route('products.show',$product->slug)}}">{{ $product->name }}</a>
            </h4>
            <ul class="review">
                <li><i class="lni lni-star-filled"></i></li>
                <li><i class="lni lni-star-filled"></i></li>
                <li><i class="lni lni-star-filled"></i></li>
                <li><i class="lni lni-star-filled"></i></li>
                <li><i class="lni lni-star"></i></li>
                <li><span>4.0 Review(s)</span></li>
            </ul>
            <div class="price">
                <span> {{Currency::format( $product->price) }}</span>
                @if ($product->compare_price)
                <span class="discount-price">${{ Currency::format($product->compare_price) }}</span>
                @endif
            </div>
        </div>
    </div>
    <!-- End Single Product -->
</div>


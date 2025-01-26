
$('.item-quantity').on('change',function(e){

     var id = $(this).data('id');
     var quantity =$(this).val();
     $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       url:"cart/" + id,
       method:'put',
       data:{
         id:id,
         quantity:quantity,
       },
       success:response => {
        $(".subtotal").html(response.subtotal);
      }

     });
});
let remove_from_cart = function(product_id){

    $.ajax({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
      url:"/cart-delete",
      method:'delete',
      data:{
        product_id : product_id,
      },
      success:response => {
        $(".cart-count").html(response.count);
        $(".subtotal").html(response.subtotal);
      }
    });
}

$('.remove-item').on('click',function(){
    var product_id = $(this).data('id');
    remove_from_cart(product_id);
    $(`#${product_id}`).remove();
});


$('.add-cart').on('click',function(e){
    e.preventDefault();
    var product_id = $(this).data('id');
    var quantity =$('[name=quantity]').val() ?? 1;

    if($(this).hasClass('active')){
        remove_from_cart(product_id);
        $(this).removeClass('active');
        $(this).html('<i class="lni lni-cart"></i>Add To Cart');
    }else{
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
           url:"/cart",
           method:'Post',
           data:{
             product_id:product_id,
             quantity:quantity,
           },
           success:response => {
             $(this).addClass('active');
             $(this).html('<i class="lni lni-cart"></i>Remove From Cart');
             $(".cart-count").html(response.count);
           }
         });
    }

});

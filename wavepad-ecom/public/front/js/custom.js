$(document).ready(function(){
	$("#getPrice").change(function(){
		var size = $(this).val();
		var product_id = $(this).attr("product-id");
		$.ajax({
			headers: {
        		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    		},
			url:'/get-product-price',
			data:{size:size,product_id:product_id},
			type:'post',
			success:function(resp){
                //if ever na di ko maayos ung orignal price ung pinakauna ang original price nalang ilalagay 
				if(resp['discount']>0){
					$(".getAttributePrice").html("<div class='price'><h4>₱ "+resp['final_price']+"</h4></div><div class='original-price'><span>Original Price: </span><span>₱ "+resp['product_price']+"</span></div>");
				}//else if(selectedSize !== ""){             
				//	$(".getAttributePrice").html("<div class='price'><h4>₱ {{ $productDetails['product_price'] }}</h4></div>");
				//}
                else{                    
                    $(".getAttributePrice").html("<div class='price'><h4>₱ "+resp['final_price']+"</h4></div>");
                }
            
			},error:function(){
				alert("Error");
			}
		});
	});

	// Update Cart Quantity
	$(document).on('click','.updateCartItem',function(){
		if($(this).hasClass('plus-a')){
			//Get quantity
			var quantity = $(this).data('qty');
			//Increase the quantity by 1
			new_qty = parseInt(quantity) + 1;
			/*alert(new_qty);*/
		}
		if($(this).hasClass('minus-a')){
			//Get quantity
			var quantity = $(this).data('qty');
			// Check if quantity is atleast 1
			if(quantity<=1){
				alert("Item quantity must be 1 or greater!");
				return false;
			}

			//Increase the quantity by 1
			new_qty = parseInt(quantity) - 1;
			/*alert(new_qty);*/
		}
		var cartid = $(this).data('cartid');
		$.ajax({
			headers: {
        		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    		},
			data:{cartid:cartid,qty:new_qty },
			url:'/cart/update',
			type:'post',
			success:function(resp){
				if(resp.status==false){
					alert(resp.message);
				}
				$("#appendCartItems").html(resp.view);
			},error:function(){
				alert("Error");
			}
		});
	});

});


function get_filter(class_name){
    var filter = [];
    $('.'+class_name+':checked').each(function(){
        filter.push($(this).val());
    });
    return filter;
}

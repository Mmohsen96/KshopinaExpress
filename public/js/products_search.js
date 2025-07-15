$(document).on('submit', '#products_search_form', function(event){

    event.preventDefault();
   
    var order_number;
    var html = "";
    var count = 0;

    order_number = $('#order_number').val();
    order_number = order_number.replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, '');
   
    if (order_number != null) {

        setTimeout(function() {

            ajaxx = $.ajax({
                url: "products_search_data",
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    order_number: order_number,
                },
                success: function(response) {
                    console.log(response);
                    if (response.lenght != 0) {

                        var objLength= Object.keys(response).length;

                            response.forEach(product => {

                                count++;

                                html += '<div class="row product_card">';
                                    html += "<div class='col-3'>";
                                        html += '<div class="card-img" id="'+product['product_id']+'" style="background-image: url(\''+product['product_cover_image']+'\')"  ></div>';
                                    html += "</div>";
                                    html += '<div class="col-8 data_">';
                                        html += '<div>';
                                            html += '<span class="product_title">Product Name :</span> <span class="product_value">' +product['product_title'];
                                            if (product['variant_title'] !== null) {
                                                html += ' - ' + product['variant_title'] + '</span>';
                                            }else{
                                                html += '</span>';
                                            }
                                            
                                        html += '</div>';
                                        html += '<div>';
                                            html += '<span class="product_title">Quantity :</span> <span class="product_value" >' + product['quantity'] + '</span>';
                                        html += '</div>';
                                        html += '<div>';
                                            html += '<span class="product_title">Barcode :</span> <span class="product_value"> ' + product['unique_barcode'] + '</span>';
                                        html += '</div>';
                                    html += '</div>';
                                html += '</div>';

                                if (count != objLength)
                                {
                                    html += '<hr>';
                                }
                                
                            });

                            $('.results').html(html);
                            $('.results').show(); 
                            
                    } else {
                        $('.results').hide(); 
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Order Number not found!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }

                }
            });


        }, 500);

    } else {
        Swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'Insert Order Number',
            showConfirmButton: false,
            timer: 1500
        });
    }

});

$(document).on('click', '#contact_us', function(event){
    console.log('you are here');
    $('#contact_us_popup').show();
});


$('.close').click(function(){
    var e = jQuery.Event("keyup"); // or keypress/keydown
    e.keyCode = 27; // for Esc
    $(document).trigger(e); // trigger it on document
});

$(document).keyup(function(e) {
    if (e.keyCode === 27) { // Esc
         
         $('.overlay').hide();
        
    }
});

$(document).on('click', '.return_close', function(event){
    $(this.parentElement.parentElement.parentElement).hide();
});
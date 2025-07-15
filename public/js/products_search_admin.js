
var country_currency={'Egypt':'EGP','Saudi Arabia': 'SAR','Kuwait':'KWD','United Arab Emirates': 'AED','Bahrain': 'BHD','Qatar': 'QAR', 'Oman': 'OMR', 'Jordan': 'JOD'};
var country="";
var queue = new Object();

$(document).on('submit', '#products_search_form', function(event){

    event.preventDefault();
   
    var order_number;
    var html = "";
    var count = 0;
    var stores_url={'origin':'https://admin.shopify.com/store/kshopina/products/','plus_egypt':'https://admin.shopify.com/store/kshopina-egypt/products/'
    ,'plus_ksa':'https://admin.shopify.com/store/kshopina-plus/products/','plus_kuwait':'https://admin.shopify.com/store/kshopina-plus-kuwait/products/'
    ,'plus_uae':'https://admin.shopify.com/store/kshopina-uae/products/' };
    
    order_number = $('#order_number').val();
    order_number = order_number.replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, '');
   
    if (order_number != null) {

        type_of_search = $('#type_of_search').val();
        
        if (type_of_search == 'order_number') {

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
                            country = response[0]['country'];
    
                            response.forEach(product => {
    
                                count++;
    
                                html += '<div class="row product_card_admin" id ="'+product['variant_id']+'">';
                                    html += "<div class='col-3'>";
                                        html += '<div class="card-img" id="'+product['product_id']+'" style="background-image: url(\''+product['product_cover_image']+'\')"  ></div>';
                                    html += "</div>";
                                    html += '<div class="col-8 data_">';
                                        html += '<div>';
                                            html += '<span class="product_title">Product Name :</span> <span class="product_value">' +product['product_title'];
                                            if (product['variant_title'] !== null) {
                                                if (product['variant_title'] != 'Default Title') {
                                                    html += ' - ' + product['variant_title'] + '</span>';

                                                }
                                            }else{
                                                html += '</span>';
                                            }
                                            
                                        html += '</div>';
                                        html += '<div>';
                                            html += '<span class="product_title">Quantity :</span> <span class="product_value" >' + product['quantity'] + '</span>';
                                        html += '</div>';
                                        html += '<div>';
                                            html += '<span class="product_title">SKU :</span> <span class="product_value"> ' + product['variant_sku'] + '</span>';
                                        html += '</div>';
                                    html += '</div>';
                                    html += '<div class="col-1 data_ padding_N">';
                                        html += '<button class="match_btn" onclick="get_similar_item(\''+product['unique_barcode']+'\','+ ' \''+product['variant_sku']+'\','  +product['price']+','+product['quantity']+',&quot;'+product['product_title'].replaceAll('"', '\'')+'&quot;,'+product['product_id']+','+product['variant_id']+',\''+product['country']+'\')">Match</button>';
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
    

        } else if ( type_of_search == 'product_barcode' ) {
            setTimeout(function() {

                ajaxx = $.ajax({
                    url: "products_search_data_by_barcode",
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        barcode: order_number,
                    },
                    success: function(response) {
                        console.log(response);
                        if (response['status'] == 'success') {

                            let product =response['data'][0];

                            html += '<div class="row product_card_admin" id ="'+product['variant_id']+'">';
                            html += "<div class='col-3'>";
                                html += '<div class="card-img" id="'+product['product_id']+'" style="background-image: url(\''+product['product_cover_image']+'\')"  ></div>';
                            html += "</div>";
                            html += '<div class="col-8 data_">';
                                html += '<div>';
                                    html += '<span class="product_title">Product Name :</span> <span class="product_value">' +product['product_title'];
                                    
                                html += '</div>';
                                html += '<div>';
                                    html += '<span class="product_title">NO. of variants :</span> <span class="product_value" >' +response['variants'].length + '</span>';
                                html += '</div>';

                                if (response['variants'].length == 1 ) {
                                    html += '<div>';
                                        html += '<span class="product_title">Barcode :</span> <span class="product_value" >' +response['variants'][0]['unique_barcode'] + '</span>';
                                    html += '</div>';
                                }

                                html += '<div>';
                                for (let i = 0; i < response['stores'].length; i++) {

                                    if (i == 0) {
                                        html +=  '<span class="product_title">Stores :</span> <a class="product_value" target="blank" href="' +stores_url[response['stores'][i]['store']] + response['stores'][i]['product_id'] +'">' + response['stores'][i]['store'] + '</a>';

                                    }else{
                                        html +=  ' | <a class="product_value" target="blank" href="' +stores_url[response['stores'][i]['store']] + response['stores'][i]['product_id'] +'">' + response['stores'][i]['store'] + '</a>';

                                    }
                                }
                               
                                html += '</div>';
                                
                            html += '</div>';
                            
                            html += '</div>';
                            html += '<div class="data_ padding_N" style="flex-direction: row;width: 100%;" id="duplicate_product"> ';
                            html += '<select name="store_name" id="store_name" style="margin-right: 8px;font-size: 14px;padding: 10px;">';
                                html +=      '<option value="plus_egypt">Egypt</option>',
                                html +=      '<option value="plus_ksa">Saudi Arabia</option>',
                                html +=      '<option value="plus_kuwait">Kuwait</option>',
                                html +=      '<option value="plus_uae">UAE</option>',
                            html += '</select>'
                                html += '<button class="match_btn" onclick="duplicate_product(this,\''+product['product_id']+'\','+ ' \''+product['barcode']+'\')">Duplicate</button>';
                            html += '</div>';

        
                                $('.results').html(html);
                                $('.results').show(); 
                                
                        } else {
                            $('.results').hide(); 
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'Product not found!',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
    
                    }
                });
    
    
            }, 500);
        }else if ( type_of_search == 'product_id'){
            setTimeout(function() {

                ajaxx = $.ajax({
                    url: "products_search_data_by_shopify_product_id",
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        shopify_product_id: order_number,
                    },
                    success: function(response) {
                        console.log(response);
                        if (response['status'] == 'success') {

                            let product =response['data'][0];

                            html += '<div class="row product_card_admin" id ="'+product['variant_id']+'">';
                            html += "<div class='col-3'>";
                                html += '<div class="card-img" id="'+product['product_id']+'" style="background-image: url(\''+product['product_cover_image']+'\')"  ></div>';
                            html += "</div>";
                            html += '<div class="col-8 data_">';
                                html += '<div>';
                                    html += '<span class="product_title">Product Name :</span> <span class="product_value">' +product['product_title'];
                                    
                                html += '</div>';
                                html += '<div>';
                                    html += '<span class="product_title">NO. of variants :</span> <span class="product_value" >' +response['variants'].length + '</span>';
                                html += '</div>';

                                if (response['variants'].length == 1 ) {
                                    html += '<div>';
                                        html += '<span class="product_title">Barcode :</span> <span class="product_value" >' +response['variants'][0]['unique_barcode'] + '</span>';
                                    html += '</div>';
                                }
                                
                                html += '<div>';
                                for (let i = 0; i < response['stores'].length; i++) {

                                    if (i == 0) {
                                        html +=  '<span class="product_title">Stores :</span> <a class="product_value" target="blank" href="' +stores_url[response['stores'][i]['store']] + response['stores'][i]['product_id'] +'">' + response['stores'][i]['store'] + '</a>';

                                    }else{
                                        html +=  ' | <a class="product_value" target="blank" href="' +stores_url[response['stores'][i]['store']] + response['stores'][i]['product_id'] +'">' + response['stores'][i]['store'] + '</a>';

                                    }
                                }
                               
                                html += '</div>';

                            html += '</div>';
                            
                            html += '</div>';
                            html += '<div class="data_ padding_N" style="flex-direction: row;width: 100%;" id="duplicate_product"> ';
                            html += '<select name="store_name" id="store_name" style="margin-right: 8px;font-size: 14px;padding: 10px;">';
                                html +=      '<option value="plus_egypt">Egypt</option>',
                                html +=      '<option value="plus_ksa">Saudi Arabia</option>',
                                html +=      '<option value="plus_kuwait">Kuwait</option>',
                                html +=      '<option value="plus_uae">UAE</option>',
                            html += '</select>'
                                html += '<button class="match_btn" onclick="duplicate_product(this,\''+product['product_id']+'\','+ ' \''+product['barcode']+'\')">Duplicate</button>';
                            html += '</div>';

    
                            $('.results').html(html);
                            $('.results').show(); 
                                
                        } else {
                            $('.results').hide(); 
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'Product not found!',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
    
                    }
                });
    
    
            }, 500);
        }
       
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

function duplicate_product(element,product_id,product_barcode){

    let store= $('#store_name').val();

    $(element).prop('disabled', true);
    $(element).html('<div style="align-items: center;justify-content: center;display: flex"><div class="loader"></div></div>');

    if (store == "plus_egypt" ||  store == "plus_ksa" || store == "plus_kuwait" || store == "plus_uae") {

          $.ajax({
              url: "duplicate_product_by_product_id",
              type: "post",
              data: {
                  _token: $('meta[name="csrf-token"]').attr('content'),
                  product_id: product_id,
                  store: store,
                  product_barcode:product_barcode
              },
              success: function(response) {
                  
                if (response == 'success') {
                    $(element).html('Duplicated!');

                }else{
                    $(element).html('Fail!');

                }
              },
              error: function(xhr) {
                  //Do Something to handle error
              }
  
          });
      } else {
          Swal.fire({
              position: 'center',
              icon: 'warning',
              title: 'Choose which store!',
              showConfirmButton: false,
              timer: 1500
          });
      }
     
  
}


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
    event.preventDefault();

});

function get_similar_item(barcode,sku,price,qty,product_name,product_shopify_id,variant_shopify_id,country){


    if (country == "Egypt" ||  country == "Saudi Arabia" || country == "Kuwait" || country == "United Arab Emirates" ) {
          $.ajax({
              url: "get_similar_item_by_barcode",
              type: "post",
              data: {
                  _token: $('meta[name="csrf-token"]').attr('content'),
                  barcode: barcode,
                  country: country,
              },
              success: function(response) {
                  console.log(response);
                  
                  var html='';
                  var length=0;
                  length=response.length - 1;
  
                  variants_number=response.length;
                  queue['item']=variant_shopify_id;

                    if (response.length>0){
  
                        response.forEach(element => {
                            
                        html += '<div  onclick="add_qty('+element['sql_variant_id']+','+qty +',\''+variant_shopify_id+'\')"  class="variant_card" > ';
    
                        if (element['variant_title']=='Default Title') {
                            html += '<input type="hidden" name="variant_id" id="shopify_variant_id" value="'+element['variant_id']+'">';
                        }
    
                        html +=     '<h2 style="margin-left: 5px;font-size: 1.4rem;" id="variant_name"> '+element['variant_title']+'</h2>'+
                                    '<div style="margin: 20px 50px 0px 30px;display: flex;align-items: center;justify-content: space-between;" class="row">'+
                                        '<div style="margin-inline: 0px;" class="row">'+
                                            '<span style="font-weight: 600;">SKU :&nbsp;</span>'+
                                            '<span id="sku">'+element['variant_sku']+'</span>'+
                                        '</div>'+
                                        '<div style="margin-inline: 0px;" class="row">'+
                                            '<span style="font-weight: 600;">Price :&nbsp;</span>'+
                                            '<span id="price">'+element['variant_price']+'&nbsp; </span>'+ country_currency[country]+
                                        '</div>'+
                                    '</div>'+
                                    '<div style="margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 30px;" class="row">'+
                                        '<span style="font-weight: 600;">QTY :&nbsp;</span>'+
                                        '<span id="qty">'+element['variant_quantity']+'</span>'+
                                    '</div>'+
                                '</div>';
    
                    
                        if (length > 0) {
                            html += '<hr>';
    
                            length=length-1;
                        }
    
                        $('#product_name').html(element['product_title']);
                        $('#number_of_variants').html(element['number_of_variants']);
                        $('#product_info').show();
    
                            if ((variants_number==1 && element['variant_title'] =='Default Title') || variants_number > 1 ) {
    
                                $('#created_variant_button').html('<button onclick="create_new_variant(\''+element['shopify_product_id']+ '\','+'\''+element['variant_sku']+'\', \' ' +element['unique_barcode']+'\','
                                        +element['variant_price']+','+qty+','+variants_number+', \''+country+'\',\''+variant_shopify_id+'\')" type="button" class="btn btn-primary"'+
                                        'style="font-weight: 700;padding: 5px 25px;">'+
                                        'Create new variant'+
                                    '</button>');
    
                                $('#created_variant_button').show();
    
                            }
                        
                        });
  
  
                  
                    }else{
  
                        $("#product_name").html('<input style="width: 90%;color: #cb9d48;margin-left: 5px;font-size: 1rem;font-weight: 500;padding: 8px;" type="text" name="product_name" id="new_product_name" value="'+product_name+'">')
                        $('#number_of_variants').html("1");
                        $('#product_info').show();
    
                        html += '<div> '+
                                    '<h2 style="margin-left: 5px;font-size: 1.4rem;" id="variant_name">Default Title</h2>'+
                                    '<div style="margin: 20px 50px 0px 30px;display: flex;align-items: center;justify-content: space-between;" class="row">'+
                                        '<div style="width: 50%;margin-inline: 0px;" class="row">'+
                                            '<span style="font-weight: 600;">SKU :&nbsp;</span>'+
                                            '<input style="width: 60%;color: #cb9d48;margin-left: 5px;" type="text" name="new_variant_sku" id="new_variant_sku" value="'+sku+'">'+
                                        '</div>'+
                                        '<div style="width: 50%;margin-inline: 0px;" class="row">'+
                                            '<span style="font-weight: 600;">Price :&nbsp;</span>'+
                                            '<input style="width: 60%;color: #cb9d48;margin-left: 5px;" type="number" name="new_variant_price" id="new_variant_price" value="'+price+'">'+
                                        '</div>'+
                                    '</div>'+
                                    '<div style="margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 30px;" class="row">'+
                                        '<span style="font-weight: 600;">QTY :&nbsp;</span>'+
                                        '<input style="color: #cb9d48;margin-left: 5px;" type="text" name="new_variant_qty" id="new_variant_qty" value="'+qty+'">'+
                                    '</div>'+
                                '</div>';
    
                        $('#variants_body').append(html);
    
                        $("#created_variant_button").html('<button onclick="submit_new_product(this,'+product_shopify_id+','+variant_shopify_id+')" type="button" class="btn btn-primary"'+
                                            'style="font-weight: 700;padding: 5px 25px;">'+
                                            'Submit'+
                                        '</button>');
    
                        $('#created_variant_button').show();
              
                    }
                  
                  $('#variants_body').html(html); 
  
                  $('#return_pop').show();
              },
              error: function(xhr) {
                  //Do Something to handle error
              }
  
          });
      } else {
          Swal.fire({
              position: 'center',
              icon: 'warning',
              title: 'No local store for this country ( '+country+' ).',
              showConfirmButton: false,
              timer: 1500
          });
      }
     
  
}

function submit_new_product(element,product_shopify_id,variant_shopify_id){

    document.getElementById('created_variant_button').firstChild.disabled= true;
    document.getElementById("created_variant_button").firstChild.innerHTML = '<div style="align-items: center;justify-content: center;display: flex"><div class="loader"></div></div>';
        
    $.ajax({
        url: "create_new_product_return",
        type: "post",
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            product_id:product_shopify_id,
            variant_id:variant_shopify_id,
            product_name:$("#new_product_name").val(),
            sku:$("#new_variant_sku").val(),
            price:$("#new_variant_price").val(),
            qty:$("#new_variant_qty").val(),
            country:country
        },
        success: function(response) {

            $("#"+queue['item']).css({"background-color": "#1b3425","color": "white"});

            if (response=='Fail') {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Can not dublicate!',
                    showConfirmButton: false,
                    timer: 1500
                    });
            } else {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Product had been dublicated',
                    showConfirmButton: false,
                    timer: 1500
                    });
            }
        
            $("#return_pop").hide();
           

            $('#variants_body').html('');
            $('#product_info').hide();
            $('#product_name').html('No item selected');
            $('#created_variant_button').hide();

        },
        error: function(xhr) {
            //Do Something to handle error
        }

    });

}

function create_new_variant(shopify_product_id,sku,barcode,price,qty,length,country,variant_shopify_id){
            
    var html="";
    var new_sku="";
    var new_variant_qty = qty ;

    if (length==1) {
        new_sku = sku+'-'+'2';

        $("#sku").html($("#sku").text()+'-1');
            document.getElementById('variants_body').firstChild.removeAttribute("onclick");
            document.getElementById('variants_body').firstChild.removeAttribute("class");

        $("#variant_name").html('<input style="color: #cb9d48;margin-left: 5px;font-size: 1.2rem;" type="text" name="variant_name" id="default_variant_name" value="'+$("#variant_name").text()+'">')

    } else if(sku.lastIndexOf("-") != -1) {
        var last_index=sku.lastIndexOf("-");
        new_sku = sku.substr(0,last_index) +'-'+ (parseInt(sku.substr(last_index+1)) +1);
    }else{
        new_sku=sku;
    }

    /* if (last_index==-1) {
        new_sku = sku+'-'+'2'
    }else{
        new_sku = sku.substr(0,last_index) +'-'+ (parseInt(sku.substr(last_index+1)) +1);
    } */

    html+="<hr>";
    
    html += '<div style="margin-top: 30px" > '+
                            '<input style="color: #cb9d48;margin-left: 5px;font-size: 1.2rem;" type="text" name="variant_name" id="new_variant_name">'+
                            '<div style="margin: 20px 50px 0px 30px;display: flex;align-items: center;justify-content: space-between;" class="row">'+
                                '<div style="margin-inline: 0px;" class="row">'+
                                    '<span style="font-weight: 600;">SKU :&nbsp;</span>'+
                                    '<span >'+new_sku+'</span>'+
                                '</div>'+
                                '<div style="margin-inline: 0px;" class="row">'+
                                    '<span style="font-weight: 600;">Price :&nbsp;</span>'+
                                    '<span >'+price+'&nbsp; '+country_currency[country]+'</span>'+
                                '</div>'+
                            '</div>'+
                            '<div style="margin-top: 8px;display: flex;align-items: center;justify-content: start;margin-left: 30px;" class="row">'+
                                '<span style="font-weight: 600;">QTY :&nbsp;</span>'+
                                '<input style="color: #cb9d48;margin-left: 5px;font-size: 1.2rem;" type="text" value='+qty+' name="new_variant_qty" id="new_variant_qty">'+
                               /*  '<span >'+qty+'</span>'+ */
                            '</div>'+
                        '</div>';

                        
         /* new_variant_qty = $('#new_variant_qty').value;
        console.log(new_variant_qty); */

        /* if ($("#variant_name").text()=='Default Title') {

            $("#sku").html($("#sku").text()+'-1');
            document.getElementById('variants_body').firstChild.removeAttribute("onclick");
            document.getElementById('variants_body').firstChild.removeAttribute("class");

            $("#variant_name").html('<input style="color: #cb9d48;margin-left: 5px;font-size: 1.2rem;" type="text" name="variant_name" id="default_variant_name" value="'+$("#variant_name").text()+'">')
        } */

        $('#variants_body').append(html);

        $("#created_variant_button").html('<button onclick="submit_new_variant(\''+
        shopify_product_id+ '\',\''+new_sku+ '\','+price+','+new_variant_qty+','+barcode+',\''+variant_shopify_id+'\')" type="button" class="btn btn-primary"'+
                            'style="font-weight: 700;padding: 5px 25px;">'+
                            'Submit'+
                        '</button>');

        $('#created_variant_button').show();


}

function submit_new_variant(shopify_product_id,sku,price,qty,barcode,variant_shopify_id){

    document.getElementById('created_variant_button').firstChild.disabled= true;
    document.getElementById("created_variant_button").firstChild.innerHTML = '<div style="align-items: center;justify-content: center;display: flex"><div class="loader"></div></div>';

    var default_variant=['Empty'];
    if (typeof(document.getElementById('default_variant_name')) !='undefined' && document.getElementById('default_variant_name') !=null) {

        default_variant=[$("#default_variant_name").val(),$("#shopify_variant_id").val(),$("#sku").text()];
    } 

    $.ajax({
        url: "create_new_variant",
        type: "post",
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            shopify_product_id: shopify_product_id,
            variant_name: $("#new_variant_name").val(),
            sku:sku,
            price:price,
            qty:$("#new_variant_qty").val(),
            default_variant:default_variant,
            country:country,
            barcode: barcode
        },
        success: function(response) {
            // document.getElementById("restock_" + id).innerHTML = "Action taken"; 

            $("#"+queue['item']).css({"background-color": "#1b3425","color": "white"});

            if (response=='Success') {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Variant had been added',
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'variant did not create!',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
            
            $("#return_pop").hide();

            $('#variants_body').html('');
            $('#product_info').hide();
            $('#product_name').html('No item selected');
            $('#created_variant_button').hide();

        },
        error: function(xhr) {
            //Do Something to handle error
        }

    });
}

function add_qty(id,qty,variant_shopify_id){
            
    $("#variants_body").html("Loading....");
    $('#created_variant_button').hide();
    $('#loader_').show();

    $.ajax({
        url: "return_qty_to_stock",
        type: "post",
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            id: id,
            qty:qty,
            country:country
        },
        success: function(response) {
            /* document.getElementById("restock_" + id).innerHTML = "Action taken"; */

            $("#"+queue['item']).css({"background-color": "#1b3425","color": "white"});


            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Order had been returned to '+country+' stock',
                showConfirmButton: false,
                timer: 1500
            });
            $("#return_pop").hide();
            $('#loader_').hide();
            $('#variants_body').html('');
            $('#product_info').hide();
            $('#product_name').html('No item selected');

             item_done=1;

        },
        error: function(xhr) {
            //Do Something to handle error
        }
    });


}


$(document).ready(function(){
   show_artwork();
   view_cart();
});


function post_art(event) {
    var data = new FormData(event.target);
    data.append('method', 'post_art');
    axios.post('includes/handler.php', data)
    .then(function(response) {
        if(response.data == 1) {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Your art has been posted',
                showConfirmButton: false,
                timer: 1500
              })
            document.getElementById("formPost").reset();
        }
        else if(response.data == 0 ) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
                footer: '<a>Make your Art title short please!.. dont make it so long!</a>'
              })
        }
        else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
                footer: '<a href="login.html" id="not-login">Please login or sign up to post an art!</a>'
              })
        }
    })
}


function show_artwork() {
    var data = new FormData();
    data.append('method', 'show_artwork');
    axios.post('includes/handler.php', data)
    .then(function(response) {
        if(response.data.length > 0 ) {
            var  buffer = '';
            $.each(response.data, function(i, val) {
			buffer += '<div class="col-md-4 col-lg-4">';
            buffer += '<div class="product-item">';
                buffer += '<div class="product-thumb">';
                if(i == 0 ) {
                    buffer += '<span class="bage">Sale</span>';
                    buffer += '<img class="img-responsive" src="images/shop/artwork/'+ val.image + '" alt="' + val.title + '" />';
                } else {
                    buffer += '<img class="img-responsive" src="images/shop/artwork/'+ val.image + '" alt="' + val.title + '" />';
                }
                    buffer += '<div class="preview-meta">';
                        buffer += '<ul>';
                            buffer += '<li>';
                                buffer += '<span  data-toggle="modal" data-target="#product-modal" onclick="on_search('+ val.art_id +')">';
                                    buffer += '<i class="tf-ion-ios-search-strong"></i>';
                                buffer += '</span>';
                            buffer += '</li>';
                            buffer += '<li>';
                                buffer += '<a href="#!" ><i class="tf-ion-ios-heart"></i></a>';
                            buffer += '</li>';
                            buffer += '<li>';
                                buffer += '<a href="#!" onclick="add_toCart('+ val.art_id+')"><i class="tf-ion-android-cart"></i></a>';
                            buffer += '</li>';
                        buffer += '</ul>';
                      buffer += '</div>';
                buffer += '</div>';
                buffer += '<div class="product-content">';
                    buffer += '<h4><a href="product-single.html">' + val.title + '</a></h4>';
                    buffer += '<p class="price">₱' + val.price + '</p>';
                buffer += '</div>';
            buffer += '</div>';
        buffer += '</div>'; 

            })

            $('#artwork_placeholder').html(buffer);
        }
    })
    .catch(function(error) {
        console.log(error);
    })
}

function on_search(id) {
   var data = new FormData();
   data.append('method', 'on_search');
   data.append('id', id);
   axios.post('includes/handler.php', data)
   .then(function(response) {
       if(response.data.length > 0) {
           var buffer = '';
           $.each(response.data, function(index, val) {
            buffer += '<div class="modal-body">';
            buffer += '<div class="row">';
                buffer += '<div class="col-md-8 col-sm-6 col-xs-12">';
                buffer += '<div class="modal-image">';
                    buffer += '<img class="img-responsive" src="images/shop/artwork/' + val.image + '" alt="modal-img" />';
                    buffer += '</div>';
                        buffer += '</div>';
                        buffer += '<div class="col-md-4 col-sm-6 col-xs-12">';
                        buffer += '<div class="product-short-details">';
                        buffer += '<h2 class="product-title">' + val.title + '</h2>';
                        buffer += '<p class="product-price">₱' + val.price + '</p>';
                        buffer += '<p class="product-short-description">';
                        buffer += val.description;
                    buffer += '</p>';
                    buffer += '<p>Features : '+ val.features + '</p>';
                    buffer += '<p>Quantity : '+ val.quantity + '</p>';
                    buffer += '<p>Category : '+ val.categories + '</p>';
                    buffer += '<buton type="button" class="btn btn-main" onclick="add_toCart('+ val.art_id +')">Add To Cart</button>'; 
                buffer += '</div>';
            buffer += '</div>'; 
            buffer += '</div></div>';
        })
           $("#modal_placeholder").html(buffer);
       }
   })
   .catch(function(error) {
       console.log(error);
   })
}


function add_toCart(id) {
    var user_id = $("#get_userId").val();
    var data = new FormData();
    data.append('method', 'add_toCart')
    data.append('user_id', user_id);
    data.append('art_id', id);
    axios.post('includes/handler.php', data)
    .then(function(response) {
        if(response.data == 1) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
              })
              Toast.fire({
                icon: 'success',
                title: 'Added to cart successfully!'
              })
              view_cart();
              window.location = "cart.php";
        }
        else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
                footer: '<a href="login.html" id="not-login">Please login or sign up to add a cart!</a>'
              })
        }
    })
}

var total = null;
var items = null;
function view_cart() {
    var user_id = $("#get_userId").val();
    var data = new FormData();
    data.append('method', 'view_cart');
    data.append('user_id', user_id);
    axios.post('includes/handler.php', data)
    .then(function(response) {
        if(response.data.length > 0 ) {
            var  buffer = '';
            var  order = '';
            var index = 0; // counter for number of items
            var total_order = 0;
            $.each(response.data, function(i, value) {
                total_order += value.price;
                index++;
                buffer += '<tr><td>';
                buffer +=  '<div class="product-info">';
                buffer += '<img width="80" src="images/shop/artwork/'+value.image+'" alt="'+value.title+'" />';
                buffer += '<a href="#">' + value.title + '</a>';
                buffer += '</div></td>';
                buffer += '<td>₱' + value.price + '</td>';
                buffer += '<td><a class="product-remove" href="#" onclick="delete_cart('+ value.art_id +')">Remove</a>';
                buffer += '</td></tr>';
                // for order 
                order += '<div class="media product-card">';
                order += '<a class="pull-left" href="shop.php">';
                order += '<img class="media-object" src="images/shop/artwork/'+ value.image + '" alt="'+ value.title +'" />';
                order += '</a>';
                order += '<div class="media-body">';
                order += '<h4 class="media-heading"><a href="shop.php">' + value.title + '</a></h4>';
                order += '<p class="price">1 x '+ value.price + '</p>';
                order += '<span class="remove" onclick="delete_cart('+ value.art_id +')">Remove</span>';
                order +='</div></div>';
                order += '<div class="discount-code">';
                order += '<p>Have a discount ? <a data-toggle="modal" data-target="#coupon-modal" href="#!">enter it here</a></p>';
                order += '</div>';
                order += '<ul class="summary-prices">';
                order += '<li>'; 
                order += '<span>Subtotal:</span>';
                order += '<span class="price">'+ value.price + '</span>';
                order += '</li><li><span>Shipping:</span>';
                order += '<span>Free</span>'
                order += '</li></ul>';
            })
            total = total_order;
            items = index;
            $('#cart-placeholder').html(buffer);
            $('#order-placeholder').html(order);
            $('.checkout-total').html("₱" + total_order);
        } 
        
    })
}

function delete_cart(id) {
    var user_id = $("#get_userId").val();
    var data= new FormData();
    data.append('method', 'delete_cart');
    data.append('user_id', user_id);
    data.append('art_id', id);
    axios.post('includes/handler.php', data)
    view_cart();
}   


function contact_us(event) {
    var data = new FormData(event.target);
    data.append('method', 'contact_us');
    axios.post('includes/handler.php', data)
    .then(function(response) {
        if(response.data == 1) {
           document.getElementById('mail-success').style.display = 'block';
           document.getElementById("contact-form").reset();
        }
         else {
             document.getElementById('mail-fail').style.display = 'block';
         }
    })
    .catch(function(error) {
        console.log("Contact Error " + error);
    })
}


function signup(event){
    if($('.password').val() == $('.cpassword').val()){
        var data = new FormData(event.target);
        data.append("method","fnSignUp");
        axios.post("includes/handler.php",data)
        .then(function(r){
            if(r.data == 2){
                alert("You are now registered");
                window.location = 'login.html';
            }
            else{
                alert("Email already exists. Choose a different email address");
            }
        })
        .catch(function(error) {
            console.log("Sign-up error " + error);
        })
    }
    else{
        alert("Password not match");
    }
}


function login(event){
    var data = new FormData(event.target);
    data.append("method","login");
    axios.post("includes/handler.php", data)
    .then(function(r){
        console.log(r.data);
        if(r.data == 1){
            window.location = "index.php";
        }
        else if(r.data == 2){
            alert("Email not exists");
        }
        else{
            alert("Incorrect password");
        }
    })
    .catch(function(error) {
        console.log("login error " + error);
    })
}

function checkout(event) {
    var user_id = $("#get_userId").val();
    var data = new FormData(event.target);
    data.append('method', 'checkout');
    data.append('items', items);
    data.append('total', total);
    data.append('user_id', user_id);
    axios.post('includes/handler.php', data)
    .then(function(response) {
        if(response.data == 1) {
            clear_cart();
            window.location = "confirmation.php";
        }
    })
}

function clear_cart() {
    var user_id = $("#get_userId").val();
    var data = new FormData();
    data.append('method', 'clear_cart');
    data.append('user_id', user_id);
    axios.post('includes/handler.php', data)
}

// to hide the address from the address tab on Dashboard
function not_show(id) {
  var data = new FormData();
  data.append('method', 'not_show');
  data.append('order_id', id);
  axios.post('includes/handler.php', data)
  .then(function(response) {
      if(response.data == 1) {
        location.reload(true); //referesh the page
      }
  })
}

var update_order_id = null;
function view_address(id) {
    update_order_id = id;
    var data = new FormData();
    data.append('method', 'view_address');
    data.append('id', id);
    axios.post('includes/handler.php', data)
    .then(function(response) {
      if(response.data.length > 0 ) {
          var buffer = '';
          $.each(response.data, function(i, value) {
            buffer += '<div class="form-group">';
            buffer += '<label for="full_name">Name</label>';
            buffer += '<input type="text" class="form-control" value="' + value.fullname + '" id="full_name" name="full_name" required>';
          buffer +='</div>';
         buffer += '<div class="form-group">';
            buffer += '<label for="user_address">Address</label>';
            buffer += '<input type="text" class="form-control" value="' + value.address + '" id="user_address" name="user_address" required>';
         buffer += '</div>';
         buffer += '<div class="checkout-country-code clearfix">';
            buffer += '<div class="form-group">';
               buffer += '<label for="user_post_code">Zip Code</label>';
               buffer += '<input type="number" class="form-control" value="' + value.zipcode + '" id="user_post_code" name="zipcode" required>';
            buffer += '</div>';
            buffer += '<div class="form-group" >';
               buffer += '<label for="user_city">City</label>';
               buffer += '<input type="text" class="form-control" value="' + value.city + '" id="user_city" name="city" required>';
            buffer += '</div>';
        buffer += '</div>';
        buffer += '<div class="form-group">';
            buffer += '<label for="user_country">Country</label>';
            buffer += '<input type="text" class="form-control" value="' + value.country + '" id="user_country" name="user_country" required >';
         buffer += '</div>';
         buffer += '<div class="form-group">';
           buffer += '<label for="phone">Phone</label>';
           buffer += '<input type="number" class="form-control" value="' + value.phone + '" id="phone" name="phone" required>';
        buffer += '</div>';
          })

          $('#update-form').html(buffer);
      } 
    })
}

function update_address(event){
    var data = new FormData(event.target);
    data.append('method', 'update_address');
    data.append('order_id', update_order_id);
    axios.post('includes/handler.php', data)
    .then(function(response) {
      if(response.data == 1) {
        location.reload(true); //referesh the page
      }
    })
}

async function upload_profile() {
  const { value: file } = await Swal.fire({
    title: 'Select image',
    input: 'file',
    inputAttributes: {
      'accept': 'image/*',
      'aria-label': 'Upload your profile picture'
    }
  })
  
  if (file) {
    const reader = new FileReader()
    reader.onload = (e) => {
      Swal.fire({
        title: 'Your uploaded picture',
        imageUrl: e.target.result,
        imageAlt: 'The uploaded picture'
      })
    }
    reader.readAsDataURL(file)
    var profile_picture = file;
    var user_id = $("#get_userId").val();
    var data = new FormData();
    data.append('method', 'upload_profile');
    data.append('user_id', user_id);
    data.append('profile_picture', profile_picture);
    axios.post('includes/handler.php', data)
    .then(function(response) {
      console.log(response.data);
        if(response.data == 1) {
          location.reload(true); //referesh the page
        }
    })
  }

}

function newsletter(event) {
  var data = new FormData(event.target);
  data.append('method', 'newsletter');
  axios.post('includes/handler.php', data)
  .then(function(response) {
    if(response.data == 1) {
        $('#btn-news').trigger('click');
        document.getElementById('susbcribe').reset();
    }
  })
}

(function ($) {
  'use strict';

  // Preloader
  $(window).on('load', function () {
    $('#preloader').fadeOut('slow', function () {
      $(this).remove();
    });
  });

  // e-commerce touchspin
  $('input[name=\'product-quantity\']').TouchSpin();

  // Count Down JS
  $('#simple-timer').syotimer({
    year: 2022,
    month: 5,
    day: 9,
    hour: 20,
    minute: 30
  });

  //Hero Slider
  $('.hero-slider').slick({
    // autoplay: true,
    infinite: true,
    arrows: true,
    prevArrow: '<button type=\'button\' class=\'heroSliderArrow prevArrow tf-ion-chevron-left\'></button>',
    nextArrow: '<button type=\'button\' class=\'heroSliderArrow nextArrow tf-ion-chevron-right\'></button>',
    dots: true,
    autoplaySpeed: 7000,
    pauseOnFocus: false,
    pauseOnHover: false
  });
  $('.hero-slider').slickAnimation();
})(jQuery);

 
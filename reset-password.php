
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Living Art | sale your art</title>
  <!-- Mobile Specific Metas
  ================================================== -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Construction Html5 Template">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
  <!-- Themefisher Icon font -->
  <link rel="stylesheet" href="plugins/themefisher-font/style.css">
  <!-- bootstrap.min css -->
  <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="css/style.css">
</head>
<body id="body">

<section class="signin-page account">
  <div class="container">
    <div class="row">
      <div class="col-md-7 col-md-offset-3">
        <div class="block text-center">
          <a class="logo" href="index.php">
            <img src='images/living-art-logo.png' class="customize-logo">
          </a>
          <h2 class="text-center">Forgot Password</h2>
          <form class="text-left checkout-form" onsubmit="event.preventDefault(); reset_password(event);">
          <input type="hidden" name="code1" value="<?php echo $_GET['verification-code']; ?>">
            <div class="checkout-country-code clearfix">
              <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" value="<?php echo $_GET['email']; ?>" name="email" required>
                </div>
              <div class="form-group" >
                  <label for="code">Verification</label>
                  <input type="text" class="form-control" id="code" name="code" placeholder="Code"  required>
                 
              </div>
            </div>
            <div class="checkout-country-code clearfix">
              <div class="form-group">
                  <label for="password">New Password</label>
                  <input type="password" class="form-control" id="password" name="password" required>
              </div>
              <div class="form-group" >
                  <label for="confirm_password">Confirm </label>
                  <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Password" required>
              </div>
            </div>
            <div class="text-center" style="margin-top: 15px;">
              <button type="submit" class="btn btn-main text-center">Reset Password</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

    <!-- 
    Essential Scripts
    =====================================-->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.24.0/axios.min.js" integrity="sha512-u9akINsQsAkG9xjc1cnGF4zw5TFDwkxuc9vUp5dltDWYCSmyd0meygbvgXrlc/z7/o4a19Fb5V0OUE58J7dcyw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script>
        function reset_password(event) {
          var data = new FormData(event.target);
          data.append('method', 'reset_password');
          axios.post('includes/handler.php', data)
          .then(function(response) {
              if(response.data == 2) {
                    Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Wrong verification code or password does not match!',
                    footer: '<a href="#!">Please try again</a>'
                  })
              }
              else {
                let timerInterval
                  Swal.fire({
                    title: 'Updating password!',
                    html: 'I will close in <b></b> milliseconds.',
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: () => {
                      Swal.showLoading()
                      const b = Swal.getHtmlContainer().querySelector('b')
                      timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft()
                      }, 100)
                    },
                    willClose: () => {
                      clearInterval(timerInterval)
                    }
                  }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                      window.location = "login.html";
                    }
                  })
               
              }
          })
        }
      </script>
  </body>
  </html>
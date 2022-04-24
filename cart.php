<?php require_once('includes/header.php'); 
  if(!$user_id){
    echo '<script>window.location.href = "login.html";</script>';
    }
?>
<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name">Cart</h1>
					<ol class="breadcrumb">
						<li><a href="index.php">Home</a></li>
						<li class="active">cart</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="page-wrapper">
  <div class="cart shopping">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="block">
            <div class="product-list">
              <form method="post">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="">Item Name</th>
                      <th class="">Item Price</th>
                      <th class="">Actions</th>
                    </tr>
                  </thead>
                  <tbody id="cart-placeholder">
                   
                  </tbody>
                </table>
                <a  href="checkout.php" class="btn btn-main pull-right">Checkout</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once('includes/footer.html'); ?>
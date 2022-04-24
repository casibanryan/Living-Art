<?php 
	require_once('includes/header.php'); 
?>


<div class="hero-slider">
  <div class="slider-item th-fullpage hero-area" style="background-image: url(images/slider/slider-1.jpg);">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 text-center">
          <p data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".1">DECORATIVE</p>
          <h1 data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".5">The beauty of nature <br> is hidden in details.</h1>
          <a data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".8" class="btn" href="shop.php">Shop Now</a>
        </div>
      </div>
    </div>
  </div>
  <div class="slider-item th-fullpage hero-area" style="background-image: url(images/slider/slider-3.jpg);">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 text-left">
          <p data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".1">COMMERCIAL</p>
          <h1 data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".5">The beauty of nature <br> is hidden in details.</h1>
          <a data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".8" class="btn" href="shop.php">Shop Now</a>
        </div>
      </div>
    </div>
  </div>
  <div class="slider-item th-fullpage hero-area" style="background-image: url(images/slider/slider-2.jpg);">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 text-right">
          <p data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".1">FINE ART</p>
          <h1 data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".5">The beauty of nature <br> is hidden in details.</h1>
          <a data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".8" class="btn" href="shop.php">Shop Now</a>
        </div>
      </div>
    </div>
  </div>
</div>

<section class="product-category section">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="title text-center">
					<h2>FEATURED ART</h2>
				</div>
			</div>
			<div class="col-md-6">
				<div class="category-box">
					<a href="#!">
						<img src="images/shop/category/category-1.jpg" alt="category-1" />
						<div class="content">
							<h3>Decorative</h3>
							<p>Shop New Season Art</p>
						</div>
					</a>
				</div>
				<div class="category-box">
					<a href="#!">
						<img src="images/shop/category/category-2.jpg" alt="category-2" />
						<div class="content">
							<h3>Fine Art</h3>
							<p>Get Wide Range Selection</p>
						</div>
					</a>
				</div>
			</div>
			<div class="col-md-6">
				<div class="category-box category-box-2">
					<a href="#!">
						<img src="images/shop/category/category-3.jpg" alt="category-3" />
						<div class="content">
							<h3>Commercial</h3>
							<p>Special Design Comes First</p>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="products section bg-gray">
	<div class="container">
		<div class="row">
			<div class="title text-center">
				<h2>Trending ART</h2>
			</div>
		</div>
		<div class="row" id="artwork_placeholder">
				<!-- data will display here-->
		</div>
	</div>
</section>

<!-- Modal -->
<div class="modal product-modal fade" id="product-modal">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<i class="tf-ion-close"></i>
	</button>
	  <div class="modal-dialog " role="document">
		<div class="modal-content" id="modal_placeholder">
			
		</div>
	  </div>
</div><!-- /.modal -->

<!--
Start Call To Action
==================================== -->
<section class="call-to-action bg-gray section">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<div class="title">
					<h2>SUBSCRIBE TO NEWSLETTER</h2>
					<p>For Exclusive art and sale update, subcribe<br> now and receive a free voucher code reward to spend on your next purchase.</p>
				</div>
				<div class="col-lg-6 col-md-offset-3">
					<form id="susbcribe" onsubmit="event.preventDefault(); newsletter(event);">
				    <div class="input-group subscription-form">
				      <input type="email" class="form-control" name="email" required placeholder="Enter Your Email Address">
				      <span class="input-group-btn">
				        <button class="btn btn-main" type="submit">Subscribe Now!</button>
						<button style="display:none;" id="btn-news" data-toggle="modal" data-target="#newsletter_modal"></button>
				      </span>
				    </div><!-- /input-group -->
					</form>
			  </div><!-- /.col-lg-6 -->
			</div>
		</div> 		<!-- End row -->
	</div>   	<!-- End container -->
</section>   <!-- End section -->

 <!-- Modal for newsletter -->
 <div class="modal fade" id="newsletter_modal">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span class="alert alert-danger alert-common"><i class="tf-ion-close-circled"></i></span>
	</button>
	  <div class="modal-dialog " role="document">
		<div class="modal-content">
			  <div class="modal-body">
				<!-- Site Logo -->
				<div class="logo text-center">
					<a href="index.php"><img src='images/living-art-logo.png' class="customize-logo"></a>
					<p class="mt-10">Thank you for subscribing to our newsletter, <?php echo $fullname; ?> <br>
						You are now subscribed to our newsletter and about to discover new art collections from the Philippines.
					</p>
				</div>
			</div>
		</div>
	  </div>
</div><!-- /.modal -->

<?php require_once('includes/footer.html'); ?>
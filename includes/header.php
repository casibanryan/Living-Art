<?php
	session_start();
	$user_id = $_SESSION['user_id'] ?? null;
	$fullname = $_SESSION['fullname'] ?? null;
	$email = $_SESSION['email'] ?? null;
	$connection = new mysqli("localhost", "root", "", "living_art");
	$total = null;
?>


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
  <meta name="author" content="Team-RCK">
  
  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="images/living-art-icon.png" />
  
  <!-- Themefisher Icon font -->
  <link rel="stylesheet" href="plugins/themefisher-font/style.css">
  <!-- bootstrap.min css -->
  <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
  
  <!-- Animate css -->
  <link rel="stylesheet" href="plugins/animate/animate.css">
  <!-- Slick Carousel -->
  <link rel="stylesheet" href="plugins/slick/slick.css">
  <link rel="stylesheet" href="plugins/slick/slick-theme.css">
  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/home.css">
	
</head>

<body id="body">
<!-- Start Top Header Bar -->
<section class="top-header">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-xs-12 col-sm-4">
				<div class="contact-number">
					<i class="tf-ion-ios-telephone"></i>
					<span>09231088268</span>
					<input type="hidden" id="get_userId" value="<?php echo $user_id; ?>">
				</div>
			</div>
			<div class="col-md-4 col-xs-12 col-sm-4">
				<!-- Site Logo -->
				<div class="logo text-center">
					<a href="index.php">
						<img src='images/living-art-logo.png' class="customize-logo">
				</a>
				</div>
			</div>
			<div class="col-md-4 col-xs-12 col-sm-4">
					<!-- Cart -->
					<ul class="top-menu text-right list-inline">
					<li class="dropdown cart-nav dropdown-slide">
						<a href="#!" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"><i
								class="tf-ion-android-cart"></i> Cart</a>
						<div class="dropdown-menu cart-dropdown">
							<!-- Cart Item -->
						<?php if($user_id) {
							$query_cart = "SELECT * FROM cart WHERE user_id = $user_id";
							$stmt_cart = mysqli_query($connection, $query_cart);
							while ($row = mysqli_fetch_array($stmt_cart)) {
								$cart_artId = $row['art_id'];
								$query_art = "SELECT * FROM artwork WHERE art_id = $cart_artId";
								$stmt_art = mysqli_query($connection, $query_art);
							
							if($cart_artId != null) { 
							while ($row = mysqli_fetch_array($stmt_art)) { ?>
								<div class="media">
								<a class="pull-left" href="#!">
									<img class="media-object" src="images/shop/artwork/<?php echo $row['image']; ?>" alt="image-cart" />
								</a>
								<div class="media-body">
									<h4 class="media-heading"><a href="#"><?php echo $row['title']; ?></a></h4>
									<div class="cart-price">
										<span>1 x <?php $total += $row['price']; ?></span>
										<span><?php echo $row['price']; ?></span>
									</div>
									<h5><strong>₱<?php echo $row['price']; ?></strong></h5>
								</div>
								<a href="" class="remove" onclick="delete_cart(<?php echo $row['art_id']; ?>);"><i class="tf-ion-close"></i></a>
							</div><!-- / Cart Item -->
							<?php } } }}?>

							<?php if($total > 0) { ?>
								<div class="cart-summary">
								<span>Total</span>
								<span class="total-price"><?php echo $total; ?></span>
								</div>
									<ul class="text-center cart-buttons">
										<li><a href="cart.php" class="btn btn-small">View Cart</a></li>
										<li><a href="checkout.php" class="btn btn-small btn-solid-border">Checkout</a></li>
									</ul>
								<?php }  else if(!$user_id) { ?>
							
									<div class="alert alert-info alert-common" role="alert">
										<a href="login.html"><i class="tf-ion-android-checkbox-outline"></i><span>Info!</span> login required</a>
									</div>
								<?php } else { ?>
									<!-- <span> No cart found </span>	 -->
									<ul class="">
									<li><a href="empty-cart.php" class="btn btn-small" style="width: fit-content;">View Cart</a></li>
								</ul>
								<?php }  ?>
						</div>
					</li><!-- / Cart -->

					<!-- Search -->
					<li class="dropdown search dropdown-slide">
						<a href="#!" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"><i
								class="tf-ion-ios-search-strong"></i> Search</a>
						<ul class="dropdown-menu search-dropdown">
							<li>
								<form action="shop.php"><input type="search" class="form-control" placeholder="Search..."></form>
							</li>
						</ul>
					</li><!-- / Search -->
						<li class="dropdown search dropdown-slide">
							<a href="#!" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
							<?php
								if(!$fullname) {
									echo "<i class='tf-ion-android-person'> Guest</i></a>";
									echo '<ul class="dropdown-menu search-dropdown">
										<li><a href="login.html" class="fw-bold">Login</a></li>
										<li><a href="signup.html" class="fw-bold">Signup</a></li>
										</ul>';
								}
								else {
									echo "<i class='tf-ion-android-person'></i> $fullname</a>";
									echo '<ul class="dropdown-menu search-dropdown">
										<li><a href="logout.php" class="fw-bold">Logout</a></li>
										</ul>';
								}
							?>
						</li>

				</ul><!-- / .nav .navbar-nav .navbar-right -->
			</div>
		</div>
	</div>
</section><!-- End Top Header Bar -->
	
<!-- Main Menu Section -->
<section class="menu">
	<nav class="navbar navigation">
		<div class="container">
			<div class="navbar-header">
				<h2 class="menu-title">Main Menu</h2>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
					aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

			</div><!-- / .navbar-header -->

			<!-- Navbar Links -->
			<div id="navbar" class="navbar-collapse collapse text-center">
				<ul class="nav navbar-nav">

					<!-- Home -->
					<li class="dropdown">
						<a href="index.php">Home</a>
					</li><!-- / Home -->
				
					<!-- shop -->
					<li class="dropdown full-width dropdown-slide">
						<a href="#!" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="350"
							role="button" aria-haspopup="true" aria-expanded="false">Shop <span
								class="tf-ion-ios-arrow-down"></span></a>
						<div class="dropdown-menu">
							<div class="row">

								<!-- Introduction -->
								<div class="col-sm-3 col-xs-12">
									<ul>
										<li class="dropdown-header">Introduction</li>
										<li role="separator" class="divider"></li>
										<li><a href="contact.php">Contact Us</a></li>
										<li><a href="about.php">About Us</a></li>
										<li><a href="coming-soon.php">Coming Soon</a></li>
										<li><a href="faq.php">FAQ</a></li>
									</ul>
								</div>

								<!--shop-->
								
								<div class="col-sm-3 col-xs-12">
									<ul>
										<li class="dropdown-header">Shop</li>
										<li role="separator" class="divider"></li>
										<li><a href="shop.php">Shop</a></li>
										<li><a href="checkout.php">Checkout</a></li>
										<?php if($total > 0) { ?>
										<li><a href="cart.php">Cart</a></li>
										<?php } else { ?>
											<li><a href="empty-cart.php">Cart</a></li>
										<?php } ?>
										<li><a href="#">Search</a></li>
									</ul>
								</div>

								<!-- user interface -->
								<div class="col-sm-3 col-xs-12">
									<ul>
										<li class="dropdown-header">Dashboard</li>
										<li role="separator" class="divider"></li>
										<li><a href="dashboard.php">Dashboard</a></li>
										<li><a href="order.php">Orders</a></li>
										<li><a href="address.php">Address</a></li>
										<li><a href="profile-details.php">Profile Details</a></li>
									</ul>
								</div>

								<!-- Mega Menu -->
								<div class="col-sm-3 col-xs-12">
									<a href="shop.php">
										<img class="img-responsive" src="images/shop/header-img.jpg" alt="menu image" />
									</a>
								</div>
							</div><!-- / .row -->
						</div><!-- / .dropdown-menu -->
					</li><!-- / shop -->


					<!-- dashboard -->
					<li class="dropdown full-width dropdown-slide">
						<a href="#!" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="350"
							role="button" aria-haspopup="true" aria-expanded="false">Dashboard <span
								class="tf-ion-ios-arrow-down"></span></a>
						<div class="dropdown-menu">
							<div class="row">

								<!-- Introduction -->
								<div class="col-sm-3 col-xs-12">
									<ul>
										<li class="dropdown-header">Introduction</li>
										<li role="separator" class="divider"></li>
										<li><a href="contact.php">Contact Us</a></li>
										<li><a href="about.php">About Us</a></li>
										<li><a href="coming-soon.php">Coming Soon</a></li>
										<li><a href="faq.php">FAQ</a></li>
									</ul>
								</div>

								<!--shop-->	
								
								<div class="col-sm-3 col-xs-12">
									<ul>
										<li class="dropdown-header">Shop</li>
										<li role="separator" class="divider"></li>
										<li><a href="shop.php">Shop</a></li>
										<li><a href="checkout.php">Checkout</a></li>
										<?php if($total > 0) { ?>
										<li><a href="cart.php">Cart</a></li>
										<?php } else { ?>
											<li><a href="empty-cart.php">Cart</a></li>
										<?php } ?>
										<li><a href="#">Search</a></li>
									</ul>
								</div>

								<!-- user interface -->
								<div class="col-sm-3 col-xs-12">
									<ul>
										<li class="dropdown-header">Dashboard</li>
										<li role="separator" class="divider"></li>
										<li><a href="dashboard.php">Dashboard</a></li>
										<li><a href="order.php">Orders</a></li>
										<li><a href="address.php">Address</a></li>
										<li><a href="profile-details.php">Profile Details</a></li>
									</ul>
								</div>

								<!-- Mega Menu -->
								<div class="col-sm-3 col-xs-12">
									<a href="shop.php">
										<img class="img-responsive" src="images/shop/header-img.jpg" alt="menu image" />
									</a>
								</div>
							</div><!-- / .row -->
						</div><!-- / .dropdown-menu -->
					</li><!-- / dashboard -->

				<!-- Post -->
				<li class="dropdown">
					<a href="post-art.php">POST ART</a>
				</li>
				</ul><!-- / .nav .navbar-nav -->
			</div>
			<!--/.navbar-collapse -->
		</div><!-- / .container -->
	</nav>
</section>

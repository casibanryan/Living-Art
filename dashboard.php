<?php 
	require_once('includes/header.php');
	if(!$user_id){
		echo '<script>window.location = "login.html";</script>';
	}
	$query_dashboard = "SELECT * FROM checkout WHERE user_id = $user_id";
	$sql_dashboard = mysqli_query($connection, $query_dashboard);
	$sql_profile =  mysqli_query($connection, "SELECT * FROM user_table WHERE user_id = $user_id");
?>
<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name">Dashboard</h1>
					<ol class="breadcrumb">
						<li><a href="index.php">Home</a></li>
						<li class="active">my account</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="user-dashboard page-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="list-inline dashboard-menu text-center">
					<li><a class="active" href="dashboard.php">Dashboard</a></li>
					<li><a href="order.php">Orders</a></li>
					<li><a href="address.php">Address</a></li>
					<li><a href="profile-details.php">Profile Details</a></li>
				</ul>
				<div class="dashboard-wrapper user-dashboard">
					<div class="media">
						<div class="pull-left">
						<?php while($row = mysqli_fetch_array($sql_profile)) { ?>
							<?php if($row['profile'] != null) { ?>
								<img class="media-object user-img" src="images/profile/<?php echo $row['profile']; ?>" alt="profile">
							<?php } else { ?>
							<img class="media-object user-img" src="images/default-profile.png" alt="default-profile">
							<?php } } ?>
						</div>
						<div class="media-body">
							<h2 class="media-heading">Welcome <?php echo $fullname; ?></h2>
							<p>"People don’t buy because what you do is awesome. People buy because it makes them feel awesome." – Tara Gentile </p>
						</div>
					</div>
					<div class="total-order mt-20">
						<h4>Total Orders</h4>
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>Order ID</th>
										<th>Date</th>
										<th>Items</th>
										<th>Total Price</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
								<?php while ($dashboard = mysqli_fetch_array($sql_dashboard)) {  ?>
									<tr>
										<td><a href="#!">#<?php echo $dashboard['order_id']; ?></a></td>
										<td><?php echo $dashboard['date']; ?></td>
										<td><?php echo $dashboard['items']; ?></td>
										<td>₱ <?php echo $dashboard['total']; ?></td>
									</tr>
								<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php require_once('includes/footer.html'); ?>
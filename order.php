<?php require_once('includes/header.php');
	if(!$user_id){
		echo '<script>window.location.href = "login.html";</script>';
		}
	$query_order = "SELECT * FROM checkout WHERE user_id = $user_id";
	$sql_order = mysqli_query($connection, $query_order);
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
					<li><a href="dashboard.php">Dashboard</a></li>
					<li><a class="active" href="order.php">Orders</a></li>
					<li><a href="address.php">Address</a></li>
					<li><a href="profile-details.php">Profile Details</a></li>
				</ul>
				<div class="dashboard-wrapper user-dashboard">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th>Order ID</th>
									<th>Date</th>
									<th>Items</th>
									<th>Total Price</th>
									<th>Status</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							<?php
								$index = 0;
								 while($order = mysqli_fetch_array($sql_order)) { ?>
								<tr>
									<td>#<?php echo $order['order_id']; ?></td>
									<td><?php echo $order['date']; ?></td>
									<td><?php echo $order['items']; ?></td>
									<td>₱ <?php echo $order['total']; ?></td>
									<?php if($index == 0) { ?>
									<td><span class="label label-primary">Processing</span></td> 
									<?php } else if($index == 1) { ?>
									<td><span class="label label-success">Completed</span></td>
									<?php } else if($index == 3) { ?>
									<td><span class="label label-danger">Canceled</span></td>
									<?php } else if($index == 4) { ?>
									<td><span class="label label-info">On Hold</span></td>
									<?php } else { ?>
									<td><span class="label label-warning">Pending</span></td>
									<?php } ?>
									<?php $index++; ?>
									<td><a href="404.html" class="btn btn-default">View</a></td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php require_once('includes/footer.html'); ?>
<?php require_once('includes/header.php');
  	if(!$user_id){
      echo '<script>window.location.href = "login.html";</script>';
    }

    $query_address = "SELECT * FROM checkout WHERE user_id = $user_id";
	  $sql_address = mysqli_query($connection, $query_address);
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
          <li><a href="order.php">Orders</a></li>
          <li><a class="active" href="address.php">Address</a></li>
          <li><a href="profile-details.php">Profile Details</a></li>
        </ul>
        <div class="dashboard-wrapper user-dashboard">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Address</th>
                  <th>Country</th>
                  <th class="col-md-2 col-sm-3">Phone</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php while($address = mysqli_fetch_array($sql_address)) { 
                      if($address['not_show'] != 1) { ?>
                <tr>
                  <td> <?php echo $address['fullname']; ?> </td>
                  <td> <?php echo $email; ?> </td>
                  <td> <?php echo $address['address']; ?> </td>
                  <td> <?php echo $address['country']; ?> </td>
                  <?php if($address['phone'] == 0) { ?>
                  <td>+639 123 456 789</td>
                  <?php } else { ?>
                    <td>+63<?php echo $address['phone']; ?> </td>
                  <?php } ?>
                  <td>
                    <div class="btn-group" role="group">
                      <button type="button" class="btn btn-default" onclick="view_address(<?php echo $address['order_id']; ?>);" data-toggle="modal" data-target="#update_address"><i class="tf-pencil2" aria-hidden="true"></i></button>
                      <button type="button" class="btn btn-default" onclick="not_show(<?php echo $address['order_id']; ?>);"><i class="tf-ion-close" aria-hidden="true"></i></button>
                    </div>
                  </td>
                </tr>
                <?php } } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Modal for update -->
<div class="modal fade" id="update_address" tabindex="-1" role="dialog" aria-labelledby="labelAddress" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form onsubmit="event.preventDefault(); update_address(event);">
      <div class="modal-header">
        <h5 class="modal-title" id="labelAddress">Update Address Informations</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="block billing-details">
          <h4 class="widget-title">Address Details</h4>
          <div class="checkout-form" id="update-form">
            
       </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" id="update-address-btn" class="btn btn-primary">Update</button>
      </div>
    </form>
    </div>
  </div>
</div>

<?php include "includes/footer.html" ?>
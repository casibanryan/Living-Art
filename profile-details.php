<?php require_once('includes/header.php'); 
	if(!$user_id) {
		echo '<script> window.location = "login.html"; </script>';
	}
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
          <li><a href="dashboard.php">Dashboard</a></li>
          <li><a href="order.php">Orders</a></li>
          <li><a href="address.php">Address</a></li>
          <li><a class="active"  href="profile-details.php">Profile Details</a></li>
        </ul>
        <div class="dashboard-wrapper dashboard-user-profile">
          <div class="media">
            <div class="pull-left text-center" href="#!">
              <?php while($row = mysqli_fetch_array($sql_profile)) { ?>
              <?php if($row['profile'] != null) { ?>
                <img class="media-object user-img" src="images/profile/<?php echo $row['profile']; ?>" alt="profile-image">
                <?php }  else { ?>
              <img class="media-object user-img" src="images/default-profile.png" alt="profile-image">
                  <?php }} ?>  
              <button type="button" class="btn btn-transparent mt-20" onclick="upload_profile();">Change Image</button>
            </div>
            <div class="media-body">
              <ul class="user-profile-list">
                <li><span>Full Name:</span><?php echo $fullname; ?></li>
                <li><span>Country:</span>Philippines</li>
                <li><span>Email:</span><?php echo $_SESSION['email']; ?></li>
                <li><span>Phone:</span>+639-12232323</li>
                <li><span>Date of Birth:</span>December , 08 ,2022</li>
              </ul>
            </div>  
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include "includes/footer.html"; ?>
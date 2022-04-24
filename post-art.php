
<?php
	require_once 'includes/header.php';
?>


<section id="post-new-art">
<div class="container">
    <div class="row">
        <form onsubmit="event.preventDefault(); post_art(event);" id="formPost">
            <div class="col-lg-5 col-md-5">
               <div class="container-fluid">
                    <div class="my-3">
                        <input type="file" class="form-control" name="image" required>
						<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                    </div>
                   <div class="my-3">
                        <input type="text" class="form-control" name="title" placeholder="Enter Art tittle" required>
                   </div>

                    <div class="my-3">
                        <div class="input-group">
                          <div class="input-group-addon">₱</div>
                          <input type="number" class="form-control" name="price" placeholder="Enter Price" required>
                          <div class="input-group-addon">.00</div>
                        </div>
                      </div>

					  <div class="my-3">
                        <input type="number" class="form-control" name="quantity" placeholder="Enter Quantity" required>
                   </div>

				   <div class="my-3">
					<input type="text" class="form-control" list="category" name="categories" placeholder="Enter Categories" required>
					<datalist id="category">
						<option value="Commercial">
						<option value="Decorative">
						<option value="Fine Art">
					  </datalist>
			   </div>


               </div>
            </div>

            <div class="col-lg-7 col-md-7">
               
                    <div class="my-3">
						<textarea class="form-control" required placeholder="Enter art description here" name="description" rows="7"></textarea>
                    </div>
					<div class="my-3">
						<textarea class="form-control" required placeholder="Enter art features here" name="features" rows="4"></textarea>
					</div>
            </div>
			
			<div class="submit-btn">
				<button type="submit" class="btn btn-main btn-large btn-round-full">
					Post new art
				</button>
			</div>

        </form>
    </div>
</div>
</section>

    

<?php require_once('includes/footer.html'); ?>

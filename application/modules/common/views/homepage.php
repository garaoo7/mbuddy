
<?php
  $headerComponents = array(
							'css' => array("common/bootstrap.min.css", "style.css")
							);
  $this->load->view("common/header2", $headerComponents);
  // $this->load->view("common/feedelement");
?>

<br>
 <div class="row">
	<div class="col-md-3">
		<div class="card">
			<a href="<?php echo base_url("index.php/listing/Listing_controller");?>">
			<img src="css/images/cards.jpg" id="cardImg">
			</a>
			<div class="container1">
				<a href="<?php echo base_url("index.php/listing/Listing_controller");?>">
				<h5><b><?php echo $listingsData->getListingObject()[142]->getListingTitle();?></b></h5>
				</a>
			</div>
			<div class="container2">
				<p><b>-<?php 
							$userID = $listingsData->getListingObject()[142]->getUserID();
							echo $listingsData->getUserObject()[$userID]->getUsername();

							?>- <span class="glyphicon glyphicon-ok"></span></b></p> 
				<p><?php echo $listingsData->getListingObject()[142]->getListingViews(); ?> views</p> 
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card">
			<img src="css/images/cards.jpg" id="cardImg">
			<div class="container1">
				<h5><b><?php echo $listingsData->getListingObject()[142]->getListingTitle();?></b></h5>
			</div>
			<div class="container2">
				<p><b>-<?php 
							$userID = $listingsData->getListingObject()[142]->getUserID();
							echo $listingsData->getUserObject()[$userID]->getUsername();

							?>- <span class="glyphicon glyphicon-ok"></span></b></p> 
				<p><?php echo $listingsData->getListingObject()[142]->getListingViews(); ?> views</p> 
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card">
			<img src="css/images/cards.jpg" id="cardImg">
			<div class="container1">
				<h5><b><?php echo $listingsData->getListingObject()[142]->getListingTitle();?></b></h5>
			</div>
			<div class="container2">
				<p><b>-<?php 
							$userID = $listingsData->getListingObject()[142]->getUserID();
							echo $listingsData->getUserObject()[$userID]->getUsername();

							?>- <span class="glyphicon glyphicon-ok"></span></b></p> 
				<p><?php echo $listingsData->getListingObject()[142]->getListingViews(); ?> views</p> 
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card">
			<img src="css/images/cards.jpg" id="cardImg">
			<div class="container1">
				<h5><b><?php echo $listingsData->getListingObject()[142]->getListingTitle();?></b></h5>
			</div>
			<div class="container2">
				<p><b>-<?php 
							$userID = $listingsData->getListingObject()[142]->getUserID();
							echo $listingsData->getUserObject()[$userID]->getUsername();

							?>- <span class="glyphicon glyphicon-ok"></span></b></p> 
				<p><?php echo $listingsData->getListingObject()[142]->getListingViews(); ?> views</p> 
			</div>
		</div>
	</div>
</div>

<!-- <button type="button" id="loadMore" value="loadmore">Load More</button>
<input type="hidden" name="limit" id="limit" value="10"/>
<input type="hidden" name="offset" id="offset" value="20"/>
<div id="testT"></div>
<script>var offset = <?php echo $offset?></script> -->

<?php
  $footerComponents = array(
							'js' => array(
										  "common/jquery-3.1.1.min.js", 
										  "common/header.js", 
										  "common/bootstrap.min.js"
										  )
						  );
  $this->load->view("common/footer", $footerComponents);
 ?>

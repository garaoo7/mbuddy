
<?php
  $headerComponents = array(
							'css' => array("common/bootstrap.min.css", "style.css")
							);
  $this->load->view("common/header2", $headerComponents);
  // $this->load->view("common/feedelement");
?>

<div class="row">
	<div class="col-md-3">
		<div class="card">
			<img src="css/images/cards.jpg" id="cardImg">
			<div class="container1">
				<h5><b><?php echo $listingData['142']['ListingTitle'];echo $listingData['142']['ListingTitle'];?></b></h5>
			</div>
			<div class="container2">
				<p><b>-<?php echo $listingData['142']['Username']; ?>-</b></p> 
				<p><?php echo $listingData['142']['ListingViews']; ?> views</p> 
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card">
			<img src="css/images/cards.jpg" id="cardImg">
			<div class="container1">
				<h5><b><?php echo $listingData['142']['ListingTitle'];echo $listingData['142']['ListingTitle'];?></b></h5>
			</div>
			<div class="container2">
				<p><?php echo $listingData['142']['ListingViews']; ?> views</p> 
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card">
			<img src="css/images/cards.jpg" id="cardImg">
			<div class="container1">
				<h5><b><?php echo $listingData['142']['ListingTitle'];echo $listingData['142']['ListingTitle'];?></b></h5>
			</div>
			<div class="container2">
				<p><?php echo $listingData['142']['ListingViews']; ?> views</p> 
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card">
			<img src="css/images/cards.jpg" id="cardImg">
			<div class="container1">
				<h5><b><?php echo $listingData['142']['ListingTitle'];echo $listingData['142']['ListingTitle'];?></b></h5>
			</div>
			<div class="container2">
				<p><?php echo $listingData['142']['ListingViews']; ?> views</p> 
			</div>
		</div>
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-3">
		<div class="card">
			<img src="css/images/cards.jpg" id="cardImg">
			<div class="container1">
				<h5><b><?php echo $listingData['142']['ListingTitle'];echo $listingData['142']['ListingTitle'];?></b></h5>
			</div>
			<div class="container2">
				<p><?php echo $listingData['142']['ListingViews']; ?> views</p> 
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card">
			<img src="css/images/cards.jpg" id="cardImg">
			<div class="container1">
				<h5><b><?php echo $listingData['142']['ListingTitle'];echo $listingData['142']['ListingTitle'];?></b></h5>
			</div>
			<div class="container2">
				<p><?php echo $listingData['142']['ListingViews']; ?> views</p> 
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card">
			<img src="css/images/cards.jpg" id="cardImg">
			<div class="container1">
				<h5><b><?php echo $listingData['142']['ListingTitle'];echo $listingData['142']['ListingTitle'];?></b></h5>
			</div>
			<div class="container2">
				<p><?php echo $listingData['142']['ListingViews']; ?> views</p> 
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card">
			<img src="css/images/cards.jpg" id="cardImg">
			<div class="container1">
				<h5><b><?php echo $listingData['142']['ListingTitle'];echo $listingData['142']['ListingTitle'];?></b></h5>
			</div>
			<div class="container2">
				<p><?php echo $listingData['142']['ListingViews']; ?> views</p> 
			</div>
		</div>
	</div>
</div>
<br>
<br>


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

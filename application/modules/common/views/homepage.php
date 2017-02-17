
<?php
  $headerComponents = array(
							'css' => array("common/bootstrap.min.css", "style.css")
							);
  $this->load->view("common/header2", $headerComponents);
  // $this->load->view("common/feedelement");
?>
<div class="row" id="homepage">
	<div class="col-md-2" id="homepageLeftMenu"></div>
	<div class="col-md-10 col-md-offset-2">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<div class="row">
					<div class="col-md-3">
						<div align="center">
							<div align="left" class="card">
								<a href="<?php 
											$listingTitle = $listingsData[130]->getListingTitle();
											$listingID = $listingsData[130]->getListingID();
											echo base_url("index.php/watch/$listingID");
										?>">
									<img src="css/images/cards.jpg" id="cardImg">
								</a>
								<div class="container1">
									<a href="<?php 
												echo base_url("index.php/watch/$listingID");
											?>">
										<h5><b><?php echo $listingTitle;?></b></h5>
									</a>
								</div>
								<div class="container2">
									<h6><?php 
											echo $listingsData[130]->getUserObject()->getUsername();
										?>
										<span class="glyphicon glyphicon-ok"></span></h6> 
									<h6><?php 
											echo $listingsData[130]->getListingViews();
										?> views</h6> 
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div align="center">
							<div align="left" class="card">
								<a href="<?php 
											$listingTitle = $listingsData[142]->getListingTitle();
											$listingID = $listingsData[142]->getListingID();
											echo base_url("index.php/watch/$listingID");
										?>">
									<img src="css/images/cards.jpg" id="cardImg">
								</a>
								<div class="container1">
									<a href="<?php 
												echo base_url("index.php/watch/$listingID");
											?>">
										<h5><b><?php echo $listingTitle;?></b></h5>
									</a>
								</div>
								<div class="container2">
									<h6><?php 
											echo $listingsData[142]->getUserObject()->getUsername();
										?>
										<span class="glyphicon glyphicon-ok"></span></h6> 
									<h6><?php 
											echo $listingsData[142]->getListingViews();
										?> views</h6> 
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div align="center">
							<div align="left" class="card">
								<a href="<?php 
											$listingTitle = $listingsData[130]->getListingTitle();
											$listingID = $listingsData[130]->getListingID();
											echo base_url("index.php/watch/$listingID");
										?>">
									<img src="css/images/cards.jpg" id="cardImg">
								</a>
								<div class="container1">
									<a href="<?php 
												echo base_url("index.php/watch/$listingID");
											?>">
										<h5><b><?php echo $listingTitle;?></b></h5>
									</a>
								</div>
								<div class="container2">
									<h6><?php 
											echo $listingsData[130]->getUserObject()->getUsername();
										?>
										<span class="glyphicon glyphicon-ok"></span></h6> 
									<h6><?php 
											echo $listingsData[130]->getListingViews();
										?> views</h6> 
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div align="center">
							<div align="left" class="card">
								<a href="<?php 
											$listingTitle = $listingsData[130]->getListingTitle();
											$listingID = $listingsData[130]->getListingID();
											echo base_url("index.php/watch/$listingID");
										?>">
									<img src="css/images/cards.jpg" id="cardImg">
								</a>
								<div class="container1">
									<a href="<?php 
												echo base_url("index.php/watch/$listingID");
											?>">
										<h5><b><?php echo $listingTitle;?></b></h5>
									</a>
								</div>
								<div class="container2">
									<h6><?php 
											echo $listingsData[130]->getUserObject()->getUsername();
										?>
										<span class="glyphicon glyphicon-ok"></span></h6> 
									<h6><?php 
											echo $listingsData[130]->getListingViews();
										?> views</h6> 
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<div align="center">
							<div align="left" class="card">
								<a href="<?php 
											$listingTitle = $listingsData[142]->getListingTitle();
											$listingID = $listingsData[142]->getListingID();
											echo base_url("index.php/watch/$listingID");
										?>">
									<img src="css/images/cards.jpg" id="cardImg">
								</a>
								<div class="container1">
									<a href="<?php 
												echo base_url("index.php/watch/$listingID");
											?>">
										<h5><b><?php echo $listingTitle;?></b></h5>
									</a>
								</div>
								<div class="container2">
									<h6><?php 
											echo $listingsData[142]->getUserObject()->getUsername();
										?>
										<span class="glyphicon glyphicon-ok"></span></h6> 
									<h6><?php 
											echo $listingsData[142]->getListingViews();
										?> views</h6> 
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div align="center">
							<div align="left" class="card">
								<a href="<?php 
											$listingTitle = $listingsData[130]->getListingTitle();
											$listingID = $listingsData[130]->getListingID();
											echo base_url("index.php/watch/$listingID");
										?>">
									<img src="css/images/cards.jpg" id="cardImg">
								</a>
								<div class="container1">
									<a href="<?php 
												echo base_url("index.php/watch/$listingID");
											?>">
										<h5><b><?php echo $listingTitle;?></b></h5>
									</a>
								</div>
								<div class="container2">
									<h6><?php 
											echo $listingsData[130]->getUserObject()->getUsername();
										?>
										<span class="glyphicon glyphicon-ok"></span></h6> 
									<h6><?php 
											echo $listingsData[130]->getListingViews();
										?> views</h6> 
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div align="center">
							<div align="left" class="card">
								<a href="<?php 
											$listingTitle = $listingsData[130]->getListingTitle();
											$listingID = $listingsData[130]->getListingID();
											echo base_url("index.php/watch/$listingID");
										?>">
									<img src="css/images/cards.jpg" id="cardImg">
								</a>
								<div class="container1">
									<a href="<?php 
												echo base_url("index.php/watch/$listingID");
											?>">
										<h5><b><?php echo $listingTitle;?></b></h5>
									</a>
								</div>
								<div class="container2">
									<h6><?php 
											echo $listingsData[130]->getUserObject()->getUsername();
										?>
										<span class="glyphicon glyphicon-ok"></span></h6> 
									<h6><?php 
											echo $listingsData[130]->getListingViews();
										?> views</h6> 
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div align="center">
							<div align="left" class="card">
								<a href="<?php 
											$listingTitle = $listingsData[130]->getListingTitle();
											$listingID = $listingsData[130]->getListingID();
											echo base_url("index.php/watch/$listingID");
										?>">
									<img src="css/images/cards.jpg" id="cardImg">
								</a>
								<div class="container1">
									<a href="<?php 
												echo base_url("index.php/watch/$listingID");
											?>">
										<h5><b><?php echo $listingTitle;?></b></h5>
									</a>
								</div>
								<div class="container2">
									<h6><?php 
											echo $listingsData[130]->getUserObject()->getUsername();
										?>
										<span class="glyphicon glyphicon-ok"></span></h6> 
									<h6><?php 
											echo $listingsData[130]->getListingViews();
										?> views</h6> 
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<div align="center">
							<div align="left" class="card">
								<a href="<?php 
											$listingTitle = $listingsData[130]->getListingTitle();
											$listingID = $listingsData[130]->getListingID();
											echo base_url("index.php/watch/$listingID");
										?>">
									<img src="css/images/cards.jpg" id="cardImg">
								</a>
								<div class="container1">
									<a href="<?php 
												echo base_url("index.php/watch/$listingID");
											?>">
										<h5><b><?php echo $listingTitle;?></b></h5>
									</a>
								</div>
								<div class="container2">
									<h6><?php 
											echo $listingsData[130]->getUserObject()->getUsername();
										?>
										<span class="glyphicon glyphicon-ok"></span></h6> 
									<h6><?php 
											echo $listingsData[130]->getListingViews();
										?> views</h6> 
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div align="center">
							<div align="left" class="card">
								<a href="<?php 
											$listingTitle = $listingsData[130]->getListingTitle();
											$listingID = $listingsData[130]->getListingID();
											echo base_url("index.php/watch/$listingID");
										?>">
									<img src="css/images/cards.jpg" id="cardImg">
								</a>
								<div class="container1">
									<a href="<?php 
												echo base_url("index.php/watch/$listingID");
											?>">
										<h5><b><?php echo $listingTitle;?></b></h5>
									</a>
								</div>
								<div class="container2">
									<h6><?php 
											echo $listingsData[130]->getUserObject()->getUsername();
										?>
										<span class="glyphicon glyphicon-ok"></span></h6> 
									<h6><?php 
											echo $listingsData[130]->getListingViews();
										?> views</h6> 
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div align="center">
							<div align="left" class="card">
								<a href="<?php 
											$listingTitle = $listingsData[130]->getListingTitle();
											$listingID = $listingsData[130]->getListingID();
											echo base_url("index.php/watch/$listingID");
										?>">
									<img src="css/images/cards.jpg" id="cardImg">
								</a>
								<div class="container1">
									<a href="<?php 
												echo base_url("index.php/watch/$listingID");
											?>">
										<h5><b><?php echo $listingTitle;?></b></h5>
									</a>
								</div>
								<div class="container2">
									<h6><?php 
											echo $listingsData[130]->getUserObject()->getUsername();
										?>
										<span class="glyphicon glyphicon-ok"></span></h6> 
									<h6><?php 
											echo $listingsData[130]->getListingViews();
										?> views</h6> 
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div align="center">
							<div align="left" class="card">
								<a href="<?php 
											$listingTitle = $listingsData[130]->getListingTitle();
											$listingID = $listingsData[130]->getListingID();
											echo base_url("index.php/watch/$listingID");
										?>">
									<img src="css/images/cards.jpg" id="cardImg">
								</a>
								<div class="container1">
									<a href="<?php 
												echo base_url("index.php/watch/$listingID");
											?>">
										<h5><b><?php echo $listingTitle;?></b></h5>
									</a>
								</div>
								<div class="container2">
									<h6><?php 
											echo $listingsData[130]->getUserObject()->getUsername();
										?>
										<span class="glyphicon glyphicon-ok"></span></h6> 
									<h6><?php 
											echo $listingsData[130]->getListingViews();
										?> views</h6> 
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<div align="center">
							<div align="left" class="card">
								<a href="<?php 
											$listingTitle = $listingsData[130]->getListingTitle();
											$listingID = $listingsData[130]->getListingID();
											echo base_url("index.php/watch/$listingID");
										?>">
									<img src="css/images/cards.jpg" id="cardImg">
								</a>
								<div class="container1">
									<a href="<?php 
												echo base_url("index.php/watch/$listingID");
											?>">
										<h5><b><?php echo $listingTitle;?></b></h5>
									</a>
								</div>
								<div class="container2">
									<h6><?php 
											echo $listingsData[130]->getUserObject()->getUsername();
										?>
										<span class="glyphicon glyphicon-ok"></span></h6> 
									<h6><?php 
											echo $listingsData[130]->getListingViews();
										?> views</h6> 
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div align="center">
							<div align="left" class="card">
								<a href="<?php 
											$listingTitle = $listingsData[130]->getListingTitle();
											$listingID = $listingsData[130]->getListingID();
											echo base_url("index.php/watch/$listingID");
										?>">
									<img src="css/images/cards.jpg" id="cardImg">
								</a>
								<div class="container1">
									<a href="<?php 
												echo base_url("index.php/watch/$listingID");
											?>">
										<h5><b><?php echo $listingTitle;?></b></h5>
									</a>
								</div>
								<div class="container2">
									<h6><?php 
											echo $listingsData[130]->getUserObject()->getUsername();
										?>
										<span class="glyphicon glyphicon-ok"></span></h6> 
									<h6><?php 
											echo $listingsData[130]->getListingViews();
										?> views</h6> 
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div align="center">
							<div align="left" class="card">
								<a href="<?php 
											$listingTitle = $listingsData[130]->getListingTitle();
											$listingID = $listingsData[130]->getListingID();
											echo base_url("index.php/watch/$listingID");
										?>">
									<img src="css/images/cards.jpg" id="cardImg">
								</a>
								<div class="container1">
									<a href="<?php 
												echo base_url("index.php/watch/$listingID");
											?>">
										<h5><b><?php echo $listingTitle;?></b></h5>
									</a>
								</div>
								<div class="container2">
									<h6><?php 
											echo $listingsData[130]->getUserObject()->getUsername();
										?>
										<span class="glyphicon glyphicon-ok"></span></h6> 
									<h6><?php 
											echo $listingsData[130]->getListingViews();
										?> views</h6> 
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div align="center">
							<div align="left" class="card">
								<a href="<?php 
											$listingTitle = $listingsData[130]->getListingTitle();
											$listingID = $listingsData[130]->getListingID();
											echo base_url("index.php/watch/$listingID");
										?>">
									<img src="css/images/cards.jpg" id="cardImg">
								</a>
								<div class="container1">
									<a href="<?php 
												echo base_url("index.php/watch/$listingID");
											?>">
										<h5><b><?php echo $listingTitle;?></b></h5>
									</a>
								</div>
								<div class="container2">
									<h6><?php 
											echo $listingsData[130]->getUserObject()->getUsername();
										?>
										<span class="glyphicon glyphicon-ok"></span></h6> 
									<h6><?php 
											echo $listingsData[130]->getListingViews();
										?> views</h6> 
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-1"></div>
		</div>
	</div>
</div>


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

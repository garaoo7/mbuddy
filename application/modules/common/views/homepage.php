
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
			<?php 	
			for ($i=4;$i>0;$i--){
				echo "<div class='row'>";
				for ($j=4;$j>0;$j--){ 
					echo "<div class='col-md-3'>
							<div align='center'>
								<div align='left' class='card'>
									<a href='";
					$listingID = $listingsData[142]->getListingID();
					echo base_url("index.php/watch/$listingID");
					echo "			'>
										<img src='css/images/cards.jpg' id='cardImg'>
									</a>
									<div class='container1'>
										<a href='";
					echo base_url("index.php/watch/$listingID");
					echo "				'>
											<h5><b>";
					echo $listingsData[142]->getListingTitle();
					echo "					</b></h5>
										</a>
									</div>
									<div class='container2'>
										<h6>";
					echo $listingsData[142]->getUserObject()->getUsername();
					echo "					<span class='glyphicon glyphicon-ok'></span></h6> 
										<h6>";
					echo $listingsData[142]->getListingViews();
					echo "				 views</h6> 
									</div>
								</div>
							</div>
						</div>";
				}
				echo "</div>";
			}
			?>
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

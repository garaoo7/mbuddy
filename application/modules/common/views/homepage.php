
<?php
  $headerComponents = array(
							'css' => array("common/bootstrap.min.css", "style.css")
							);
  $this->load->view("common/header", $headerComponents);
  // $this->load->view("common/feedelement");
?>
<div class="row" id="homepage">
	<div class="col-md-2" id="homepageLeftMenu"></div>
	<div class="col-md-10 col-md-offset-2">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10" id=mainContent>
			<?php 	
			// for ($i=4;$i>0;$i--){
			foreach($listingsData as $listingData){
				echo "<div class='row'>";
				for ($j=4;$j>0;$j--){ 
					echo "<div class='col-md-3'>
							<div align='center'>
								<div align='left' class='card'>
									<a href='";
					$listingID = $listingData->getListingID();
					echo $listingData->getListingUrl();
					echo "			'>
										<img src='".getYoutubeVideoThumbnailUrl($listingData->getListingSourceLink(), "small")."' id='cardImg'>
									</a>
									<div class='container1'>
										<a href='";
					echo $listingData->getListingUrl();
					echo "				'>
											<h5><b>";
					echo $listingData->getListingTitle();
					echo "					</b></h5>
										</a>
									</div>
									<div class='container2'>
										<h6>";
					echo $listingData->getUserObject()->getUsername();
					echo "					<span class='glyphicon glyphicon-ok'></span></h6> 
										<h6>";
					echo $listingData->getListingViews();
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
			<div align="center">
				<input type="hidden" id="resultParameters" value="3">
				<input type="button" id="load" value="Load More Results">
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

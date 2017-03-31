<?php 	
// for ($i=4;$i>0;$i--){
if(!empty($listingsData)){
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
}
?>
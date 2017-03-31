
<?php
  $headerComponents = array(
							'css' => array("common/bootstrap.min.css", "style.css")
							);
  $this->load->view("common/header", $headerComponents);
  // $this->load->view("common/feedelement");
?>
<div class="pageContentListing">
<br>
<div class="row">
	<div class="col-md-8">
		<div class="row">
			<div class="well well-sm col-md-12">
			<?php 
				$ListingSource = $listingData->getListingSourceLink();
				$ListingSource = preg_replace("(watch\?v\=)", "embed/", $ListingSource);
			 ?>
				<iframe width="850" height="480" src="<?php echo $ListingSource;?>" frameborder="0" allowfullscreen></iframe>
			</div>
		</div>
		<div class="row">
			<div class="well well-sm col-md-12">
				<div class="row">
					<div class="col-md-8">
						<h3><b><?php echo $listingData->getListingTitle();?></b></h3>
						<h5><b><?php echo $listingData->getUserObject()->getUsername();?></b></h5>
					</div>
					<div class="col-md-3 col-md-offset-1">
						<div align="right"><h4><?php echo $listingData->getListingViews();?> views</h4></div>
						<div align="right"><h4><span class="glyphicon glyphicon-thumbs-up"></span>&nbsp;<?php echo $listingData->getListingLikes();?></h4></div>
						<div align="right"><h4><span class="glyphicon glyphicon-thumbs-down"></span>&nbsp;<?php echo $listingData->getListingDislikes();?></h4></div>

					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="well col-md-12">
				<h4>Artist: </h4>
				<?php 
					foreach ($listingData->getArtistObject() as $value) {
						echo "<h5>".$value->getArtistName()."</h5>";
					}
				?>
			</div>
		</div>
	</div>
	<div class="well col-md-4">
		<h1>heya!!</h1>
		<?php    
			echo getYoutubeVideoId($listingData->getListingSourceLink());
		?>	
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
  <script>
	$('#leftMenubar').addClass("collapse");
</script>


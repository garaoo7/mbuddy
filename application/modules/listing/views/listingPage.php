
<?php
  $headerComponents = array(
							'css' => array("common/bootstrap.min.css", "style.css")
							);
  $this->load->view("common/header2", $headerComponents);
  // $this->load->view("common/feedelement");
?>
<div class="pageContentListing">
<div class="row">
	<div class="col-md-8">
		<div class="row">
			<div class="well col-md-12">
				<img src="<?php echo base_url('css/images/cards.jpg')?>" height='300px' width='500px'>
			</div>
		</div>
		<div class="row">
			<div class="well col-md-12">
				<h3><b><?php echo $listingData->getListingObject()->getListingTitle();?></b></h3>
				<h5><b><?php echo $listingData->getUserObject()->getUsername();?></b> (<?php echo $listingData->getUserObject()->getFirstname();?> <?php echo $listingData->getUserObject()->getLastname();?>)</h5>

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


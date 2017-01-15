</div>
</div>
</body>
<!-- //use base_url(); -->
<?php
	foreach ($js as $value) {
		echo "<script src=".base_url('/js/'.$value)."></script>";
	}
?>

</html>

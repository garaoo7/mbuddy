<!DOCTYPE html>
<html>
<head>
	<title>untitled</title>
</head>
<body>
<?php echo "WELCOME ".$_SESSION['username'];
	  echo "<br>"; 
	  echo "<br>"; 
	  echo "<br>"; 
?>
<a href="<?php echo base_url("index.php/userModule/home/logout") ?>"><button type="button">Logout</button></a>

</body>
<script src="<?php echo base_url("jquery/jquery-3.1.1.min.js");?>"></script>
<script src="<?php echo base_url("js/javascript.js");?>"></script>
</html>
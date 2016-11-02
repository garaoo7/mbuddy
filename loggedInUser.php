<!DOCTYPE html>
<html>
<head>
	<title>untitled</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url("js/javascript.js");?>"></script>
</head>
<body>
<?php echo "WELCOME ".$_SESSION['username'];
	  echo "<br>"; 
	  echo "<br>"; 
	  echo "<br>"; 

?>
<a href="<?php echo base_url("index.php/userModule/home/logout") ?>"><button type="button">Logout</button></a>

</body>
</html>
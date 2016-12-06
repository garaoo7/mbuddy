


<html>
    <title>My Page</title>
    <body>
    	<input type="text" id="birds">

    </body>






<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

<!--Jquery for Autocomplete -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script type="text/javascript">

jQuery(document).ready(function(){

$(function(){
  $("#birds").autocomplete({
    source: "Birds/get_birds" // path to the get_birds method
        });
    });
     });
</script>
</html>
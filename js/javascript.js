


<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script> -->
<!-- <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 --><!-- x-editable Jquery (bootstrap version) -->
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script> -->


<!--Jquery for Autocomplete -->
<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> -->

<!-- <link href="<?php echo base_url("jquery-ui/jquery-ui.css");?>" rel="stylesheet" type="text/css" /> -->
  <!-- <script src="<?php echo base_url("jquery/jquery-3.1.1.min.js");?>"> </script> -->
  <!-- <link href="<?php echo base_url("jquery-ui/jquery-ui.css");?>" rel="stylesheet" type="text/css" /> -->
  <!-- <script src="<?php echo base_url("jquery/jquery-3.1.1.min.js");?>"> </script> -->
  <!-- <script src="<?php echo base_url("js/javascript.js");?>"> </script> -->



<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script src="<?php echo base_url('js/index.js'); ?>"></script>





<script type ="text/javascript">

jQuery(document).ready(function(){
$(function(){
  $("#birds").autocomplete({
    source: "birds/get_birds" // path to the get_birds method
  });
    });
     });

</script>
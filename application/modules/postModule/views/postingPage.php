<!DOCTYPE html>
<html>
<head>
  <title>untitled</title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/style.css">
</head>
<body>
<form name=listingForm id=listingForm>	

  		<label>Title:</label>
  		<input type="text" name="title" id="title" value="s" placeholder="Title">
      <div id="titleError" hidden="true"></div>

		  <label>Description:</label>
  		<input type="text" name="description" id="description" value="s" placeholder="Description">
      <div id="descriptionError" hidden="true"></div>
  		
  		<label>Source Link:</label>
  		<input type="text" name="sourceLink" id="sourceLink" value="s" placeholder="Source Link">
      <img src id="sourceThumbnail">
      <div id="sourceLinkError" hidden="true"></div>

  		<label>Lyrics:</label>
  		<input type="text" name="lyrics" id="lyrics" value="s" placeholder="Lyrics">
      <div id="lyricsError" hidden="true"></div>

      <label>Language:</label>
      <input type="text" name="language" id="language" value="s" placeholder="Language">
      <div id="languageError" hidden="true"></div>

      <label>Category/Section:</label>
      <input type="text" name="section" id="section" value="s" placeholder="Category/Section">
      <div id="sectionError" hidden="true"></div>

      <label>Artist:</label>
      <input type="text" name="artist" id="artist" value="s" placeholder="Artist">
      <div id="artistError" hidden="true"></div>

      <label>Singer:</label>
      <input type="text" name="singer" id="singer" value="s" placeholder="Singer">
      <div id="singerError" hidden="true"></div>

      <label>Composer:</label>
      <input type="text" name="composer" id="composer" value="s" placeholder="Composer">
      <div id="composerError" hidden="true"></div>
<!-- writer should be lyricist-->
      <label>Writer:</label>
      <input type="text" name="writer" id="writer" value="s" placeholder="Writer">
      <div id="writerError" hidden="true"></div>

      <label>Producer:</label>
      <input type="text" name="producer" id="producer" value="s" placeholder="Producer">
      <div id="producerError" hidden="true"></div>

      <button id=listingFormSubmit name="submit" type="button">Submit</button>


</form>

<a href="<?php echo base_url("index.php/Common/home/index") ?>"><button type="button">Home</button></a>

</body>
<script src="<?php echo base_url("jquery/jquery-3.1.1.min.js");?>"></script>
<script src="<?php echo base_url("js/javascript.js");?>"></script>
<!--Jquery for Autocomplete -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</html>

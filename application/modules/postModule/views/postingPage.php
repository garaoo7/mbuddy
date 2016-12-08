
<form name=listingForm id=listingForm>	

  		<label>Title:</label>
  		<input type="text" name="title" placeholder="Title">
      <div id="titleError" hidden="true"></div>

		  <label>Description:</label>
  		<input type="text" name="description" placeholder="Description">
      <div id="descriptionError" hidden="true"></div>
  		
  		<label>Source Link:</label>
  		<input type="password" name="sourceLink" placeholder="Source Link">
      <div id="sourceLinkError" hidden="true"></div>

  		<label>Lyrics:</label>
  		<input type="password" name="lyrics" placeholder="Lyrics">
      <div id="lyricsError" hidden="true"></div>

      <label>Language:</label>
      <input type="password" name="language" placeholder="Language">
      <div id="languageError" hidden="true"></div>

      <label>Artist/Singer:</label>
      <input type="password" name="artist" placeholder="Artist/Singer">
      <div id="artistError" hidden="true"></div>

      <label>Composer:</label>
      <input type="password" name="composer" placeholder="Composer">
      <div id="composerError" hidden="true"></div>
<!-- writer should be lyricist-->
      <label>Writer:</label>
      <input type="password" name="writer" placeholder="Writer">
      <div id="writerError" hidden="true"></div>

      <label>Producer:</label>
      <input type="password" name="producer" placeholder="Producer">
      <div id="producerError" hidden="true"></div>

      <button id=listingFormSubmit name="submit" type="button">Submit</button>


</form>

<a href="<?php echo base_url("index.php/Common/home/index") ?>"><button type="button">Home</button></a>


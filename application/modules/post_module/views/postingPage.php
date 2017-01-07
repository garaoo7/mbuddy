<?php
  $linkData = array(
            'css' => array("http://localhost/mbuddy/css/bootstrap.min.css", "http://localhost/mbuddy/css/style.css", "http://localhost/mbuddy/css/simply-tag.css")
            );
  $this->load->view("common/header", $linkData);
 ?>

  <div class="row">
        <div class="col-xs-8 col-sm-6 col-md-6 col-xs-offset-2 col-sm-offset-3 col-md-offset-3">
          <h2>Submit Your Post Here</h2>
        </div>
  </div>

  <form name=listingForm id=listingForm>
    <div class="form-group">
      <div class="row">
        <div class="col-xs-8 col-sm-6 col-md-6 col-xs-offset-2 col-sm-offset-3 col-md-offset-3">
          <label>Title:</label>
          <input type="text" class="form-control" name="title" id="title" value="s" placeholder="Title"> 
          <div id="titleError" hidden="true"></div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="row">
        <div class="col-xs-8 col-sm-6 col-md-6 col-xs-offset-2 col-sm-offset-3 col-md-offset-3">
  		    <label>Description:</label>
    		  <input type="text" class="form-control" name="description" id="description" value="s" placeholder="Description">
          <div id="descriptionError" hidden="true"></div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="row">
        <div class="col-xs-8 col-sm-6 col-md-6 col-xs-offset-2 col-sm-offset-3 col-md-offset-3">
    		  <label>Source Link:</label>
    		  <input type="text" class="form-control" name="sourceLink" id="sourceLink" value="https://www.youtube.com/watch?v=JbjzPKTfjlc" placeholder="Source Link">
          <img src id="sourceThumbnail">
          <div id="sourceLinkError" hidden="true"></div>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1">
          <button id="verifySourceUrl" class="btn btn-default" name="verify" type="button">Verify</button>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="row">
        <div class="col-xs-8 col-sm-6 col-md-6 col-xs-offset-2 col-sm-offset-3 col-md-offset-3">
    		  <label>Lyrics:</label>
    		  <input type="text" class="form-control" name="lyrics" id="lyrics" value="s" placeholder="Lyrics">
          <div id="lyricsError" hidden="true"></div>
        </div>
      </div>   
      </div>

    <div class="form-group">
        <div class="row">
            <div class="col-xs-8 col-sm-6 col-md-6 col-xs-offset-2 col-sm-offset-3 col-md-offset-3">
                <label>Language:</label>
                <div id="language"></div>
                <div id="languageError" hidden="true"></div>
            </div>
        </div>   
    </div>

    <div class="form-group">
      <div class="row">
        <div class="col-xs-8 col-sm-6 col-md-6 col-xs-offset-2 col-sm-offset-3 col-md-offset-3">
          <label>Category/Section:</label>
          <div id="section"></div>
          <div id="sectionError" hidden="true"></div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="row">
        <div class="col-xs-8 col-sm-6 col-md-6 col-xs-offset-2 col-sm-offset-3 col-md-offset-3">
          <label>Artist:</label>
          <div id="artist"></div>
          <div id="artistError" hidden="true"></div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="row">
        <div class="col-xs-8 col-sm-6 col-md-6 col-xs-offset-2 col-sm-offset-3 col-md-offset-3">
          <label>Singer:</label>
          <div id="singer"></div>
          <div id="singerError" hidden="true"></div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="row">
        <div class="col-xs-8 col-sm-6 col-md-6 col-xs-offset-2 col-sm-offset-3 col-md-offset-3">
          <label>Composer:</label>
          <div id="composer"></div>
          <div id="composerError" hidden="true"></div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="row">
        <div class="col-xs-8 col-sm-6 col-md-6 col-xs-offset-2 col-sm-offset-3 col-md-offset-3">
          <label>Writer:</label>  <!-- writer should be lyricist-->
          <div id="writer"></div>
          <div id="writerError" hidden="true"></div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="row">
        <div class="col-xs-8 col-sm-6 col-md-6 col-xs-offset-2 col-sm-offset-3 col-md-offset-3">
          <label>Producer:</label>
          <div id="producer"></div>
          <div id="producerError" hidden="true"></div>
        </div>
      </div>     
    </div>

    <div align="center">
      <button id="listingFormSubmit" class="btn btn-default" name="submit" type="button">Submit</button>
      <a href="<?php echo base_url("index.php/home_module/home/index") ?>" id="test3"><button type="button" class="btn btn-default">Home</button></a>
    </div>
  </form>

<?php
  $scriptData = array(
            'js' => array("http://localhost/mbuddy/jquery/jquery-3.1.1.min.js", "http://localhost/mbuddy/js/javascript.js", "http://localhost/mbuddy/js/post/post-javascript.js", "http://localhost/mbuddy/js/bootstrap.min.js", "http://localhost/mbuddy/js/simply-tag.js")
            );
  $this->load->view("footer", $scriptData);
 ?>
</div>


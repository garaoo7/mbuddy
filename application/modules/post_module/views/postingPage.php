<?php
  $headerComponents = array(
                        'css' => array("common/bootstrap.min.css", "style.css", "common/simply-tag.css")
                      );
  $this->load->view("common/header", $headerComponents);
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
          <div id="sourceError" hidden="true"></div>
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
                <div id="language" class="autoComplete"></div>
                <div id="languageError" hidden="true"></div>
            </div>
        </div>   
    </div>

    <div class="form-group">
      <div class="row">
        <div class="col-xs-8 col-sm-6 col-md-6 col-xs-offset-2 col-sm-offset-3 col-md-offset-3">
          <label>Category/Section:</label>
          <div id="section" class="autoComplete"></div>
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
          <label>Instrument:</label>
          <div id="instrument"></div>
          <div id="instrumentError" hidden="true"></div>
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

    <div class="form-group">
      <div class="row">
        <div class="col-xs-8 col-sm-6 col-md-6 col-xs-offset-2 col-sm-offset-3 col-md-offset-3">
          <label>Tag:</label>
          <div id="tag"></div>
          <div id="tagError" hidden="true"></div>
        </div>
      </div>
    </div>

    <div align="center">
      <button id="listingFormSubmit" class="btn btn-default" name="submit" type="button">Submit</button>
      <a href="<?php echo base_url() ?>" id="test3"><button type="button" class="btn btn-default">Home</button></a>
    </div>
  </form>

<?php
  $footerComponents = array(
                        'js' => array(
                                  "common/jquery-3.1.1.min.js", 
                                  "common/header.js", 
                                  "post/post.js", 
                                  "common/bootstrap.min.js", 
                                  "common/simply-tag.js"
                                )
                      );
  $this->load->view("footer", $footerComponents);
 ?>
</div>


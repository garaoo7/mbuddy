<div class="container-fluid">
  <?php
    $this->load->view("header");
   ?>

  <div class="row">
        <div class="col-xs-8 col-sm-6 col-md-6 col-xs-offset-2 col-sm-offset-3 col-md-offset-3">
          <h2>Submit Your Post Here</h2>
        </div>
      </div>
  </div>

<!-- testing below for tag it jquery plugin -->

<!--   <div id='test'></div>
  <input type="text" id="testTags"> -->
<!-- test finished -->

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
    		  <input type="text" class="form-control" name="sourceLink" id="sourceLink" value="s" placeholder="Source Link">
          <img src id="sourceThumbnail">
          <div id="sourceLinkError" hidden="true"></div>
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
          <input type="text" class="form-control" name="language" id="language" value="s" placeholder="Language">
          <div id="languageError" hidden="true"></div>
        </div>
      </div>   
    </div>

    <div class="form-group">
      <div class="row">
        <div class="col-xs-8 col-sm-6 col-md-6 col-xs-offset-2 col-sm-offset-3 col-md-offset-3">
          <label>Category/Section:</label>
          <input type="text" class="form-control" name="section" id="section" value="s" placeholder="Category/Section">
          <div id="sectionError" hidden="true"></div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="row">
        <div class="col-xs-8 col-sm-6 col-md-6 col-xs-offset-2 col-sm-offset-3 col-md-offset-3">
          <label>Artist:</label>
          <input type="text" class="form-control" name="artist" id="artist" value="a" placeholder="Artist">
          <div id="artistError" hidden="true"></div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="row">
        <div class="col-xs-8 col-sm-6 col-md-6 col-xs-offset-2 col-sm-offset-3 col-md-offset-3">
          <label>Singer:</label>
          <input type="text" class="form-control" name="singer" id="singer" value="s" placeholder="Singer">
          <div id="singerError" hidden="true"></div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="row">
        <div class="col-xs-8 col-sm-6 col-md-6 col-xs-offset-2 col-sm-offset-3 col-md-offset-3">
          <label>Composer:</label>
          <input type="text" class="form-control" name="composer" id="composer" value="s" placeholder="Composer">
          <div id="composerError" hidden="true"></div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="row">
        <div class="col-xs-8 col-sm-6 col-md-6 col-xs-offset-2 col-sm-offset-3 col-md-offset-3">
          <label>Writer:</label>  <!-- writer should be lyricist-->
          <input type="text" class="form-control" name="writer" id="writer" value="s" placeholder="Writer">
          <div id="writerError" hidden="true"></div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="row">
        <div class="col-xs-8 col-sm-6 col-md-6 col-xs-offset-2 col-sm-offset-3 col-md-offset-3">
          <label>Producer:</label>
          <input type="text" class="form-control" name="producer" id="producer" value="s" placeholder="Producer">
          <div id="producerError" hidden="true"></div>
        </div>
      </div>     
    </div>

    <div align="center">
      <button id="listingFormSubmit" class="btn btn-default" name="submit" type="button">Submit</button>
      <a href="<?php echo base_url("index.php/common/home/index") ?>"><button type="button" class="btn btn-default">Home</button></a>
    </div>
  </form>

  <?php
    $this->load->view("footer");
   ?>
</div>
<script>
  // $('#title').simplyTag({                    
  //   dataSource: JSON.parse('[{ "key": 1, "value": "Value1" }, { "key": 2, "value": "value2" }, { "key": 3, "value": "value3" }]')
  // });
</script>


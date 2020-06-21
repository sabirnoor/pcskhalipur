<form id="paymentForm" method="post" action="target.php">
  <div class="form-group">
    <div class="row gutter">
      <div class="col-md-4">
        <label class="control-label">Coach Name</label>
        <input type="text" placeholder="Coach Name" class="form-control" name="director">
      </div>
      <div class="col-md-4">
        <label class="control-label">Bus Type</label>
        <select class="form-control" name="country">
          <option value="">--Select--</option>
          <option value="fr">France</option>
          <option value="de">Germany</option>
          <option value="it">Italy</option>
          <option value="jp">Japan</option>
          <option value="ru">Russia</option>
          <option value="gb">United Kingdom</option>
          <option value="us">United State</option>
        </select>
      </div>
      <div class="col-md-4">
        <label class="control-label">Vehicle Company</label>
        <select class="form-control" name="country">
          <option value="">--Select--</option>
          <option value="fr">France</option>
          <option value="de">Germany</option>
          <option value="it">Italy</option>
          <option value="jp">Japan</option>
          <option value="ru">Russia</option>
          <option value="gb">United Kingdom</option>
          <option value="us">United State</option>
        </select>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="row gutter">
      <div class="col-md-4">
        <label class="control-label">Layout type</label>
        <select class="form-control" name="country">
          <option value="">--Select--</option>
          <option value="2+1">2+1</option>
          <option value="1+2">1+2</option>
          <option value="2+2">2+2</option>
          <option value="2+3">2+3</option>
          <option value="1+1">1+1</option>
          <option value="1+1+1">1+1+1</option>
        </select>
      </div>
      <div class="col-md-4">
        <label class="control-label">Is ac</label>
        <select class="form-control" name="country">
          <option value="">--Select--</option>
          <option value="AC">AC</option>
          <option value="Non-AC">Non-AC</option>
        </select>
      </div>
      <div class="col-md-4">
        <label class="control-label">Coach Feature</label>
        <select class="form-control" name="country">
          <option value="">--Select--</option>
          <option value="Video">Video</option>
          <option value="Non-Video">Non-Video</option>
          <option value="LCD">LCD</option>
          <option value="LED">LED</option>
          <option value="Individual LCD">Individual LCD</option>
          <option value="Individual LED">Individual LED</option>
          <option value="Cabin LCD">Cabin LCD</option>
          <option value="Cabin LED">Cabin LED</option>
          <option value="Cabin VIDEO">Cabin VIDEO</option>
        </select>
      </div>
    </div>
  </div>
  <div class="form-group no-margin">
    <div class="row gutter">
      <div class="col-lg-offset-6 pull-right">
        <button type="submit" class="btn btn-success">Save & Next</button>
      </div>
    </div>
  </div>
</form>

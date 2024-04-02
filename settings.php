<?php include 'navigation.php';
?>
<!DOCTYPE html>
<html>
<head>
<style type="text/css">
	.form-wrapper {
    margin-top: 50px; /* Adjust the margin to create space */
  }
	.form-horizontal{
    width: 50%;
    margin: 0 auto;	
	}
	.btn-custom{
    margin-top: 20px;
	}
	.black-text{
		color: black;
	}
	.form-control{
		width:150%;
	}
</style>	
<title>Settings</title>
</head>
<body>

</body>
</html>
<div class="form-wrapper">
<form class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>Settings</legend>

<!-- Multiple Radios -->
<div class="form-group">
  <label class="col-md-4 control-label black-text" for="radios">Images</label>
  <div class="col-md-4">
  <div class="radio">
    <label for="radios-0">
      <input name="radios_images" id="radios-0" value="1" checked="checked" type="radio">
      Yes
    </label>
	</div>
  <div class="radio">
    <label for="radios-1">
      <input name="radios_images" id="radios-1" value="2" type="radio">
      No
    </label>
	</div>
  </div>
</div>

<!-- Multiple Radios -->
<div class="form-group">
  <label class="col-md-4 control-label black-text" for="radios">Language</label>
  <div class="col-md-4">
  <div class="radio black=text">
    <label for="radios-0">
      <input name="radios_language" id="radios-0" value="1" checked="checked" type="radio">
      Telegu
    </label>
	</div>
  <div class="radio">
    <label for="radios-1">
      <input name="radios_language" id="radios-1" value="2" type="radio">
      English
    </label>
	</div>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label black-text" for="textinput">Image-Width</label>  
  <div class="col-md-4">
  <input id="textinput" name="textinput" placeholder="201px" class="form-control input-md" type="text">
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label black-text" for="textinput">Image-Height</label>  
  <div class="col-md-4">
  <input id="textinput" name="textinput" placeholder="273px" class="form-control input-md" type="text">
  </div>
</div>

<!-- Multiple Radios (inline) -->
<div class="form-group">
  <label class="col-md-4 control-label black-text" for="radios">Number Of Images</label>
  <div class="col-md-4"> 
    <label class="radio-inline" for="radios-0">
      <input name="radios" id="radios-0" value="1" checked="checked" type="radio">
      1
    </label> 
    <label class="radio-inline" for="radios-1">
      <input name="radios" id="radios-1" value="2" type="radio">
      2
    </label> 
    <label class="radio-inline" for="radios-2">
      <input name="radios" id="radios-2" value="3" type="radio">
      3
    </label> 
    <label class="radio-inline" for="radios-3">
      <input name="radios" id="radios-3" value="4" type="radio">
      4
    </label>
    <label class="radio-inline" for="radios-3">
      <input name="radios" id="radios-3" value="5" type="radio"checked="checked">
      5
    </label>
    <label class="radio-inline" for="radios-3">
      <input name="radios" id="radios-3" value="6" type="radio">
      6
    </label>
    <label class="radio-inline" for="radios-3">
      <input name="radios" id="radios-3" value="7" type="radio">
      7
    </label>
    <label class="radio-inline" for="radios-3">
      <input name="radios" id="radios-3" value="8" type="radio">
      8
    </label>
    <label class="radio-inline" for="radios-3">
      <input name="radios" id="radios-3" value="9" type="radio">
      9
    </label>

  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="Button"></label>
  <div class="col-md-4">
    <button id="Button" name="Button" class="btn btn-success" action="index.php" formmethod="get">Submit!</button>
  </div>
</div>

</fieldset>
</form>
<footer>
  <?php include 'footer.php'; ?>
</footer>
</div>


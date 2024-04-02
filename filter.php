<?php
include 'navigation.php';

// Check if the keys exist in the $_GET array before accessing them
$lang_type = isset($_GET['lang_type']) ? $_GET['lang_type'] : '';
$lang_filter_type = isset($_GET['lang_filter_type']) ? $_GET['lang_filter_type'] : '';
$dance_type = isset($_GET['dance_type']) ? $_GET['dance_type'] : '';
$dance_filter_type = isset($_GET['dance_filter_type']) ? $_GET['dance_filter_type'] : '';

if ($lang_type != '' && $lang_filter_type != '' && $dance_type != '' && $dance_filter_type != '') {
    // Redirect form on a particular page
    header("Location:index.php");
    exit(); // Use exit instead of die for graceful exit
} else {
    // Handle the case where some or all parameters are empty
    //echo('<script>alert("is empty for all");</script>');
}
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
</head>

<body>
  <div class="form-wrapper">
  <form class="form-horizontal">
  <fieldset>

  <!-- Form Name -->
  <legend>Filter</legend>

  <!-- Select Basic -->
  <div class="form-group">
    <label class="col-md-4 control-label black-text" for="selectbasic">Filter By Language</label>
    <div class="col-md-4">
      <select id="selectbasic" name="lang_type" class="form-control">
        <option value="1">Telegu</option>
        <option value="2">English</option>
        <option value="3">Hindi</option>
        <option value="4">Bengali</option>
        <option value="5">Other</option>
        <option value="6">Malanyam</option>
      </select>
      <select id="filter_option_for_languages" name="lang_filter_type" class="form-control">
        <option value="1">Include</option>
        <option value="2">Exclude</option>
      </select>
    </div>
  </div>

  <!-- Select Basic -->
  <div class="form-group">
    <label class="col-md-4 control-label black-text" for="selectbasic">Filter By Type</label>
    <div class="col-md-4">
      <select id="selectbasic" name="dance_type" class="form-control">
        <option value="1">Classical</option>
        <option value="2">Traditional</option>
        <option value="3">Folk</option>
        <option value="4">Other</option>
      </select>
      <select id="filter_option_for_dances" name="dance_filter_type" class="form-control">
        <option value="1">Include</option>
        <option value="2">Exclude</option>
      </select>
    </div>
  </div>

  <!-- Button -->
  <div class="form-group">
    <label class="col-md-4 control-label" for="Button"></label>
    <div class="col-md-4">
      <button id="Button" name="Button" class="btn btn-success" type="submit" name='submit' formmethod="get">Submit!</button>
    </div>
  </div>

  </fieldset>
  </form>
  </div>
  <footer>
    <?php include 'footer.php'; ?>
  </footer>
</body>

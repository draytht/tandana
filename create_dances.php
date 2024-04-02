<?php include 'navigation.php';

// Start session to store variables
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
// Allows user to return 'back' to this page
ini_set('session.cache_limiter','public');
session_cache_limiter(false);

 ?>
<!DOCTYPE html>
<html>
<!-- <head><script>
$("a").hover(function(){
    $(this).css("background-color", "green");
    }, function(){
    $(this).css("background-color", "#green");
});
</script> -->
<style>
        textarea {
            height: 400px;
            width: 600px;
        }
        div.submit_wrapper {
            background-color: #f7dc83; 
            color: white; 
            padding: 20px;
            border-radius: 10px; 
        }
        label {
            color: #000; 
            margin-bottom: 5px; 
        }
    </style>
</head>
<body>

<div class="container submit_wrapper top_space" style="float: left; width:45%;">
  <h3 class="headline" style="color: #000" >Add a Performing Art</h3>
  <?php
  require_once('db_configuration.php');

// Establishing Connection with Server
$servername = DATABASE_HOST;
$db_username = DATABASE_USER;
$db_password = DATABASE_PASSWORD;
$database = DATABASE_DATABASE;

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully<br>";
$conn->set_charset("utf8");

// define variables and set to empty values
	$dance_english_name_error = $dance_category_error = $dance_image_reference_error = $dance_video_reference_error = $dance_status_error = 
	$artist_images_error = $links_error = "";
	$dance_english_name = $dance_alternate_name = $dance_telugu_name = $dance_category = $dance_origin = $dance_description
	= $dance_image_reference = $dance_video_reference = $dance_key_words = $dance_status = $artist_images = $links = "";	


$_SESSION['confirmation_english_name'] = $_SESSION['confirmation_alternate_name'] = $_SESSION['confirmation_telugu_name'] =
$_SESSION['confirmation_category'] = $_SESSION['confirmation_origin'] = $_SESSION['confirmation_description'] = 
$_SESSION['confirmation_image_reference'] = $_SESSION['confirmation_video_reference'] = $_SESSION['confirmation_key_words'] = $_SESSION['confirmation_status'] = $_SESSION['confirmation_artist_images'] = $_SESSION['confirmation_links'] ="";


if ($_SERVER["REQUEST_METHOD"] == "POST"){
	
	if (empty($_POST["dance_english_name"])){
		$dance_english_name_error = "is required.";
	}
	else{
		$dance_english_name = test_input($_POST["dance_english_name"]);
	}

	if (empty($_POST["dance_alternate_name"])){
		$dance_alternate_name = "";
	}
	else{
		$dance_alternate_name = test_input($_POST["dance_alternate_name"]);
	}

	if (empty($_POST["dance_telugu_name"])){
		$dance_telugu_name = "";
	}
	else{
		$dance_telugu_name = test_input($_POST["dance_telugu_name"]);
	}
	
	if ($_POST["dance_category"] === ""){
		$dance_category_error = "is required.";
	}
	else{
		$dance_category = test_input($_POST["dance_category"]);
	}

	if (empty($_POST["dance_origin"])){
		$dance_origin = "";
	}
	else{
		$dance_origin = test_input($_POST["dance_origin"]);
	}

	if (empty($_POST["dance_description"])){
		$dance_description = "";
	}
	else{
		$dance_description = mysqli_real_escape_string($conn, test_input($_POST["dance_description"]));
	}

	if (empty($_POST["dance_image_reference"])){
		$dance_image_reference = "";
	}
	else{
		$dance_image_reference = test_input($_POST["dance_image_reference"]);
		 // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$dance_image_reference)) {
      $dance_image_reference_error = "Invalid URL"; 
  		}
	}

	if (empty($_POST["dance_video_reference"])){
		$dance_video_reference = "";
	}
	else{
		$dance_video_reference = test_input($_POST["dance_video_reference"]);
		 // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$dance_video_reference)) {
      $dance_video_reference_error = "Invalid URL"; 
  		}
	}

	if (empty($_POST["dance_key_words"])){
		$dance_key_words = "";
	}
	else{
		$dance_key_words = test_input($_POST["dance_key_words"]);
	}

	if ($_POST["dance_status"] === ""){
		$dance_status_error = "is required.";
	}
	else{
		$dance_status = test_input($_POST["dance_status"]);
	}

	// Upload images
	if(empty($_FILES['file']['name'][0])){
		$artist_images_error = "";
	}
	else{
	if (isset($_POST['submit'])) {
	$j = 0;     // Variable for indexing uploaded image.
	$target_path = "assets/artist_images/";     // Declaring Path for uploaded images.
	$artist_path = "assets/artist_images/";
	for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
	// Loop to get individual element from the array
	$validextensions = array("jpeg", "JPEG", "jpg", "JPG", "png", "PNG", "gif", "GIF", "tiff", "TIFF", "svg", "SVG");      // Extensions which are allowed.
	$ext = explode('.', basename($_FILES['file']['name'][$i]));   // Explode file name from dot(.)
	$file_extension = end($ext); // Store extensions in the variable.
	$target_path = "assets/artist_images/" . basename($_FILES['file']['name'][$i]);     // Set the target path with a new name of image.
	if(count($_FILES['file']['name']) > 1 ){
		if ($i == 0){
			$artist_path = "assets/artist_images/" . basename($_FILES['file']['name'][$i]) . ", "; 
		}
		else if($i > 0 && $i < count($_FILES['file']['name']) - 1){
			$artist_path = $artist_path  . "assets/artist_images/" . basename($_FILES['file']['name'][$i]) . ", "; 
		}
		else {
			$artist_path = $artist_path  . "assets/artist_images/" . basename($_FILES['file']['name'][$i]);
		}
	}
	else{
			$artist_path = "assets/artist_images/" . basename($_FILES['file']['name'][$i]); 
	}
	
	$j = $j + 1;      // Increment the number of uploaded images according to the files in array.
	if (($_FILES["file"]["size"][$i] < 24000000)     // Approx. 24mb files can be uploaded.
	&& in_array($file_extension, $validextensions)) {
	if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path)) {
	// If file moved to uploads folder.
	echo $j. ').<span id="noerror">Image uploaded successfully!.</span><br/><br/>';
	$artist_images = $artist_path;
	} 

	else {     //  If File Was Not Moved.
	echo $j. ').<span id="error">Error uploading image! Please try again!.</span><br/><br/>';
	$artist_images_error = "Error uploading image! Please try again!";
	}
	}

	else {     //   If File Size And File Type Was Incorrect.
	echo $j. ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';
	$artist_images_error = "Invalid file size or type!";
	}
	}
	}
	}
	

	if (empty($_POST["links"])){
		$links = "";
	}
	else{
		$links = test_input($_POST["links"]);
		 // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$links)) {
      $links_error = "Invalid URL"; 
  		}
	}

// If no errors, go to confirmation page
	if($dance_english_name_error === "" && $dance_category_error === "" && $dance_image_reference_error === "" && $dance_video_reference_error === "" && $artist_images_error === "" && $links_error === ""){


				//Store sessions
		$_SESSION['confirmation_english_name'] = $dance_english_name;
		$_SESSION['confirmation_alternate_name'] = $dance_alternate_name;
		$_SESSION['confirmation_telugu_name'] = $dance_telugu_name;
		$_SESSION['confirmation_category'] = $dance_category;
		$_SESSION['confirmation_origin'] = $dance_origin;
		$_SESSION['confirmation_description'] = $dance_description;
		$_SESSION['confirmation_image_reference'] = $dance_image_reference;
		$_SESSION['confirmation_video_reference'] = $dance_video_reference;
		$_SESSION['confirmation_key_words'] = $dance_key_words;
		$_SESSION['confirmation_status'] = $dance_status;
		$_SESSION['confirmation_artist_images'] = $artist_images;
		$_SESSION['confirmation_links'] = $links;



	// Run Query
		if(isset($_POST['submit'])){
	$sql = "INSERT INTO dances (dance_english_name, dance_alternate_name, dance_telugu_name, dance_category, dance_origin, dance_description, dance_image_reference, dance_video_reference, dance_key_words, dance_status, artist_images, links)
	VALUES ('$dance_english_name', '$dance_alternate_name', '$dance_telugu_name', '$dance_category', '$dance_origin', '$dance_description', '$dance_image_reference', '$dance_video_reference', '$dance_key_words', '$dance_status', '$artist_images', '$links')";



//Close Connection
			if ($conn->query($sql) === TRUE) {
		    echo "New record created successfully.";
			}
			else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
			}

			header('Location: view.php');
		}

			}

		}

function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

// if(!isset($_POST['dance_category'])) 
// {
// $errorMessage .= "<li>You forgot to select a dance category!</li>";
// }

?>

<span class="error">* required field.</span>
<form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<table width=50% class="suggest_dance_table">
<!-- Dance Name in English Input -->
<tr>
<td>
<label>Name (English): </label>
</td>
</tr>
<tr>
<td>
<input type="text" name="dance_english_name" value="<?php echo $dance_english_name;?>">
<span class="error">* <?php echo $dance_english_name_error;?></span>
</td>
</tr>

<!-- Dance Name in Telugu Input -->
<tr>
<td>
<label>Name (Telugu): </label>
</td>
</tr>
<tr>
<td>
<input type="text" name="dance_telugu_name" value="<?php echo $dance_telugu_name;?>">
</td>
</tr>

<!-- Alternate Dance Name Input -->
<tr>
<td>
<label>Other Names: </label>
</td>
</tr>
<tr>
<td>
<input type="text" name="dance_alternate_name" value="<?php echo $dance_alternate_name;?>">
</td>
</tr>



<!-- Dance Category Input -->
<tr>
<td>
<label>Category: </label>
</td>
</tr>
<tr>
<td>
<select name="dance_category">
				<option <?php if (isset($dance_category) && $dance_category=="Folk") echo "selected";?>>Folk</option>
				<option <?php if (isset($dance_category) && $dance_category=="Classical") echo "selected";?>>Classical</option>
				<option <?php if (isset($dance_category) && $dance_category=="Traditional") echo "selected";?>>Traditional</option>
				<option <?php if (isset($dance_category) && $dance_category=="Other") echo "selected";?>>Other</option>
				</select>
<span class="error">* <?php echo $dance_category_error;?></span>
</td>
</tr>

<!-- Dance Origin Input -->
<tr>
<td>
<label>Origin: </label>
</td>
</tr>
<tr>
<td>
<input type="text" name="dance_origin" value="<?php echo $dance_origin;?>">
</td>
</tr>

<!-- Dance Description Input -->
<tr>
<td>
<label>Description: </label>
</td>
</tr>
<tr>
<td>
<textarea name="dance_description" rows="5" cols="40" placeholder="Enter description..." maxlength="5000"><?php echo $dance_description;?></textarea>
</td>
</tr>

<!-- Dance Image Reference Input -->
<tr>
<td>
<label>Images: </label>
</td>
<tr>
<td>
<textarea name="dance_image_reference" rows="5" cols="40" placeholder="www.image.com/image1, www.image.com/image2, www.image.com/image3, etc..." maxlength="5000"><?php echo $dance_image_reference;?></textarea>
<span class="error"><?php echo $dance_image_reference_error;?></span>
</td>
</tr>

<!-- Dance Video Reference Input -->
<tr>
<td>
<label>Videos: </label>
</td>
</tr>
<tr>
<td>
<textarea name="dance_video_reference" rows="5" cols="40" placeholder="www.youtube.com/video1, www.youtube.com/video2, www.youtube.com/video3, etc..." maxlength="5000"><?php echo $dance_video_reference;?></textarea>
<span class="error"><?php echo $dance_video_reference_error;?></span>
</td>
</tr>

<!-- Upload Image Input -->
<tr>
<td>
<label>Artist Images: </label>
</td>
</tr>
<tr>
<td>
<div id="filediv">
<input type="file" style="color: #000" name="file[]" id="file">
<input type="button" style="color: #000" id="add_more" value="Add More Files" />
<span class="error"><?php echo $artist_images_error;?></span>
</div>
</td>
</tr>

<!-- Links Input -->
<tr>
<td>
<label>Links: </label>
</td>
</tr>
<tr>
<td>
<textarea name="links" rows="5" cols="40" placeholder="https://www.wikipedia.com/dances, https://www.wikipedia.com/dances2, https://www.wikipedia.com/dances3, etc..." maxlength="5000"><?php echo $links;?></textarea>
<span class="error"><?php echo $links_error;?></span>
</td>
</tr>

<!-- Dance Key Words Input -->
<tr>
<td>
<label>Key Words: </label>
</td>
</tr>
<tr>
<td>
<input type="text" name="dance_key_words" value="<?php echo $dance_key_words;?>" placeholder="Word1, Word2, etc...">
</td>
</tr>

<!-- Status Input -->
<tr>
<td>
<label>Status: </label>
</td>
</tr>
<tr>
<td>
<select class="dropdown" style="color: #000" name="dance_status">
				<option <?php if (isset($dance_status) && $dance_status=="Submitted") echo "selected";?>>Submitted</option>
				<option <?php if (isset($dance_status) && $dance_status=="Selected") echo "selected";?>>Selected</option>
				<option <?php if (isset($dance_status) && $dance_status=="In Progress") echo "selected";?>>In Progress</option>
				<option <?php if (isset($dance_status) && $dance_status=="Done") echo "selected";?>>Done</option>
				</select>
<span class="error">* <?php echo $dance_status_error;?></span>
</td>
</tr>

<!-- Submit Button -->
<tr>
<td>
<input class="orange_button" type="submit" name="submit" value="Submit">
</td>
</tr>
</table>
</form>
</div>

<footer>
<?php include 'footer.php'; ?>
</footer>
<script type="text/javascript">
var abc = 0;      // Declaring and defining global increment variable.
$(document).ready(function() {
//  To add new input file field dynamically, on click of "Add More Files" button below function will be executed.
$('#add_more').click(function() {
$(this).before($("<div/>", {
id: 'filediv'
}).fadeIn('slow').append($("<input/>", {
name: 'file[]',
type: 'file',
id: 'file'
}), $("<br/><br/>")));
});
// Following function will executes on change event of file input to select different file.
$('body').on('change', '#file', function() {
if (this.files && this.files[0]) {
abc += 1; // Incrementing global variable by 1.
var z = abc - 1;
var x = $(this).parent().find('#previewimg' + z).remove();
$(this).before("<div id='abcd" + abc + "' class='abcd'><img id='previewimg" + abc + "' src='' width='500px' height='400px'/></div>");
var reader = new FileReader();
reader.onload = imageIsLoaded;
reader.readAsDataURL(this.files[0]);
$(this).hide();
$("#abcd" + abc).append($("<img/>", {
id: 'img',
src: 'x.png',
alt: 'delete'
}).click(function() {
$(this).parent().parent().remove();
}));
}
});
// To Preview Image
function imageIsLoaded(e) {
$('#previewimg' + abc).attr('src', e.target.result);
};
$('#upload').click(function(e) {
var name = $(":file").val();
if (!name) {
alert("First Image Must Be Selected");
e.preventDefault();
}
});

$('.navbar-nav li').removeClass('active');
$('.navbar-nav li.page_admin').addClass('active');

});

</script>\
</body>

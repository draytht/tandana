<?php include 'navigation.php';


// Start session to store variables
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

// Allows user to return 'back' to this page
// Close the session if it's active
if (session_status() == PHP_SESSION_ACTIVE) {
    session_write_close();
}

// Change session-related settings
ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);

// Start the session
session_start();

 ?>
<div class="col-md-2 left_nav" style="padding-left: 0;">
<div class="translation_wrapper">
            <div><a class="dance_telugu_name" href="#" onClick="sortTeluguName('ALL')"> </a></div>
</div>
<div id="left_menu">
<?php
require_once('db_configuration.php');

		$dance_id = "";
		$dance_english_name = "";
		$dance_alternate_name = "";
		$dance_telugu_name = "";
		$dance_category = "";
		$dance_origin = "";
		$dance_description = "";
		$dance_image_reference = "";
		$dance_video_reference = "";
		$dance_key_words = "";

		// Split image and video strings by commas to parse for url
		$image_reference_array = [];
		$video_reference_array = [];
		$artist_reference_array = [];
		$image_reference_set = false;
		$artist_reference_set = false;

		// Sort status
		$sort = "";

		// if(null !== english_menu_order){
  //   	$english_menu_order = english_menu_order;
		// }
		// else{
  //  		$english_menu_order = 'alphabetical';
		// }

		
		// if(null !== telugu_menu_order){
  //   	$telugu_menu_order = telugu_menu_order;
		// }
		// else{
   		$telugu_menu_order = 'alphabetical';
		// }
		
		

// Establishing Connection with Server
$servername = DATABASE_HOST;
$db_username = DATABASE_USER;
$db_password = DATABASE_PASSWORD;
$database = DATABASE_DATABASE;

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $database);

// Check connection
if ($conn->connect_error) {
	echo("<p>$servername</p>");
	echo("<p>$db_username</p>");
	echo("<p>$db_password</p>");
	echo("<p>$database</p>"); //get the details of the connection if it failed
    die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully<br>";
$conn->set_charset("utf8");

if (empty($_GET['sort']) ){
	//if ($english_menu_order == 'alphabetical'){
	//$sql = "SELECT dance_id, dance_english_name, dance_telugu_name FROM dances ORDER BY dance_telugu_name";
	//	$result = $conn->query($sql);
	//}
	//else{
	$sql = "SELECT dance_id, dance_english_name, dance_telugu_name FROM dances ORDER BY dance_id";
		$result = $conn->query($sql);
	//}

	if ($result->num_rows > 0) {
		echo "<table width='100%' border='1px'>";

    while($row = $result->fetch_assoc()) {
    	echo '
    	<tr>
    	<td colspan="2">
    	<a href="dances.php?id='. $row["dance_id"] .'" style="display: block"> '. $row["dance_telugu_name"] .'</a>
    	</td>
    	</tr>
    	';
    }

    	echo "</table>";
	}

    else {
    echo "0 results";
	}


}

else{
	if ($_GET['sort'] == 'telugu'){

		if($telugu_menu_order){
		$sql = "SELECT dance_id, dance_english_name, dance_telugu_name FROM dances ORDER BY dance_telugu_name";
		$result = $conn->query($sql);
		}
		else{
		$sql = "SELECT dance_id, dance_english_name, dance_telugu_name FROM dances ORDER BY dance_id";
		$result = $conn->query($sql);
		}

	if ($result->num_rows > 0) {
		echo "<table width='100%' border='1px'>";

    while($row = $result->fetch_assoc()) {
    	echo '
    	<tr>
    	<td colspan="2">
    	<a href="dances.php?id='. $row["dance_id"] .'&sort=telugu" style="display: block"> '. $row["dance_telugu_name"] .'</a>
    	</td>
    	</tr>
    	';
    }

    	echo "</table>";
	}

    else {
    echo "0 results";
	}
	}
	else{
		if ($english_menu_order == 'alphabetical'){
	$sql = "SELECT dance_id, dance_english_name, dance_telugu_name FROM dances ORDER BY dance_telugu_name";
		$result = $conn->query($sql);
	}
	else{
	$sql = "SELECT dance_id, dance_english_name, dance_telugu_name FROM dances ORDER BY dance_id";
		$result = $conn->query($sql);
	}

	if ($result->num_rows > 0) {
		echo "<table width='100%' border='1px'>";

    while($row = $result->fetch_assoc()) {
    	echo '
    	<tr>
    	<td colspan="2">
    	<a href="dances.php?id='. $row["dance_id"] .'&sort=english" style="display: block"> '. $row["dance_telugu_name"] .'</a>
    	</td>
    	</tr>
    	';
    }

    	echo '</table>';
	}

    else {
    echo '0 results';
	}
	}
}

?>
</div>
</div>
<?php
if (empty($_GET)){
	$sql = "SELECT dance_id, dance_english_name, dance_alternate_name, dance_telugu_name, dance_category, dance_origin, dance_description, dance_image_reference, dance_video_reference, dance_key_words, dance_status, artist_images FROM dances ORDER BY dance_english_name LIMIT 1";
		$result = $conn->query($sql);
}

else{
$id = $_GET['id'];
	$sql = "SELECT dance_id, dance_english_name, dance_alternate_name, dance_telugu_name, dance_category, dance_origin, dance_description, dance_image_reference, dance_video_reference, dance_key_words, dance_status, artist_images FROM dances WHERE dance_id = '$id'";
		$result = $conn->query($sql);
}

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
    	// Grab dance ID
    	$dance_id = $row["dance_id"];
  //   	$dance_english_name = $_row["dance_english_name"];
		// $dance_alternate_name = $_row["dance_alternate_name"];
		// $dance_telugu_name = $_row["dance_telugu_name"];
		// $dance_category = $_row["dance_category"];
		// $dance_origin = $_row["dance_origin"];
		// $dance_description = $_row["dance_description"];
		// $dance_image_reference = $_row["dance_image_reference"];
		// $dance_video_reference = $_row["dance_video_reference"];
		// $dance_key_words = $_row["dance_key_words"];

    	$image_reference_array = explode(',', $row["dance_image_reference"]);
		$video_reference_array = explode(',', $row["dance_video_reference"]);
		$artist_reference_array = explode(',', $row["artist_images"]);

// Display dance data
echo '<div class="col-md-10 dances_display top_space">
<div class="dance_display_description">
<div class="dance_display_description_row1">
<div class="wrapper">
<div class="dance_id"><div>
<!-- Dance ID -->
';
if (isset($_SESSION['username'])) {
	echo '<a href="update.php?id='.$row["dance_id"].'" style="display: block;">'.$row["dance_id"].'</a>';
}
else{
	echo $row['dance_id'];
}

echo'
<title>'. $row['dance_english_name'].'</title>
</div></div>
</div>
<div class="wrapper">
<p class="dance_english_name">
<!-- Dance Name in English Input -->
'. $row['dance_english_name'].'
</p>
<p class="dance_telugu_name">
<!-- Dance Name in Telugu Input --> 
'. $row['dance_telugu_name'].'
</p>
</div>
</div>

<div class="dance_display_description_row3">
<p class="dance_alternate_name">

'. $row['dance_alternate_name'].'
</p>
</div>
</div>
';

if($artist_reference_array[0] != ""){
	$artist_reference_set = true;
}
else{
	$artist_reference_set = false;
}

if($image_reference_array[0] != ""){
	$image_reference_set = true;
}
else{
	$image_reference_set = false;
}

// If artist images and internet images exist
if($artist_reference_set == true && $image_reference_set == true){
	echo '
	<div id="imageCarousel" class="carousel slide" data-ride="carousel">
	<ol class="carousel-indicators">
	';
	for ($i = 0; $i < sizeof($artist_reference_array); $i++){
	if($i == 0){
		echo '<li data-target="#imageCarousel" data-slide-to="$i" class="active"></li>';
	}
	else{
		echo '<li data-target="#imageCarousel" data-slide-to="$i"></li>';
	}
	}
	for ($j = 0; $j < sizeof($image_reference_array); $j++){
		echo '<li data-target="#imageCarousel" data-slide-to="$j"></li>';
	}
echo '
</ol>
<div class="carousel-inner" role="listbox">
';
for ($i = 0; $i < sizeof($artist_reference_array); $i++){
	if($i == 0){
		echo '<div class="item active">
					<img src="' . $artist_reference_array[$i]. '" width="auto" height="400">
			  </div>';
	}
	else{
		echo '<div class="item">
					<img src="' . $artist_reference_array[$i]. '" width="auto" height="400">
			  </div>';
	}
}
for ($i = 0; $i < sizeof($image_reference_array); $i++){
		echo '<div class="item">
					<img src="' . $image_reference_array[$i]. '" width="auto" height="400">
			  </div>';
}
echo '
</div>
<a class="left carousel-control" href="#imageCarousel" role="button" data-slide="prev">
<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#imageCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
';
}

// If only artist images exist
if($artist_reference_set == true && $image_reference_set == false){
	echo '
	<div id="imageCarousel" class="carousel slide" data-ride="carousel">
	<ol class="carousel-indicators">
	';
	for ($i = 0; $i < sizeof($artist_reference_array); $i++){
	if($i == 0){
		echo '<li data-target="#imageCarousel" data-slide-to="$i" class="active"></li>';
	}
	else{
		echo '<li data-target="#imageCarousel" data-slide-to="$i"></li>';
	}
	}
echo '
</ol>
<div class="carousel-inner" role="listbox">
';
for ($i = 0; $i < sizeof($artist_reference_array); $i++){
	if($i == 0){
		echo '<div class="item active">
					<img src="' . $artist_reference_array[$i]. '" width="auto" height="400">
			  </div>';
	}
	else{
		echo '<div class="item">
					<img src="' . $artist_reference_array[$i]. '" width="auto" height="400">
			  </div>';
	}
}
echo '
</div>
<a class="left carousel-control" href="#imageCarousel" role="button" data-slide="prev">
<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#imageCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
';
}

// If only internet images exist
if($artist_reference_set == false && $image_reference_set == true){
	echo '
	<div id="imageCarousel" class="carousel slide" data-ride="carousel">
	<ol class="carousel-indicators">
	';
	for ($i = 0; $i < sizeof($image_reference_array); $i++){
	if($i == 0){
		echo '<li data-target="#imageCarousel" data-slide-to="$i" class="active"></li>';
	}
	else{
		echo '<li data-target="#imageCarousel" data-slide-to="$i"></li>';
	}
}
echo '
</ol>
<div class="carousel-inner" role="listbox">
';
for ($i = 0; $i < sizeof($image_reference_array); $i++){
	if($i == 0){
		echo '<div class="item active">
					<img src="' . $image_reference_array[$i]. '" width="auto" height="400">
			  </div>';
	}
	else{
		echo '<div class="item">
					<img src="' . $image_reference_array[$i]. '" width="auto" height="400">
			  </div>';
	}
}
echo '
</div>
<a class="left carousel-control" href="#imageCarousel" role="button" data-slide="prev">
<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#imageCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
';
}


// if($image_reference_set == true){
// 	echo '
// 	<div id="imageCarousel" class="carousel slide" data-ride="carousel">
// 	<ol class="carousel-indicators">
// 	';
// 	for ($i = 0; $i < sizeof($image_reference_array); $i++){
// 	if($i == 0){
// 		echo '<li data-target="#imageCarousel" data-slide-to="$i" class="active"></li>';
// 	}
// 	else{
// 		echo '<li data-target="#imageCarousel" data-slide-to="$i"></li>';
// 	}
// }
// echo '
// </ol>
// <div class="carousel-inner" role="listbox">
// ';
// for ($i = 0; $i < sizeof($image_reference_array); $i++){
// 	if($i == 0){
// 		echo '<div class="item active">
// 					<img src="' . $image_reference_array[$i]. '" width="auto" height="400">
// 			  </div>';
// 	}
// 	else{
// 		echo '<div class="item">
// 					<img src="' . $image_reference_array[$i]. '" width="auto" height="400">
// 			  </div>';
// 	}
// }
// echo '
// </div>
// <a class="left carousel-control" href="#imageCarousel" role="button" data-slide="prev">
// <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
//     <span class="sr-only">Previous</span>
//   </a>
//   <a class="right carousel-control" href="#imageCarousel" role="button" data-slide="next">
//     <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
//     <span class="sr-only">Next</span>
//   </a>
// </div>
// ';
// }



echo '<br>';
echo $row["dance_description"];
echo '<br>';

if($video_reference_array[0] != ""){
echo '
<br>
<!-- Dance Video Reference Input -->
<center>
<div>
';
for ($j = 0; $j < sizeof($video_reference_array); $j++){
	echo '<iframe width="500" height="400"
	src="'. $video_reference_array[$j] .'">
	</iframe>';
}
echo '
</center>
</div>';
}
// Loop through video array, display videos
;
}
} 

else {
    echo "0 results";
}

$conn->close();

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">

    function sortEnglishName() {
      $('#left_menu').load('sort_by_english_name.php?id=');
      $sort = "english";
    }

    function sortTeluguName() {
      $('#left_menu').load('sort_by_telugu_name.php?id=');
      $sort = "telugu";
    }

    // Hide carousel controls if only one image
    $('.carousel-inner').each(function() {

    if ($(this).children('div').length === 1) $(this).siblings('.carousel-control, .carousel-indicators').hide();
	});

	$('.navbar-nav li').removeClass('active');
	$('.navbar-nav li.page_dances').addClass('active');
</script>
<head>
  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-121774211-1"></script>

<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-121774211-1');
</script>
</head>
<footer>
<?php include 'footer.php'; ?>
</footer>	
</body>
</html>


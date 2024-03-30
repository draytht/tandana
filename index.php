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
<head><script>
$("a").hover(function(){
    $(this).css("background-color", "green");
    }, function(){
    $(this).css("background-color", "#3953ad");
});
</script></head>
<?php
require_once('db_configuration.php');
		//$lang_type = $_GET['lang_type'];
		//$lang_filter_type = $_GET['lang_filter_type'];
		//$dance_type = $_GET['dance_type'];
		//$dance_filter_type = $_GET['dance_filter_type'];
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

		$count = 0;
		$count_temp = 0;
		$row_count = 0;
		

// Establishing Connection with Server
$servername = DATABASE_HOST;
$db_username = DATABASE_USER;
$db_password = DATABASE_PASSWORD;
$database = DATABASE_DATABASE;

		if(null !== homepage_show_total){
    	$homepage_show_total = homepage_show_total;
		}
		else{
   		$homepage_show_total = '10';
		}

		if(null !== homepage_show_per_row){
    	$homepage_show_per_row = homepage_show_per_row;
		}
		else{
   		$homepage_show_per_row = '5';
		}

		if(null !== default_language){
    	$default_language = default_language;
		}
		else{
   		$default_language = 'english';
		}

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully<br>";
$conn->set_charset("utf8");

	$sql = "SELECT dance_id, dance_english_name, dance_alternate_name, dance_telugu_name, dance_category, dance_origin, dance_description, dance_image_reference, dance_video_reference, dance_key_words, dance_status FROM dances ORDER BY RAND()";
		$result = $conn->query($sql);



if ($result->num_rows > 0) {
	foreach ($_GET as $key => $value){
	echo('<script>alert($key,$value);</script>');
}

		echo 
		'
		<div class="container top_space">
		';


    while($row = $result->fetch_assoc()) {
    	// Grab dance ID
    	$dance_id = $row["dance_id"];

    	$image_reference_array = explode(',', $row["dance_image_reference"]);
		// $video_reference_array = explode(',', $row["dance_video_reference"]);


		if($image_reference_array[0] != "" && $count != $homepage_show_total){

			if($row_count == 0){
				echo '
				<div class="row">
				<div class="test_row_1">
				';
			}

			if($row_count < $homepage_show_per_row){
				echo '
				<div class="thumbnail_wrapper">
				<div class="thumbnail">
				<a href="dances.php?id=' .$row["dance_id"]. '">
				<div class="thumbnail_image_wrapper" style="background:url(' . $image_reference_array[0]. ') no-repeat;">
				</div>
			 	<div class="caption">
			 	';

			 	if($default_language == 'telugu'){
			 		echo '<p style="text-align: center">'. $row["dance_telugu_name"].'</p>';
			 	}
			 	else{
			 		echo '<p style="text-align: center">'. $row["dance_english_name"].'</p>';
			 	}

			 	echo '
			 	</div>
			 	</a>
			 	</div>
			 	</div>
				 ';

				 $row_count++;
			}

			if($row_count == $homepage_show_per_row){
				echo '
				</div>
				</div>
				';
			}


			if ($row_count >= $homepage_show_per_row){
				$row_count = 0;
			}

		// if($count_temp == 0 && $count == $homepage_show_per_row){
		// 		echo 
		// 		'
		// 		</div>
		// 		<div class="test_row_1">
		// 		';
		// 		$count_temp = 1;
		// }
			

		// if($count >= $homepage_show_per_row && $count < $homepage_show_total){
		// 		echo '
		// 		<div class="thumbnail_wrapper">
		// 		<div class="thumbnail">
		// 		<a href="dances.php?id=' .$row["dance_id"]. '">
		// 		<div class="thumbnail_image_wrapper" style="background:url(' . $image_reference_array[0]. ') no-repeat;"></div>
		// 	 	<div class="caption">
		// 	 	';

		// 	 		if($default_language == 'telugu'){
		// 	 		echo '<p style="text-align: center">'. $row["dance_telugu_name"].'</p>';
		// 	 		}
		// 	 		else{
		// 	 		echo '<p style="text-align: center">'. $row["dance_english_name"].'</p>';
		// 	 		}

		// 	 	echo '
		// 	 	</div>
		// 	 	</a>
		// 	 	</div>
		// 	 	</div>
		// 	 	';
		// }

		$count++;
		}
	}

	

	echo'
	</div>
	';
}
	    

else {
    echo "0 results";
}

$conn->close();

?>

<footer>
<?php include 'footer.php'; ?>
</footer>	
</body>
</html>


<?php
include 'navigation.php';
require_once('db_configuration.php');
//require_once ('mpdf/mpdf.php');
?>

<html>
<head>
<title>Dances</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

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

        $sql = "SELECT dance_id, dance_english_name, dance_alternate_name, dance_telugu_name, dance_category, dance_origin, dance_description, dance_image_reference, dance_video_reference, dance_key_words, dance_status, artist_images FROM dances ORDER BY dance_id";
        $result = $conn->query($sql);

            // $html = file_get_contents("assets/pdf/front.html");
echo '<div class="container top_space">';

if(isset($_SESSION['username'])){
            
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                // Grab dance ID
                $dance_id = $row["dance_id"];
          //    $dance_english_name = $_row["dance_english_name"];
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
                    echo '
                    <div class="col-md-12 dances_display">
                    <div class="dance_display_description">
                    <div class="dance_display_description_row1">
                    <div class="wrapper">
                    <div class="dance_id"><div>
                    <!-- Dance ID -->
                    '. $row['dance_id'].'
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
                    <div class="dance_display_description_row2">
                    <p class="dance_origin">
                    <!-- Dance Origin Input -->
                    Origin: 
                    '. $row['dance_origin'].'
                    </p>
                    <p class="dance_category">
                    <!-- Dance Category Input -->
                    Category: 
                    '. $row['dance_category'].'
                    </p>
                    </div>
                    <div class="dance_display_description_row3">
                    <p class="dance_alternate_name">
                    Alternate Names: 
                    '. $row['dance_alternate_name'].'
                    </p>
                    </div>
                    </div>
                    ';

                    echo '
                    <div>
                    <center>';
                    if($artist_reference_array[0] != ""){
                            for ($i = 0; $i < sizeof($artist_reference_array); $i++){
                            echo '<img src="' . $artist_reference_array[$i]. '" width="500" height="400">
                            ';
                            }
                    }

                     if($image_reference_array[0] != ""){
                            for ($i = 0; $i < sizeof($image_reference_array); $i++){
                            echo '<img src="' . $image_reference_array[$i]. '" width="500" height="400">
                            ';
                            }
                    }

                    echo '
                    <br>
                    <br>
                    </center>
                    </div>
                    ';

                    echo 
                    ' 
                    </div>
                    <br>
                    <br>
                    <br>
                    ';
                    }      
        }
            else{
                echo "0 results";
            }
        
} // End if statement of user session

else{
    echo 'Please log in as an Admin.';
}

echo '</div>';        

?>
<footer>
<?php include 'footer.php'; ?>
</footer>

<script type="text/javascript">
    $(document).ready(function() {
        $('.navbar-nav li').removeClass('active');
        $('.navbar-nav li.page_admin').addClass('active');
    });
</script>
</body>
</html>
<?php
require_once('db_configuration.php');
// require_once ('mpdf/mpdf.php');
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

$where_string = "";
$count = 0;

        $sql = "SELECT dance_id, dance_english_name, dance_alternate_name, dance_telugu_name, dance_category, dance_origin, dance_description, dance_image_reference, dance_video_reference, dance_key_words, dance_status, artist_images FROM dances WHERE dance_status = 'done' ORDER BY dance_id";
        $result = $conn->query($sql);

            // $html = file_get_contents("assets/pdf/front.html");

        if(isset($_SESSION['username'])){

                // Print front page, front pages, table of contents etc...
                    echo '
                    <center>
                    <img src="assets/pdf/front.jpg" />
                    </center>
                    <br>
                    <p style="page-break-after:always;"></p>
                    <p style="page-break-after:always;"></p>
                    <br>
                    <center>
                    ';
                    readfile("assets/pdf/front.html");
                    echo 
                    '
                    </center>
                    <br>
                    <p style="page-break-after:always;"></p>
                    <p style="page-break-after:always;"></p>
                    ';



                    // Print table of contents
                    $sql = "SELECT dance_id, dance_english_name, dance_telugu_name, dance_status, dance_image_reference, dance_video_reference, artist_images FROM dances WHERE dance_status = 'done' ORDER BY dance_id ";
                    $table_of_contents = $conn->query($sql);

                     echo '
                        <div class="col-md-12 dances_display">
                            <table class="compile_table" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <th>ID</th>
                                    <th>Thumbnail</th>
                                    <th>English Name</th>
                                    <th>Telegu Name</th>
                                </tr>
                                <tr>
                    ';
                    if($table_of_contents ->num_rows > 0){
                        while($row = $table_of_contents->fetch_assoc()){
                            // echo 'ID: ' . $row["dance_id"] . ' - ' . $row["dance_english_name"] .' - ' . $row["dance_telugu_name"] . '<br>';
                            echo '
                                <tr class="compile_rows">
                                    <td>'. $row["dance_id"] .'</td>
                                    <td>';

                                    if ($row["artist_images"] != ""){
                                        if(isset($artist_images_set) && $artist_images_set == TRUE){
                                        $ext_array = explode(',', $row["artist_images"]);   // Explode file name from comma
                                        echo '<img src="'.$ext_array[0].'" height="100px" width="100px">';
                                        }
                                        else{
                                        echo '<img src="assets/images/100x100.png" height="100px" width="100px">';
                                        }
                                    }
                                    else if ($row["dance_image_reference"] != ""){
                                        if (isset($internet_images_set) && $internet_images_set == TRUE){
                                        $exp_array = explode(',', $row["dance_image_reference"]);
                                        echo '<img src="'.$exp_array[0].'" height="100px" width="100px">';
                                        }
                                        else{
                                        echo '<img src="assets/images/100x100.png" height="100px" width="100px">';
                                        }
                                    }
                                    else{
                                        echo '<img src="assets/images/100x100.png" height="100px" width="100px">';
                                    }

                            echo'
                                    </td>
                                    <td>'. $row["dance_english_name"] .'</td>
                                    <td>'. $row["dance_telugu_name"] .'</td>
                                </tr>
                            ';
                        }
                    }
                    echo'
                            </table>
                        </div>
                    <br>
                    <p style="page-break-after:always;"></p>
                    <p style="page-break-after:always;"></p>
                    ';
                    }
                    

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

                    if($artist_reference_array[0] == "" && $artist_reference_array[0] ==""){
                        echo '<img src="assets/images/500x400.png" width="500" height="400">
                                 ';
                    }
                    else{
                        for ($i = 0; $i < sizeof($artist_reference_array); $i++){
                        echo '<img src="' . $artist_reference_array[$i]. '" width="500" height="400">';
                        }
                    }

                    echo '
                    </center>
                    </div>
                    ';

                    echo '<br>';
                    echo nl2br($row["dance_description"]);
                    echo 
                    ' 
                    </div>
                    <p style="page-break-after:always;"></p>
                    ';
                    }

                    echo '
                    <p style="page-break-after:always;"></p>
                    <center>
                    ';
                    readfile("assets/pdf/back.html");
                    echo 
                    '
                    </center>
                    <br>
                    <p style="page-break-after:always;"></p>
                    <p style="page-break-after:always;"></p>
                    <center>
                    <img src="assets/pdf/back.jpg" />
                    </center>
                    <br>
                    '
                    ;
                }
        else{
            echo 'Please login as admin.';
        }
?>
</body>
</html>
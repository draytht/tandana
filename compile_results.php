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

$target_dir = "assets/pdf/";

// $target_frontPage = $target_dir . basename($_FILES["upload"]["name"][0]);
// $target_backPage = $target_dir . basename($_FILES["upload"]["name"][0]);
// $target_backCover = $target_dir . basename($_FILES["upload"]["name"][0]);

$uploadOk = 1;



// if(isset($_FILES['frontCover'])){
//     $front_cover_name = $_FILES['frontCover']['name'];
//     echo 'ISSET!';
// }
// else{
//     echo 'IS NOT SET!';
// }


$uploadOk = 1;

if(!empty($_FILES['upload']['name'][0])){
    $target_frontCover = $target_dir . basename($_FILES["upload"]["name"][0]);
    $fileType_frontCover = pathinfo($target_frontCover,PATHINFO_EXTENSION);
    // echo $target_frontCover;

    if($fileType_frontCover != "gif" && $fileType_frontCover != "GIF" && $fileType_frontCover != "jpg" && $fileType_frontCover != "JPG" && $fileType_frontCover != "JPEG" && $fileType_frontCover != "jpeg"
    && $fileType_frontCover != "tiff" && $fileType_frontCover != "TIFF" && $fileType_frontCover != "svg" && $fileType_frontCover != "SVG" && $fileType_frontCover != "png" && $fileType_frontCover != "PNG") {
    echo "<b>Warning only gif, jpg, jpeg, tiff, png, and svg files are allowed for front covers!<br></b>";
    $uploadOk = 0;
    $target_frontCover = 'assets/pdf/front.jpg';
    }

    else{
    if (move_uploaded_file($_FILES["upload"]["tmp_name"][0], $target_frontCover)) {
        // echo "The file ". basename( $_FILES["upload"]["name"][0]). " has been successfully uploaded.";
    } 

    else {
        echo "<b>Sorry, there was an error uploading your front cover file!<br></b>";
        $target_frontCover = 'assets/pdf/front.jpg';
    }
    }
}
else{
    $target_frontCover = 'assets/pdf/front.jpg';
}




if(!empty($_FILES["upload"]["name"][1])){
    $target_frontPage = $target_dir . basename($_FILES["upload"]["name"][1]);
    $fileType_frontPage = pathinfo($target_frontPage,PATHINFO_EXTENSION);
    // echo $target_frontPage;

    // Allow certain file formats
    if($fileType_frontPage != "html" && $fileType_frontPage != "HTML") {
    echo "<b>Warning only html files are allowed for front pages!<br></b>";
    $target_frontPage = 'assets/pdf/front.html';
    $uploadOk = 0;
    }

    else{
    if (move_uploaded_file($_FILES["upload"]["tmp_name"][1], $target_frontPage)) {
        // echo "The file ". basename( $_FILES["upload"]["name"][1]). " has been successfully uploaded.";
    } 

    else {
        echo "<b>Sorry, there was an error uploading your front page file!<br></b>";
        $target_frontPage = 'assets/pdf/front.html';
    }
    }
}
else{
    $target_frontPage = 'assets/pdf/front.html';
}





if(!empty($_FILES["upload"]["name"][2])){
    $target_backPage = $target_dir . basename($_FILES["upload"]["name"][2]);
    $fileType_backPage = pathinfo($target_backPage,PATHINFO_EXTENSION);
    // echo $target_backPage;

    // Allow certain file formats
    if($fileType_backPage != "html" && $fileType_backPage != "HTML") {
    echo "<b>Warning only html files are allowed for back pages!<br></b>";
    $target_backPage = 'assets/pdf/back.html';
    $uploadOk = 0;
    }

    else{
    if (move_uploaded_file($_FILES["upload"]["tmp_name"][2], $target_backPage)) {
        // echo "The file ". basename( $_FILES["upload"]["name"][2]). " has been successfully uploaded.";
    } 

    else {
        echo "<b>Sorry, there was an error uploading your back page file!<br></b>";
        $target_backPage = 'assets/pdf/back.html';
    }
    }
}
else{
    $target_backPage = 'assets/pdf/back.html';
}





if(!empty($_FILES["upload"]["name"][3])){
    $target_backCover = $target_dir . basename($_FILES["upload"]["name"][3]);
    $fileType_backCover = pathinfo($target_backCover,PATHINFO_EXTENSION);
    // echo $target_backCover;

    if($fileType_backCover != "gif" && $fileType_backCover != "GIF" && $fileType_backCover != "jpg" && $fileType_backCover != "JPG" && $fileType_backCover != "JPEG" && $fileType_backCover != "jpeg"
    && $fileType_backCover != "tiff" && $fileType_backCover != "TIFF" && $fileType_backCover != "svg" && $fileType_backCover != "SVG" && $fileType_backCover != "png" && $fileType_backCover != "PNG") {
    echo "<b>Warning only gif, jpg, jpeg, tiff, png, and svg files are allowed for front covers!<br></b>";
    $uploadOk = 0;
    $target_backCover = 'assets/pdf/back.jpg';
    }

    else{
    if (move_uploaded_file($_FILES["upload"]["tmp_name"][3], $target_backCover)) {
        // echo "The file ". basename( $_FILES["upload"]["name"][3]). " has been successfully uploaded.";
    } 

    else {
        echo "<b>Sorry, there was an error uploading your back cover file!<br></b>";
        $target_backCover = 'assets/pdf/back.jpg';
    }
    }
}
else{
    $target_backCover = 'assets/pdf/back.jpg';
}


// Check if image file is a actual image or fake image
// if(isset($_POST["submit"])) {
//     $check = getimagesize($_FILES["target_frontCover"]["tmp_name"]);
//     if($check !== false) {
//         echo "File is an image - " . $check["mime"] . ".";
//         $uploadOk = 1;
//     } else {
//         echo "File is not an image.";
//         $uploadOk = 0;
//     }

//     $check = getimagesize($_FILES["target_backCover"]["tmp_name"]);
//     if($check !== false) {
//         echo "File is an image - " . $check["mime"] . ".";
//         $uploadOk = 1;
//     } else {
//         echo "File is not an image.";
//         $uploadOk = 0;
//     }
// }


// // Check if $uploadOk is set to 0 by an error
// if ($uploadOk == 0) {
//     echo "Sorry, your file was not uploaded.";
// // if everything is ok, try to upload file
// }

// else {
   

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

if (empty($_POST)){
    echo 'No performances selected.';
}

else{
$where_string = "";
$count = 0;

if (!empty($_POST['submitted'])){
    $submitted = $_POST['submitted'];
    if($count != 0){
        $where_string = $where_string . " OR dance_status = 'Submitted'";
    }
    else{
        $where_string = $where_string . " dance_status = 'Submitted'";
    }
    $count++;
}
if (!empty($_POST['selected'])){
    $selected = $_POST['selected'];
    if($count != 0){
        $where_string = $where_string . " OR dance_status = 'Selected'";
    }
    else{
        $where_string = $where_string . " dance_status = 'Selected'";
    }
    $count++;
}
if (!empty($_POST['in_progress'])){
    $in_progress = $_POST['in_progress'];
    if($count != 0){
        $where_string = $where_string . " OR dance_status = 'In Progress'";
    }
    else{
        $where_string = $where_string . " dance_status = 'In Progress'";
    }
    $count++;
}
if (!empty($_POST['done'])){
    $done = $_POST['done'];
    if($count != 0){
        $where_string = $where_string . " OR dance_status = 'Done'";
    }
    else{
        $where_string = $where_string . " dance_status = 'Done'";
    }
}

if (empty($_POST['submitted']) && empty($_POST['selected']) && empty($_POST['in_progress']) && empty($_POST['done'])){
    echo 'No performances selected';
}

else{
        $sql = "SELECT dance_id, dance_english_name, dance_alternate_name, dance_telugu_name, dance_category, dance_origin, dance_description, dance_image_reference, dance_video_reference, dance_key_words, dance_status, artist_images FROM dances WHERE $where_string ORDER BY dance_id";
        $result = $conn->query($sql);

             if (!empty($_POST['artist_images'])){
                $artist_images = $_POST['artist_images'];
                $artist_radio = $_POST['artist_radio'];
                $artist_images_set = TRUE;
                if($artist_radio == 'First Image'){
                    $artist_radio_set = 'first';
                }
                else{
                    $artist_radio_set = 'all';
                }
            }

            if (!empty($_POST['internet_images'])){
                $internet_images = $_POST['internet_images'];
                $internet_radio = $_POST['internet_radio'];
                $internet_images_set = TRUE;
                if($internet_radio == 'First Image'){
                    $internet_radio_set = 'first';
                }
                else{
                    $internet_radio_set = 'all';
                }
             }

            if (!empty($_POST['format_radio'])){
                $format_radio = $_POST['format_radio'];
                if($format_radio == 'HTML'){
                    $html = true;
                }
                else{
                    $pdf = true;
                }
            }

             if (!empty($_POST['table_of_contents'])){
                $table_of_contents = TRUE;
            }

            // $html = file_get_contents("assets/pdf/front.html");

        if(isset($_SESSION['username'])){

            // If user selects html
            if(isset($html) && $html == true){
                // Print front page, front pages, table of contents etc...
                    echo '
                    <center>
                    <img src="'.$target_frontCover.'" />
                    </center>
                    <br>
                    <p style="page-break-after:always;"></p>
                    <p style="page-break-after:always;"></p>
                    <br>
                    <center>
                    ';
                    readfile($target_frontPage);
                    echo 
                    '
                    </center>
                    <br>
                    <p style="page-break-after:always;"></p>
                    <p style="page-break-after:always;"></p>
                    ';

                    if(isset($table_of_contents) && $table_of_contents == true){

                    // Print table of contents
                    $sql = "SELECT dance_id, dance_english_name, dance_telugu_name, dance_image_reference, dance_video_reference, artist_images FROM dances ORDER BY dance_id";
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
                    if($artist_reference_array[0] != ""){
                        if(isset($artist_images_set) && $artist_images_set == TRUE){
                            if($artist_radio_set == "first"){
                                echo '<img src="' . $artist_reference_array[0]. '" width="500" height="400">
                                ';
                            }
                            else{
                                 for ($i = 0; $i < sizeof($artist_reference_array); $i++){
                                 echo '<img src="' . $artist_reference_array[$i]. '" width="500" height="400">
                                 ';
                                 }
                            }
                        }
                    }

                     if($image_reference_array[0] != ""){
                        if (isset($internet_images_set) && $internet_images_set == TRUE){
                            if($internet_radio_set == "first"){
                                echo '<img src="' . $image_reference_array[0]. '" width="500" height="400">
                                ';
                            }
                            else{
                                 for ($i = 0; $i < sizeof($image_reference_array); $i++){
                                 echo '<img src="' . $image_reference_array[$i]. '" width="500" height="400">
                                 ';
                                 }
                            }
                        }
                    }

                    if($artist_reference_array[0] == "" && $image_reference_array[0] ==""){
                        echo '<img src="assets/images/500x400.png" width="500" height="400">
                                 ';
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
                    <br>
                    <br>
                    <p style="page-break-after:always;"></p>
                    ';
                    }

                    echo '
                    <p style="page-break-after:always;"></p>
                    <center>
                    ';
                    readfile($target_backPage);
                    echo 
                    '
                    </center>
                    <br>
                    <p style="page-break-after:always;"></p>
                    <p style="page-break-after:always;"></p>
                    <center>
                    <img src="'.$target_backCover.'" />
                    </center>
                    <br>
                    '
                    ;
        }
            else{
                echo "0 results";
            }
        }
        // START PDF COMPILE
        // else{
        //     $mpdf = new mPDF('UTF-8');
        //     $stylesheet = file_get_contents('styles.css');
        //     $mpdf->WriteHTML($stylesheet,1);
        //     $mpdf->autoScriptToLang = true;
        //     $mpdf->baseScript = 1;
        //     $mpdf->autoLangToFont = true;
        //     $mpdf->WriteHTML('
        //             <div class="box">
        //             <p>
        //             <img src="'.$target_frontCover.'" />
        //             </p>
        //             </div>
        //             ');

        //     $mpdf->addPage();
        //     $mpdf->addPage();


        //     $html_front = file_get_contents($target_frontPage);
        //     $mpdf->WriteHTML($html_front);

        //     $mpdf->addPage();
        //     $mpdf->addPage();

        //      if(isset($table_of_contents) && $table_of_contents == true){

        //             // Print table of contents
        //             $sql = "SELECT dance_id, dance_english_name, dance_alternate_name, dance_telugu_name, dance_category, dance_origin, dance_description, dance_image_reference, dance_video_reference, dance_key_words, dance_status, artist_images FROM dances ORDER BY dance_id";
        //             $pdf_contents = $conn->query($sql);

        //             $mpdf->WriteHTML('
        //                 <div class="col-md-12 dances_display">
        //                     <table class="compile_table" border="0" cellpadding="0" cellspacing="0">
        //                         <tr>
        //                             <th>ID</th>
        //                             <th>Thumbnail</th>
        //                             <th>English Name</th>
        //                             <th>Telegu Name</th>
        //                         </tr>
        //                         <tr>
        //                 ');

        //             if($pdf_contents ->num_rows > 0){
        //                 while($row = $pdf_contents->fetch_assoc()){
        //                     $mpdf->WriteHTML(
        //                         '<tr class="compile_rows">
        //                             <td>'. $row["dance_id"] .'</td>
        //                             <td>');

        //                              if ($row["artist_images"] != ""){
        //                                 if(isset($artist_images_set) && $artist_images_set == TRUE){
        //                                 $ext_array = explode(',', $row["artist_images"]);   // Explode file name from comma
        //                                 $mpdf->WriteHTML( '<img src="'.$ext_array[0].'" height="100px" width="100px">' );
        //                                 }
        //                                 else{
        //                                 $mpdf->WriteHTML( '<img src="assets/images/100x100.png" height="100px" width="100px"> ');
        //                                 }
        //                             }
        //                             else if ($row["dance_image_reference"] != ""){
        //                                 if (isset($internet_images_set) && $internet_images_set == TRUE){
        //                                 $exp_array = explode(',', $row["dance_image_reference"]);
        //                                 $mpdf->WriteHTML( '<img src="'.$exp_array[0].'" height="100px" width="100px"> ');
        //                                 }
        //                                 else{
        //                                 $mpdf->WriteHTML( '<img src="assets/images/100x100.png" height="100px" width="100px"> ');
        //                                 }
        //                             }
        //                             else{
        //                                 $mpdf->WriteHTML( '<img src="assets/images/100x100.png" height="100px" width="100px"> ');
        //                             }


        //                     $mpdf->WriteHTML('
        //                             </td>
        //                             <td>'. $row["dance_english_name"] .'</td>
        //                             <td>'. $row["dance_telugu_name"] .'</td>
        //                         </tr>'
        //                         );
        //                 }
        //             }

        //             $mpdf->WriteHTML('</table>
        //                 </div>');
        //     }

        //     $mpdf->addPage();
        //     $mpdf->addPage();

        //      if ($result->num_rows > 0) {
        //             while($row = $result->fetch_assoc()) {
        //         // Grab dance ID
        //         $dance_id = $row["dance_id"];
        //   //    $dance_english_name = $_row["dance_english_name"];
        //         // $dance_alternate_name = $_row["dance_alternate_name"];
        //         // $dance_telugu_name = $_row["dance_telugu_name"];
        //         // $dance_category = $_row["dance_category"];
        //         // $dance_origin = $_row["dance_origin"];
        //         // $dance_description = $_row["dance_description"];
        //         // $dance_image_reference = $_row["dance_image_reference"];
        //         // $dance_video_reference = $_row["dance_video_reference"];
        //         // $dance_key_words = $_row["dance_key_words"];

        //         $image_reference_array = explode(',', $row["dance_image_reference"]);
        //         $video_reference_array = explode(',', $row["dance_video_reference"]);
        //         $artist_reference_array = explode(',', $row["artist_images"]);

        //         $mpdf->writeHTML('
        //             <div class="col-md-12 dances_display">
        //             <div class="dance_display_description">
        //             <div class="dance_display_description_row1">
        //                 <div class="wrapper" style="float:left; width:100px; padding:10px;">
        //                     <div class="dance_id"><div>
        //                     <!-- Dance ID -->
        //                     '. $row['dance_id'].'
        //                     </div></div>
        //                 </div>
        //                 <div class="wrapper_pdf" style="float:left; width:500px; height:60px; padding-top:30px 0 0 0;">
        //                     <p class="dance_english_name" style="font-size:26px; line-height:30px; text-align:center;">
        //                     <!-- Dance Name in English Input -->
        //                     '. $row['dance_english_name'].'
        //                     </p>
        //                     <p class="dance_telugu_name" style="font-size:26px; line-height:30px; text-align:center;">
        //                     <!-- Dance Name in Telugu Input --> 
        //                     '. $row['dance_telugu_name'].'
        //                     </p>
        //                 </div>
        //             </div>
        //             <table class="dance_display_description_row2" border="0" cellpadding="0" cellspacing="0">
        //                 <tr>
        //                     <td align="center" class="dance_origin" style="border-right:1px solid black; padding:10px 0;">
        //                     <!-- Dance Origin Input -->
        //                     Origin: 
        //                     '. $row['dance_origin'].'
        //                     </td>
        //                     <td align="center" class="dance_category" style="padding:10px 0;">
        //                     <!-- Dance Category Input -->
        //                     Category: 
        //                     '. $row['dance_category'].'
        //                     </td>
        //                 </tr>
        //             </table>
        //             <div class="dance_display_description_row3" style="text-align:center; padding:10px 0;">
        //             <p class="dance_alternate_name">
        //             Alternate Names: 
        //             '. $row['dance_alternate_name'].'
        //             </p>
        //             </div>
        //             </div>');

        //             $mpdf->writeHTML('
        //             <table border="0" cellpadding="0" cellspacing="0" width="100%">
        //             <tr><td align="center" style="padding:10px 0 0;">
        //             ');

        //             if($artist_reference_array[0] != ""){
        //                 if(isset($artist_images_set) && $artist_images_set == TRUE){
        //                     if($artist_radio_set == "first"){
        //                         $mpdf->writeHTML('<img src="' . $artist_reference_array[0]. '" width="500" height="400" style="padding-bottom:10px; margin:0 auto; display:block;">
        //                         ');
        //                     }
        //                     else{
        //                          for ($i = 0; $i < sizeof($artist_reference_array); $i++){
        //                          $mpdf->writeHTML('<img src="' . $artist_reference_array[$i]. '" width="500" height="400" style="padding-bottom:10px; margin:0 auto; display:block;">
        //                          ');
        //                          }
        //                     }
        //                 }
        //             }

        //              if($image_reference_array[0] != ""){
        //                 if (isset($internet_images_set) && $internet_images_set == TRUE){
        //                     if($internet_radio_set == "first"){
        //                         $mpdf->writeHTML('<img src="' . $image_reference_array[0]. '" width="500" height="400" style="padding-bottom:10px; margin:0 auto; display:block;">
        //                         ');
        //                     }
        //                     else{
        //                          for ($i = 0; $i < sizeof($image_reference_array); $i++){
        //                          $mpdf->WriteHTML('<img src="' . $image_reference_array[$i]. '" width="500" height="400" style="padding-bottom:10px; margin:0 auto; display:block;">
        //                          ');
        //                          }
        //                     }
        //                 }
        //             }

        //             if($artist_reference_array[0] == "" && $image_reference_array[0] ==""){
        //                 $mpdf->writeHTML('<img src="assets/images/500x400.png" width="500" height="400" style="padding-bottom:10px; margin:0 auto; display:block;">
        //                          ');
        //             }

        //             $mpdf->writeHTML('
        //                 </td></tr>
        //             </table>
        //             ');
                    
        //             $dance_spacing = nl2br($row["dance_description"]);
        //             $mpdf->writeHTML('<br>');
        //             $mpdf->writeHTML($dance_spacing);

        //             $mpdf->addPage();

        //             }
        //      }

        //     $mpdf->addPage();

        //     $html_back = file_get_contents($target_backPage);
        //     $mpdf->WriteHTML($html_back);

        //     $mpdf->addPage();
        //     $mpdf->addPage();

        //      $mpdf->WriteHTML('
        //         <div class="box">
        //         <p>
        //         <center>
        //             <img src="'.$target_backCover.'" />
        //         </center>
        //         <p>
        //         </div>
        //         ');

        //     $mpdf->Output();
        // }

} // End if statement of user session

         
}
}
?>
</body>
</html>
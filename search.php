<?php include 'navigation.php';
require_once('db_configuration.php');

if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>

<div id="search_menu">
<?php
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

    $sql = "SELECT dance_id, dance_english_name, dance_telugu_name, dance_alternate_name FROM dances";
    $result = $conn->query($sql);

    if(isset($_POST['searchData'])){
         $searchData = $_POST['searchData'];
    }
    if(isset($_POST['searchButton'])){
         $searchButton = $_POST['searchButton'];
    }

    //Sort Status
    $field = "dance_id";
    $sort = "ASC";
    

    if(isset($_GET['sort']))
    {
      if($_GET['sort']=='ASC')
      {
      $sort='DESC';
      }
      else { $sort='ASC'; }
    }
    if(isset($_GET['field'])){
        if($_GET['field']=='dance_id')
    { 
        $field = "dance_id";  
    }
        elseif($_GET['field']=='dance_english_name')
        {
           $field = "dance_english_name"; 
        }
        elseif($_GET['field']=='dance_telugu_name')
        { 
           $field="dance_telugu_name"; 
        }
    }

    if(isset($_GET['searchParam'])){
        $searchParam = $_GET['searchParam'];
    }
    else{
        $searchParam = "";
    }

    if(isset($_GET['update'])){
        $update = $_GET['update'];
        echo '<b>Update successful!</b><br><br>';
    }
    else{
        $update = "";
    }
    
        // String to search
        if(isset($_POST['searchData'])){
        $searchData = trim($_POST['searchData']);
        $searchParam = $searchData;
        }
        

        // String URL for looking through html docs
        $searchURL;

    
         if (!empty($searchData)){

                $sql = "SELECT dance_id, dance_english_name, dance_telugu_name, dance_alternate_name, dance_origin, dance_key_words, dance_category, dance_status, dance_image_reference, dance_video_reference, artist_images, links, dance_description from dances WHERE dance_english_name LIKE '%$searchData%'
                UNION
                SELECT dance_id, dance_english_name, dance_telugu_name, dance_alternate_name, dance_origin, dance_key_words, dance_category, dance_status, dance_image_reference, dance_video_reference, artist_images, links, dance_description from dances WHERE dance_telugu_name LIKE '%$searchData%'
                UNION
                SELECT dance_id, dance_english_name, dance_telugu_name, dance_alternate_name, dance_origin, dance_key_words, dance_category, dance_status, dance_image_reference, dance_video_reference, artist_images, links, dance_description from dances WHERE dance_alternate_name LIKE '%$searchData%' 
                UNION
                SELECT dance_id, dance_english_name, dance_telugu_name, dance_alternate_name, dance_origin, dance_key_words, dance_category, dance_status, dance_image_reference, dance_video_reference, artist_images, links, dance_description from dances WHERE dance_origin LIKE '%$searchData%'
                UNION
                SELECT dance_id, dance_english_name, dance_telugu_name, dance_alternate_name, dance_origin, dance_key_words, dance_category, dance_status, dance_image_reference, dance_video_reference, artist_images, links, dance_description from dances WHERE dance_key_words LIKE '%$searchData%' 
                UNION
                SELECT dance_id, dance_english_name, dance_telugu_name, dance_alternate_name, dance_origin, dance_key_words, dance_category, dance_status, dance_image_reference, dance_video_reference, artist_images, links, dance_description from dances WHERE dance_category LIKE '%$searchData%' 
                UNION
                SELECT dance_id, dance_english_name, dance_telugu_name, dance_alternate_name, dance_origin, dance_key_words, dance_category, dance_status, dance_image_reference, dance_video_reference, artist_images, links, dance_description from dances WHERE dance_id LIKE '%$searchData%' 
                UNION
                SELECT dance_id, dance_english_name, dance_telugu_name, dance_alternate_name, dance_origin, dance_key_words, dance_category, dance_status, dance_image_reference, dance_video_reference, artist_images, links, dance_description from dances WHERE dance_status LIKE '%$searchData%'
                ORDER BY $field $sort;
                ";
                $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '
            <div class="container top_space">
            <table width="100%"" border="1px">
            <tr>
            <td>
             <a href="search.php?sort='.$sort.'&field=dance_id&searchParam='.$searchParam.'">ID</a>
            ';
            if(isset($_GET['sort'])){
                if($_GET['field'] == "dance_id"){
                    if($_GET['sort'] == 'ASC'){
                    echo '<img src="assets/images/arrow_asc.png">';
                    }
                     else{
                    echo '<img src="assets/images/arrow_desc.png">';
                    }
                }
            }

            echo 
            '
            </td>
            <td>
            Thumbnail
            </td>
            <td>
            <a href="search.php?sort='.$sort.'&field=dance_english_name&searchParam='.$searchParam.'">Name (English)</a>
            ';
            if(isset($_GET['sort'])){
                if($_GET['field'] == "dance_english_name"){
                    if($_GET['sort'] == 'ASC'){
                    echo '<img src="assets/images/arrow_asc.png">';
                    }
                     else{
                    echo '<img src="assets/images/arrow_desc.png">';
                    }
                }
            }

            echo '
            </td>
            <td>
            <a href="search.php?sort='.$sort.'&field=dance_telugu_name&searchParam='.$searchParam.'">Name (Telugu)</a>
            ';
            if(isset($_GET['sort'])){
                if($_GET['field'] == "dance_telugu_name"){
                    if($_GET['sort'] == 'ASC'){
                    echo '<img src="assets/images/arrow_asc.png">';
                    }
                     else{
                    echo '<img src="assets/images/arrow_desc.png">';
                    }
                }
            }
            echo
            '
            </td>
            <td>
            <a href="search.php?sort='.$sort.'&field=dance_alternate_name&searchParam='.$searchParam.'">Other Names</a>
            ';
            if(isset($_GET['sort'])){
                if($_GET['field'] == "dance_alternate_name"){
                    if($_GET['sort'] == 'ASC'){
                    echo '<img src="assets/images/arrow_asc.png">';
                    }
                     else{
                    echo '<img src="assets/images/arrow_desc.png">';
                    }
                }
            }
            echo'
            </td>
            ';

        if(isset($_SESSION['username'])){
            echo '
            <td>
            Link
            </td>
            <td>
            Actions
            </td>
            </tr>';
        }

        while($row = $result->fetch_assoc()) {
            echo '
            <tr>
            <td>
            '.$row["dance_id"].'
            </td>
            <td>
            ';
            if ($row["artist_images"] != ""){
                $ext_array = explode(',', $row["artist_images"]);   // Explode file name from comma
                 echo '<img src="'.$ext_array[0].'" height="100px" width="100px">';
            }
            else if ($row["dance_image_reference"] != ""){
                $exp_array = explode(',', $row["dance_image_reference"]);
                echo '<img src="'.$exp_array[0].'" height="100px" width="100px">';
            }
            else{
                echo '<img src="assets/images/100x100.png" height="100px" width="100px">';
            }
            echo '
            </td>
            <td>
            <a href="dances.php?id='. $row["dance_id"] .'" TITLE="'.$row["dance_description"].'">'. $row["dance_english_name"] .'</a>
            </td>
            <td>
            <a href="dances.php?id='. $row["dance_id"] .'" TITLE="'.$row["dance_description"].'">'. $row["dance_telugu_name"] .'</a>
            </td>
            <td>
            <a href="dances.php?id='. $row["dance_id"] .'" TITLE="'.$row["dance_description"].'">'. $row["dance_alternate_name"] .'</a>
            </td>';
        if(isset($_SESSION['username'])){
            echo
            '
            <td>
            ';
            
             if($row["links"] != ""){
                $link_array = explode(',', $row["links"]);
                foreach($link_array as $link){
                // $website = get_data($link);

                //     $curlSession = curl_init();
                // curl_setopt($curlSession, CURLOPT_URL, $link);
                // curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
                // curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

                // $jsonData = json_decode(curl_exec($curlSession));
                // curl_close($curlSession);

                echo '
                <a href="'. $link . '" target="_blank"">
                <img src="assets/images/red_dot.png"/>
                </a>';
                }
            }

            echo'
            </td>
            <td>
            <a href="update.php?id='. $row["dance_id"] .'"">
            <img src="assets/images/edit.png" alt="Edit" height="20" width="20" />
            </a>
            <a href="delete.php?id='. $row["dance_id"] .'">
            <img src="assets/images/delete.png" alt="Delete" height="20" width="20" />
            </a>
            </td>';
        }

        

        echo '</tr>';
        }

        echo '</table>';
        }

        else {
         echo 'No results.';
        }

            }

         else{
                if(isset($_GET['searchParam']) && $_GET['searchParam'] != ""){
                    // echo 'WORKED!!!!!!';
                $sql = "SELECT dance_id, dance_english_name, dance_telugu_name, dance_alternate_name, dance_origin, dance_key_words, dance_category, dance_status, dance_image_reference, artist_images, links, dance_description from dances WHERE dance_english_name LIKE '%$searchParam%'
                UNION
                SELECT dance_id, dance_english_name, dance_telugu_name, dance_alternate_name, dance_origin, dance_key_words, dance_category, dance_status, dance_image_reference, artist_images, links, dance_description from dances WHERE dance_telugu_name LIKE '%$searchParam%'
                UNION
                SELECT dance_id, dance_english_name, dance_telugu_name, dance_alternate_name, dance_origin, dance_key_words, dance_category, dance_status, dance_image_reference, artist_images, links, dance_description from dances WHERE dance_alternate_name LIKE '%$searchParam%' 
                UNION
                SELECT dance_id, dance_english_name, dance_telugu_name, dance_alternate_name, dance_origin, dance_key_words, dance_category, dance_status, dance_image_reference, artist_images, links, dance_description from dances WHERE dance_origin LIKE '%$searchParam%'
                UNION
                SELECT dance_id, dance_english_name, dance_telugu_name, dance_alternate_name, dance_origin, dance_key_words, dance_category, dance_status, dance_image_reference, artist_images, links, dance_description from dances WHERE dance_key_words LIKE '%$searchParam%' 
                UNION
                SELECT dance_id, dance_english_name, dance_telugu_name, dance_alternate_name, dance_origin, dance_key_words, dance_category, dance_status, dance_image_reference, artist_images, links, dance_description from dances WHERE dance_category LIKE '%$searchParam%' 
                UNION
                SELECT dance_id, dance_english_name, dance_telugu_name, dance_alternate_name, dance_origin, dance_key_words, dance_category, dance_status, dance_image_reference, artist_images, links, dance_description from dances WHERE dance_status LIKE '%$searchParam%'
                ORDER BY $field $sort;
                ";
                $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '
            <div class="container top_space" style="padding-bottom: 50px">
            <table width="100%"" border="1px">
            <tr>
            <td>
             <a href="search.php?sort='.$sort.'&field=dance_id&searchParam='.$searchParam.'">ID</a>
            ';
            if(isset($_GET['sort'])){
                if($_GET['field'] == "dance_id"){
                    if($_GET['sort'] == 'ASC'){
                    echo '<img src="assets/images/arrow_asc.png">';
                    }
                     else{
                    echo '<img src="assets/images/arrow_desc.png">';
                    }
                }
            }

            echo 
            '
            </td>
            <td>
            Thumbnail
            </td>
            <td>
            <a href="search.php?sort='.$sort.'&field=dance_english_name&searchParam='.$searchParam.'">Name (English)</a>
            ';
            if(isset($_GET['sort'])){
                if($_GET['field'] == "dance_english_name"){
                    if($_GET['sort'] == 'ASC'){
                    echo '<img src="assets/images/arrow_asc.png">';
                    }
                     else{
                    echo '<img src="assets/images/arrow_desc.png">';
                    }
                }
            }

            echo '
            </td>
            <td>
            <a href="search.php?sort='.$sort.'&field=dance_telugu_name&searchParam='.$searchParam.'">Name (Telugu)</a>
            ';
            if(isset($_GET['sort'])){
                if($_GET['field'] == "dance_telugu_name"){
                    if($_GET['sort'] == 'ASC'){
                    echo '<img src="assets/images/arrow_asc.png">';
                    }
                     else{
                    echo '<img src="assets/images/arrow_desc.png">';
                    }
                }
            }
            echo
            '
            </td>
            <td>
            <a href="search.php?sort='.$sort.'&field=dance_alternate_name&searchParam='.$searchParam.'">Other Names</a>
            ';
            if(isset($_GET['sort'])){
                if($_GET['field'] == "dance_alternate_name"){
                    if($_GET['sort'] == 'ASC'){
                    echo '<img src="assets/images/arrow_asc.png">';
                    }
                     else{
                    echo '<img src="assets/images/arrow_desc.png">';
                    }
                }
            }
            echo'
            </td>
            ';

        if(isset($_SESSION['username'])){
            echo '
            <td>
            Link
            </td>
            <td>
            Actions
            </td>
            </tr>';
        }

        while($row = $result->fetch_assoc()) {
            echo '
            <tr>
            <td>
            '.$row["dance_id"].'
            </td>
            <td>
            ';
            if ($row["artist_images"] != ""){
                $ext_array = explode(',', $row["artist_images"]);   // Explode file name from comma
                 echo '<img src="'.$ext_array[0].'" height="100px" width="100px">';
            }
            else if ($row["dance_image_reference"] != ""){
                $exp_array = explode(',', $row["dance_image_reference"]);
                echo '<img src="'.$exp_array[0].'" height="100px" width="100px">';
            }
            else{
                echo '<img src="assets/images/100x100.png" height="100px" width="100px">';
            }
            echo '
            </td>
            <td>
            <a href="dances.php?id='. $row["dance_id"] .'" TITLE="'.$row["dance_description"].'">'. $row["dance_english_name"] .'</a>
            </td>
            <td>
            <a href="dances.php?id='. $row["dance_id"] .'" TITLE="'.$row["dance_description"].'">'. $row["dance_telugu_name"] .'</a>
            </td>
            <td>
            <a href="dances.php?id='. $row["dance_id"] .'" TITLE="'.$row["dance_description"].'">'. $row["dance_alternate_name"] .'</a>
            </td>';
        if(isset($_SESSION['username'])){
            echo
            '
            <td>
            ';
            
             if($row["links"] != ""){
                $link_array = explode(',', $row["links"]);
                foreach($link_array as $link){
                // $website = get_data($link);

                //     $curlSession = curl_init();
                // curl_setopt($curlSession, CURLOPT_URL, $link);
                // curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
                // curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

                // $jsonData = json_decode(curl_exec($curlSession));
                // curl_close($curlSession);

                echo '
                <a href="'. $link . '" target="_blank"">
                <img src="assets/images/red_dot.png"/>
                </a>';
                }
            }

            echo'
            </td>
            <td>
            <a href="update.php?id='. $row["dance_id"] .'"">
            <img src="assets/images/edit.png" alt="Edit" height="20" width="20" />
            </a>
            <a href="delete.php?id='. $row["dance_id"] .'">
            <img src="assets/images/delete.png" alt="Delete" height="20" width="20" />
            </a>
            </td>';
        }

        

        echo '</tr>';
        }

        echo '</table>';
        }

        else {
         echo 'No results.';
        }
    }

            else{
            $sql = "SELECT dance_id, dance_english_name, dance_telugu_name, dance_alternate_name, dance_origin, dance_key_words, dance_category, dance_status, dance_image_reference, dance_video_reference, artist_images, links, dance_description FROM dances ORDER BY $field $sort;";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
            echo '
            <div class="container top_space" style="padding-top: 100px">
            <table width="100%"" border="1px">
            <tr>
            <td>
             <a href="search.php?sort='.$sort.'&field=dance_id">ID</a>
            ';
            if(isset($_GET['sort'])){
                if($_GET['field'] == "dance_id"){
                    if($_GET['sort'] == 'ASC'){
                    echo '<img src="assets/images/arrow_asc.png">';
                    }
                     else{
                    echo '<img src="assets/images/arrow_desc.png">';
                    }
                }
            }

            echo 
            '
            </td>
            <td>
            Thumbnail
            </td>
            <td>
            <a href="search.php?sort='.$sort.'&field=dance_english_name">Name (English)</a>
            ';
            if(isset($_GET['sort'])){
                if($_GET['field'] == "dance_english_name"){
                    if($_GET['sort'] == 'ASC'){
                    echo '<img src="assets/images/arrow_asc.png">';
                    }
                     else{
                    echo '<img src="assets/images/arrow_desc.png">';
                    }
                }
            }

            echo '
            </td>
            <td>
            <a href="search.php?sort='.$sort.'&field=dance_telugu_name">Name (Telugu)</a>
            ';
            if(isset($_GET['sort'])){
                if($_GET['field'] == "dance_telugu_name"){
                    if($_GET['sort'] == 'ASC'){
                    echo '<img src="assets/images/arrow_asc.png">';
                    }
                     else{
                    echo '<img src="assets/images/arrow_desc.png">';
                    }
                }
            }
            echo
            '
            </td>
            <td>
            <a href="search.php?sort='.$sort.'&field=dance_alternate_name">Other Names</a>
            ';
            if(isset($_GET['sort'])){
                if($_GET['field'] == "dance_alternate_name"){
                    if($_GET['sort'] == 'ASC'){
                    echo '<img src="assets/images/arrow_asc.png">';
                    }
                     else{
                    echo '<img src="assets/images/arrow_desc.png">';
                    }
                }
            }
            echo'
            </td>
            ';

            if(isset($_SESSION['username'])){
            echo '
            <td>
            Link
            </td>
            <td>
            Actions
            </td>
            </tr>';
            }

            while($row = $result->fetch_assoc()) {
            echo '
            <tr>
            <td>
            <a href="dances.php?id='. $row["dance_id"] .'" TITLE="'.$row["dance_description"].'">'. $row["dance_id"] .'</a>
            </td>
            <td>
            ';
            if ($row["artist_images"] != ""){
                $ext_array = explode(',', $row["artist_images"]);   // Explode file name from comma
                 echo '<img src="'.$ext_array[0].'" height="100px" width="100px">';
            }
            else if ($row["dance_image_reference"] != ""){
                $exp_array = explode(',', $row["dance_image_reference"]);
                echo '<img src="'.$exp_array[0].'" height="100px" width="100px">';
            }
            else{
                echo '<img src="assets/images/100x100.png" height="100px" width="100px">';
            }
            echo '
            <img src=""/>
            </td>
            <td>
            <a href="dances.php?id='. $row["dance_id"] .'" TITLE="'.$row["dance_description"].'">'. $row["dance_english_name"] .'</a>
            </td>
            <td>
            <a href="dances.php?id='. $row["dance_id"] .'" TITLE="'.$row["dance_description"].'">'. $row["dance_telugu_name"] .'</a>
            </td>
            <td>
            <a href="dances.php?id='. $row["dance_id"] .'" TITLE="'.$row["dance_description"].'">'. $row["dance_alternate_name"] .'</a>
            </td>';
            if(isset($_SESSION['username'])){
            echo
            '<td>
            <table>
            <tr>
            <td>
             ';
            // for ($i = 0; $i < sizeof($link_array); $i++){
            //     echo '<a href="'. $link_array[$i] . '"/>LINK </a>';
            // }
            if($row["links"] != ""){
                $link_array = explode(',', $row["links"]);
                foreach($link_array as $link){
                // $website = get_data($link);

                // $curlSession = curl_init();
                // curl_setopt($curlSession, CURLOPT_URL, $link);
                // curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
                // curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

                // $jsonData = json_decode(curl_exec($curlSession));
                // curl_close($curlSession);

                echo '
                <a href="'. $link . '" target="_blank"">
                <img src="assets/images/red_dot.png"/>
                </a>';
                }
            }

            echo '
            </td>
            </tr>
            <tr>
            <td>
            ';

            if($row["artist_images"] != ""){
                $artist_array = explode(',', $row["artist_images"]);   // Explode file name from comma
                foreach($artist_array as $artist_image){

                echo '
                <a href="'. $artist_image . '" target="_blank"">
                <img src="assets/images/blue_dot.png"/>
                </a>';
                }
            }

            if($row["dance_image_reference"] != ""){
                $image_array = explode(',', $row["artist_images"]);   // Explode file name from comma
                foreach($image_array as $image_reference){

                echo '
                <a href="'. $image_reference . '" target="_blank"">
                <img src="assets/images/blue_dot.png"/>
                </a>';
                }
            }

            echo '
            </td>
            </tr>
            <tr>
            <td>
            ';
        

            if($row["dance_video_reference"] != ""){
                $video_array = explode(',', $row["dance_image_reference"]);   // Explode file name from comma
                foreach($video_array as $video_reference){

                echo '
                <a href="'. $video_reference . '" target="_blank"">
                <img src="assets/images/green_dot.png"/>
                </a>';
                }
            }

             echo '
            </td>
            </tr>
            ';

            echo'
            </table>
            </td>
            <td>
            <a href="update.php?id='. $row["dance_id"] .'"">
            <img src="assets/images/edit.png" alt="Edit" height="30" width="30" />
            </a>
            <a href="delete.php?id='. $row["dance_id"] .'">
            <img src="assets/images/delete.png" alt="Delete" height="30" width="30" />
            </a>
            </td>';
            }
            echo '</tr>';
            }

            echo '</table>
            </div>';
            }

            else {
            echo 'No results.';
            }
        }
    }

    

?>


</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">

    function sortEnglishAscending() {
      $('#left_menu').load('sort_english_ascending.php?id=');
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
</script>

<footer>
<?php include 'footer.php'; ?>
</footer>
</body>
</html>

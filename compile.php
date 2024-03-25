<?php include 'navigation.php';
require_once('db_configuration.php');

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

	// $sql = "SELECT login_id, username, password FROM login";
	// $result = $conn->query($sql);

if(isset($_SESSION['username'])){
	// if ($result->num_rows > 0) {
		echo '
        <div class="container top_space">
        <h3>What would you like to compile?</h3>
        <form action="compile_results.php" method="post" target="_blank" enctype="multipart/form-data">
            <input type="checkbox" name="submitted" id="submitted" value="Submitted" checked>Submitted<br>
            <input type="checkbox" name="selected" id="selected" value="Selected" checked>Selected<br>
            <input type="checkbox" name="in_progress" id="in_progress" value="In Progress" checked>In Progress<br>
            <input type="checkbox" name="done" id="done" value="Done" checked>Done<br>
        <h3>What images would you like to include in the book?</h3>
            <input type="checkbox" name="internet_images" value="Internet Images" checked>Internet Images
                <input type="radio" name="internet_radio" value="First Image" checked>First Image
                <input type="radio" name="internet_radio" value="All Images">All Images
            <br>
            <input type="checkbox" name="artist_images" value="Artist Images" checked>Artist Images
                <input type="radio" name="artist_radio" value="First Image" checked>First Image
                <input type="radio" name="artist_radio" value="All Images">All Images
            <br>
            
        
        <h3>Generate Table of Contents</h3>
            <input type="checkbox" name="table_of_contents" value="Table of Contents" checked>Yes
            <br>
            <br>
            Front Cover: <input type="file" name="upload[]" id="upload[]" />
            <br>
            Front Pages: <input type="file" name="upload[]" id="upload[]" />
            <br>
            Back Pages: <input type="file" name="upload[]" id="upload[]" />
            <br>
            Back Cover: <input type="file" name="upload[]" id="upload[]" />
            <br>
            <input type="submit" value="Show the compilation" name="submit">
        </form>
        ';

    // while($row = $result->fetch_assoc()) {
    // 	echo "
    // 	<tr>
    // 	<td>
    // 	". $row["login_id"]."
    // 	</td>
    // 	<td>
    // 	". $row["username"]."
    // 	</td>
    // 	<td>
    // 	". $row["password"]."
    // 	</td>
    // 	<td>
    // 	<a href='edit_admin.php?id=". $row["login_id"] ."'>Edit</a>
    // 	<a href='delete_admin.php?id=". $row["login_id"] ."'>Delete</a>
    // 	</td>
    // 	</tr>
    // 	";
    // 	}

    	echo '</table>
        </div>';
// }

//     else{
//     	echo "0 results";
//     }

	}

else {
echo "<b>Only admins can compile.</b>";
}

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
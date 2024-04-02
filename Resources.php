<?php include 'navigation.php';

    if (!isset($_SESSION)) {
        session_start();
    }

    $conn = new mysqli("localhost", "root", "", "tandana_db");
    if ($conn->connect_error) {
        die('Connect Error (' . $conn->connect_errno . ') ' . $conn->connect_error);
    }                   
?>

<!DOCTYPE html>
<html>
<head>
  <title>Resources</title>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/2.0.0/js/dataTables.min.js"></script>

  <style type="text/css">
    .link {
      position:relative; 
      top:700px;
    }
    li a:hover{
      background-color:green;
    }
    .thumbnail_wrapper:hover{
        transform: scale(1.15);
    }
    .caption{
        background-color: #0a244d !important; 
    }
    p{
        color:white;
    }
    .responsive {
        max-width: 100%;
        height: auto;
    }
    .navigation-container  {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        background: #cccccc;
        position: relative;
    }
  </style>
</head>
<body>
  <div>
  <form method='get'>
    <?PHP
    require_once('db_configuration.php');
    ?>        
  </form>
  </div>
  <button class="centered-button" onclick="window.location.href='create_resources.php';">Create A Resource</button>
    <style>
    .centered-button {
        background-color: #3953ad; 
        color: white; 
        padding: 10px 20px; /
        border: none; 
        border-radius: 5px; 
        margin-top: 20px; 
        display: block; 
        margin-left: auto; 
        margin-right: auto; 
        cursor: pointer; 
        text-align: center; 
    }
    .centered-button:hover {
        background-color: #45a049; 
    }
    </style>

  <div>
        <table id="artist_table" class="display" style="width:100%">
            <thead>
                <tr>
                        <th>ID</th>
                        <th>Resource Type</th>
                        <th>Resource Name</th>
                        <th>Resource Location</th>
                        <th>ISBN</th>
                        <th>Publication Date</th>
                        <th>Author Name</th>
                        <th>Publication Company</th>
                        <th>Author2 Name</th>
                        <th>Author3 Name</th>
                        <?php if (isset($_SESSION['username'])): ?>
                            <th>ACTIONS</th>
                        <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                    //check if the starting row variable was passed in the URL or not
                    if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) {
                      //we give the value of the starting row to 0 because nothing was found in URL
                      $startrow = 0;
                    //otherwise we take the value from the URL
                    } else {
                      $startrow = (int)$_GET['startrow'];
                    }
                    $fetch = mysqli_query($conn, "SELECT * FROM Resources") or die(mysqli_error($conn));
                    $num = Mysqli_num_rows($fetch);

                    if ($num > 0) {
                        while ($row = mysqli_fetch_row($fetch)) {
                            echo "<tr>";
                            foreach ($row as $value) {
                                echo "<td>$value</td>";
                            }
                            if (isset($_SESSION['username'])) {
                                echo '<td><a href="update_artists.php?id=' . $row[0] . '">Edit </a><a href="delete_artist.php?id=' . $row[0] . '">Delete</a></td>';
                            }
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='13'>No artists found.</td></tr>";
                    }
                    ?>
            </tbody>
        </table>
    </div>
    <footer>
        <?php include 'footer.php'; ?>
    </footer>
    <script>
        $(document).ready(function() {
            $('#artist_table').DataTable({
                "pageLength": 10
            });
        });
    </script>
</body>
</html>
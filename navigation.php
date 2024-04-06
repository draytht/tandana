<?php
session_start();
require 'configure.php';
$header_image = header_image;
?>
<!DOCTYPE html>
<html>

<head>
  <!-- <title>Dances</title> -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="styles.css">
  <style type="text/css">
    li a:hover {
      background-color: green;
    }

    .thumbnail_wrapper:hover {
      transform: scale(1.15);
    }

    .caption {
      background-color: #0a244d !important;
    }

    p {
      color: white;
    }
  </style>
</head>

<body>
  <div class="masthead_wrapper" style="height: 322px;">
    <div class="masthead">
      <?php echo '
  <img src="assets/images/' . $header_image . '" width="100%" height="272" id="header_image"/>
  ';
      ?>
    </div>
    <div>
      <nav class="navbar navbar-default">
        <script>
          var image_width = document.getElementById('header_image').offsetWidth;
        </script>
        <div class="container-fluid container">
          <!--       <div class="navbar-header">
        <a class="navbar-brand" href="index.php">Dances</a>
      </div> -->
          <ul class="nav navbar-nav">
            <li class="page_index active"><a class="menubar" href="index.php">Home</a></li>
            <li class="page_dances"><a class="menubar" href="dances.php">Dances</a></li>
            <?php
            if (isset($_SESSION['username'])) {
              echo '<li class="page_admin"><a href="admin_commands.php">Admin</a></li>';
            }
            ?>
            <li class="page_artists" id=Artists><a class="menubar" href="Artists.php">Artists</a></li>
            <li>
              <form method="post" action="search.php">
                <input type="text" name="searchData" placeholder="Search..">
                <input class="page_submit" type="submit" name="searchButton" value="Search" />
              </form>
            </li>
            <!-- <li class="page_resources"><a class ="menubar" href="Resources.php">Resources</a></li> -->
            <li class="filter"><a class="menubar" href="filter.php">Filter</a></li>
            <li class="settings"><a class="menubar" href="settings.php">Settings</a></li>
            <!-- <li class="create_form"><a class ="menubar" href="create.php">Create A New Dance</a></li> -->
            <li class="dance_form"><a class="menubar" href="dancesuggested.php">Suggested Dances</a></li>
            <li class="dance_form"><a class="menubar" href="api_documentation.php">API</a></li>

          </ul>
          <ul class="nav navbar-nav float_right">
            <?php
            if (isset($_SESSION['username'])) {
              echo "<li><a href='logout.php'>Logout</a></li>";
            } else {
              echo '<li class="page_admin"><a class ="menubar" href="admin.php">Login</a></li>';
            }
            ?>
            <li><a href="about.php"><img src="assets/images/about.png" style=" width: 18px; height: 18px;"></a></li>
          </ul>
        </div>
      </nav>
    </div>
  </div>
<?php 
require_once('db_configuration.php');

// Handle the POST request from the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $country = $_POST['country'] ?? '';
    $state = $_POST['state'] ?? '';
    $description = $_POST['description'] ?? '';
    $references = $_POST['references'] ?? '';

    // Create connection
    $conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO dances (dance_english_name, dance_origin, dance_key_words, dance_description, dance_image_reference, dance_status) VALUES (?, ?, ?, ?, ?, 'draft')");
    $stmt->bind_param("sssss", $name, $country, $state, $description, $references);

    // Execute and close
    $stmt->execute();
    $stmt->close();
    $conn->close();

    echo "<p>Suggestion submitted successfully!</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Suggest a Dance</title>
    <style>
        #navigation {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000; 
            background-color: #fff; 
            height: 100px; 
        }

        body {
            padding-top: 100px; 
            margin: 0;
            font-family: Arial, sans-serif;
        }
        textarea {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            line-height: 1.5; 
        }
        textarea    {
		height: 100px;
		width: 600px;
	    }
        button[type='submit'] {
            padding: 10px 20px;
            background-color: #0056b3;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button[type='submit']:hover {
            background-color: #00ffff; 
        }

        #form-container {
            margin-top: 300px; 
            padding: 20px;
        }

        label {
            display: flex;
            flex-direction: column;
            gap: 5px; 
            color: black;
        }

        .text {
        color: black;
        }
        


    </style>
</head>
<body>
    <div id="navigation">
        <?php include 'navigation.php'; ?>
    </div>

    <div id="form-container">
        <h1>Suggest a Dance</h1>
        <form action="suggest_dance.php" method="POST">
            
            <label class="text" for="name">Dance Name:</label><br>
            <input rows="5" cols="40" type="text" id="name" name="name" required><br>

            <label class="text" for="country">Country:</label><br>
            <input rows="5" cols="40" type="text" id="country" name="country" required><br>

            <label class="text" for="state">State:</label><br>
            <input rows="5" cols="40" type="text" id="state" name="state"><br>

            <label class="text" for="description">Brief Description:</label><br>
            <textarea rows="5" cols="40" id="description" name="description" required></textarea><br>

            <label class="text" for="references">References:</label><br>
            <textarea rows="5" cols="40" id="references" name="references"></textarea><br><br>

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>

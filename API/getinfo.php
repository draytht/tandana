<?php

require_once('../db_configuration.php');

$servername = DATABASE_HOST;
$db_username = DATABASE_USER;
$db_password = DATABASE_PASSWORD;
$database = DATABASE_DATABASE;

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $database);
if (isset($_GET['id'])) {
    $query = 'SELECT * FROM dances WHERE dance_id=' . $_GET["id"] . '';
    $run = mysqli_query($conn, $query);
    if ($run) {
        if (mysqli_num_rows($run)) {
            $response = mysqli_fetch_all($run, MYSQLI_ASSOC);

            $data = [
                'response_code' => 200,
                'message' => 'Found Data Successfully',
                'data' => $response[0],
            ];

            header('HTTP/1.0 200 OK');
            header('Content-Type: application/json');
            echo json_encode($data, JSON_PRETTY_PRINT);
        } else {
            $data = [
                'response_code' => 404,
                'message' => 'No Record Found',
            ];

            header('HTTP/1.0 404 No Record Found');
            header('Content-Type: application/json');
            echo json_encode($data, JSON_PRETTY_PRINT);
        }
    } else {
        $data = [
            'response_code' => 500,
            'message' => 'Internal Server Error',
        ];

        header('HTTP/1.0 500 Internal Server Error');
        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
} else {
    $data = [
        'response_code' => 400,
        'message' => 'Required Parameter Missing',
    ];

    header('HTTP/1.0 400 Required Parameter Missing');
    header('Content-Type: application/json');
    echo json_encode($data, JSON_PRETTY_PRINT);
}

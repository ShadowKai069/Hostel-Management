<?php
define('SECURE_INCLUDE', true);
include 'db.php';

if (isset($_GET['first_name'])) {
    $first_name = mysqli_real_escape_string($conn, $_GET['first_name']);

    $query = "SELECT middle_name, last_name, token_no FROM students WHERE first_name = '$first_name' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        echo json_encode($data);
    } else {
        echo json_encode(["error" => "No data found"]);
    }
} else {
    echo json_encode(["error" => "Invalid request"]);
}
?>


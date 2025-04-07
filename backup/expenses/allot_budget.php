<?php
// Database connection
define('SECURE_INCLUDE', true);
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $month = $_POST['month'];
    $total_budget = $_POST['total_budget'];

    if (empty($month) || empty($total_budget)) {
        echo json_encode(["message" => "All fields are required"]);
        exit;
    }

    // Check if budget already exists
    $query = "INSERT INTO budgets (month, total_budget) VALUES ('$month', '$total_budget')
              ON DUPLICATE KEY UPDATE total_budget = '$total_budget'";

    if (mysqli_query($conn, $query)) {
        echo json_encode(["message" => "Budget allocated successfully"]);
    } else {
        echo json_encode(["message" => "Error: " . mysqli_error($conn)]);
    }
}
?>

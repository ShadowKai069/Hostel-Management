<?php
// Database connection
define('SECURE_INCLUDE', true);
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    if (empty($id)) {
        echo json_encode(["message" => "Expense ID required"]);
        exit;
    }

    $query = "DELETE FROM expenses WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        echo json_encode(["message" => "Expense removed successfully"]);
    } else {
        echo json_encode(["message" => "Error: " . mysqli_error($conn)]);
    }
}
?>

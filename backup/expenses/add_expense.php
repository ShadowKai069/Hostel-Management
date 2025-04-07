<?php
// Database connection
define('SECURE_INCLUDE', true);
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $month = $_POST['month'];
    $category = $_POST['category'];
    $amount = $_POST['amount'];

    if (empty($month) || empty($category) || empty($amount)) {
        echo json_encode(["message" => "All fields are required"]);
        exit;
    }

    // Check if budget exists for the selected month
    $budgetCheckQuery = "SELECT total_budget FROM budgets WHERE month = '$month'";
    $budgetCheckResult = mysqli_query($conn, $budgetCheckQuery);

    if (mysqli_num_rows($budgetCheckResult) == 0) {
        echo json_encode(["message" => "Please allot a budget before adding expenses."]);
        exit;
    }

    $query = "INSERT INTO expenses (month, category, amount) VALUES ('$month', '$category', '$amount')";

    if (mysqli_query($conn, $query)) {
        echo json_encode(["message" => "Expense added successfully"]);
    } else {
        echo json_encode(["message" => "Error: " . mysqli_error($conn)]);
    }
}
?>


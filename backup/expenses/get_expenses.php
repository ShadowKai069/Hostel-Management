<?php
// Database connection
define('SECURE_INCLUDE', true);
include 'db.php';

$month = $_GET['month'];

$response = [
    "total_budget" => 0,
    "total_spent" => 0,
    "remaining_balance" => 0,
    "expenses" => []
];

// Fetch budget for the month
$budgetQuery = "SELECT total_budget FROM budgets WHERE month = '$month'";
$budgetResult = mysqli_query($conn, $budgetQuery);
if ($budgetRow = mysqli_fetch_assoc($budgetResult)) {
    $response["total_budget"] = (float)$budgetRow["total_budget"];
}

// Fetch expenses for the month
$expenseQuery = "SELECT id, month, category, amount FROM expenses WHERE month = '$month'";
$expenseResult = mysqli_query($conn, $expenseQuery);
$totalSpent = 0;

while ($expenseRow = mysqli_fetch_assoc($expenseResult)) {
    $response["expenses"][] = $expenseRow;
    $totalSpent += (float)$expenseRow["amount"];
}

// Calculate remaining balance
$response["total_spent"] = $totalSpent;
$response["remaining_balance"] = $response["total_budget"] - $totalSpent;

// Send response as JSON
echo json_encode($response);
?>

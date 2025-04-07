<?php
// Database connection
define('SECURE_INCLUDE', true);
include 'db.php';

// Fetch room details with prices
$sql = "SELECT room_no, fees_per_bed FROM rooms";
$result = $conn->query($sql);

$rooms = array();
while ($row = $result->fetch_assoc()) {
    $rooms[] = $row;
}

echo json_encode($rooms);

$conn->close();
?>

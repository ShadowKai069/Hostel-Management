<?php
// Database connection
define('SECURE_INCLUDE', true);
include 'db.php';

if (isset($_GET['room_no'])) {
    $room_no = $_GET['room_no'];
    
    $query = "SELECT total_beds FROM rooms WHERE room_no = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $room_no);
    $stmt->execute();
    $stmt->bind_result($total_beds);
    $stmt->fetch();
    $stmt->close();

    echo json_encode(["total_beds" => $total_beds]);
}
?>

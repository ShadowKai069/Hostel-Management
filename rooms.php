<?php
// Database connection
define('SECURE_INCLUDE', true);
include 'db.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_number = $_POST['room-number'];
    $total_beds = $_POST['total-beds'];
    $floor = $_POST['floor'];
    $fees_per_bed = isset($_POST['fees_per_bed']) && $_POST['fees_per_bed'] !== '' ? $_POST['fees_per_bed'] : null;
    $description = $_POST['description'];

    // Validate Fees Per Bed
    if ($fees_per_bed === '' || !is_numeric($fees_per_bed) || $fees_per_bed <= 0) {
        die("<script>alert('Error: Fees per bed is required and must be a positive number!'); window.location.href='ADD-NEW-ROOMS.html';</script>");
    }

    // Check if the room number already exists
    $check_sql = "SELECT room_no FROM rooms WHERE room_no = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $room_number);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        echo "<script>alert('Error: Room already exists!'); window.location.href='ADD-NEW-ROOMS.html';</script>";
        exit();
    }
    
    // Proceed with insertion
    $sql_room = "INSERT INTO rooms (room_no, total_beds, floor, fees_per_bed, description) 
                 VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql_room);
    $stmt->bind_param("siids", $room_number, $total_beds, $floor, $fees_per_bed, $description);

    if ($stmt->execute()) {
        $room_id = $stmt->insert_id;

        // Insert bed numbers
        $sql_bed = "INSERT INTO beds (room_id, bed_number) VALUES (?, ?)";
        $stmt_bed = $conn->prepare($sql_bed);

        for ($i = 1; $i <= $total_beds; $i++) {
            $stmt_bed->bind_param("ii", $room_id, $i);
            $stmt_bed->execute();
        }

        echo "<script>alert('Room Added Successfully'); window.location.href='dashboard.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statements and connection
    $stmt->close();
    $stmt_bed->close();
    $check_stmt->close();
    $conn->close();
}

?>

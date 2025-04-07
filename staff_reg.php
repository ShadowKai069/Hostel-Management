<?php
session_start();
// Database connection
define('SECURE_INCLUDE', true);
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Validate inputs
    $NAME = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
    $STAFF_ID = trim(filter_input(INPUT_POST, 'staff-id', FILTER_SANITIZE_STRING));
    $DESIGNATION = trim(filter_input(INPUT_POST, 'designation', FILTER_SANITIZE_STRING));
    $CONTACT = trim(filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_STRING));
    $EMAIL = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $ADDRESS = trim(filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING));
    $JOINDATE = trim(filter_input(INPUT_POST, 'joining-date', FILTER_SANITIZE_STRING));

    if (!$EMAIL) {
        die("<script>alert('Invalid email format.'); window.location.href='staff-details.html';</script>");
    }

    // File Upload Handling
    if (isset($_FILES['staff-photo']) && $_FILES['staff-photo']['error'] == 0) {
        $uploadDir = "uploads/staff/";
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        $maxFileSize = 2 * 1024 * 1024; // 2MB
        $fileTmpPath = $_FILES['staff-photo']['tmp_name'];
        $fileName = $_FILES['staff-photo']['name'];
        $fileSize = $_FILES['staff-photo']['size'];
        $fileType = mime_content_type($fileTmpPath);
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Validate file type & size
        if (!in_array($fileExt, $allowedTypes) || !in_array(explode('/', $fileType)[1], $allowedTypes)) {
            die("<script>alert('Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.'); window.location.href='staff-details.html';</script>");
        }

        if ($fileSize > $maxFileSize) {
            die("<script>alert('File size should be less than 2MB.'); window.location.href='staff-details.html';</script>");
        }

        // Rename and move file securely
        $newFileName = uniqid() . "_" . basename($fileName);
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        if (!move_uploaded_file($fileTmpPath, $uploadDir . $newFileName)) {
            die("<script>alert('File upload failed. Please try again.'); window.location.href='staff-details.html';</script>");
        }
    } else {
        die("<script>alert('No file uploaded or upload error.'); window.location.href='staff-details.html';</script>");
    }

    // Check for duplicate email
    $stmt = $conn->prepare("SELECT * FROM staff WHERE Email = ?");
    $stmt->bind_param("s", $EMAIL);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
        echo "<script>alert('This email already exists.'); window.location.href='staff-details.html';</script>";
        exit();
    }
    $stmt->close();

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO staff (Name, Staff_id, Designation, Contact, Email, Address, Join_date, staff_photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $NAME, $STAFF_ID, $DESIGNATION, $CONTACT, $EMAIL, $ADDRESS, $JOINDATE, $newFileName);

    if ($stmt->execute()) {
        echo "<script>alert('Registration Successful'); window.location.href='success.html';</script>";
        exit();
    } else {
        error_log("Database error: " . $stmt->error);
        echo "<script>alert('An error occurred. Please try again later.'); window.location.href='staff-details.html';</script>";
    }

    // Close connections
    $stmt->close();
    $conn->close();
}
?>

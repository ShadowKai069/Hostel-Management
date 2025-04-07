<?php
session_start();
// Database connection
define('SECURE_INCLUDE', true);
include 'db.php';

if (isset($_POST['submit'])) {
    $NAME = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $ROLL = filter_input(INPUT_POST, 'roll', FILTER_SANITIZE_STRING);
    $GENDER = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);
    $DOB = filter_input(INPUT_POST, 'dob', FILTER_SANITIZE_STRING);
    $CONTACT = filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_STRING);
    $CITY = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
    $ROOMNUMBER = filter_input(INPUT_POST, 'room-number', FILTER_SANITIZE_STRING);
    $PARENTNAME = filter_input(INPUT_POST, 'parent-name', FILTER_SANITIZE_STRING);
    $PARENTCONTACT = filter_input(INPUT_POST, 'parent-contact', FILTER_SANITIZE_STRING);
    $ADDRESS = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);

    // Handle file uploads securely
    $studentPhoto = $_FILES['student-photo']['name'];
    $parentPhoto = $_FILES['parent-photo']['name'];
    $uploadDir = "uploads/";

    // Validate file types and size
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    $maxFileSize = 2 * 1024 * 1024; // 2MB

    $studentPhotoExt = strtolower(pathinfo($studentPhoto, PATHINFO_EXTENSION));
    $parentPhotoExt = strtolower(pathinfo($parentPhoto, PATHINFO_EXTENSION));

    if (!in_array($studentPhotoExt, $allowedTypes) || !in_array($parentPhotoExt, $allowedTypes)) {
        die("<script>alert('Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.');</script>");
    }

    if ($_FILES['student-photo']['size'] > $maxFileSize || $_FILES['parent-photo']['size'] > $maxFileSize) {
        die("<script>alert('File size should be less than 2MB.');</script>");
    }

    // Rename files to prevent overwrites
    $studentPhoto = uniqid() . "_" . basename($studentPhoto);
    $parentPhoto = uniqid() . "_" . basename($parentPhoto);

// Ensure uploads directory exists
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Move uploaded files
if (!move_uploaded_file($_FILES['student-photo']['tmp_name'], $uploadDir . $studentPhoto) ||
    !move_uploaded_file($_FILES['parent-photo']['tmp_name'], $uploadDir . $parentPhoto)) {
    die("<script>alert('File upload failed. Please try again.');</script>");
}

    // Check for duplicate Token_no
    $checkuser = "SELECT * FROM students WHERE token_no=?";
    $stmt = $conn->prepare($checkuser);
    $stmt->bind_param("s", $reg_no);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        die("<script>alert('This Token Number already exists'); window.location.href='student_registration.php';</script>");
    }
    
    } else {
        // Insert into database
        $stmt = $conn->prepare("INSERT INTO student_registration (name, Token_no, gender, dob, contact, city, Rzoom_no, student_photo, parent_guardian, parent_contact, Address, parent_photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssssss", $NAME, $ROLL, $GENDER, $DOB, $CONTACT, $CITY, $ROOMNUMBER, $studentPhoto, $PARENTNAME, $PARENTCONTACT, $ADDRESS, $parentPhoto);
        
        if ($stmt->execute()) {
            echo "<script>alert('Student registered successfully!'); window.location.href='dashboard.php';</script>";
        } else {
            echo "Error in SQL execution: " . $stmt->error;
        }
    }        

    

    // Close connection
    $stmt->close();
    $con->close();
?>

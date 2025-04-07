<?php
// Secure include
define('SECURE_INCLUDE', true);
include 'db.php'; // This includes the database connection

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data safely
    $first_name = mysqli_real_escape_string($conn, $_POST['first-name']);
    $middle_name = mysqli_real_escape_string($conn, $_POST['middle-name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last-name']);
    $student_id = mysqli_real_escape_string($conn, $_POST['student-id']);
    $purpose = mysqli_real_escape_string($conn, $_POST['outing-purpose']);
    $outing_date = mysqli_real_escape_string($conn, $_POST['outing-date']);
    $return_date = mysqli_real_escape_string($conn, $_POST['return-date']);
    $destination = mysqli_real_escape_string($conn, $_POST['destination']);
    $approval = mysqli_real_escape_string($conn, $_POST['warden-approval']);

    // File upload handling
    $file_name = $_FILES['outing-application']['name'];
    $file_tmp = $_FILES['outing-application']['tmp_name'];
    $file_type = $_FILES['outing-application']['type'];
    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $allowed_exts = ['pdf', 'jpeg', 'jpg', 'png'];

    // Validate file extension
    if (!in_array(strtolower($file_ext), $allowed_exts)) {
        die("Invalid file type. Only PDF, JPEG, and PNG are allowed.");
    }

    // Create uploads folder if not exists
    $upload_dir = 'uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    // Generate unique file name and move file
    $new_file_name = uniqid('application_', true) . '.' . $file_ext;
    $target_path = $upload_dir . $new_file_name;

    if (move_uploaded_file($file_tmp, $target_path)) {
        // Insert into DB
        $query = "INSERT INTO outing (first_name, middle_name, last_name, token_no, outing_purpose, outing_date, return_date, destination, warden_approval, application_file)
                  VALUES ('$first_name', '$middle_name', '$last_name', '$student_id', '$purpose', '$outing_date', '$return_date', '$destination', '$approval', '$new_file_name')";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Outing request submitted successfully.'); window.location.href='dashboard.php';</script>";
        } else {
            echo "Database error: " . mysqli_error($conn);
        }
    } else {
        echo "File upload failed. Please try again.";
    }
} else {
    echo "Invalid request.";
}
?>

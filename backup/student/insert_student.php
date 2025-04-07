<?php
// Database connection
define('SECURE_INCLUDE', true);
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data safely
    $token_no = $_POST['token_no'] ?? '';
    $first_name = $_POST['first-name'] ?? '';
    $middle_name = $_POST['middle-name'] ?? '';
    $last_name = $_POST['last-name'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $contact_no = $_POST['contact-no'] ?? '';
    $email = $_POST['email'] ?? '';
    $address = $_POST['studentaddress'] ?? '';
    $city = $_POST['corrCity'] ?? '';
    $state = $_POST['corrState'] ?? '';
    $pincode = $_POST['corrPincode'] ?? '';
    $room_no = $_POST['room_no'] ?? '';
    $bed_no = $_POST['bed_no'] ?? '';
    $fees_per_month = isset($_POST['fees']) ? str_replace("Rs. ", "", $_POST['fees']) : '0';
    $stay_from = $_POST['stay_from'] ?? '';
    $duration = $_POST['duration'] ?? '';
    $total_fees = isset($_POST['total_fees']) ? str_replace("Rs. ", "", $_POST['total_fees']) : '0';
    $parent_name = $_POST['parent-name'] ?? '';
    $parent_contact = $_POST['parent-contact'] ?? '';
    $parent_address = $_POST['parentaddress'] ?? '';

    // File Upload Handling
    $uploadDir = "uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    function uploadFile($fileKey, $uploadDir) {
        if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] == 0) {
            $filePath = $uploadDir . basename($_FILES[$fileKey]['name']);
            if (move_uploaded_file($_FILES[$fileKey]['tmp_name'], $filePath)) {
                return $filePath;
            }
        }
        return "";
    }

    $student_photo = uploadFile("student-photo", $uploadDir);
    $aadhaar_photo = uploadFile("aadhaar-photo", $uploadDir);
    $parent_photo = uploadFile("parent-photo", $uploadDir);
    $parent_aadhaar_photo = uploadFile("parent-aadhaar-photo", $uploadDir);


    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    // exit();

    // SQL Query (Prepared Statement to prevent SQL Injection)
    $sql = "INSERT INTO students 
            (token_no, first_name, middle_name, last_name, gender, contact_no, email, address, city, state, pincode, room_no, bed_no, fees_per_month, stay_from, duration, student_photo, student_aadhaar, parent_name, parent_contact, parent_address, parent_photo, parent_aadhaar, total_fees) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error in preparing statement: " . $conn->error);
    }

    $stmt->bind_param("ssssssssssssssssssssssss", 
        $token_no, $first_name, $middle_name, $last_name, $gender, $contact_no, $email, 
        $address, $city, $state, $pincode, $room_no, $bed_no, $fees_per_month, 
        $stay_from, $duration, $student_photo, $aadhaar_photo, $parent_name, 
        $parent_contact, $parent_address, $parent_photo, $parent_aadhaar_photo, $total_fees);

    if ($stmt->execute()) {
        echo "<script>alert('Student Registered Successfully!'); window.location.href='registration.html';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<?php
// Database connection
define('SECURE_INCLUDE', true);
include 'db.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid request.");
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM students WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Student not found.");
}

$student = $result->fetch_assoc();

// Handle update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function safePost($key) {
        return $_POST[$key] ?? '';
    }

    $token_no = safePost('token_no');
    $first_name = safePost('first_name');
    $middle_name = safePost('middle_name');
    $last_name = safePost('last_name');
    $gender = safePost('gender');
    $contact_no = safePost('contact_no');
    $email = safePost('email');
    $address = safePost('address');
    $city = safePost('city');
    $state = safePost('state');
    $pincode = safePost('pincode');
    $room_no = safePost('room_no');
    $bed_no = safePost('bed_no');
    $fees_per_month = safePost('fees_per_month');
    $stay_from = safePost('stay_from');
    $duration = safePost('duration');
    $total_fees = safePost('total_fees');
    $parent_name = safePost('parent_name');
    $parent_contact = safePost('parent_contact');
    $parent_address = safePost('parent_address');

    // Upload handling
    $uploadDir = "uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    function uploadFile($fileKey, $existingFile, $uploadDir) {
        if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] == 0) {
            $filePath = $uploadDir . basename($_FILES[$fileKey]['name']);
            if (move_uploaded_file($_FILES[$fileKey]['tmp_name'], $filePath)) {
                return $filePath;
            }
        }
        return $existingFile; // Return old file if no new upload
    }

    $student_photo = uploadFile('student_photo', $student['student_photo'], $uploadDir);
    $student_aadhaar = uploadFile('student_aadhaar', $student['student_aadhaar'], $uploadDir);
    $parent_photo = uploadFile('parent_photo', $student['parent_photo'], $uploadDir);
    $parent_aadhaar = uploadFile('parent_aadhaar', $student['parent_aadhaar'], $uploadDir);

    // Update query
    $sql = "UPDATE students SET 
        token_no=?, first_name=?, middle_name=?, last_name=?, gender=?, contact_no=?, email=?, 
        address=?, city=?, state=?, pincode=?, room_no=?, bed_no=?, fees_per_month=?, stay_from=?, 
        duration=?, student_photo=?, student_aadhaar=?, parent_name=?, parent_contact=?, 
        parent_address=?, parent_photo=?, parent_aadhaar=?, total_fees=? 
        WHERE id=?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssssssssssssssssi",
        $token_no, $first_name, $middle_name, $last_name, $gender, $contact_no, $email,
        $address, $city, $state, $pincode, $room_no, $bed_no, $fees_per_month, $stay_from,
        $duration, $student_photo, $student_aadhaar, $parent_name, $parent_contact,
        $parent_address, $parent_photo, $parent_aadhaar, $total_fees, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Student updated successfully!'); window.location.href='students_list.php';</script>";
    } else {
        echo "Error updating student: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <style>
        form { max-width: 800px; margin: auto; }
        label { display: block; margin-top: 10px; }
        input[type="text"], input[type="email"], input[type="number"], input[type="date"] {
            width: 100%; padding: 8px; margin-top: 4px;
        }
        .form-section { margin-bottom: 20px; border: 1px solid #ccc; padding: 15px; border-radius: 6px; }
        .form-section h3 { margin-top: 0; }
        .submit-btn {
            background-color: #4CAF50; color: white; padding: 10px 20px;
            border: none; border-radius: 5px; cursor: pointer;
        }
        .back-link { display: inline-block; margin-top: 15px; }
    </style>
</head>
<body>

<h2 style="text-align:center;">Edit Student</h2>
<form method="post" enctype="multipart/form-data">
    <div class="form-section">
        <h3>Basic Info</h3>
        <label>Token No: <input type="text" name="token_no" value="<?= htmlspecialchars($student['token_no']) ?>"></label>
        <label>First Name: <input type="text" name="first_name" value="<?= htmlspecialchars($student['first_name']) ?>"></label>
        <label>Middle Name: <input type="text" name="middle_name" value="<?= htmlspecialchars($student['middle_name']) ?>"></label>
        <label>Last Name: <input type="text" name="last_name" value="<?= htmlspecialchars($student['last_name']) ?>"></label>
        <label>Gender: <input type="text" name="gender" value="<?= htmlspecialchars($student['gender']) ?>"></label>
        <label>Contact No: <input type="text" name="contact_no" value="<?= htmlspecialchars($student['contact_no']) ?>"></label>
        <label>Email: <input type="email" name="email" value="<?= htmlspecialchars($student['email']) ?>"></label>
        <label>Address: <input type="text" name="address" value="<?= htmlspecialchars($student['address']) ?>"></label>
        <label>City: <input type="text" name="city" value="<?= htmlspecialchars($student['city']) ?>"></label>
        <label>State: <input type="text" name="state" value="<?= htmlspecialchars($student['state']) ?>"></label>
        <label>Pincode: <input type="text" name="pincode" value="<?= htmlspecialchars($student['pincode']) ?>"></label>
    </div>

    <div class="form-section">
        <h3>Hostel Info</h3>
        <label>Room No: <input type="text" name="room_no" value="<?= htmlspecialchars($student['room_no']) ?>"></label>
        <label>Bed No: <input type="text" name="bed_no" value="<?= htmlspecialchars($student['bed_no']) ?>"></label>
        <label>Fees Per Month: <input type="text" name="fees_per_month" value="<?= htmlspecialchars($student['fees_per_month']) ?>"></label>
        <label>Stay From: <input type="date" name="stay_from" value="<?= htmlspecialchars($student['stay_from']) ?>"></label>
        <label>Duration (in months): <input type="number" name="duration" value="<?= htmlspecialchars($student['duration']) ?>"></label>
        <label>Total Fees: <input type="text" name="total_fees" value="<?= htmlspecialchars($student['total_fees']) ?>"></label>
    </div>

    <div class="form-section">
        <h3>Parent Info</h3>
        <label>Parent Name: <input type="text" name="parent_name" value="<?= htmlspecialchars($student['parent_name']) ?>"></label>
        <label>Parent Contact: <input type="text" name="parent_contact" value="<?= htmlspecialchars($student['parent_contact']) ?>"></label>
        <label>Parent Address: <input type="text" name="parent_address" value="<?= htmlspecialchars($student['parent_address']) ?>"></label>
    </div>

    <div class="form-section">
        <h3>Upload Files (Leave blank to keep existing)</h3>
        <label>Student Photo: <input type="file" name="student_photo"></label>
        <label>Student Aadhaar: <input type="file" name="student_aadhaar"></label>
        <label>Parent Photo: <input type="file" name="parent_photo"></label>
        <label>Parent Aadhaar: <input type="file" name="parent_aadhaar"></label>
    </div>

    <input type="submit" class="submit-btn" value="Update Student">
    <br>
    <a class="back-link" href="students_list.php">← Back to List</a>
</form>

</body>
</html>

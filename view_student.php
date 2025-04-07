<?php
// Database connection
define('SECURE_INCLUDE', true);
include 'db.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid request.");
}

$id = intval($_GET['id']); // Sanitize input

// Fetch student record
$sql = "SELECT * FROM students WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Student not found.");
}

$student = $result->fetch_assoc();
$full_name = $student['first_name'] . ' ' . $student['middle_name'] . ' ' . $student['last_name'];

?>

<!DOCTYPE html>
<html>
<head>
    <title>View Student</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: auto;
        }

        h2 {
            text-align: center;
        }

        .student-details {
            border: 1px solid #ccc;
            padding: 20px;
            margin-top: 20px;
            border-radius: 8px;
        }

        .student-details img {
            max-height: 150px;
            margin-right: 10px;
        }

        .row {
            margin-bottom: 12px;
        }

        .label {
            font-weight: bold;
            width: 200px;
            display: inline-block;
        }

        .value {
            display: inline-block;
        }

        .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 8px 15px;
            background-color: #2196F3;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .back-btn:hover {
            background-color: #0b7dda;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Student Details</h2>
    <div class="student-details">
        <div class="row"><span class="label">Full Name:</span> <span class="value"><?= htmlspecialchars($full_name) ?></span></div>
        <div class="row"><span class="label">Token No:</span> <span class="value"><?= $student['token_no'] ?></span></div>
        <div class="row"><span class="label">Gender:</span> <span class="value"><?= $student['gender'] ?></span></div>
        <div class="row"><span class="label">Contact No:</span> <span class="value"><?= $student['contact_no'] ?></span></div>
        <div class="row"><span class="label">Email:</span> <span class="value"><?= $student['email'] ?></span></div>
        <div class="row"><span class="label">Address:</span> <span class="value"><?= $student['address'] ?>, <?= $student['city'] ?>, <?= $student['state'] ?> - <?= $student['pincode'] ?></span></div>
        <div class="row"><span class="label">Room No:</span> <span class="value"><?= $student['room_no'] ?></span></div>
        <div class="row"><span class="label">Bed No:</span> <span class="value"><?= $student['bed_no'] ?></span></div>
        <div class="row"><span class="label">Stay From:</span> <span class="value"><?= $student['stay_from'] ?></span></div>
        <div class="row"><span class="label">Duration:</span> <span class="value"><?= $student['duration'] ?> month(s)</span></div>
        <div class="row"><span class="label">Monthly Fees:</span> <span class="value">Rs. <?= $student['fees_per_month'] ?></span></div>
        <div class="row"><span class="label">Total Fees:</span> <span class="value">Rs. <?= $student['total_fees'] ?></span></div>

        <div class="row"><span class="label">Parent Name:</span> <span class="value"><?= $student['parent_name'] ?></span></div>
        <div class="row"><span class="label">Parent Contact:</span> <span class="value"><?= $student['parent_contact'] ?></span></div>
        <div class="row"><span class="label">Parent Address:</span> <span class="value"><?= $student['parent_address'] ?></span></div>

        <div class="row">
            <span class="label">Student Photo:</span>
            <?php if ($student['student_photo']): ?>
                <img src="<?= htmlspecialchars($student['student_photo']) ?>" alt="Student Photo">
            <?php else: ?>
                <span>No photo uploaded.</span>
            <?php endif; ?>
        </div>

        <div class="row">
            <span class="label">Student Aadhaar:</span>
            <?php if ($student['student_aadhaar']): ?>
                <img src="<?= htmlspecialchars($student['student_aadhaar']) ?>" alt="Aadhaar Photo">
            <?php else: ?>
                <span>No Aadhaar uploaded.</span>
            <?php endif; ?>
        </div>

        <div class="row">
            <span class="label">Parent Photo:</span>
            <?php if ($student['parent_photo']): ?>
                <img src="<?= htmlspecialchars($student['parent_photo']) ?>" alt="Parent Photo">
            <?php else: ?>
                <span>No photo uploaded.</span>
            <?php endif; ?>
        </div>

        <div class="row">
            <span class="label">Parent Aadhaar:</span>
            <?php if ($student['parent_aadhaar']): ?>
                <img src="<?= htmlspecialchars($student['parent_aadhaar']) ?>" alt="Parent Aadhaar">
            <?php else: ?>
                <span>No Aadhaar uploaded.</span>
            <?php endif; ?>
        </div>

        <a class="back-btn" href="students_list.php">← Back to List</a>
    </div>
</div>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>

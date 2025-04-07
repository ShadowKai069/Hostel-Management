<?php
define('SECURE_INCLUDE', true);
include 'db.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid request. Student ID is missing.");
}

$id = intval($_GET['id']);

// 1. Fetch student data
$sql = "SELECT * FROM students WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Student not found.");
}

$student = $result->fetch_assoc();

// 2. Insert into previous_students (archive)
$columns = implode(", ", array_keys($student));
$placeholders = implode(", ", array_fill(0, count($student), "?"));
$types = str_repeat("s", count($student)); // assume all columns are string-like for simplicity

$insert_sql = "INSERT INTO previous_students ($columns) VALUES ($placeholders)";
$insert_stmt = $conn->prepare($insert_sql);

if ($insert_stmt === false) {
    die("Error preparing archive statement: " . $conn->error);
}

$values = array_values($student);
$insert_stmt->bind_param(str_repeat("s", count($values)), ...$values);

if (!$insert_stmt->execute()) {
    die("Error archiving student: " . $insert_stmt->error);
}

// 3. Delete original record
$delete_sql = "DELETE FROM students WHERE id = ?";
$delete_stmt = $conn->prepare($delete_sql);
$delete_stmt->bind_param("i", $id);

if ($delete_stmt->execute()) {
    echo "<script>alert('Student archived and deleted successfully.'); window.location.href='students_list.php';</script>";
} else {
    echo "Error deleting student: " . $delete_stmt->error;
}

$stmt->close();
$insert_stmt->close();
$delete_stmt->close();
$conn->close();
?>

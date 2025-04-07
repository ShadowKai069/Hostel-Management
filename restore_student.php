<?php
define('SECURE_INCLUDE', true);
include 'db.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid request. Student ID is missing.");
}

$id = intval($_GET['id']);

// Step 1: Fetch student from archive
$sql = "SELECT * FROM previous_students WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Archived student not found.");
}

$student = $result->fetch_assoc();

// Remove deleted_at field
unset($student['deleted_at']);

// Step 2: Insert into students table
$columns = implode(", ", array_keys($student));
$placeholders = implode(", ", array_fill(0, count($student), "?"));
$insert_sql = "INSERT INTO students ($columns) VALUES ($placeholders)";
$insert_stmt = $conn->prepare($insert_sql);

if ($insert_stmt === false) {
    die("Error preparing restore statement: " . $conn->error);
}

$values = array_values($student);
$types = str_repeat("s", count($values)); // treat all as strings for safety
$insert_stmt->bind_param($types, ...$values);

if (!$insert_stmt->execute()) {
    die("Error restoring student: " . $insert_stmt->error);
}

// Step 3: Delete from archive
$delete_sql = "DELETE FROM previous_students WHERE id = ?";
$delete_stmt = $conn->prepare($delete_sql);
$delete_stmt->bind_param("i", $id);
$delete_stmt->execute();

echo "<script>alert('Student restored successfully.'); window.location.href='previous_students.php';</script>";

$stmt->close();
$insert_stmt->close();
$delete_stmt->close();
$conn->close();
?>

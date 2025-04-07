<?php
// Database connection
define('SECURE_INCLUDE', true);
include 'db.php';

// Get form data
$email = $_POST['email'];
$password = $_POST['password'];

// Check if user exists
$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    
    // Verify password
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        echo "Login successful! Welcome, " . $user['name'] . ". <a href='dashboard.php'>Go to Dashboard</a>";
    } else {
        echo "Incorrect password. <a href='login.html'>Try again</a>";
    }
} else {
    echo "User not found. <a href='signup.html'>Sign Up</a>";
}

$conn->close();
?>

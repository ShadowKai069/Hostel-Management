<?php
// Database connection
define('SECURE_INCLUDE', true);
include 'db.php';

// Check if the user is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    echo "<script>alert('Access Denied!'); window.location.href='dashboard.php';</script>";
    exit();
}

// Handle role update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $new_role = $_POST['role'];

    $update_query = "UPDATE users SET role = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("si", $new_role, $user_id);
    
    if ($stmt->execute()) {
        echo "<script>alert('User role updated successfully!'); window.location.href='assign_roles.php';</script>";
    } else {
        echo "<script>alert('Error updating role!');</script>";
    }
    $stmt->close();
}

// Fetch users from the database
$query = "SELECT id, username, role FROM users";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign User Roles</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Assign Roles to Users</h2>
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Current Role</th>
                    <th>Assign New Role</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['username'] ?></td>
                        <td><?= $row['role'] ?></td>
                        <td>
                            <form method="POST" action="">
                                <input type="hidden" name="user_id" value="<?= $row['id'] ?>">
                                <select name="role" class="form-control">
                                    <option value="admin" <?= ($row['role'] == 'admin') ? 'selected' : '' ?>>Admin</option>
                                    <option value="manager" <?= ($row['role'] == 'manager') ? 'selected' : '' ?>>Manager</option>
                                    <option value="staff" <?= ($row['role'] == 'staff') ? 'selected' : '' ?>>Staff</option>
                                    <option value="student" <?= ($row['role'] == 'student') ? 'selected' : '' ?>>Student</option>
                                </select>
                                <button type="submit" class="btn btn-primary mt-2">Update Role</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>

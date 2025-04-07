<?php
// Database connection
define('SECURE_INCLUDE', true);
include 'db.php';

// Fetch all students
$sql = "SELECT * FROM students ORDER BY id ASC"; // Assuming 'id' is auto-increment primary key
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registered Students</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .action-btn {
            margin-right: 5px;
            padding: 5px 10px;
            background-color: #4CAF50;
            border: none;
            color: white;
            cursor: pointer;
        }

        .action-btn.edit {
            background-color: #ff9800;
        }

        .action-btn.delete {
            background-color: #f44336;
        }

        .archive-btn {
        display: inline-block;
        margin-bottom: 20px;
        padding: 10px 20px;
        background-color: #6c757d;
        color: white;
        text-decoration: none;
        border-radius: 5px;
    }

    .archive-btn:hover {
        background-color: #5a6268;
    }
    </style>
</head>
<body>

<h2>Active Student Records</h2>

<a href="previous_students.php" class="archive-btn">View Archived Students</a>
    <table>
        <thead>
            <tr>
                <th>S.No</th>
                <th>Student Name</th>
                <th>Token No</th>
                <th>Contact No</th>
                <th>Room No</th>
                <th>Bed No</th>
                <th>Staying From</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if ($result && $result->num_rows > 0) {
            $sn = 1;
            while ($row = $result->fetch_assoc()) {
                $full_name = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'];
                echo "<tr>
                    <td>{$sn}</td>
                    <td>{$full_name}</td>
                    <td>{$row['token_no']}</td>
                    <td>{$row['contact_no']}</td>
                    <td>{$row['room_no']}</td>
                    <td>{$row['bed_no']}</td>
                    <td>{$row['stay_from']}</td>
                    <td>
                        <button class='action-btn' onclick=\"window.location.href='view_student.php?id={$row['id']}'\">View</button>
                        <button class='action-btn edit' onclick=\"window.location.href='edit_student.php?id={$row['id']}'\">Edit</button>
                        <button class='action-btn delete' onclick=\"if(confirm('Are you sure to delete?')) window.location.href='delete_student.php?id={$row['id']}'\">Delete</button>
                    </td>
                </tr>";
                $sn++;
            }
        } else {
            echo "<tr><td colspan='8'>No students found.</td></tr>";
        }
        ?>
        </tbody>
    </table>

</body>
</html>

<?php
$conn->close();
?>

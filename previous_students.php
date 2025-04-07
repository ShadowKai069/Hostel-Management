<?php
define('SECURE_INCLUDE', true);
include 'db.php';

// Fetch all archived students
$sql = "SELECT * FROM previous_students ORDER BY deleted_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Archived Students</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
        }

        .back-btn {
            margin: 20px auto;
            display: block;
            text-align: center;
            text-decoration: none;
            color: white;
            background-color: #007BFF;
            padding: 10px 20px;
            border-radius: 5px;
            width: fit-content;
        }
        .action-btn {
    display: inline-block;
    margin-right: 5px;
    padding: 6px 12px;
    text-decoration: none;
    border-radius: 4px;
    font-size: 14px;
    color: white;
}

.action-btn.view {
    background-color: #17a2b8;
}

.action-btn.restore {
    background-color: #28a745;
}

.action-btn:hover {
    opacity: 0.9;
}

    </style>
</head>
<body>

<h2>Archived Student Records</h2>

<a class="back-btn" href="students_list.php">← Back to Active Students</a>

<table>
    <thead>
        <tr>
            <th>S.No</th>
            <th>Student Name</th>
            <th>Token No</th>
            <th>Contact No</th>
            <th>Room No</th>
            <th>Bed No</th>
            <th>Stay From</th>
            <th>Deleted At</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sno = 1;
        if ($result->num_rows > 0):
            while ($row = $result->fetch_assoc()):
                $fullName = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'];
        ?>
            <tr>
                <td><?= $sno++ ?></td>
                <td><?= htmlspecialchars($fullName) ?></td>
                <td><?= htmlspecialchars($row['token_no']) ?></td>
                <td><?= htmlspecialchars($row['contact_no']) ?></td>
                <td><?= htmlspecialchars($row['room_no']) ?></td>
                <td><?= htmlspecialchars($row['bed_no']) ?></td>
                <td><?= htmlspecialchars($row['stay_from']) ?></td>
                <td><?= htmlspecialchars($row['deleted_at']) ?></td>
                <td>
    <a href="view_student.php?id=<?= $row['id'] ?>&archive=1" class="action-btn view">View</a>
    <a href="restore_student.php?id=<?= $row['id'] ?>" class="action-btn restore" onclick="return confirm('Restore this student?');">Restore</a>
</td>
            </tr>
        <?php
            endwhile;
        else:
        ?>
            <tr>
                <td colspan="8" style="text-align:center;">No archived students found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>

<?php
session_start();
define('SECURE_INCLUDE', true);
include 'db.php';

// Fetch all outing entries
$sql = "SELECT * FROM outing ORDER BY id ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Outing Entries</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #999;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        a.button {
            background-color: #4CAF50;
            color: white;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
        }

        a.button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h2>Outing Entries</h2>
<table>
    <thead>
        <tr>
            <th>S.no</th>
            <th>Name</th>
            <th>Token Number</th>
            <th>Outing Purpose</th>
            <th>Outing Date</th>
            <th>Return Date</th>
            <th>Application</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result && $result->num_rows > 0) {
            $sn = 1;
            while ($row = $result->fetch_assoc()) {
                $full_name = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'];
                $application_link = htmlspecialchars($row['application_file']);

                echo "<tr>
                        <td>{$sn}</td>
                        <td>{$full_name}</td>
                        <td>{$row['token_no']}</td>
                        <td>{$row['outing_purpose']}</td>
                        <td>{$row['outing_date']}</td>
                        <td>{$row['return_date']}</td>
                        <td><a class='button' href='uploads/{$application_link}' target='_blank'>View File</a></td>
                      </tr>";
                $sn++;
            }
        } else {
            echo "<tr><td colspan='7'>No outing entries found.</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>

<?php
$conn->close();
?>

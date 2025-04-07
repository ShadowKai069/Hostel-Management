<?php
// Database connection
define('SECURE_INCLUDE', true);
include 'db.php';

$sql = "SELECT id, total_beds, room_no, fees_per_bed FROM rooms ORDER BY id ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Rooms</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f7fa;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
        }

        .table-container {
            max-width: 900px;
            margin: 0 auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            text-align: left;
            padding: 12px 15px;
        }

        th {
            background-color: #3498db;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f6fa;
        }

        tr:hover {
            background-color: #eaf3fc;
        }

        a {
            text-decoration: none;
            color: #3498db;
            margin-right: 10px;
        }

        a:hover {
            text-decoration: underline;
        }

        .action-buttons a {
            background-color: #2980b9;
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            transition: background-color 0.3s ease;
        }

        .action-buttons a:hover {
            background-color: #1c638f;
        }

        @media screen and (max-width: 600px) {
            th, td {
                padding: 10px;
            }

            .action-buttons a {
                display: block;
                margin-bottom: 6px;
            }
        }
    </style>
</head>
<body>
    <h2>Manage Rooms</h2>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Total Beds</th>
                    <th>Room No</th>
                    <th>Fees per Month</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $sno = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$sno}</td>
                            <td>{$row['total_beds']}</td>
                            <td>{$row['room_no']}</td>
                            <td>Rs. {$row['fees_per_bed']}</td>
                            <td class='action-buttons'>
                                <a href='edit.php?id={$row['id']}'>Edit</a>
                                <a href='delete.php?id={$row['id']}' onclick='return confirm(\"Are you sure you want to delete?\")'>Delete</a>
                            </td>
                        </tr>";
                        $sno++;
                    }
                } else {
                    echo "<tr><td colspan='5' style='text-align:center;'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>

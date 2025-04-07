<?php
define('SECURE_INCLUDE', true);
include 'db.php';

// Filters
$from = $_GET['from'] ?? date('Y-m-d');
$to = $_GET['to'] ?? date('Y-m-d');
$search = $_GET['search'] ?? "";

// CSV Export
if (isset($_GET['export']) && $_GET['export'] === 'csv') {
    header("Content-Type: text/csv");
    header("Content-Disposition: attachment; filename=attendance_export.csv");

    $output = fopen("php://output", "w");
    fputcsv($output, ['Token No', 'Name', 'Room', 'Date', 'Morning', 'Afternoon', 'Night', 'Remarks']);

    $stmt = $conn->prepare("SELECT * FROM attendance WHERE date BETWEEN ? AND ? AND (name LIKE ? OR token_no LIKE ? OR room_no LIKE ?) ORDER BY date, name");
    $like = "%$search%";
    $stmt->bind_param("sssss", $from, $to, $like, $like, $like);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        fputcsv($output, [
            $row['token_no'], $row['name'], $row['room_no'], $row['date'],
            $row['morning'], $row['afternoon'], $row['night'],
            "M: {$row['remark_morning']} | A: {$row['remark_afternoon']} | N: {$row['remark_night']}"
        ]);
    }
    fclose($output);
    exit;
}

// Fetch attendance
$stmt = $conn->prepare("SELECT * FROM attendance WHERE date BETWEEN ? AND ? AND (name LIKE ? OR token_no LIKE ? OR room_no LIKE ?) ORDER BY date, name");
$like = "%$search%";
$stmt->bind_param("sssss", $from, $to, $like, $like, $like);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Attendance Report</title>
  <style>
    body { font-family: Arial; margin: 20px; background: #f0f0f0; }
    table { width: 100%; border-collapse: collapse; background: #fff; box-shadow: 0 0 10px #ccc; margin-top: 10px; }
    th, td { padding: 10px; border: 1px solid #ddd; text-align: center; }
    th { background-color: #343a40; color: white; }
    .filters { margin-bottom: 15px; }
    .filters input, .filters button { padding: 6px 10px; margin-right: 10px; }
  </style>
</head>
<body>

  <h2>Attendance Report</h2>

  <form method="get" class="filters">
    <label>From: <input type="date" name="from" value="<?= $from ?>"></label>
    <label>To: <input type="date" name="to" value="<?= $to ?>"></label>
    <label>Search: <input type="text" name="search" placeholder="Name, Token No, Room" value="<?= htmlspecialchars($search) ?>"></label>
    <button type="submit">Filter</button>
    <button type="submit" name="export" value="csv">Export to CSV</button>
  </form>

  <table>
    <thead>
      <tr>
        <th>Date</th>
        <th>Token No</th>
        <th>Name</th>
        <th>Room No</th>
        <th>Morning</th>
        <th>Afternoon</th>
        <th>Night</th>
        <th>Present</th>
        <th>Absent</th>
        <th>Remarks</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $attendanceCount = [];
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $present = $row['morning'] + $row['afternoon'] + $row['night'];
          $absent = 3 - $present;

          // Count for percentage
          $id = $row['student_id'];
          if (!isset($attendanceCount[$id])) {
            $attendanceCount[$id] = ['name' => $row['name'], 'total' => 0, 'present' => 0];
          }
          $attendanceCount[$id]['total'] += 3;
          $attendanceCount[$id]['present'] += $present;

          echo "<tr>
            <td>{$row['date']}</td>
            <td>{$row['token_no']}</td>
            <td>{$row['name']}</td>
            <td>{$row['room_no']}</td>
            <td>" . ($row['morning'] ? "✅" : "❌") . "</td>
            <td>" . ($row['afternoon'] ? "✅" : "❌") . "</td>
            <td>" . ($row['night'] ? "✅" : "❌") . "</td>
            <td>$present</td>
            <td>$absent</td>
            <td>
              M: {$row['remark_morning']}<br>
              A: {$row['remark_afternoon']}<br>
              N: {$row['remark_night']}
            </td>
          </tr>";
        }
      } else {
        echo "<tr><td colspan='10'>No records found.</td></tr>";
      }
      ?>
    </tbody>
  </table>

  <h3>Attendance Percentage Summary</h3>
  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Total Sessions</th>
        <th>Present</th>
        <th>Absent</th>
        <th>Percentage</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($attendanceCount as $entry) {
        $absent = $entry['total'] - $entry['present'];
        $percent = $entry['total'] > 0 ? round(($entry['present'] / $entry['total']) * 100, 2) : 0;
        echo "<tr>
          <td>{$entry['name']}</td>
          <td>{$entry['total']}</td>
          <td>{$entry['present']}</td>
          <td>{$absent}</td>
          <td>{$percent}%</td>
        </tr>";
      }
      ?>
    </tbody>
  </table>

</body>
</html>

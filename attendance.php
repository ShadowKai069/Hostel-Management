<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Mark Attendance Page</title>
  <style>
    body { font-family: Arial; margin: 20px; background: #f5f5f5; }
    table { width: 100%; border-collapse: collapse; background: #fff; box-shadow: 0 0 10px #ccc; }
    th, td { padding: 10px; border: 1px solid #ddd; text-align: center; }
    th { background-color: #007bff; color: white; }
    input[type="date"] { width: 100%; padding: 5px; }
    textarea { width: 100%; height: 40px; }
    .btn { padding: 5px 10px; margin: 5px; cursor: pointer; }
    .save { background-color: #28a745; color: white; }
    .edit { background-color: #ffc107; color: black; }
  </style>
</head>
<body>

  <h2>Attendance Form</h2>
  <form action="save_attendance.php" method="POST">
    <table>
      <thead>
        <tr>
          <th>Token No</th>
          <th>Name</th>
          <th>Date</th>
          <th>Room No</th>
          <th>Morning</th>
          <th>Afternoon</th>
          <th>Night</th>
          <th>Total Present</th>
          <th>Total Absent</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="attendanceBody">
      <?php
        define('SECURE_INCLUDE', true);
        include 'db.php';

        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        // Fetch students
        $sql = "SELECT id, token_no, first_name, middle_name, last_name, room_no FROM students";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $tokenNo = $row["token_no"];
            $tokenNo = $row["token_no"];
$fullName = $row["first_name"] . " " . $row["middle_name"] . " " . $row["last_name"];
$roomNo = $row["room_no"];
echo '
<tr>
  <td>'.$tokenNo.'</td> <!-- Token No -->
  <td><input type="hidden" name="student_id[]" value="'.$row["id"].'">'.$fullName.'</td>
<td><input type="date" name="date[]" required class="autoDate" readonly></td>
  <td><input type="text" name="room_no[]" value="'.$roomNo.'" readonly></td>

  <td>
    <input type="checkbox" name="morning['.$row["id"].']" value="1">
    <textarea name="remark_morning['.$row["id"].']" placeholder="Remark..."></textarea>
  </td>
  <td>
    <input type="checkbox" name="afternoon['.$row["id"].']" value="1">
    <textarea name="remark_afternoon['.$row["id"].']" placeholder="Remark..."></textarea>
  </td>
  <td>
    <input type="checkbox" name="night['.$row["id"].']" value="1">
    <textarea name="remark_night['.$row["id"].']" placeholder="Remark..."></textarea>
  </td>

  <td class="presentCount">0</td>
  <td class="absentCount">3</td>

  <td>
    <button type="submit" class="btn save">Save</button>
    <button type="button" class="btn edit">Edit</button>
  </td>
</tr>';

          }
          
          }
         else {
          echo "<tr><td colspan='9'>No students found</td></tr>";
        }
        $conn->close();
        ?>
      </tbody>
    </table>
  </form>

  <script>
  // Set all date fields to today's date
  document.querySelectorAll('.autoDate').forEach(input => {
    const today = new Date().toISOString().split('T')[0];
    input.value = today;
  });

  // Existing JS for attendance checkboxes remains unchanged
  document.querySelectorAll('tr').forEach(row => {
    const checkboxes = row.querySelectorAll('input[type="checkbox"]');
    const present = row.querySelector('.presentCount');
    const absent = row.querySelector('.absentCount');

    function updateCount() {
      let count = 0;
      checkboxes.forEach(cb => cb.checked && count++);
      present.innerText = count;
      absent.innerText = 3 - count;
    }

    checkboxes.forEach(cb => cb.addEventListener('change', updateCount));
  });
</script>


</body>
</html>

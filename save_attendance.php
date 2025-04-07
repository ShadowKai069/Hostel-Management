<?php
// Secure include
define('SECURE_INCLUDE', true);
include 'db.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  

  foreach ($_POST['student_id'] as $index => $studentId) {
    $date = $_POST['date'][$index];
    $roomNo = $_POST['room_no'][$index];
    
    // Optional: retrieve token_no and name from students table using $studentId, or pass via form
    $tokenNo = ''; // or retrieve from DB if needed
    $name = '';    // or retrieve from DB if needed

    $morning = isset($_POST['morning'][$studentId]) ? 1 : 0;
    $afternoon = isset($_POST['afternoon'][$studentId]) ? 1 : 0;
    $night = isset($_POST['night'][$studentId]) ? 1 : 0;

    $remarkMorning = $_POST['remark_morning'][$studentId] ?? '';
    $remarkAfternoon = $_POST['remark_afternoon'][$studentId] ?? '';
    $remarkNight = $_POST['remark_night'][$studentId] ?? '';

    $stmt = $conn->prepare("INSERT INTO attendance 
  (student_id, token_no, name, date, room_no, morning, remark_morning, afternoon, remark_afternoon, night, remark_night)
  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
  ON DUPLICATE KEY UPDATE
    token_no = VALUES(token_no),
    name = VALUES(name),
    room_no = VALUES(room_no),
    morning = VALUES(morning),
    remark_morning = VALUES(remark_morning),
    afternoon = VALUES(afternoon),
    remark_afternoon = VALUES(remark_afternoon),
    night = VALUES(night),
    remark_night = VALUES(remark_night)
");

    // If token_no and name aren't passed via form, fetch them here
    if (!$tokenNo || !$name) {
      $studentInfo = $conn->query("SELECT token_no, CONCAT(first_name, ' ', middle_name, ' ', last_name) AS full_name FROM students WHERE id = $studentId");
      if ($studentInfo && $studentInfo->num_rows > 0) {
        $data = $studentInfo->fetch_assoc();
        $tokenNo = $data['token_no'];
        $name = $data['full_name'];
      }
    }

    $stmt->bind_param("issssississ",
      $studentId, $tokenNo, $name, $date, $roomNo,
      $morning, $remarkMorning,
      $afternoon, $remarkAfternoon,
      $night, $remarkNight
    );

    $stmt->execute();
  }

  echo "Attendance saved successfully!";
  $conn->close();
}
?>


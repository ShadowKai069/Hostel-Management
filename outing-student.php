<!DOCTYPE html>
<html lang="en-US">

<head>
  <!-- Meta setup -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="NTTF Hostel Outing Request Form">
  <meta name="author" content="NTTF Admin">
  <!-- Title -->
  <title>Hostel Outing Request</title>

  <!-- Fav Icon -->
  <link rel="icon" href="img/fav.png" />
  
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- Animation -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
  
  <!-- Main StyleSheet -->
  <link rel="stylesheet" href="css/outing.css" />
</head>

<body>
  <!--Header Section-->
  <section class="home">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-3">
          <div class="home-logo">
            <img src="images/nttf logo white back.jpeg" alt="NTTF Logo">
          </div>
        </div>
        <div class="col-md-9">
          <nav>
            <ul class="menu_links">
              <li>
                <a href="dashboard.php"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
              </li>
              <li>
                <a href="profile.html"><i class="fas fa-user me-2"></i>Profile</a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </section>

  <!--Form Section-->
  <div class="container2" data-aos="fade-up">
    <h2><i class="fas fa-door-open me-2"></i>Hostel Outing Request Form</h2>
    <form action="submit_outing.php" method="post" enctype="multipart/form-data">
      
      <!-- Student Selection -->
      <label for="first-name">First Name <span class="required">*</span></label>
      <select id="first-name" name="first-name" required onchange="fetchStudentDetails(this.value)">
        <option value="" disabled selected>Choose First Name</option>
        <?php
          // PHP code to populate dropdown from database
          define('SECURE_INCLUDE', true);
          include 'db.php';

          $query = "SELECT DISTINCT first_name FROM students";
          $result = mysqli_query($conn, $query);
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='".htmlspecialchars($row['first_name'])."'>".htmlspecialchars($row['first_name'])."</option>";
          }
        ?>
      </select>

      <!-- Auto-Filled Fields -->
      <label for="middle-name">Middle Name</label>
      <input type="text" id="middle-name" name="middle-name" readonly>

      <label for="last-name">Last Name</label>
      <input type="text" id="last-name" name="last-name" readonly>

      <label for="student-id">Student ID</label>
      <input type="text" id="student-id" name="student-id" readonly>

      <!-- Outing Purpose -->
      <label for="outing-purpose">Purpose of Outing <span class="required">*</span></label>
      <textarea id="outing-purpose" name="outing-purpose" required rows="4" placeholder="Please provide detailed reason for your outing request"></textarea>

      <!-- Outing Date and Time -->
      <label for="outing-date">Outing Date & Time <span class="required">*</span></label>
      <input type="datetime-local" id="outing-date" name="outing-date" required onchange="validateDates()">

      <label for="return-date">Expected Return Date & Time <span class="required">*</span></label>
      <input type="datetime-local" id="return-date" name="return-date" required onchange="validateDates()">

      <!-- Destination -->
      <label for="destination">Destination <span class="required">*</span></label>
      <input type="text" id="destination" name="destination" required placeholder="Enter full address of your destination">

      <!-- Warden Approval -->
      <label>Warden Approval <span class="required">*</span></label>
      <div class="radio-group">
        <div class="radio-option">
          <input type="radio" id="approval-yes" name="warden-approval" value="Yes" required>
          <label for="approval-yes">Yes</label>
        </div>
        <div class="radio-option">
          <input type="radio" id="approval-no" name="warden-approval" value="No">
          <label for="approval-no">No</label>
        </div>
      </div>

      <!-- Upload Application -->
      <label for="outing-application">Upload Application (PDF/JPEG/PNG) <span class="required">*</span></label>
      <input type="file" id="outing-application" name="outing-application" accept="application/pdf, image/jpeg, image/png" required>

      <!-- Submit Button -->
      <button type="submit"><i class="fas fa-paper-plane me-2"></i>Submit Request</button>
    </form>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  
  <script>
    // Initialize AOS animation
    AOS.init({
      duration: 800,
      once: true
    });

    // Set minimum date to today
    function setMinDate() {
      let today = new Date().toISOString().slice(0, 16);
      document.getElementById("outing-date").min = today;
      document.getElementById("return-date").min = today;
    }

    // Validate dates (return must be after outing)
    function validateDates() {
      let outingDate = document.getElementById("outing-date").value;
      let returnDate = document.getElementById("return-date").value;

      if (returnDate && outingDate && new Date(returnDate) <= new Date(outingDate)) {
        alert("Return date & time must be after the outing date & time.");
        document.getElementById("return-date").value = "";
      }
    }

    // Fetch student details via AJAX
    function fetchStudentDetails(firstName) {
      if (firstName === "") {
        document.getElementById("middle-name").value = "";
        document.getElementById("last-name").value = "";
        document.getElementById("student-id").value = "";
        return;
      }

      var xhr = new XMLHttpRequest();
      xhr.open("GET", "fetch_student.php?first_name=" + encodeURIComponent(firstName), true);
      xhr.onload = function () {
        if (xhr.status === 200) {
          try {
            var data = JSON.parse(xhr.responseText);
            if (data) {
              document.getElementById("middle-name").value = data.middle_name || "";
              document.getElementById("last-name").value = data.last_name || "";
              document.getElementById("student-id").value = data.token_no || "";
            }
          } catch (e) {
            console.error("JSON Parsing Error:", e);
          }
        } else {
          console.error("XHR Failed:", xhr.status);
        }
      };
      xhr.send();
    }

    // Initialize on page load
    window.onload = setMinDate;
  </script>
</body>
</html>
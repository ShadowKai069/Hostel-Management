<!DOCTYPE html>
<html lang="en-US">

<head>
  <!-- Meta setup -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="keywords" content="">
  <meta name="decription" content="">
  <meta name="author" content="Asad Kabir">
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <!-- Title -->
  <title> OUTING</title>

  <!-- Fav Icon -->
  <link rel="icon" href="img/fav.png" />

  <!-- Include Font-Awesome -->
  <link rel="stylesheet" href="css/all.css" />

  <!-- Include Bootstrap -->
  <link rel="stylesheet" href="css/bootstrap.css" />

  <!-- Include Wow -->
  <link rel="stylesheet" href="css/animate.css" />

  <!-- Main StyleSheet -->
  <link rel="stylesheet" href="style.css" />


  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

  <!-- Responsive CSS -->
  <link rel="stylesheet" href="css/responsive.css" />

  <link href="css/flaticon.css" rel="stylesheet" type="text/css" /> <!-- flat icons css -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">


  <link href="product/vendor/icons/css/materialdesignicons.min.css" media="all" rel="stylesheet" type="text/css" />
  <!-- Select2 CSS -->

  <!-- Custom styles for this template -->
  <link href="product/css/osahan.css" rel="stylesheet">
  <!-- Owl Carousel -->
  <link rel="stylesheet" href="product/vendor/owl-carousel/owl.carousel.css">
  <link rel="stylesheet" href="product/vendor/owl-carousel/owl.theme.css">


  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

</head>

<style>
  .company-part{
    text-align:right;
    margin-top:30px;
  }
  .company-part h1{
    font-size:100px;
    font-family: "Times New Roman", Times, serif;
}

  .headerlinks {
    text-align: justify;
  }

  .headerlinks li {
    display: flex;
    gap: 28px;
    flex-direction: row;
    /* align-items: center; */
    justify-content: center;
    padding-top: 11px;
    margin-left: 140%;
}
  
  .services li {
    display: flex;
    gap: 20px;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    padding-top: 33px;
  }
  .home-logo img {
    border-radius: 1%;
    WIDTH: 81%;
    margin-top: -6px;
    margin-left: -174px;
}     
  

  ul.menu_links li a {
    display: flex;
  justify-content: flex-end;
  float: right;

    font-size: 19px;
    font-weight: bolder;
    font-family: auto;
    text-transform: uppercase;
    color: #FFF;
    margin-left: 301px;
  }

  ul.info li a {
    font-weight: bolder;
    font-family: auto;
    text-transform: uppercase;
  }

  section.home {
    background-image: linear-gradient(to right,blue, rgb(247, 147, 69));
    color: #FFF;
    HEIGHT: 102PX;
  }
 
  .container2 {
    max-width: 621px;
    margin-top: 53px;
    margin-left: 492px;
    padding: 25px;
    background: white;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}
        label {
            font-weight: bold;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            margin: 5px 0 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background: #28a745;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background: #218838;
        }
        body{
     /*background-color: rgb(212, 207, 223)*/
     background-image:url(hostel-blur.jpg);
   
   background-size: cover;
}
.menu_links a:hover {
      color: yellow;
    }

</style>
<body>
  <!--heading section begins-->
  <section class="home">`
    <div class="container">
      <div class="row">
        <div class="col-md-2">
          <div class="home-logo">
            <img src="C:\Users\DELL\Pictures\logo-nttf.jpg" height="70" width="150">
          </div>
        </div>
        <div class="col-md-7">
          <div class="headerlinks">
            <header>
              <nav>
                <ul class="menu_links">
                  <li>
                    <a href="C:\Users\DELL\Desktop\hostel-managemen\dashboard.html">Dashboard</a>
                    
                  </li>
                </ul>
              </nav>
            </header>

          </div>
       
      </div>
    </div>
  </section>
<!--heading section ends-->


<div class="container2">
  <h2 data-aos="fade-down"><span style="color: blue;">Hostel Outing Entry Form</span></h2>
  <form action="submit_outing.php" method="post" enctype="multipart/form-data">
      
<!-- First Name Dropdown -->
<label for="first-name">First Name:<span style="color:red">*</span></label>
<select id="first-name" name="first-name" required onchange="fetchStudentDetails(this.value)">
    <option value="" disabled selected>Choose First Name</option>
    <?php
        define('SECURE_INCLUDE', true);
        include 'db.php';

        $query = "SELECT DISTINCT first_name FROM students"; // Fetch unique first names
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='".$row['first_name']."'>".$row['first_name']."</option>";
        }
    ?>
</select>

<style>
  select#first-name {
      width: 100%;
      padding: 10px;
      border: 2px solid #007bff;
      border-radius: 5px;
      font-size: 16px;
      background-color: #f8f9fa;
      color: #333;
      transition: all 0.3s ease;
  }
  
  select#first-name:focus {
      border-color: #0056b3;
      outline: none;
      box-shadow: 0 0 5px rgba(0, 91, 187, 0.5);
  }
</style>

<br><br>

<!-- Auto-Filled Fields -->
<label for="middle-name">Middle Name:</label>
<input type="text" id="middle-name" name="middle-name" readonly>
<br><br>

<label for="last-name">Last Name:</label>
<input type="text" id="last-name" name="last-name" readonly>
<br><br>

<label for="student-id">Student ID:</label>
<input type="text" id="student-id" name="student-id" readonly>
<br><br>

<script>
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
            console.log("Server Response:", xhr.responseText); // Debugging
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

</script>

      <!-- Outing Purpose -->
      <label for="outing-purpose">Purpose of Outing:<span style="color:red">*</span></label>
      <textarea id="outing-purpose" name="outing-purpose" required></textarea>
      <br><br>

      <label for="outing-date">Outing Date & Time:<span style="color:red">*</span></label>
<input type="datetime-local" id="outing-date" name="outing-date" required min="" onchange="validateDates()">
<br><br>

<label for="return-date">Expected Return Date & Time:<span style="color:red">*</span></label>
<input type="datetime-local" id="return-date" name="return-date" required min="" onchange="validateDates()">
<br><br>

<script>
  function setMinDate() {
      let today = new Date().toISOString().slice(0, 16);
      document.getElementById("outing-date").min = today;
      document.getElementById("return-date").min = today;
  }

  function validateDates() {
      let outingDate = document.getElementById("outing-date").value;
      let returnDate = document.getElementById("return-date").value;

      if (returnDate && outingDate && new Date(returnDate) <= new Date(outingDate)) {
          alert("Return date & time must be after the outing date & time.");
          document.getElementById("return-date").value = "";
      }
  }

  window.onload = setMinDate;
</script>


      <!-- Destination -->
      <label for="destination">Destination:<span style="color:red">*</span></label>
      <input type="text" id="destination" name="destination" required>
      <br><br>

      <!-- Warden Approval -->
      <label>Warden Approval:</label>
      <input type="radio" id="approval-yes" name="warden-approval" value="Yes" required>
      <label for="approval-yes">Yes</label>
      <input type="radio" id="approval-no" name="warden-approval" value="No">
      <label for="approval-no">No</label>
      <br><br>

      <!-- Upload Application (PDF, JPEG, PNG) -->
      <label for="outing-application">Upload Application (PDF/JPEG/PNG):<span style="color:red">*</span></label>
      <input type="file" id="outing-application" name="outing-application" accept="application/pdf, image/jpeg, image/png" required>
      <br><br>        <button type="submit">Submit</button>
    </form>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 1000,  // Animation duration
    once: true       // Ensures animation happens only once
  });
</script>
</html>


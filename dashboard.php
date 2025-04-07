<?php
define('SECURE_INCLUDE', true);
include 'db.php';

session_start();
// if (!isset($_SESSION['user_id'])) {
//     header("Location: login.html");
//     die("Access Denied: Please log in first.");
//     exit();
// }

if (session_status() == PHP_SESSION_NONE) {
  session_start();
  session_regenerate_id(true);
}

?>

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
  <title> Dashboard</title>

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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">

  <link href="product/vendor/icons/css/materialdesignicons.min.css" media="all" rel="stylesheet" type="text/css" />
  <!-- Select2 CSS -->

  <!-- Custom styles for this template -->
  <link href="product/css/osahan.css" rel="stylesheet">
  <!-- Owl Carousel -->
  <link rel="stylesheet" href="product/vendor/owl-carousel/owl.carousel.css">
  <link rel="stylesheet" href="product/vendor/owl-carousel/owl.theme.css">

  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

  

  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: white;
      color: white;
    }

    section.home {
      background-image: linear-gradient(to right, blue, rgb(247, 147, 69));
      color: #FFF;
      height: 102px;
      display: flex;
      align-items: center;
    }

    .home-logo img {
      border-radius: 1%;
      width: 150px;
      height: 70px;
    }

    .headerlinks {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-grow: 1;
    }

    .menu_links {
      display: flex;
      gap: 20px;
      list-style: none;
      padding: 0;
    }

    .menu_links li {
      display: flex;
      align-items: center;
    }

    .menu_links a {
      font-size: 19px;
      font-weight: bolder;
      font-family: auto;
      text-transform: uppercase;
      color: #FFF;
      text-decoration: none;
      transition: color 0.3s ease-in-out;
    }

    .menu_links a:hover {
      color: yellow;
    }

    .dropdown {
      position: relative;
      display: inline-block;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background-color: white;
      min-width: 150px;
      box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
      padding: 14px;
      z-index: 1;
    }

    .dropdown:hover .dropdown-content {
      display: block;
    }

    .container2 {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin: 20px;
      background: rgb(244, 239, 239);
      padding: 20px;
      border-radius: 10px;
      color: black;
      animation: fadeIn 1s ease-in-out;
    }

    .sidebar {
      width: 45%;
      text-align: center;
    }

    .sidebar h2 {
      color: #1d09d2;
      text-align: center;
    }

    .sidebar button {
      width: 90%;
      padding: 15px;
      margin: 10px 0;
      border: none;
      background: rgb(246, 123, 8);
      color: white;
      font-size: 16px;
      cursor: pointer;
      text-align: center;
      transition: transform 0.3s ease-in-out;
    }

    .sidebar button:hover {
      background: #5C0E02;
      transform: scale(1.05);
    }

    .image-section {
      width: 50%;
      text-align: center;
    }

    .image-section img {
      width: 45%;
      margin: 10px;
      border-radius: 5px;
      transition: transform 0.3s ease-in-out;
    }

    .image-section img:hover {
      transform: scale(1.1);
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }
      to {
        opacity: 1;
      }
    }
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: white;
      color: white;
    }

    section.home {
      background-image: linear-gradient(to right, blue, rgb(247, 147, 69));
      color: #FFF;
      height: 102px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 20px;
    }

    .home-logo img {
      border-radius: 1%;
      width: 150px;
      height: 70px;
    }

    .headerlinks {
      display: flex;
      justify-content: flex-end;
      align-items: center;
      flex-grow: 1;
    }

    .menu_links {
      display: flex;
      gap: 20px;
      list-style: none;
      padding: 0;
    }

    .menu_links li {
      display: flex;
      align-items: center;
    }

    .menu_links a {
      font-size: 19px;
      font-weight: bolder;
      font-family: auto;
      text-transform: uppercase;
      color: #FFF;
      text-decoration: none;
      transition: color 0.3s ease-in-out;
    }

    .menu_links a:hover {
      color: yellow;
    }

    .dropdown {
      position: relative;
      display: inline-block;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background-color: white;
      min-width: 150px;
      box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
      padding: 14px;
      z-index: 1;
      margin-top: 343px;
    }

    .dropdown-content a {
      display: block;
      color: black;
      padding: 5px 0;
      text-decoration: none;
    }

    .dropdown-content a:hover {
      background-color: lightgray;
    }

    .dropdown:hover .dropdown-content {
      display: block;
    }

    .container2 {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin: 20px;
      background: rgb(244, 239, 239);
      padding: 20px;
      border-radius: 10px;
      color: black;
      animation: fadeIn 1s ease-in-out;
    }

    .sidebar {
      width: 45%;
      text-align: center;
    }

    .sidebar h2 {
      color: #1d09d2;
      text-align: center;
    }

    .sidebar button {
      width: 90%;
      padding: 15px;
      margin: 10px 0;
      border: none;
      background: rgb(246, 123, 8);
      color: white;
      font-size: 16px;
      cursor: pointer;
      text-align: center;
      transition: transform 0.3s ease-in-out;
    }

    .sidebar button:hover {
      background: #5C0E02;
      transform: scale(1.05);
    }

    .image-section {
      width: 50%;
      text-align: center;
    }

    .image-section img {
      width: 45%;
      margin: 10px;
      border-radius: 5px;
      transition: transform 0.3s ease-in-out;
    }

    .image-section img:hover {
      transform: scale(1.1);
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }
      to {
        opacity: 1;
      }
    }
  </style>
</head>
<body>


  <section class="home">
    <div class="home-logo">
      <img src="images/nttf logo white back.jpeg" alt="Logo">
    </div>
    <div class="headerlinks">
      <nav>
        <ul class="menu_links">
          <li><a href="dashboard.php">Dashboard</a></li>

          <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') { ?>
    <li><a href="assign_roles.php">Manage User Roles</a></li>
<?php } ?>

<li class="dropdown">
  <a href="#">ADMIN</a>
  <div class="dropdown-content">
    <a href="ADD-NEW-ROOMS.html">➕ Add Room</a>
    <a href="student_registration.php">👨‍🎓 Add Student</a>
    <a href="staff-details.html">👨‍🏫 Add Staff</a>
    <a href="outing-student.php">🚶 Outing Details</a>
    <a href="inventory.html">📦 Inventory</a>
    <a href="expenses.html">💰 Expenses</a>
    <a href="attendance.php">📍 Mark Attendance</a>
  </div>
</li>

          <li><a href="#">REPORTS</a></li>
          <li><a href="statistics.html">STATISTICS</a></li>
          <li><a href="logout.php">LOGOUT</a></li>
        </ul>
      </nav>
    </div>
  </section>

  <div class="container2">
    <div class="sidebar">
      <h2><strong>WELCOME TO HOSTEL MANAGEMENT SYSTEM</strong></h2>
      <a href="manage-rooms.php"><button>Room Details</button></a>
      <a href="students_list.php"><button>Student Details</button></a>
      <a href="students_list.php"><button>Staff Details</button></a>
      <a href="outing_list.php"><button>Outing Details</button></a>
      <a href="students_list.php"><button>Inventory Management</button></a>
      <a href="expenses.html"><button>Expenses Management</button></a>
      <a href="view_attendance.php"><button>Attendance Record</button></a>
    </div>
    <div class="image-section">
      <img src="images/bunk bed.png" alt="Room Image 1" >
      <br>
      <br>
      <img src="images/canteen.png" alt="Room Image 2">
    </div>
  </div>
</body>
</html>

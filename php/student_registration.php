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
  <title> student registration</title>

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
    margin-top: 12px;
    margin-left: -178px;
}
        
.menu_links a:hover {
      color: yellow;
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
    max-width: 840px;
    margin-top: 63px;
    margin-left: 340px;
    background: white;
    padding: 37px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
        label {
            font-weight: bold;
        }
        input, select, textarea {
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
</style>
<body>
  <!--heading section begins-->
  <section class="home">
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
                    
                  
              </div>
          
                </ul>
              </nav>
            </header>
          </div>
        </div>
      </div>
  </section>
<!--heading section ends-->

<!-- Script for room details fetch -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    let roomSelect = document.getElementById("room-no");
    let bedSelect = document.getElementById("bed-no");
    let feesInput = document.getElementById("fees");
    let durationSelect = document.getElementById("duration");
    let totalFeesInput = document.getElementById("total-fees");

    // Fetch room numbers and their prices
    fetch("get_rooms_details.php")
        .then(response => response.json())
        .then(data => {
            data.forEach(room => {
                let option = document.createElement("option");
                option.value = room.room_no;
                option.textContent = `Room ${room.room_no}`;
                option.setAttribute("data-price", room.price); // Store price in attribute
                roomSelect.appendChild(option);
            });
        })
        .catch(error => console.error("Error fetching rooms:", error));

    // Fetch beds and room price when a room is selected
    roomSelect.addEventListener("change", function () {
        let selectedRoom = roomSelect.value;
        let selectedOption = roomSelect.options[roomSelect.selectedIndex];
        let price = selectedOption.getAttribute("data-price");

        // Update Fees Per Month field
        feesInput.value = price ? price : "";

        if (selectedRoom) {
            fetch(`get_beds_details.php?room_no=${selectedRoom}`)
                .then(response => response.json())
                .then(data => {
                    bedSelect.innerHTML = '<option value="">Select Bed</option>'; // Reset options
                    for (let i = 1; i <= data.total_beds; i++) {
                        let option = document.createElement("option");
                        option.value = i;
                        option.textContent = "Bed " + i;
                        bedSelect.appendChild(option);
                    }
                })
                .catch(error => console.error("Error fetching beds:", error));
        } else {
            bedSelect.innerHTML = '<option value="">Select Bed</option>'; // Reset if no room selected
        }
    });

    // Calculate total fees based on duration and fee per month
    function calculateTotalFees() {
        let monthlyFee = parseFloat(feesInput.value) || 0;
        let duration = parseInt(durationSelect.value) || 0;
        let total = monthlyFee * duration;
        totalFeesInput.value = total ? `Rs. ${total}` : "";
    }

    // Event listener for duration selection change
    durationSelect.addEventListener("change", calculateTotalFees);
    feesInput.addEventListener("input", calculateTotalFees);
});
</script>




<form action="insert_student.php" method="POST" enctype="multipart/form-data">
<div class="container2">
  <h3 style="color: green;">Room Related Info</h3>

  <!-- Room Number Dropdown -->
  <label for="room-no" required data-aos="zoom-in">Room No.:</label>
  <select id="room-no" name="room_no">
    <option value="2">Select Room</option>
</select>


  <br><br>

<!-- Bed Number Dropdown -->
<label for="bed-no" required data-aos="zoom-in">Bed No.:</label>
<select id="bed-no" name="bed_no">
    <option value="">Select Bed</option>
</select>


  <br><br>

  

  <!-- Fees Per Month -->
  <label for="fees">Fees Per Month:</label>
  <input type="text" id="fees" name="fees" placeholder="Enter monthly fee" readonly required data-aos="zoom-in">

  <br><br>

  <!-- Stay From Date -->
  <label for="stay-from">Stay From:</label>
  <input type="date" id="stay-from" name="stay_from" required data-aos="zoom-in">

  <br><br>

  <!-- Duration Dropdown -->
  <label for="duration">Duration:</label>
  <select id="duration" name="duration">
      <option value="">Select Duration in Month</option>
      <option value="1">1 Month</option>
      <option value="3">3 Months</option>
      <option value="6">6 Months</option>
      <option value="12">12 Months</option>
  </select>

  <!-- Total Fees -->
  <label for="totalfees">Total Fees:</label>
  <input type="" id="total-fees" name="total_fees" placeholder="total fees" readonly required data-aos="zoom-in">

<br><br>
<h3 style="color: green;">Personal Info</h3>

    <h4 data-aos="fade-left"><span style="color: blue;">Student Registration</span></h4>
    
        <div class="mb-3">
            <label for="token_no" class="form-label" data-aos="fade-up">Token No:</label>
            <input type="text" id="token_no" name="token_no" required data-aos="zoom-in">
        </div>

        <div class="mb-3">
            <label for="first_name" class="form-label" data-aos="fade-up">First Name:</label>
            <input type="text" class="form-control" id="first_name" name="first-name" placeholder="Enter First Name" required data-aos="zoom-in">
        </div>

        <div class="mb-3">
            <label for="middle_name" class="form-label" data-aos="fade-up">Middle Name:</label>
            <input type="text" class="form-control" id="middle-name" name="middle-name" placeholder="Enter Middle Name">
        </div>

        <div class="mb-3">
            <label for="last_name" class="form-label" data-aos="fade-up">Last Name:</label>
            <input type="text" class="form-control" id="last_name" name="last-name"  placeholder="Enter Last Name" required data-aos="zoom-in">
        </div>

        <div class="mb-3">
            <label for="gender" class="form-label" data-aos="fade-up">Gender:</label>
            <select class="form-select" id="gender" name="gender" required data-aos="zoom-in">
                <option selected>Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="contactNo" class="form-label" data-aos="fade-up">Contact No:</label>
            <input type="text" class="form-control" name="contact-no" id="contact-no" placeholder="Enter Contact No" required data-aos="zoom-in">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label" data-aos="fade-up">Email ID:</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" required data-aos="zoom-in">
        </div>

        
          <div class="mb-3">
              <label for="studentaddress" class="form-label">Address:</label>
              <textarea class="form-control" id="studentaddress" rows="2" name="studentaddress" required data-aos="zoom-in"></textarea>
          </div>
          <div class="mb-3">
              <label for="corrCity" class="form-label">City:</label>
              <input type="text" class="form-control" id="corrCity" name="corrCity" required data-aos="zoom-in">
          </div>
          <div class="mb-3">
              <label for="corrState" class="form-label">State:</label>
              <select class="form-select" id="corrState" name="corrState" required data-aos="zoom-in">
                <option value="Andhra Pradesh">Andhra Pradesh</option>
                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                <option value="Assam">Assam</option>
                <option value="Bihar">Bihar</option>
                <option value="Chhattisgarh">Chhattisgarh</option>
                <option value="Goa">Goa</option>
                <option value="Gujarat">Gujarat</option>
                <option value="Haryana">Haryana</option>
                <option value="Himachal Pradesh">Himachal Pradesh</option>
                <option value="Jharkhand">Jharkhand</option>
                <option value="Karnataka">Karnataka</option>
                <option value="Kerala">Kerala</option>
                <option value="Madhya Pradesh">Madhya Pradesh</option>
                <option value="Maharashtra">Maharashtra</option>
                <option value="Manipur">Manipur</option>
                <option value="Meghalaya">Meghalaya</option>
                <option value="Mizoram">Mizoram</option>
                <option value="Nagaland">Nagaland</option>
                <option value="Odisha">Odisha</option>
                <option value="Punjab">Punjab</option>
                <option value="Rajasthan">Rajasthan</option>
                <option value="Sikkim">Sikkim</option>
                <option value="Tamil Nadu">Tamil Nadu</option>
                <option value="Telangana">Telangana</option>
                <option value="Tripura">Tripura</option>
                <option value="Uttar Pradesh">Uttar Pradesh</option>
                <option value="Uttarakhand">Uttarakhand</option>
                <option value="West Bengal">West Bengal</option>
            
                <!-- Union Territories -->
                <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                <option value="Chandigarh">Chandigarh</option>
                <option value="Dadra and Nagar Haveli and Daman and Diu">Dadra and Nagar Haveli and Daman and Diu</option>
                <option value="Delhi">Delhi</option>
                <option value="Lakshadweep">Lakshadweep</option>
                <option value="Puducherry">Puducherry</option>
                <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                <option value="Ladakh">Ladakh</option>
              </select>
          </div>
          <div class="mb-3">
              <label for="corrPincode" class="form-label" required data-aos="zoom-in">Pincode:</label>
              <input type="text" class="form-control" name="corrPincode" id="corrPincode" required data-aos="zoom-in">
          </div>
      
       
          <h4>Upload Student Documents</h4>

          <!-- Student Photo Upload -->
          <label for="student-photo">Upload Student Photo (JPEG, PNG):</label>
          <input type="file" id="student-photo" name="student-photo" accept="image/jpeg, image/png" required data-aos="zoom-in">
      
          <br><br>
      
          <!-- Aadhaar Card Photo Upload -->
          <label for="aadhaar-photo">Upload Aadhaar Card Photo (JPEG, PNG, PDF):</label>
          <input type="file" id="aadhaar-photo" name="aadhaar-photo" accept="image/jpeg, image/png, application/pdf" required data-aos="zoom-in">
      
          <br><br>
      
         

<h4 data-aos="fade-left"><span style="color: blue;">Parent/Guardian Registration</span></h4>
        <label for="parent-name" data-aos="fade-up">Parent/Guardian Name:</label>
        <input type="text" id="parent-name" name="parent-name" required data-aos="zoom-in">

        <label for="parent-contact" data-aos="fade-up">Parent Contact:</label>
        <input type="tel" id="parent-contact" name="parent-contact" required data-aos="zoom-in">

        <label for="parent-address" data-aos="fade-up">Address:</label>
        <textarea id="address" name="parentaddress" rows="3" required data-aos="zoom-in"></textarea>

        
        <h4>Upload Parents Documents</h4>

        <!-- Student Photo Upload -->
        <label for="student-photo">Upload Parent Photo (JPEG, PNG):</label>
        <input type="file" id="student-photo" name="student-photo" accept="image/jpeg, image/png" required data-aos="zoom-in">
    
        <br><br>
    
        <!-- Aadhaar Card Photo Upload -->
        <label for="parent-aadhaar-photo">Upload Parent Aadhaar Card (JPEG, PNG, PDF):</label>
        <input type="file" id="parent-aadhaar-photo" name="parent-aadhaar-photo" accept="image/jpeg, image/png, application/pdf">

        <br><br>

        


        <button type="submit">Submit</button>
    </form>
</div>
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


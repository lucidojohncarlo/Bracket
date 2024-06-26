<?php
@include 'config.php';

session_start();

if(!isset($_SESSION['user_name'])){
   header('location:login_form.php');
}
// Logout function
if (isset($_GET['logout'])) {
   session_unset();
   session_destroy();
   header('location: login_form.php');
   exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $teamName = $_POST['team_name'];
    $participantName = $_POST['participant_name'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phone_number'];

    // Prepare the SQL statement to insert data into the team_participants table
    $sql = "INSERT INTO team_participants (team_name, participant_name, email, phone_number) VALUES (?, ?, ?, ?)";
    
    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);
    
    // Bind parameters and execute the statement
    $stmt->bind_param("ssss", $teamName, $participantName, $email, $phoneNumber);
    $stmt->execute();

    // Check if the data is inserted successfully
    if ($stmt->affected_rows > 0) {
        // Data inserted successfully
        echo "Team participant added successfully!";
    } else {
        // Error occurred while inserting data
        echo "Error: Unable to add team participant.";
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Bracket Tournament System</title>
   
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <link rel="stylesheet" href="css/custom.css">
   <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
   
   <!-- jQuery and Bootstrap JS -->
   <script src="js/jquery-3.2.1.min.js"></script>
   <script src="js/popper.min.js"></script>
   <script src="js/bootstrap.min.js"></script>

   <!-- Custom CSS -->
   <style>
      body {
         background-color: #f8f9fa;
      }

      #header {
         background-color: #003da7;
         color: #ffffff;
         padding: 12px;
         display: flex;
         justify-content: space-between;
         align-items: center;
      }

      #header-left {
         display: flex;
         align-items: center;
      }

      #logoutBtn {
         display: none;
         position: absolute;
         top: 10px;
         right: 0;
      }

      .content {
         margin-top: 0;
      }

      #calendar {
         max-width: 800px;
         margin: 0 auto;
      }

      #dashboard-content {
         padding: 10px;
         background-color: #ffffff;
         border: 2px solid #ddd;
         border-radius: 0;
      }

      .nav-box {
         border: 1px solid #ddd;
         padding: 15px;
         margin: 15px;
         text-align: center;
      }

      .nav-logo {
         max-width: 100px;
         margin-bottom: 10px;
      }

      .nav-content {
         font-size: 15px;
      }


   </style>
</head>
<body>


<div id="content">
  <!-- Topbar -->
  <nav class="navbar navbar-expand mb-1">
      <div id="header" class="col-12 d-flex justify-content-between align-items-center">
         <div id="header-left" class="d-flex align-items-center">
            <img src="logo.png" style="object-fit: cover; object-position: center center" width="30" height="30" class="d-inline-block align-top" alt="Logo">
            <span><?php echo "Bracket Tournament System"; ?></span>
         </div>
         <div class="d-flex align-items-center">
            <h6 class="mb-0">Welcome Back, <span><?php echo $_SESSION['user_name']; ?></span></h6>
            <div class="topbar-divider d-none d-sm-block mx-2"></div>
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow list-unstyled">
               <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="mr-2 d-none d-lg-inline text-gray-600 small"></span>
               </a>
               <!-- Dropdown - User Information when log out-->
               <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                     <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                     Logout
                  </a>
               </div>
            </li>
         </div>
      </div>
  </nav>
  <!-- End of Topbar -->

  <!-- Main Content -->
  <div class="container-fluid">
     <div class="row">
        <main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-md-12">
           <div class="content">
              <div id="dashboard-content">
                 <h5>Dashboard</h5>
              </div>
           </div>
        </main>
     </div>
  </div>

  <nav id="core-nav" class="navbar navbar-expand-md navbar-light bg-light">
     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
     </button>
     <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          
           </li>
           <li class="nav-item">
              <div class="nav-box">
                 <img src="managesytem.png" alt="Manage System" class="nav-logo">
                 <a class="nav-link" href="manage_system.php">View Tournament</a>
              </div>
           </li>
           <li class="nav-item">
              <div class="nav-box">
                 <img src="generate-report.png" alt="Generate Report" class="nav-logo">
                 <a class="nav-link" href="participant_list.php">Participant</a>
              </div>
           </li>
           <li class="nav-item">
              <div class="nav-box">
                 <img src="Create.png" alt="Calendar Proposal" class="nav-logo">
                 <a class="nav-link" href="team_participants.php">Apply Team</a>
              </div>
          
           </li>
        </ul>
     </div>
  </nav>
  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
               <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
               </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
               <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
               <form action="logout.php" method="POST"> 
                  <button type="submit" name="logout_btn" class="btn btn-danger">Logout</button>
               </form>
            </div>
         </div>
      </div>
  </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-5ZGi0auFXAzE0Ma8FSKwZzO/35PLFiT0QquqkKu5ZZSqM1agpEBKTWHKj9bcxJ3" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wyk5qPIWOaXGpUFeU/E2W/t5Q92J0+WBX" crossorigin="anonymous"></script>

   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Include Bootstrap CSS and JS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wyk5qPIWOaXGpUFeU/E2W/t5Q92J0+WBX" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-5ZGi0auFXAzE0Ma8FSKwZzO/35PLFiT0QquqkKu5ZZSqM1agpEBKTWHKj9bcxJ3" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wyk5qPIWOaXGpUFeU/E2W/t5Q92J0+WBX" crossorigin="anonymous"></script>




   
</body>
</html>
<?php
// Include the database configuration file
include 'config.php';

// Determine the page to return to
$returnPage = isset($_GET['role']) && $_GET['role'] === 'admin' ? 'admin_page.php' : 'user_page.php';

$message = '';
$messageType = '';

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
        $message = "Team participant added successfully!";
        $messageType = "success";
    } else {
        // Error occurred while inserting data
        $message = "Error: Unable to add team participant.";
        $messageType = "danger";
    }

    // Close the statement
    $stmt->close();
}

// Fetch participants data from the database
$sql = "SELECT * FROM team_participants";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Apply for Team Participation</title>
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <!-- Custom CSS -->
   <style>
      body {
         background-color: #1a1a1a;
         color: #fff;
         font-family: 'Arial', sans-serif;
         padding-top: 50px;
      }
      .form-container {
         max-width: 500px;
         margin: auto;
         background-color: #2d2d2d;
         padding: 30px;
         border-radius: 10px;
         box-shadow: 0px 0px 20px 0px rgba(0,0,0,0.5);
      }
      .form-container h2 {
         text-align: center;
         margin-bottom: 30px;
         color: #00ff00;
         text-transform: uppercase;
         font-weight: bold;
      }
      .form-group label {
         font-weight: bold;
      }
      .form-group input {
         background-color: #333333;
         color: #fff;
         border: none;
         padding: 10px;
         border-radius: 5px;
      }
      .btn-custom {
         background-color: #00ff00;
         color: #1a1a1a;
         font-weight: bold;
      }
      .back-button {
         display: flex;
         justify-content: left;
         margin-top: 20px;
      }
      .alert-container {
         margin-top: 20px;
      }
      .table-container {
         margin-top: 50px;
         background-color: #2d2d2d;
         padding: 30px;
         border-radius: 10px;
         box-shadow: 0px 0px 20px 0px rgba(0,0,0,0.5);
      }
      .table-container h2 {
         text-align: center;
         margin-bottom: 30px;
         color: #00ff00;
         text-transform: uppercase;
         font-weight: bold;
      }
      .table {
         background-color: #1a1a1a;
         color: #fff;
      }
      .table thead {
         background-color: #00ff00;
      }
      .table thead th {
         color: #1a1a1a;
         text-align: center;
      }
      .table tbody tr {
         transition: background-color 0.3s ease;
      }
      .table tbody tr:hover {
         background-color: #333333;
      }
      .table tbody td {
         text-align: center;
      }
   </style>
</head>
<body>



    <div class="row table-container">
        <div class="col-md-12">
            <h2>Participants List</h2>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Team Name</th>
                        <th>Participant Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['team_name']}</td>
                                    <td>{$row['participant_name']}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='2'>No participants found</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
  <div class="back-button">
                    <a href="<?php echo $returnPage; ?>" class="btn btn-custom">Back</a>
                </div>
<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

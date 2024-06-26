<?php
include 'config.php';

// Fetch user data from the database
$query = "SELECT * FROM team_participants";
$result = mysqli_query($conn, $query);

if (!$result) {
  die("Error: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <style>
    body {
      font-family: 'Arial', sans-serif;
      margin: 0;
      background-color: #F7F7F7; /* Light grey */
      color: #333; /* Dark grey text */
    }

    header {
      background-color: #0047AB; /* Dark blue */
      padding: 10px;
      display: flex;
      align-items: center;
    }

    #logo {
      margin-right: 10px;
    }

    h1 {
      margin: 0;
      color: #FFF; /* White */
    }

    table {
      border-collapse: collapse;
      width: 100%;
      margin: 10px 0;
      overflow-x: auto;
    }

    th, td {
      padding: 8px;
      text-align: left;
      border: 1px solid #DDD; /* Light grey border */
    }

    th {
      background-color: #003366; /* Dark blue */
      color: #FFF; /* White text */
    }

    tr:nth-child(even) {
      background-color: #E6E6E6; /* Light grey background for even rows */
    }

    .back-button, .delete-button, .edit-button {
      padding: 10px 15px;
      font-size: 14px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      text-decoration: none;
      color: #FFF; /* White text */
      display: inline-block;
    }

    .back-button {
      background-color: #388E3C; /* Green */
      margin: 10px 0;
    }

    .delete-button {
      background-color: #D32F2F; /* Red */
    }

    .delete-button:hover {
      background-color: #B71C1C; /* Darker red on hover */
    }

    .edit-button {
      background-color: #1976D2; /* Blue */
      margin-right: 5px;
    }

    .edit-button:hover {
      background-color: #0D47A1; /* Darker blue on hover */
    }

    form.inline-form {
      display: inline-block;
    }
  </style>
</head>
<body>
 <body>
  <header>
    <img id="logo" src="logo.png" alt="Sports Tournament System Logo" width="100">
    <h1>Team List</h1>
  </header>

  <table>
    <tr>
      <th>Team Name</th>
      <th>Participant Name</th>
      <th>Email</th>
      <th>Phone Number</th>
      <th>Action</th>
    </tr>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td>" . htmlspecialchars($row['team_name']) . "</td>";
      echo "<td>" . htmlspecialchars($row['participant_name']) . "</td>";
      echo "<td>" . htmlspecialchars($row['email']) . "</td>";
      echo "<td>" . htmlspecialchars($row['phone_number']) . "</td>";

      echo "<td>
        <form action='adminEditUser.php' method='GET' class='inline-form'>
          <input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>
          <button type='submit' class='edit-button' name='edit' value='" . htmlspecialchars($row['id']) . "'>Edit</button>
          <a href='admindeleteuser.php?id=" . htmlspecialchars($row['id']) . "' class='delete-button'>Delete</a>
        </form>
      </td>";
      echo "</tr>";
    }
    ?>
  </table>

  <a href="admin_page.php" class="back-button">Back to Admin Page</a>

</body>
</html>

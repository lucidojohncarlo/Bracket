<?php
include 'config.php';

// Fetch user data from the database
$query = "SELECT * FROM user_form";
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
      font-family: 'Roboto', sans-serif;
      margin: 0;
      background-color: #071429; /* Deep blue */
      color: #FFFFFF; /* White text */
    }

    header {
      background-color: #00171F; /* Dark blue */
      padding: 10px;
      display: flex;
      align-items: center;
    }

    #logo {
      margin-right: 10px;
    }

    h1 {
      margin: 0;
      color: #FFD700; /* Gold */
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
      border: 1px solid #20465C; /* Light blue */
    }

    th {
      background-color: #00171F; /* Dark blue */
    }

    tr:nth-child(even) {
      background-color: #002F41; /* Darker blue */
    }

    .back-button, .delete-button, .edit-button {
      padding: 10px 15px;
      font-size: 14px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      text-decoration: none;
      color: white;
      display: inline-block;
    }

    .back-button {
      background-color: #00A86B; /* Green */
      margin: 10px 0;
    }

    .delete-button {
      background-color: #D73A49; /* Red */
    }

    .delete-button:hover {
      background-color: #AC2E3A; /* Darker red */
    }

    .edit-button {
      background-color: #1F77C5; /* Blue */
      margin-right: 5px;
    }

    .edit-button:hover {
      background-color: #145A8D; /* Darker blue */
    }

    form.inline-form {
      display: inline-block;
    }
  </style>
</head>
<body>
  <header>
    <img id="logo" src="logo.png" alt="Nu Laguna Calendar System Logo" width="100">
    <h1>User List</h1>
  </header>

  <table>
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>User Type</th>
      <th>Action</th>
    </tr>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td>" . htmlspecialchars($row['name']) . "</td>";
      echo "<td>" . htmlspecialchars($row['email']) . "</td>";
      echo "<td>" . htmlspecialchars($row['user_type']) . "</td>";
      echo "<td>
        <form action='edit_user.php' method='GET' class='inline-form'>
          <input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>
          <button type='submit' class='edit-button' name='edit' value='" . htmlspecialchars($row['id']) . "'>Edit</button>
          <a href='delete_user.php?id=" . htmlspecialchars($row['id']) . "' class='delete-button'>Delete</a>
        </form>
      </td>";
      echo "</tr>";
    }
    ?>
  </table>

  <a href="admin_page.php" class="back-button">Back</a>

</body>
</html>

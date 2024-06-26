<?php
// edit_user.php
// Start the session
session_start();
include 'config.php';

// Check if ID is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch user data based on the ID
    $query = "SELECT * FROM user_form WHERE id = $id";
    $result = mysqli_query($conn, $query);

    // Check if user data is found
    if ($row = mysqli_fetch_assoc($result)) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
        }

        form {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            width: 400px;
        }

        h2 {
            text-align: center;
            color: #3498db;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        input[type="text"], input[type="email"], input[type="password"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #3498db;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: block;
            width: 100%;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }

    </style>
</head>
<body>
    <form action="update_user.php" method="post">
        <h2>Edit User</h2>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
        
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>
        
        <label for="user_type">User Type:</label>
        <select id="user_type" name="user_type" required>
            <option value="admin" <?php echo ($row['user_type'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
            <option value="user" <?php echo ($row['user_type'] == 'user') ? 'selected' : ''; ?>>User</option>
            <!-- Add other user types as needed -->
        </select>
         <div class="button-container">
            <input type="submit" name="update" value="Update">
            <!-- Back button to go back to the previous page -->
            <a href="display_users.php" class="back-button">Back</a>
        </div>
       
    </form>

   
</body>
</html>
<?php
    } else {
        echo "User not found.";
    }
} else {
    echo "User ID not provided.";
}
?>

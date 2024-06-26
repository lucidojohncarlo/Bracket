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
            background-color: #171717; /* Dark background */
            font-family: 'Press Start 2P', cursive; /* Game-like font */
            color: #FFF; /* White text */
        }

        form {
            background-color: #222; /* Dark gray form background */
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.1); /* White shadow effect */
            width: 400px;
        }

        h2 {
            text-align: center;
            color: #FFD700; /* Gold color for headings */
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #FFD700; /* Gold color for labels */
        }

        input[type="text"], input[type="email"], input[type="password"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #FFD700; /* Gold border */
            border-radius: 4px;
            box-sizing: border-box;
            background-color: #333; /* Dark gray input background */
            color: #FFF; /* White text */
        }

        input[type="submit"] {
            background-color: #FFD700; /* Gold button background */
            color: #171717; /* Dark text */
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: block;
            width: 100%;
            font-size: 16px;
            margin-bottom: 10px;
        }

        input[type="submit"]:hover {
            background-color: #FFA500; /* Orange hover effect */
        }

        .button-container {
            text-align: center;
        }

        .back-button {
            background-color: #333; /* Dark gray button background */
            color: #FFD700; /* Gold text */
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            font-size: 16px;
            display: inline-block;
        }

        .back-button:hover {
            background-color: #555; /* Slightly lighter on hover */
        }

    </style>
</head>
<body>
    <form action="adminupdate_user.php" method="post">
        <h2>Edit User</h2>
        <?php
        // Start the session
        session_start();
        include 'config.php';

        // Check if ID is provided in the URL
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);  // Securely cast to integer to prevent SQL injection

            // Fetch user data based on the ID
            $query = "SELECT * FROM team_participants WHERE id = $id";
            $result = mysqli_query($conn, $query);

            // Check if user data is found
            if ($row = mysqli_fetch_assoc($result)) {
        ?>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
        
        <label for="team_name">Team Name:</label>
        <input type="text" id="team_name" name="team_name" value="<?php echo htmlspecialchars($row['team_name']); ?>" required>
        
        <label for="participant_name">Participant Name:</label>
        <input type="text" id="participant_name" name="participant_name" value="<?php echo htmlspecialchars($row['participant_name']); ?>" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>
        
        <input type="submit" name="update" value="Update">
        
        <div class="button-container">
            <a href="display_users.php" class="back-button">Back</a>
        </div>
        <?php
            } else {
                echo "User not found.";
            }
        } else {
            echo "User ID not provided.";
        }
        ?>
    </form>
</body>
</html>

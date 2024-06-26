<?php
@include 'config.php';

session_start();

if (isset($_POST['submit'])) {
    // Check if the keys exist before accessing them
    $name = isset($_POST['name']) ? mysqli_real_escape_string($conn, $_POST['name']) : null;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : null;
    $pass = isset($_POST['password']) ? md5($_POST['password']) : null;
    $cpass = isset($_POST['cpassword']) ? md5($_POST['cpassword']) : null;
    $user_type = isset($_POST['user_type']) ? $_POST['user_type'] : null;

    if ($email && $pass) {
        $select = "SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

        $result = mysqli_query($conn, $select);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);

            if ($row['user_type'] == 'admin') {
                $_SESSION['admin_name'] = $row['name'];
                header('location:admin_page.php');
            } elseif ($row['user_type'] == 'user') {
                $_SESSION['user_name'] = $row['name'];
                header('location:user_page.php');
            }
        } else {
            $error[] = 'Incorrect email or password!';
        }
    } elseif (!$email || !$pass) {
        $error[] = 'Please provide both email and password.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="index.css">
   <title>Login Form</title>
   <style>
      body {
         background-image: url('back.jpg');
         background-size: cover;
         background-position: center;
         background-repeat: no-repeat;
         margin: 0;
         font-family: Arial, sans-serif;
         display: flex;
         align-items: center;
         justify-content: center;
         height: 100vh;
      }

      .form-container {
         background: rgba(255, 255, 255, 0.8);
         padding: 0px;
         border-radius: 10px;
         text-align: center;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
         display: flex;
         max-width: 800px;
      }

      .left-section {
         flex: 1;
         padding: 20px;
         border-radius: 10px;
         text-align: center;
         background-color: #FF0000; /* red background color */
      }

      .right-section {
         flex: 1;
         padding: 20px;
         text-align: center;
      }

      form {
         display: flex;
         flex-direction: column;
         align-items: center;
      }

      h3 {
         margin-bottom: 20px;
         color: #000000; /* yellow text color */
      }

      .error-msg {
         color: red;
         margin-bottom: 10px;
      }

      input {
         margin-bottom: 15px;
         padding: 10px;
         width: 100%;
         box-sizing: border-box;
      }

      .form-btn {
         background-color: #003d87; /* Blue button color */
         color: white;
         padding: 10px;
         border: none;
         border-radius: 5px;
         cursor: pointer;
         transition: background-color 0.3s;
      }

      .form-btn:hover {
         background-color: #005bb5; /* Darker blue on hover */
      }

      img {
         max-width: 100%;
         max-height: 100px; /* Adjust the maximum height as needed */
         margin-bottom: 10px;
      }

      .show-password {
         display: flex;
         align-items: center;
         justify-content: flex;
         width: 100%;
         margin-top: -10px;
         margin-bottom: 5px;
      }

      .show-password label {
         display: flex;
         align-items: center;
         cursor: pointer;
         opacity: 0.7; /* Add transparency */
         font-size: 0.9em; /* Smaller font size */
      }

      .show-password input[type="checkbox"] {
         width: 12px;
         margin-right: 10px;

   </style>
   <script>
      function togglePasswordVisibility() {
         var passwordInput = document.getElementById('password');
         if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
         } else {
            passwordInput.type = 'password';
         }
      }
   </script>
</head>

<body>

<div class="form-container">

   <div class="left-section">
      <!-- Add your logo here -->
      <img src="logo.png" alt="Logo">
      <h3>Welcome to Bracket Tournament System</h3>
   </div>

   <div class="right-section">
      <form action="" method="post">
         <h3>Login Please</h3>
         <?php
         if (isset($error)) {
            foreach ($error as $error) {
               echo '<span class="error-msg">' . $error . '</span>';
            }
         }
         ?>
         <input type="email" name="email" required placeholder="Enter your email">
         <input type="password" id="password" name="password" required placeholder="Enter your password">
         <div class="show-password">
            <label>
               <input type="checkbox" onclick="togglePasswordVisibility()"> Show Password
            </label>
         </div>
         <input type="submit" name="submit" value="Login" class="form-btn">
      </form>
   </div>

</div>

</body>
</html>

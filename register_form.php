<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
         mysqli_query($conn, $insert);
         header('location: display_users.php');
      }
   }

};
?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register Form</title>

   <style>
      body {
         margin: 0;
         padding: 0;
         font-family: Arial, sans-serif;
         background-image: url('back.jpg'); /* Add your background image URL here */
         background-size: cover;
         background-position: center;
         display: flex;
         justify-content: center;
         align-items: center;
         height: 100vh;
      }

      .form-container {
         background-color: rgba(255, 255, 255, 0.8);
         padding: 20px;
         border-radius: 10px;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
         text-align: center;
         max-width: 400px; /* Adjust the maximum width as needed */
         width: 100%;
         box-sizing: border-box;
      }

      h3 {
         color: #333;
      }

      .error-msg {
         color: red;
      }

      input, select {
         width: calc(100% - 20px);
         padding: 10px;
         margin: 10px 0;
         box-sizing: border-box;
      }

      .form-btn {
         background-color: #000000;
         color: #fff;
         border: none;
         padding: 10px 20px;
         cursor: pointer;
         border-radius: 5px;
      }

   </style>
</head>

<body>

   <div class="form-container">

      <form action="" method="post">
         <h3>Create Account</h3>
         <?php
         if(isset($error)){
            foreach($error as $error){
               echo '<span class="error-msg">'.$error.'</span>';
            };
         };
         ?>
         <input type="text" name="name" required placeholder="Enter your name">
         <input type="email" name="email" required placeholder="Enter your email">
         <input type="password" name="password" required placeholder="Enter your password">
         <input type="password" name="cpassword" required placeholder="Confirm your password">
         <select name="user_type">
            <option value="user">User</option>
            <option value="admin">Admin</option>
         </select>
         <input type="submit" name="submit" value="Create Account" class="form-btn">
      </form>

   </div>

</body>

</html>


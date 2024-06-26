<?php
// update_user.php

include 'config.php';

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $user_type = $_POST['user_type'];

    // Update the user data
    $query = "UPDATE user_form SET name='$name', email='$email', user_type='$user_type' WHERE id = $id";
    mysqli_query($conn, $query);

    // Redirect back to the admin page
    header('location: display_users.php');
}
?>

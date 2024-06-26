<?php
// delete_user.php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Check if the user confirmed the deletion
    if (isset($_GET['confirm']) && $_GET['confirm'] === 'true') {
        // Delete the user based on the ID
        $query = "DELETE FROM user_form WHERE id = $id";
        $result = mysqli_query($conn, $query);

        if ($result) {
            header('location: display_users.php');
            exit; // Ensure script stops executing after redirect
        }
    } else {
        // Prompt the user for confirmation
        echo '<script>';
        echo 'if(confirm("Are you sure you want to delete this user?")) {';
        echo 'window.location.href = "delete_user.php?id=' . $id . '&confirm=true";';
        echo '} else {';
        echo 'window.location.href = "display_users.php";'; // Redirect back to display_users.php if cancel is clicked
        echo '}';
        echo '</script>';
    }
}
?>

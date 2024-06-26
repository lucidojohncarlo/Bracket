<?php
// Start the session
session_start();
include 'config.php';

// Check if the form is submitted
if (isset($_POST['update'])) {
    $id = intval($_POST['id']); // Securely cast to integer to prevent SQL injection
    $team_name = mysqli_real_escape_string($conn, $_POST['team_name']);
    $participant_name = mysqli_real_escape_string($conn, $_POST['participant_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Update the user data in the database
    $query = "UPDATE team_participants SET team_name='$team_name', participant_name='$participant_name', email='$email' WHERE id=$id";

    if (mysqli_query($conn, $query)) {
        // Redirect to display_users.php with a success message
        $_SESSION['message'] = "User updated successfully.";
        header("Location: admin_list_participants.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>

<?php
include 'config.php';

if(isset($_GET['id']) && !isset($_GET['confirm'])) {
    $id = $_GET['id'];
    
    // Prompt for confirmation
    echo "Are you sure you want to delete this team?";
    echo "<br>";
    echo "<a href='admindeleteuser.php?id=$id&confirm=true'>Yes</a>"; // Confirmation link
    echo " | ";
    echo "<a href='admin_list_participants.php'>No</a>";
} elseif (isset($_GET['id']) && isset($_GET['confirm'])) {
    $id = $_GET['id'];
    
    // Delete user based on ID
    $deleteQuery = "DELETE FROM team_participants WHERE id = $id";
    $deleteResult = mysqli_query($conn, $deleteQuery);
    
    if($deleteResult) {
        header("Location: admin_list_participants.php"); // Redirect back to your original page
        exit;
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>

function showUserInfo() {
    // Redirect to the user_info.php page with the user's ID as a query parameter
    var user_id = "<?php echo $_SESSION['user_id']; ?>";
    window.location.href = "user_info.php?user_id=" + user_id;
}
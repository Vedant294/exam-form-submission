<?php
session_start(); // Start session only if not already started
session_unset(); // Unset session variables
session_destroy(); // Destroy session
header("Location: login.php"); // Redirect to login page
exit();
?>

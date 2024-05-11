<?php
session_start();

// Clear the session
session_unset();
session_destroy();

// Redirect to the login page
header("Location: login.html");
exit();
?>

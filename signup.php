<?php
// Connect to the database
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'swapmeet';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user information from the form
$username = $_POST['username'];
$password = $_POST['password'];
$fullname = $_POST['fullname'];

// Insert user into the database
$query = "INSERT INTO users (username, password, fullname) VALUES ('$username', '$password', '$fullname')";
if ($conn->query($query) === TRUE) {
    // Redirect to the login page after successful signup
    header("Location: login.html");
} else {
    // Handle error if signup fails
    echo "Error: " . $query . "<br>" . $conn->error;
}

$conn->close();
?>

<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page
    header("Location: login.html");
    exit();
}

// Retrieve user information from the session
$username = $_SESSION['username'];

// Connect to the database
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'lab11';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user details from the database
$query = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$fullname = $row['fullname'];

// Display the profile page
echo "<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 400px;
            margin: 100px auto;
        }

        .card-header {
            background-color: #343a40;
            color: #fff;
            text-align: center;
            font-weight: bold;
        }

        .card-footer {
            background-color: #f8f9fa;
            border-top: none;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class='container'>
        <div class='card'>
            <div class='card-header'>
                User Profile
            </div>
            <div class='card-body'>
                <p><strong>Username:</strong> $username</p>
                <p><strong>Full Name:</strong> $fullname</p>
            </div>
            <div class='card-footer'>
                <a href='logout.php' class='btn btn-primary'>Sign out</a>
            </div>
        </div>
    </div>
</body>
</html>";

$conn->close();
?>

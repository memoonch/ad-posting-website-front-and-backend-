<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Database connection settings
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "swapmeet";

  // Create a new connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Prepare and bind the INSERT statement
  $stmt = $conn->prepare("INSERT INTO ads (name, description, item, location, image) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("sssss", $name, $description, $item, $location, $image);

  // Get the form data
  $name = $_POST["name"];
  $description = $_POST["description"];
  $item = $_POST["item"];
  $location = $_POST["location"];

  // Check if an image was uploaded
  if ($_FILES["image"]["error"] == 0) {
    $image = $_FILES["image"]["name"];
    $target = "uploads/" . basename($image);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target);
  } else {
    $image = ""; // If no image was uploaded, set it to an empty string or handle it as needed
  }

  // Execute the statement
  if ($stmt->execute()) {
    echo "Data inserted successfully.";
  } else {
    echo "Error: " . $stmt->error;
  }

  // Close the statement and connection
  $stmt->close();
  $conn->close();
}
?>

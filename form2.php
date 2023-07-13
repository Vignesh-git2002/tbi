<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  // Database configuration
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "tbi";

  // Create a connection to the database
  $conn = new mysqli($servername, $username, $password, $dbname);
  
  // Check if the connection was successful
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Retrieve the form data
  $regNo = $_POST['regno'];
  $name = $_POST['name'];
  $mobile = $_POST['mobile'];
  $email = $_POST['email'];
  $projectName = $_POST['projectName'];
  $teamDetails = $_POST['teamDetails'];
  $projectDescription = $_POST['projectDescription'];
  $startupDetails = $_POST['startupDetails'];
  $timeline = $_POST['timeline'];

  // Prepare and bind the SQL statement
  $stmt = $conn->prepare("UPDATE info SET name = ?, mobile = ?, email = ?, projectName = ?, teamDetails = ?, projectDescription = ?, startupDetails = ?, timeline = ? WHERE regNo = ?");
  $stmt->bind_param("sssssssss", $name, $mobile, $email, $projectName, $teamDetails, $projectDescription, $startupDetails, $timeline, $regNo);

  // Execute the statement
  if ($stmt->execute()) {
    echo "Details updated successfully.";
  } else {
    echo "Error updating details: " . $stmt->error;
  }

  // Close the statement and connection
  $stmt->close();
  $conn->close();
}
?>

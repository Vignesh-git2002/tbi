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
  $name = $_POST['name'];
  $mobile = $_POST['mobile'];
  $email = $_POST['email'];
  $projectName = $_POST['projectName'];
  $teamDetails = $_POST['teamDetails'];
  $projectDescription = $_POST['projectDescription'];
  $startupDetails = $_POST['startupDetails'];
  $timeline = $_POST['timeline'];

  $stmt = $conn->prepare("INSERT INTO info(name, mobile, email, projectName, teamDetails, projectDescription, startupDetails, timeline) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssssss", $name, $mobile, $email, $projectName, $teamDetails, $projectDescription, $startupDetails, $timeline);

  // Execute the statement
  if ($stmt->execute()) {
    echo "Form submitted successfully.";
    echo '<a href="form2.html">update details</a>';
    $sql = "SELECT RegNO FROM info WHERE name = ?";
    $stmt = $conn->prepare($sql);
    
    // Bind the value to the prepared statement
    $stmt->bind_param("s", $name);
    
    // Execute the query
    $stmt->execute();
    
    // Get the result
    $stmt->bind_result($regNo);
    
    // Fetch the result
    $stmt->fetch();
    
    // Display the result
    echo "Your register number is " . $regNo;
    
  } else {
    echo "Error submitting form: " . $stmt->error;
    
  }

  // Close the statement and connection
  $stmt->close();
  $conn->close();
}
?>

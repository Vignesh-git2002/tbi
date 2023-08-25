<?php
// Assuming your MySQL database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hello";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Escape user inputs to prevent SQL injection
    $regno = $conn->real_escape_string($_POST['regno']);
    $date = $conn->real_escape_string($_POST['Date']);
    $incubateename = $conn->real_escape_string($_POST['Incubateename']);
    $contactno = $conn->real_escape_string($_POST['Contactno']);
    $email = $conn->real_escape_string($_POST['email']);
    $companyname = $conn->real_escape_string($_POST['companyname']);
    $type = $conn->real_escape_string($_POST['type']);
    $partnership = $conn->real_escape_string($_POST['partnership']);
    $business = $conn->real_escape_string($_POST['business']);
    $detail = $conn->real_escape_string($_POST['detail']);
    $registrate = $conn->real_escape_string($_POST['registrate']);
    $problem = $conn->real_escape_string($_POST['problem']);

    // Create the SQL query to insert the values into the table
    $sql = "INSERT INTO stud (regno, date, incubateename, contactno, email, companyname, type, partnership, business, detail, registrate, problem)
            VALUES ('$regno', '$date', '$incubateename', '$contactno', '$email', '$companyname', '$type', '$partnership', '$business', '$detail', '$registrate', '$problem')";

    // Execute the query
    if ($conn->query($sql) === true) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

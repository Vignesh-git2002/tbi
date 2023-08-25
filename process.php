<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Function to fetch email by register number from the database
function getEmailByRegisterNumber($registerNumber)
{
    // Implement the database connection and query here to fetch the email
    // Replace the placeholders (DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) with your actual database credentials
    $sname = "localhost";
$uname = "root";
$password = "";
$db_name = "hello";

$connection = new mysqli($sname, $uname, $password, $db_name);

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

    $registerNumber = mysqli_real_escape_string($connection, $registerNumber);
    $sql = "SELECT email FROM stud WHERE regno = '$registerNumber' LIMIT 1";
    $result = mysqli_query($connection, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['email'];
    }

    return null;
}

// Check if the form is submitted with the register number
if (isset($_POST['regno'])) {
    // Get the register number from the form
    $registerNumber = $_POST['regno'];

    // Fetch the email using the register number
    $email = getEmailByRegisterNumber($registerNumber);

    // If the email is found, send the email using PHPMailer
    if ($email) {
        try {
            // Create a new instance of PHPMailer
            $mail = new PHPMailer(true);

            // Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'viswanathanvignesh466@gmail.com';     // SMTP username
            $mail->Password   = 'hdzqkorkyncmeqxa';                    // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Enable implicit TLS encryption
            $mail->Port       = 465;                                    // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            // Recipients
            $mail->setFrom('viswanathanvignesh466@gmail.com', 'Vignesh Viswanathan');
            $mail->addAddress($email, 'Recipient Name');

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            // Send the email
            $mail->send();
            echo 'Message has been sent to ' . $email;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Email not found for the given register number.";
    }
} else {
    echo "Invalid request. Please submit the form properly.";
}
?>

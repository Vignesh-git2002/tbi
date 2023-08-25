<?php
$sname = "localhost";
$uname = "root";
$password = "";
$db_name = "hello";

$connection = new mysqli($sname, $uname, $password, $db_name);
if(!$connection->connect_error)
{
    echo "<center><br><h1>TBI REGISTRATION ENTRIES<br><br><br></h1></center>";
}
$entriesPerPage = 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $entriesPerPage;
$sql = "SELECT * FROM stud LIMIT $offset, $entriesPerPage";
$countSql = "SELECT COUNT(*) AS total FROM stud"; 

$result = $connection->query($sql);
$countResult = $connection->query($countSql);
$totalEntries = $countResult->fetch_assoc()['total']; 
$totalPages = ceil($totalEntries / $entriesPerPage); 
$outputMessages = array();
if (isset($_GET['messages'])) {
    $outputMessages = json_decode($_GET['messages'], true);
}
?>

<html>
<head>
    <title></title>
    <style>

    th {
        background-color: #f2f2f2;
    }
        table {
            width: 850px;
        }
        .button {
  display: inline-block;
  border-radius: 10px;
  background-color: #f4511e;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 11px;
  padding: 5px;
  width: 65px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
  align:right;
}

.button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.button span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.button:hover span {
  padding-right: 25px;
}

.button:hover span:after {
  opacity: 1;
  right: 0;
}


.but{
  display: inline-block;
  border-radius: 10px;
  background-color: #f4511e;
  border: none;
  color: #f44336;
  text-align: center;
  font-size: 11px;
  padding: 5px;
  width: 65px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
  align:right;
}

.but span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.but span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.but:hover span {
  padding-right: 25px;
}

.but:hover span:after {
  opacity: 1;
  right: 0;
}
    </style>
</head>

<body>
    <h1></h1>

    <table>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
               
                $regno=$row['regno'];
                $Date= $row['date'];
                $Incubateename=$row['incubateename'];
                $Contactno=$row['contactno'];
                $registrate= $row['registrate'];
                $companyname=$row['companyname'];
                $problem=$row['problem'];
                $email=$row['email'];
                $type=$row['type'];
                $partnership=$row['partnership'];
                $business=$row['business'];
                $detail=$row['detail'];

                echo "<table style='margin: 0 auto;'>";
                echo "<tr>";
                echo "<td style='border: 1px solid #ccc;'><strong>Date:</strong></td><td style='border: 1px solid #ccc;'>$Date</td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td style='border: 1px solid #ccc;'><strong>Incubateename:</strong></td><td style='border: 1px solid #ccc;'>$Incubateename</td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td style='border: 1px solid #ccc;'><strong>Contactno:</strong></td><td style='border: 1px solid #ccc;'>$Contactno</td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td style='border: 1px solid #ccc;'><strong>Email ID:</strong></td><td style='border: 1px solid #ccc;'>$email</td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td style='border: 1px solid #ccc;'><strong>Companyname:</strong></td><td style='border: 1px solid #ccc;'>$companyname</td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td style='border: 1px solid #ccc;'><strong>Type of Incubatee:</strong></td><td style='border: 1px solid #ccc;'>$type</td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td style='border: 1px solid #ccc;'><strong>Individual or partnership:</strong></td><td style='border: 1px solid #ccc;'>$partnership</td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td style='border: 1px solid #ccc;'><strong>Nature of Incubatee business:</strong></td><td style='border: 1px solid #ccc;'>$business</td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td style='border: 1px solid #ccc;'><strong>Registration details (proprietorship/LLP/Private limited, etc.):</strong></td><td style='border: 1px solid #ccc;'>$detail</td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td style='border: 1px solid #ccc;'><strong>Startup registration details (MSME/startup India, etc.):</strong></td><td style='border: 1px solid #ccc;'>$registrate</td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td style='border: 1px solid #ccc;'><strong>Problem statement:</strong></td><td style='border: 1px solid #ccc;'>$problem</td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td>";
                echo "<form action='process.php' method='post'>";
                echo "<input type='hidden' name='regno' value='$regno'>";
                echo "<br><button class='button' type='submit' name='action' value='select' style=' background-color: #4CAF50;color: white; border:2px solid #4CAF50' ><span>Select</span></button><button  class='but' type='submit' name='action' value='reject' style=' background-color:#f44336;color: white;
                border: 2px solid #f44336' ><span>Reject</span></button>";
                
                echo "</form>";
                echo "</td>";
                echo "</tr>";

                echo "</table>";
                
                
            }
        } else {
            echo "<tr><td colspan='4'>No entries found.</td></tr>";
        }
        ?>
    </table>

    <?php
    if (!empty($outputMessages)) {
        echo "<h2>Output Messages:</h2>";
        echo "<table>";
        foreach ($outputMessages as $message) {
            echo "<tr><td>$message</td></tr>";
        }
        echo "</table>";
    }
    ?>

    <?php
    $connection->close();
    ?>
</body>

</html>


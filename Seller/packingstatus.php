<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "RSM";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
if($_GET['stat'] === "yes"){
    $stats = "1";
}
else
{
    $stats = "0";
}
$sql = " UPDATE orders SET Packing = '$stats' WHERE Id = '$id' ";
 
if ($conn->query($sql) === TRUE) {
    ?>
    <script>
        alert("Packing Status Updated Successfully!!");
        window.location = "http://localhost/RSM/SELLER/vieworders.php";
    </script>
<?php
} else {
    ?>
    <script>
        alert("Failed to Update Status!!");
        window.location = "http://localhost/RSM/SELLER/vieworders.php";
    </script>
<?php
}
$conn->close();

?>
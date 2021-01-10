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
$sql = " UPDATE items SET Status = '1' WHERE Id = '$id' ";
 
if ($conn->query($sql) === TRUE) {
    ?>
    <script>
        alert("Item Status Updated Successfully!!");
        window.location = "http://localhost/RSM/SELLER/modifyitem.php";
    </script>
<?php
} else {
    ?>
    <script>
        alert("Failed to Show Item!!");
        window.location = "http://localhost/RSM/SELLER/modifyitem.php";
    </script>
<?php
}
$conn->close();

?>
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
$sql = "DELETE from orders where Id = '$id' ";

if ($conn->query($sql) === TRUE) {
    ?>
    <script>
        alert("Order Deleted Successfully!!");
        window.location = "http://localhost/RSM/Buyer/myorders.php";
    </script>
<?php
} else {
    ?>
    <script>
        alert("Failed to Delete Item!!");
        window.location = "http://localhost/RSM/Buyer/myorders.php";
    </script>
<?php
}
$conn->close();

?>
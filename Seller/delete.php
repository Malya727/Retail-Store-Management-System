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
$sql = "DELETE from items where Id = '$id' ";

if ($conn->query($sql) === TRUE) {
    ?>
    <script>
        alert("Item Deleted Successfully!!");
        window.location = "http://localhost/RSM/SELLER/afterlogin.php";
    </script>
<?php
} else {
    ?>
    <script>
        alert("Failed to Delete Item!!");
        window.location = "http://localhost/RSM/SELLER/afterlogin.php";
    </script>
<?php
}
$conn->close();

?>
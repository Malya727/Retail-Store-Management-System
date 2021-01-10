<?php   
    session_start(); //to ensure you are using same session
    session_destroy();
    header("location:http://localhost/RSM/Buyer/index.php");
    exit();
?>
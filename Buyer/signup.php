<?php
 session_start();
 $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "RSM";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $n1 = (rand(10, 5000));
        $n4 = time();
        $id = $n1 . $n4;
        $Name = $_POST['name'];
        $Phone = $_POST['phone'];
        $Address = $_POST['address'];
        $Username = $_POST['username'];
        $Password = $_POST['password'];

        $sql = "INSERT INTO users VALUES ('$Name' , '$id' , '$Phone' , '$Address' , '$Username' , '$Password' )";

        if ($conn->query($sql) === TRUE) {
            ?>
            <script>
                alert("Account Created Successfully!! Please Login");
                window.location = "http://localhost/RSM/BUYER/login.php";
            </script>
        <?php
            } else {
                ?>
            <script>
                alert("Failed to Create Account");
                window.location = "http://localhost/RSM/BUYER/signup.php";
            </script>
    <?php
        }
        $conn->close();
    }
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" >
    <title>Local Retail Management System</title>
    <script src="https://kit.fontawesome.com/a2d9fe4007.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./CSS/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

  <body>
  <div class="background">
    <div class="container">
        <div class=" m-4">
            <div class="col-lg-4 border mb-3 mx-auto rounded pt-4" style="background-color: beige;">
                <div class="text-center col">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c8/Shopping_cart_with_food_clip_art_2.svg/307px-Shopping_cart_with_food_clip_art_2.svg.png"alt="" class="" style="height: 110px;">
                    <div class="display-8">Sign Up</div>
                    <hr>
                </div>
                <form method = "post" action = "">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input required type="text" name="name" id="name" class=" form-control-sm form-control"
                            placeholder="Your Name">
                    </div>

                    <div class="form-group">
                        <label for="">Phone Number</label>
                        <input required type="text" name="phone" id="phone" class=" form-control-sm form-control"
                            placeholder="Your Phone Number">
                    </div>

                    <div class="form-group">
                        <label for="">Address</label>
                        <input required type="text" name="address" id="address" class=" form-control-sm form-control"
                            placeholder="Your Address">
                    </div>

                    <div class="form-group">
                        <label for="">Username</label>
                        <input required type="text" name="username" id="username" class=" form-control-sm form-control"
                            placeholder="Your Username">
                    </div>

                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" id="password" class="form-control form-control-sm"
                            placeholder="Your Password">
                    </div>
                    
                    <hr>

                    <div class="d-flex justify-content-center links" style="font-size: small;">
                         <a href="login.php" class="ml-2">Already Registered?</a>
                    </div>
                    </br>

                    <div class="form-group" style="text-align: center;">
                        <input class="btn btn-sm btn-success col-lg-4" type="submit" value="Sign Up">
                    </div>
                    
                </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" ></script>

  </body>
</html>
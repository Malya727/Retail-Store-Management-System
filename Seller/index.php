<?php
 session_start();
 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = "RSM";
 $conn = new mysqli($servername, $username, $password, $dbname);
 if ($conn->connect_error) 
 {
    die("Connection failed: " . $conn->connect_error);
 }
 if ($_SERVER["REQUEST_METHOD"] == "POST") 
 {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $table_name = "seller";
        
        $querry = "select * from $table_name where Username = '$username' and Password = '$password'";
        $user_authentication_result = mysqli_query($conn, $querry) or die(mysqli_error($conn));
        $rows_fetched = mysqli_num_rows($user_authentication_result);
        if ($rows_fetched == 0)
        {
        ?>
            <script>
                window.alert("Invalid Username or Password");
                window.location = "http://localhost/RSM/SELLER/index.php"
            </script>
        <?php
        } 
        else 
        {
            $row = mysqli_fetch_array($user_authentication_result);
            $_SESSION['name'] = $row['Name'];
        ?>
        <script>
            window.location = "http://localhost/RSM/SELLER/afterlogin.php";
        </script>
        <?php
        }
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
    <br/><br/>
    <div class="container">
        <div class="p-4 m-4">
            <div class="col-lg-4 mt-4 border mb-4 mx-auto rounded pt-4" style="background-color: beige;">
                <div class="text-center col">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c8/Shopping_cart_with_food_clip_art_2.svg/307px-Shopping_cart_with_food_clip_art_2.svg.png"alt="" class="" style="height: 150px;">
                    <div class="display-8">Retail Shop Management System</div>
                    <hr>
                </div>
                <form method = "post" action = "">
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
                    <div class="form-group" style="text-align: center;">
                        <input class="btn btn-sm btn-success col-lg-4" type="submit" value="Login">
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
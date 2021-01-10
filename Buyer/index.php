<?php
 session_start();
?>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $name = $_POST['itemname'];
        $price = $_POST['itemprice'];
        $des = $_POST['itemdescription'];
        $default = 1;
        if(isset($_SESSION['cart']))
        {
            $flag = TRUE;
            $c = 0;
            foreach($_SESSION['cart'] as $val){
                if($val['Name'] === $name){
                    $_SESSION['cart'][$c]['Quantity'] += 1;
                    $flag = FALSE;
                    break;
                }
                $c++;
            }
            if($flag){
                $new_item = array("Name" => $name,"Price" => $price, "Description" => $des ,"Quantity" => $default);
                array_push($_SESSION['cart'], $new_item);
            }
            ?>
            <script>
                alert("Item Added To Cart");
                window.location = "http://localhost/RSM/BUYER/index.php";
            </script>
            <?php
        }
        else
        {
            $_SESSION['cart'] = array();
            $new_item = array("Name" => $name,"Price" => $price, "Description" => $des ,"Quantity" => $default);
            array_push($_SESSION['cart'], $new_item);
            ?>
            <script>
                alert("Item Added To Cart");
                window.location = "http://localhost/RSM/BUYER/index.php";
            </script>
            <?php
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" >
    <title>Local Retail Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a href="index.php"><img class="navbar-brand" src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c8/Shopping_cart_with_food_clip_art_2.svg/307px-Shopping_cart_with_food_clip_art_2.svg.png" alt="Logo" style="width:45px;height:45px;"></a>
        <a class="navbar-brand" href="index.php">RSM</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="myorders.php">My Orders<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <!-- <a class="nav-link" href="additem.php">Add Item</a> -->
                </li>
                <li class="nav-item">
                    <!-- <a class="nav-link" href="modifyitem.php">Modify Items</a> -->
                </li>
                <li class="nav-item">
                    <!-- <a class="nav-link" href="vieworders.php">View Orders</a> -->
                </li>
            </ul>
            <ul class="navbar-nav my-2 my-lg-0">
                <?php
                    if (isset($_SESSION['name']))
                    {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php">
                                <i class="fa" style="font-size:24px">&#xf07a;</i>
                                <?php 
                                    if(isset($_SESSION['cart']))
                                        { 
                                        ?>
                                        <span class='badge badge-warning' id='lblCartCount'> 
                                        <?php echo count($_SESSION['cart']) ?> </span><?php 
                                        } 
                                        else 
                                        {
                                        ?>
                                        <span class='badge badge-warning' id='lblCartCount'> 0 </span>
                                        <?php
                                        }
                                ?>         
                            </a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#"><span class="glyphicon glyphicon glyphicon-user"></span> <?php
                            echo "Welcome, " . $_SESSION['name']; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php"><i class="fa fa-sign-out" style="font-size:24px"></i></a>
                        </li>
                        <?php
                    }
                    else{
                        ?>
                        <li class="nav-item"><a class="nav-link" href="#"><span class="glyphicon glyphicon glyphicon-user"></span> Welcome, User</a>
                        </li>
                        <?php
                    }
                ?>
                
            </ul>
        </div>
    </nav>

    <div class="container">
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "RSM";
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

        ?>
        <br/>
        <h2 style="text-align:center">Retail Service Management Items List</h2>
        <hr />
        <div class="row mx-auto">
        <?php
            $query = "SELECT * FROM items WHERE Status = '1' ORDER BY Name";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                $count = 0;
                while ($row = mysqli_fetch_array($result)) {
                    $count += 1;
        ?>
				<div class="card mx-auto col-mb-3 mt-4"  style="width: 18rem;">
					<img class="card-img-top" src="../Seller/<?php echo $row['Image']?>" height="300px" alt="Card image cap">
					<div class="card-body">
                    <?php
                        if (isset($_SESSION['name']))
                        {
                        ?>
                        <form action="" method="POST">
                            <p class="card-title"><b>Name : </b><?php echo $row["Name"]; ?></p>
                            <input type="hidden" name="itemname" value="<?php echo $row['Name']; ?>">
                            <input type="hidden" name="itemprice" value="<?php echo $row['Price']; ?>">
                            <input type="hidden" name="itemdescription" value="<?php echo $row['Description']; ?>">
                            <p class="card-text"><b>Amount : </b><?php echo $row["Price"]; ?>&#8377</p>
                            <p class="card-text"><b>Description : </b><?php echo $row["Description"]; ?></p>
                            <input type="submit" nsme = "cartbutton" class="float-right btn btn-primary  form-control" value="Add To Cart">
                        </form>
                        <?php
                        }
                        else
                        {
                        ?>
                            <p class="card-title"><b>Name : </b><?php echo $row["Name"]; ?></p>
                            <p class="card-text"><b>Amount : </b><?php echo $row["Price"]; ?>&#8377</p>
                            <p class="card-text"><b>Description : </b><?php echo $row["Description"]; ?></p>
                            <a href="login.php"><input type="submit" class="float-right btn btn-primary  form-control" value="Add Item To Cart"></a>
                        <?php
                        }
                    ?>
                        
					</div>
                </div>
                <br/>

        <?php
            echo "<hr/><br/><br/>";
            }
            } else {
            ?><img src="../Seller/IMAGE/sadface.png /IMAGE/sadface.png" height="150px" alt=""><br /> Oops! No Items Found<br /><?php
            }
            ?>
            
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" ></script>
</body>
</html>
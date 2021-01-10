<?php
 session_start();
?>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "RSM";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $uid = $_SESSION['id'];
        $n1 = (rand(10, 5000));
        $n4 = time();
        $id = $n1 . $n4;
        $orders = serialize($_SESSION['cart']);
        $date = date("Y-m-d");
        $packing = "0";
        $payment = "0";
        $sql = "INSERT INTO orders VALUES ('$id' , '$uid' , '$orders' , '$date' , '$packing' , '$payment' )";

        if ($conn->query($sql) === TRUE) {
            unset($_SESSION['cart']);
            ?>
            <script>
                alert("Order Placed Successfully");
                window.location = "http://localhost/RSM/BUYER/index.php";
            </script>
        <?php
            } else {
                ?>
            <script>
                alert("Unable to Place Your Order");
                window.location = "http://localhost/RSM/BUYER/index.php";
            </script>
    <?php
        }
        $conn->close();
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
                    <a class="nav-link" href="myorders.php">My Orders <span class="sr-only">(current)</span></a>
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
    <?php
        if(isset($_SESSION['cart']))
        {
    ?>
    <div class="container">
        <br/>
       
        <a href="index.php" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>
        <br/>
        <form action="" class = "mt-4" method="POST">
        <table id="cart" class="table table-hover table-condensed">
                        <thead>
                            <tr>
                                <th style="width:30%">Product</th>
                                <th style="width:20%">Description</th>
                                <th style="width:10%">Price</th>
                                <th style="width:8%">Quantity</th>
                                <th style="width:22%" class="text-center">Subtotal</th>
                                <th style="width:10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $total_amount = 0;
                                foreach($_SESSION['cart'] as $val){
                                    ?>
                                        <tr>
                                            <td data-th="Price"><?php  echo $val["Name"]?></td>
                                            <td data-th="Price"><?php  echo $val["Description"]?></td>
                                            <td data-th="Price"><?php  echo $val["Price"]?>&#8377</td>
                                            <td data-th="Quantity" style = "text-align:center"><?php  echo $val["Quantity"]?></td>
                                            <td data-th="Subtotal" class="text-center"><?php  echo $val["Price"] * $val["Quantity"]; $total_amount = $total_amount + ($val["Price"] * $val["Quantity"]) ; ?>&#8377</td>
                                            <td class="actions" data-th="">
                                                <a href="delete.php?action=delete&id=<?php echo $val["Name"]; ?>"><i class="fa fa-trash-o"></i></a>								
                                            </td>
                                        </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr class="visible-xs">
                                <td colspan="4" class="hidden-xs"></td>
                                <td><strong>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                    <?php echo $total_amount ?>&#8377</strong></td>
                            </tr>
                            <tr>
                                <td colspan="1" class="hidden-xs"></td>
                                <td class="text-center"><strong>Total : <?php echo $total_amount ?>&#8377</strong></td>
                                <td colspan="1" class="hidden-xs"></td>
                                <td><button class="btn btn-success" style = "color:white">Checkout</button></td>
                            </tr>
                        </tfoot>
        </table>
        </form>
    </div>
    <?php
    }else{
        ?>
            <h1 style="text-align: center;color: blueviolet;" class="mt-4">CART IS EMPTY</h1><br/>
            <center>
                <i class="fa"  style="font-size:24px;">&#xf07a;</i>
                <span class='badge badge-warning' id='lblCartCount'>0</span>
            </center>
        <?php
    }
    ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" ></script>
</body>
</html>
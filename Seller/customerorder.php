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
    $oid = $_GET['id'];
    $query = "select * from orders where Id = '$oid'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    $item =  unserialize($row['Items']);
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" >
    <title>Local Retail Management System</title>
    <script src="https://kit.fontawesome.com/a2d9fe4007.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <img class="navbar-brand" src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c8/Shopping_cart_with_food_clip_art_2.svg/307px-Shopping_cart_with_food_clip_art_2.svg.png" alt="Logo" style="width:45px;height:45px;">
        <a class="navbar-brand" href="afterlogin.php">RSM</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="afterlogin.php">All Items </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="additem.php">Add Item</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="modifyitem.php">Modify Items</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="vieworders.php">View Orders <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <ul class="navbar-nav my-2 my-lg-0">
                <li class="nav-item"><a class="nav-link" href="logout.php"><span class="glyphicon glyphicon glyphicon-user"></span> <?php
                    echo "Welcome, " . $_SESSION['name']; ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php"><i class="fa fa-sign-out" style="font-size:24px"></i></a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <table id="cart" class="table mt-4">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Product</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col" class="text-center">Subtotal</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $total_amount = 0;
                    foreach($item as $val){
                ?>
                    <tr>
                        <td data-th="Price"><?php  echo $val["Name"]?></td>
                        <td data-th="Price"><?php  echo $val["Description"]?></td>
                        <td data-th="Price"><?php  echo $val["Price"]?>&#8377</td>
                        <td data-th="Quantity" style = "text-align:center"><?php  echo $val["Quantity"]?></td>
                        <td data-th="Subtotal" class="text-center"><?php  echo $val["Price"] * $val["Quantity"]; $total_amount = $total_amount + ($val["Price"] * $val["Quantity"]) ; ?>&#8377</td>
                    </tr>
                    <?php
                        }
                    ?>
                    <tfoot>
                        <tr class="visible-xs">
                            <td colspan="4" class="hidden-xs"></td>
                            <td><strong>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                Total : <?php echo $total_amount ?>&#8377</strong></td>
                        </tr>
                    </tfoot>
            </tbody>
        </table>
        <?php  if($row['Packing'] == "0"){?><a href="packingstatus.php?action=update&id=<?php echo $_GET['id']; ?>&stat=<?php echo 'yes'; ?>"><button class="btn btn-primary" style="float: left;" >Packing Finished</button></a><?php } ?>
        <?php  if($row['Packing'] == "1"){?><a href="packingstatus.php?action=update&id=<?php echo $_GET['id']; ?>&stat=<?php echo 'no'; ?>"><button class="btn btn-primary" style="float: left;" >Keep Packing Status on Pending</button></a><?php } ?>
        <?php  if($row['Payment'] == "0"){?><a href = "paymentstatus.php?action=update&id=<?php echo $_GET['id']; ?>&stat=<?php echo 'yes'; ?>"><button class="btn btn-warning" style="float: right;">Payment Received</button></a><?php } ?>
        <?php  if($row['Payment'] == "1"){?><a href = "paymentstatus.php?action=update&id=<?php echo $_GET['id']; ?>&stat=<?php echo 'no'; ?>"><button class="btn btn-warning" style="float: right;">Update as Unpaid</button></a><?php } ?>
    </div>

    

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" ></script>
</body>
</html>


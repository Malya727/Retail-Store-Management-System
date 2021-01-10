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
                <form class="form-inline" method="POST" action = "">
                    <label for="example-date-input" class="col-2 col-form-label">Date</label>
                    <div class="col-10">
                        <input class="form-control" type="date" value="2011/08/19" name = "date" id="example-date-input">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </div>
                </form>
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
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $date = $_POST['date'];
                }else {
                    $date = "";
                }
                if (empty($date)) {
                $query = "SELECT * FROM orders";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    $count = 0;
                ?>
                <table class="table mt-4">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Date</th>
                    <th scope="col">Packing Status</th>
                    <th scope="col">Delivery Status</th>
                    <th scope="col">View Order</th>
                    </tr>
                </thead>
                <?php
                    while ($row = mysqli_fetch_array($result)) {
                        $count += 1;
            ?>
                <tbody>
                    <tr>
                    <?php
                        $uid = $row['UId'];
                        $q2 = "select * from users where Id = '$uid'";
                        $r2 = mysqli_query($conn, $q2);
                        $ro2 = mysqli_fetch_array($r2);
                    ?>
                        <td><?php echo $ro2['Name'] ?></td>
                        <td><?php echo $row['Date'] ?></td>
                        <td><?php if($row['Packing'] == "0"){?> <b><span style="color: red;">Packing Pending</span></b> <?php } else{ ?> <b><span style="color: green;">Packed</span></b> <?php } ?></td>
                        <td><?php if($row['Payment'] == "0"){?> <b><span style="color: red;">Payment Pending</span></b> <?php } else{ ?> <b><span style="color: green;">Payement Done</span></b> <?php } ?></td>
                        <td class = "text-align:center;"><a href="customerorder.php?action=view&id=<?php echo $row["Id"]; ?>"><i class="fas fa-eye"></i></a></td>
                    </tr>
                </tbody>
            
            <?php
                }
                ?>
                </table>
                <?php
            } else 
            {
                ?><br/><h1 class="mt-4" style="text-align: center;margin-top: 50px;">No Orders Made on Requested Date</h1><?php
            }
        }
        else{
            $query = "SELECT * FROM orders WHERE Date = '$date' ";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                $count = 0;
            ?>
            <table class="table mt-4">
            <thead class="thead-dark">
                <tr>
                <th scope="col">Customer Name</th>
                <th scope="col">Date</th>
                <th scope="col">Packing Status</th>
                <th scope="col">Delivery Status</th>
                <th scope="col">View Order</th>
                </tr>
            </thead>
            <?php
                while ($row = mysqli_fetch_array($result)) {
                    $count += 1;
        ?>
            <tbody>
                <tr>
                <?php
                    $uid = $row['UId'];
                    $q2 = "select * from users where Id = '$uid'";
                    $r2 = mysqli_query($conn, $q2);
                    $ro2 = mysqli_fetch_array($r2);
                ?>
                    <td><?php echo $ro2['Name'] ?></td>
                    <td><?php echo $row['Date'] ?></td>
                    <td><?php if($row['Packing'] == "0"){?> <b><span style="color: red;">Packing Pending</span></b> <?php } else{ ?> <b><span style="color: green;">Packed</span></b> <?php } ?></td>
                    <td><?php if($row['Payment'] == "0"){?> <b><span style="color: red;">Payment Pending</span></b> <?php } else{ ?> <b><span style="color: green;">Payement Done</span></b> <?php } ?></td>
                    <td class = "text-align:center;"><a href="customerorder.php?action=view&id=<?php echo $row["Id"]; ?>"><i class="fas fa-eye"></i></a></td>
                </tr>
            </tbody>
        
        <?php
            }
            ?>
            </table>
            <?php
        } else 
        {
            ?><br/><h1 class="mt-4" style="text-align: center;margin-top: 50px;">No Orders Made on Requested Date</h1><?php
        }
                
        }
            ?>
            
        

    </div>

    

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" ></script>
</body>
</html>
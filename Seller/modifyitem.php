<?php
 session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/a2d9fe4007.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" >
    <title>Local Retail Management System</title>
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
                <li class="nav-item">
                    <a class="nav-link" href="afterlogin.php">All Items </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="additem.php">Add Item</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="modifyitem.php">Modify Items <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="vieworders.php">View Orders</a>
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
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Description</th>
                    <th scope="col">Update</th>
                    <th scope="col">Delete</th>
                    <th scope="col">Hide/Display</th>
                </tr>
            </thead>
            <tbody>
        <?php
            $query = "SELECT * FROM items ORDER BY Name";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) 
            {
                $count = 0;
                while ($row = mysqli_fetch_array($result)) 
                {
                    $count += 1;
        ?>
                <tr>
                    <td><?php echo $row["Name"]; ?></td>
                    <td><?php echo $row["Price"]; ?>&#8377</td>
                    <td><?php echo $row["Description"];?></td>
                    <td><span class="text-danger">&nbsp&nbsp&nbsp&nbsp <a href="update.php?action=update&id=<?php echo $row["Id"]; ?>" data-toggle="tooltip" title="Update"><i class="fas fa-pen"></i></a></span></td>
                    <td><span class="text-danger">&nbsp&nbsp&nbsp&nbsp <a href="delete.php?action=delete&id=<?php echo $row["Id"]; ?>" data-toggle="tooltip" title="Delete"><i class="fas fa-trash-alt"></i></a></span></td>
                    <?php if($row["Status"] == "1"){?> <td><span class="text-danger">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <a href="hideitem.php?action=update&id=<?php echo $row["Id"]; ?>" data-toggle="tooltip" title="Hide"><i class="fas fa-eye-slash"></i></a></span></td> <?php }
                    else{ ?> <td><span class="text-danger">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <a href="showitem.php?action=update&id=<?php echo $row["Id"]; ?>"  data-toggle="tooltip" title="Show"><i class="fas fa-eye"></i></a></span></td><?php }?> 
                    
                </tr>

        <?php
            }
        ?>
            </tbody>
        </table>
        <?php
        } else 
        {
        ?>
            <center><img src="./IMAGE/sadface.png" height="150px" alt=""><br /> Oops! No Items Found<br /></center><?php
        }
        ?>
            
    

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" ></script>
</body>
</html>
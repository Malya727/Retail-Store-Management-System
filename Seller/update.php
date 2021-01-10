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
        $id = $_GET['id'];
        $Name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $sql = "UPDATE items SET Name = '$Name',Price = '$price' , Description = '$description' WHERE Id = '$id'";
        if ($conn->query($sql) === TRUE) {
            ?>
            <script>
                alert("Item Updated Successfully!!");
                window.location = "http://localhost/RSM/SELLER/afterlogin.php";
            </script>
        <?php
            } else {
                ?>
            <script>
                alert("Failed to Update Item!!");
                window.location = "http://localhost/RSM/SELLER/afterlogin.php";
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
                <li class="nav-item active">
                    <a class="nav-link" href="modifyitem.php">Modify Items</a>
                </li>
                <li class="nav-item ">
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

    <br/>
    <h2 style="text-align:center">Retail Service Management Item Update</h2>
    <hr /><br />
    
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
        $id = $_GET['id'];
        $query = "select * from items where Id = '$id'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
    ?>
    <form method = "post" action="" class = "container" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input required type="text" class="form-control" value = "<?php echo $row['Name']; ?>" name = "name" placeholder="Enter Item Name" id="name">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Price</label>
                    <input required type="number" min="0" step=".01" value = "<?php echo $row['Price']; ?>" class="form-control" name = "price" placeholder="Enter Price " id="price">
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="name">Description</label>
                    <input required type="text" class="form-control" value = "<?php echo $row['Description']; ?>" name = "description" placeholder="Enter Description" id="description">
                </div>
            </div>
        </div>

        <button type="submit" style="text-align: center;" class="btn btn-primary">Update Item</button>
    </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" ></script>
</body>
</html>
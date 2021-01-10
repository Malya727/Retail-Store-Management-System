<?php
    session_start();
    $id = $_GET['id'];
    $flag = FALSE;
    $c = 0;
    if(count($_SESSION['cart']) == 1)
    {
        $flag = TRUE;
        unset($_SESSION['cart']);
    }
    else
    {
        foreach($_SESSION['cart'] as $val){
            echo $val["Name"];
            if($val["Name"] === $id){
                unset( $_SESSION['cart'][$c] );
                $_SESSION['cart'] = array_values( $_SESSION['cart'] );
                $_SESSION['cart'][$c]['Quantity'] += 1;
                $flag = TRUE;
                break;
            }
            $c++;
        }
    }
    

if ($flag) {
    ?>
    <script>
        alert("Item Deleted Successfully!!");
        window.location = "http://localhost/RSM/Buyer/cart.php";
    </script>
<?php
} else {
    ?>
    <script>
        alert("Failed to Delete Item!!");
        window.location = "http://localhost/RSM/Buyer/cart.php";
    </script>
<?php
}
$conn->close();

?>
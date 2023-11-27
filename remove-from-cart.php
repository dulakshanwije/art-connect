<?php
require_once("dbConfig/connect.php");

if(isset($_SESSION["current_user_id"])){
    if(isset($_GET["cart_id"])){
        $product_id = $_GET["cart_id"];

        $cart_remove = "DELETE FROM cart WHERE cart_id = $product_id";

        if (mysqli_query($conn, $cart_remove)) {
            header("location:shoping-cart.php");
          } else {
            echo "Error: " . $cart_remove . "<br>" . mysqli_error($conn);
          }
          
          mysqli_close($conn);
    }
}
else{
    header("location:login.php?msg=cart-login");
}



?>
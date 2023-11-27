<?php
require_once("dbConfig/connect.php");

if(isset($_SESSION["current_user_id"])){
    if(isset($_POST["product_id"]) && isset($_POST["quantity"])){
        $product_id = $_POST["product_id"];
        $quantity = $_POST["quantity"];
        $user_id = $_SESSION["current_user_id"];

        $cart_insert = "INSERT INTO cart(p_id, u_id, cart_quantity) VALUES ('$product_id','$user_id','$quantity')";

        if (mysqli_query($conn, $cart_insert)) {
            header("location:shop-details.php?product=$product_id&&msg=cart-success");
          } else {
            echo "Error: " . $cart_insert . "<br>" . mysqli_error($conn);
          }
          
          mysqli_close($conn);
    }
}
else{
    header("location:login.php?msg=cart-login");
}



?>
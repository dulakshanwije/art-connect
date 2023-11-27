<?php
require_once("dbConfig/connect.php");

if(!isset($_SESSION["current_user_id"])){
    header("location:login.php?msg=cart-login");
}

?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ogani | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <!-- <div id="preloder">
        <div class="loader"></div>
    </div> -->

    <!-- Humberger Begin -->
    <?php include('humberger.html') ?>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <?php include('header.php') ?>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <?php include('hero-section.html') ?>
    <!-- Hero Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $user_id = $_SESSION["current_user_id"];

                                $get_cart_items = "SELECT * FROM cart, products WHERE products.p_id = cart.p_id AND cart.u_id = $user_id";
                                $cart_items = mysqli_query($conn, $get_cart_items);

                                if (mysqli_num_rows($cart_items) > 0) {
                                    
                                    $total_value = 0;
                                    $total_item_value = 0;

                                    while ($row = mysqli_fetch_assoc($cart_items)) {

                                        $total_item_value = (float)$row["p_price"] * (float)$row["cart_quantity"];

                                        $total_value += $total_item_value;

                                        echo '
                                            <tr>
                                                <td class="shoping__cart__item">
                                                    <img src="img/products/'.$row["p_image_url"].'" alt="">
                                                    <h5>'.$row["p_name"].'</h5>
                                                </td>
                                                <td class="shoping__cart__price">
                                                    Rs.'.$row["p_price"].'.00
                                                </td>
                                                <td class="shoping__cart__quantity">
                                                    <div class="quantity">
                                                        <div class="quantity_count">
                                                            <input type="text" value="'.$row["cart_quantity"].'">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="shoping__cart__total">
                                                    Rs. '.$total_item_value.'.00
                                                </td>
                                                <td class="shoping__cart__item__close">
                                                    <span onclick = "removeItem('.$row["cart_id"].')" class="icon_close"></span>
                                                </td>
                                            </tr>
                                        ';
                                    }
                                } else {
                                    echo "0 results";
                                }

                                mysqli_close($conn);
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="#" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            Upadate Cart</a>
                    </div>
                </div> -->
                <!-- <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    </div>
                </div> -->
                <div class="col-lg-12 bg-dark">
                    <div class="shoping__checkout col-lg-6 mx-auto my-3">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Subtotal <span>Rs.<?php echo $total_value?>.00</span></li>
                            <li>Total <span>Rs.<?php echo $total_value?>.00</span></li>
                        </ul>
                        <a href="checkout.php" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->

    <!-- Footer Start -->
    <?php include('footer.html') ?>
    <!-- Footer End -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>

    <script>
        function removeItem(product_id){
            if(confirm("You are going to remove this item from your cart. Do you want to continue?" + product_id)){
                window.location.href = "./remove-from-cart.php?cart_id="+product_id;
            }
        }
    </script>


</body>

</html>
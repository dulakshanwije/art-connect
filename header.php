<?php
if(isset($_SESSION["current_user_id"])){
    $user_id = $_SESSION["current_user_id"];
    
    $get_cart_items = "SELECT * FROM cart, products WHERE products.p_id = cart.p_id AND cart.u_id = $user_id";
    $cart_items = mysqli_query($conn, $get_cart_items);
    
    if (mysqli_num_rows($cart_items) > 0) {
    
        $total_value = 0;
        $total_item_value = 0;
        $total_item_count = 0;
    
        while ($row = mysqli_fetch_assoc($cart_items)) {
    
            $total_item_value = (float)$row["p_price"] * (float)$row["cart_quantity"];
            $total_value += $total_item_value;
            $total_item_count += (int)$row["cart_quantity"];
        }
    } else {
    }
}
?>

<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="./index.php"><img src="img/logo.png" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li><a href="./index.php">Home</a></li>
                        <li><a href="./shop-grid.php">Shop</a></li>
                        <li><a href="./gallery.php">Galley</a></li>
                        <li><a href="#">Contact</a></li>
                        <?php echo(isset($_SESSION["current_user_id"])?
                            '<li><a href="./dashboard.php">Profile</a></li>'
                        :
                            '<li><a href="./login.php">Login</a></li>'
                        );?>
                        <!-- <li><a href="./login.php">Login</a></li> -->
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__cart">
                    <ul>
                        <li><a href="shoping-cart.php"><i class="fa fa-shopping-bag"></i> <span>
                            <?php
                            if(isset($_SESSION["current_user_id"])){
                                if(isset($total_item_count)){
                                    echo $total_item_count;
                                }
                                else{
                                    echo "0";
                                }
                            }
                            else{
                                echo "0";
                            }
                            ?>
                        </span></a></li>
                    </ul>
                    <div class="header__cart__price">Total: <span>Rs. 
                    <?php
                            if(isset($_SESSION["current_user_id"])){
                                if(isset($total_value)){
                                    echo $total_value;
                                }
                                else{
                                    echo "00";
                                }
                            }
                            else{
                                echo "00";
                            }
                            ?>
                        .00</span></div>
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
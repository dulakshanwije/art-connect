<?php
require_once("dbConfig/connect.php");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ArtConnect</title>

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
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="img/logo.png" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>0</span></a></li>
            </ul>
            <div class="header__cart__price">item: <span>Rs. 00.00</span></div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="./index.php">Home</a></li>
                <li><a href="shop-grid.php">Shop</a></li>
                <li><a href="#">Gallery</a>
                </li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">Login</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> info@artconnect.com</li>
                <li>Explore, Create</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <?php include('header.html')?>
    <!-- Header Section End -->
    
    <!-- Hero Section Begin -->
    <?php include('hero-section.html')?>
    <!-- Hero Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Art Materials Shop</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Department</h4>
                            <ul>
                                <li><a href="#">Colours</a></li>
                                <li><a href="#">Brushes</a></li>
                                <li><a href="#">Surfaces</a></li>
                                <li><a href="#">Mediums & Additives</a></li>
                                <li><a href="#">Accessory</a></li>
                                <li><a href="#">Art Works</a></li>
                                <li><a href="#">Publications</a></li>
                            </ul>
                        </div>
                        <!-- <div class="sidebar__item">
                            <h4>Price</h4>
                            <div class="price-range-wrap">
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                    data-min="10" data-max="1000">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                </div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <input type="text" id="minamount">
                                        <input type="text" id="maxamount">
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="sidebar__item">
                        <div class="latest-product__text">
                        <h4>Latest Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                            <?php

                                $sql = "SELECT * FROM products";
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                // output data of each row
                                $count = 0;
                                $count_max = mysqli_num_rows($result);
                                while($row = mysqli_fetch_assoc($result)) {
                                    echo '
                                        <a href="shop-details.php?product='.$row["p_id"].'" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="img/products/'.$row["p_image_url"].'" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>'.$row["p_name"].'</h6>
                                                <span>'.$row["p_price"].'</span>
                                            </div>
                                        </a>
                                    ';
                                    $count++;
                                    if($count > 0 && $count % 3 == 0 && $count < $count_max){
                                        echo '
                                        </div>
                                        <div class="latest-prdouct__slider__item">
                                        ';
                                    }
                                    if($count == $count_max){
                                        echo '
                                            </div>
                                        ';
                                    }
                                }
                                } else {
                                echo "0 results";
                                }
                            ?>
                        </div>
                    </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="product__discount">
                        <div class="section-title product__discount__title">
                            <h2>Sale Off</h2>
                        </div>
                        <div class="row">
                            <div class="product__discount__slider owl-carousel">
                                <?php
                                    $sql = "SELECT * FROM products WHERE p_isDiscount = TRUE";
                                    $result = mysqli_query($conn, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                        // output data of each row
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $price = $row["p_price"];
                                            $discount = $row["p_discount"];
                                            $disPrice = $price * ((100 - $discount)/100);
                                            echo '
                                            <div class="col-lg-4">
                                                <a href = "shop-details.php?product='.$row["p_id"].'">
                                                <div class="product__discount__item">
                                                    <div class="product__discount__item__pic set-bg"
                                                        data-setbg="img/products/'.$row["p_image_url"].'">
                                                        <div class="product__discount__percent">-'.$discount.'%</div>
                                                    </div>
                                                    <div class="product__discount__item__text">
                                                        <span>'.$row["p_category"].'</span>
                                                        <h5>'.$row["p_name"].'</h5>
                                                        <div class="product__item__price">Rs.'.$disPrice.'.00<span>Rs.'.$row["p_price"].'.00</span></div>
                                                    </div>
                                                </div>
                                                </a>
                                            </div>
                                            ';
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Sort By</span>
                                    <select>
                                        <option value="0">Default</option>
                                        <option value="0">Default</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6><span>*</span> Products found</h6>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3">
                                <div class="filter__option">
                                    <span class="icon_grid-2x2"></span>
                                    <span class="icon_ul"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row"> -->

                        <?php
                            $sql = "SELECT * FROM products";
                            $result = mysqli_query($conn, $sql);
                            $num_rows = mysqli_num_rows($result);

                            echo '
                            <div class="filter__item">
                                <div class="row">
                                    <div class="col-lg-4 col-md-5">
                                        <div class="filter__sort">
                                            <span>Sort By</span>
                                            <select>
                                                <option value="0">Default</option>
                                                <option value="0">Default</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="filter__found">
                                            <h6><span>'.$num_rows.'</span> Products found</h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-3">
                                        <div class="filter__option">
                                            <span class="icon_grid-2x2"></span>
                                            <span class="icon_ul"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            
                            ';

                            if (mysqli_num_rows($result) > 0) {
                                // output data of each row
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '
                                    <a href = "shop-details.php?product='.$row["p_id"].'">
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <div class="product__item">
                                            <div class="product__item__pic set-bg" data-setbg="img/products/'.$row["p_image_url"].'">
                                            </div>
                                            <div class="product__item__text">
                                                <span>'.$row["p_category"].'</span>
                                                <h6><a href="shop-details.php?product='.$row["p_id"].'">'.$row["p_name"].'</a></h6>
                                                <h5>Rs.'.$row["p_price"].'.00</h5>
                                            </div>
                                        </div>
                                    </div>
                                    </a>
                                    ';
                                }
                            } else {
                                echo "0 results";
                            }
                            mysqli_close($conn);
                        ?>
                    </div>
                    <div class="product__pagination">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Footer Start -->
    <?php include('footer.html')?>
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



</body>

</html>
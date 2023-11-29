<?php
require_once("dbConfig/connect.php");

$post_id;

if (isset($_GET["post"])) {
    $post_id = $_GET["post"];
} else {
    header("location:gallery.php");
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
    <title>ArtConnect | Art Shop</title>

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
    <?php include('humberger.html') ?>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <?php include('header.php') ?>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <?php include('hero-section.html') ?>
    <!-- Hero Section End -->

    <!-- Blog Details Hero Begin -->
    <?php

    $sql = "SELECT * FROM posts,users WHERE users.u_id = posts.u_id AND post_id = '$post_id'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "0 results";
    }
    ?>
    <section class="blog-details-hero set-bg" data-setbg="img/blog/details/details-hero-2.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog__details__hero__text">
                        <h2><?php echo $row['post_title'] ?></h2>
                        <ul>
                            <li>By <?php echo $row['u_name'] ?></li>
                            <li><?php echo $row['post_date'] ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Hero End -->

    <!-- Blog Details Section Begin -->
    <section class="blog-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5 order-md-1 order-2">
                    <div class="blog__sidebar">
                        <!-- <div class="blog__sidebar__search">
                            <form action="#">
                                <input type="text" placeholder="Search...">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div> -->
                        <!-- <div class="blog__sidebar__item">
                            <h4>Categories</h4>
                            <ul>
                                <li><a href="#">All</a></li>
                                <li><a href="#">Beauty (20)</a></li>
                                <li><a href="#">Food (5)</a></li>
                                <li><a href="#">Life Style (9)</a></li>
                                <li><a href="#">Travel (10)</a></li>
                            </ul>
                        </div> -->
                        <div class="blog__sidebar__item">
                            <h4>Used by the Painter</h4>
                            <div class="blog__sidebar__recent">
                                <?php

                                $sql_get_products = "SELECT products.p_id, p_name, p_category, p_image_url FROM products, posts_products WHERE posts_products.post_id = '$post_id' AND posts_products.p_id = products.p_id;";

                                $result_products = mysqli_query($conn, $sql_get_products);

                                if (mysqli_num_rows($result_products) > 0) {
                                    // output data of each row
                                    while ($row_products = mysqli_fetch_assoc($result_products)) {
                                        echo '
                                                <a href="./shop-details.php?product=' . $row_products["p_id"] . '" class="blog__sidebar__recent__item">
                                                    <div class="blog__sidebar__recent__item__pic">
                                                        <img src="img/products/' . $row_products["p_image_url"] . '" alt="">
                                                    </div>
                                                    <div class="blog__sidebar__recent__item__text">
                                                        <h6>' . $row_products["p_name"] . '</h6>
                                                        <span>' . $row_products["p_category"] . '</span>
                                                    </div>
                                                </a>
                                            ';
                                    }
                                } else {
                                    echo "0 results";
                                }

                                ?>
                            </div>
                        </div>
                        <!-- <div class="blog__sidebar__item">
                            <h4>Search By</h4>
                            <div class="blog__sidebar__item__tags">
                                <a href="#">Apple</a>
                                <a href="#">Beauty</a>
                                <a href="#">Vegetables</a>
                                <a href="#">Fruit</a>
                                <a href="#">Healthy Food</a>
                                <a href="#">Lifestyle</a>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="col-lg-8 col-md-7 order-md-1 order-1">
                    <div class="blog__details__text">
                        <img src="img/blog/<?php echo $row['post_photo'] ?>" alt="">
                        <h3><?php echo $row['post_title'] ?></h3>
                        <p><?php echo $row['post_description'] ?>
                        </p>
                    </div>
                    <div class="blog__details__content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="blog__details__author">
                                    <div class="blog__details__author__pic">
                                        <img src="img/users/<?php echo $row['u_profile_pic'] ?>" alt="">
                                    </div>
                                    <div class="blog__details__author__text">
                                        <h6><?php echo $row['u_name'] ?></h6>
                                        <span>Editor</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="blog__details__widget">
                                    <ul>
                                        <li><span>Category:</span> <?php echo $row['post_category'] ?></li>
                                        <li>Share this: </li>
                                    </ul>
                                    <div class="blog__details__social">
                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                        <a href="#"><i class="fa fa-google-plus"></i></a>
                                        <a href="#"><i class="fa fa-linkedin"></i></a>
                                        <a href="#"><i class="fa fa-envelope"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->

    <!-- Related Blog Section Begin -->
    <section class="related-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related-blog-title">
                        <h2>Post You May Like</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php

                $get_all_recent_posts_sql = "SELECT post_id, post_title, post_description, post_date,post_photo FROM posts ORDER BY post_id DESC LIMIT 3";
                $result_recent = mysqli_query($conn, $get_all_recent_posts_sql);

                if (mysqli_num_rows($result_recent) > 0) {
                    // output data of each row
                    while ($row_posts = mysqli_fetch_assoc($result_recent)) {
                        echo '
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="blog__item">
                                    <div class="blog__item__pic">
                                        <img src="img/blog/' . $row_posts["post_photo"] . '" alt="">
                                    </div>
                                    <div class="blog__item__text">
                                        <ul>
                                            <li><i class="fa fa-calendar-o"></i>' . $row_posts["post_date"] . '</li>
                                        </ul>
                                        <h5><a href="blog-details.php?post=' . $row_posts["post_id"] . '">' . $row_posts["post_title"] . '</a></h5>
                                        <p style = "overflow:hidden; height:75px;">' . $row_posts["post_description"] . '</p>
                                    </div>
                                </div>
                            </div>
                        ';
                    }
                }
                ?>
            </div>
        </div>
    </section>
    <!-- Related Blog Section End -->

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



</body>

</html>
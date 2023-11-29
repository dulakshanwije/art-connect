<?php
require_once("dbConfig/connect.php");
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ArtConnect | The Art Shop</title>

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

    <!-- Galley Page CSS -->
    <link rel="stylesheet" href="css/gallery_page.css">
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

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Gallery</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Gallery</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Gallery Start -->
    <!-- <div class="gallery-page-wrapper">
        <div class="container">
            <div class="row">
                <p class="gallery-page-header">Our Exhibition Gallery</p>
                <div class="gallery-page-holder">
                    <div class="gallery-page-img-holder">
                        <img src="./img/gallery/g1.jpg" alt="">
                    </div>
                    <div class="gallery-page-img-holder">
                        <img src="./img/gallery/g2.jpg" alt="">
                    </div>
                    <div class="gallery-page-img-holder">
                        <img src="./img/gallery/g3.jpg" alt="">
                    </div>
                    <div class="gallery-page-img-holder">
                        <img src="./img/gallery/g4.jpg" alt="">
                    </div>
                    <div class="gallery-page-img-holder">
                        <img src="./img/gallery/g10.jpg" alt="">
                    </div>
                    <div class="gallery-page-img-holder">
                        <img src="./img/gallery/g6.jpg" alt="">
                    </div>
                    <div class="gallery-page-img-holder">
                        <img src="./img/gallery/g7.jpg" alt="">
                    </div>
                    <div class="gallery-page-img-holder">
                        <img src="./img/gallery/g8.jpg" alt="">
                    </div>
                    <div class="gallery-page-img-holder">
                        <img src="./img/gallery/g9.jpg" alt="">
                    </div>
                    <div class="gallery-page-img-holder">
                        <img src="./img/gallery/g1.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <div class="galley-wrapper">
        <div class="container">
            <div class="row gallery">
                <p class="gallery-header">Our Exhibition Gallery</p>
                <div class="gallery-holder">
                    <div class="gallery-single-img-holder">
                        <img src="img/gallery/g2.jpg" alt="">
                    </div>
                    <div class="gallery-single-img-holder">
                        <img src="img/gallery/g1.jpg" alt="">
                    </div>
                    <div class="gallery-single-img-holder">
                        <img src="img/gallery/g4.jpg" alt="">
                    </div>
                    <div class="gallery-single-img-holder">
                        <img src="img/gallery/g3.jpg" alt="">
                    </div>
                    <div class="gallery-single-img-holder">
                        <img src="img/gallery/g6.jpg" alt="">
                    </div>
                    <div class="gallery-single-img-holder">
                        <img src="img/gallery/g7.jpg" alt="">
                    </div>
                    <div class="gallery-single-img-holder">
                        <img src="img/gallery/g8.jpg" alt="">
                    </div>
                    <div class="gallery-single-img-holder">
                        <img src="img/gallery/g9.jpg" alt="">
                    </div>
                    <div class="gallery-single-img-holder">
                        <img src="img/gallery/g10.jpg" alt="">
                    </div>
                    <div class="gallery-single-img-holder">
                        <img src="img/gallery/g11.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Gallery End -->

    <!-- Blog Section Begin -->
    <section class="blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5">
                    <div class="blog__sidebar">
                        <div class="blog__sidebar__search">
                            <form action="#">
                                <input type="text" placeholder="Search...">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div>
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
                            <h4>Recent Posts</h4>
                            <div class="blog__sidebar__recent">
                                <?php

                                $get_all_recent_posts_sql = "SELECT post_id, post_title, post_description, post_date,post_photo FROM posts ORDER BY post_id DESC LIMIT 5";
                                $result_recent = mysqli_query($conn, $get_all_recent_posts_sql);

                                if (mysqli_num_rows($result_recent) > 0) {
                                    // output data of each row
                                    while ($row_posts = mysqli_fetch_assoc($result_recent)) {
                                        echo '
                                            <a href="blog-details.php?post='.$row_posts["post_id"].'" class="blog__sidebar__recent__item">
                                                <div class="blog__sidebar__recent__item__pic">
                                                    <img src="img/blog/'.$row_posts["post_photo"].'" alt="">
                                                </div>
                                                <div class="blog__sidebar__recent__item__text">
                                                    <h6>'.$row_posts["post_title"].'</h6>
                                                    <span>'.$row_posts["post_date"].'</span>
                                                </div>
                                            </a>
                                        ';
                                    }
                                }

                                ?>
                            </div>
                        </div>
                        <div class="blog__sidebar__item">
                            <h4>Search By</h4>
                            <div class="blog__sidebar__item__tags">
                                <a href="#">Abstract</a>
                                <a href="#">Portraiture</a>
                                <a href="#">Still Life</a>
                                <a href="#">Pop Art</a>
                                <a href="#">Conceptual Art</a>
                                <a href="#">Digital Art</a>
                                <a href="#">Landscape</a>
                                <a href="#">Illustration</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-7">
                    <div class="row">

                        <?php
                        $get_all_posts_sql = "SELECT post_id, post_title, post_description, post_date,post_photo FROM posts ORDER BY post_id DESC";
                        $result = mysqli_query($conn, $get_all_posts_sql);

                        if (mysqli_num_rows($result) > 0) {
                            // output data of each row
                            while ($row = mysqli_fetch_assoc($result)) {

                                echo '
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="blog__item">
                                            <div class="blog__item__pic">
                                                <img src="img/blog/' . $row["post_photo"] . '" alt="">
                                            </div>
                                            <div class="blog__item__text">
                                                <ul>
                                                    <li><i class="fa fa-calendar-o"></i> ' . $row["post_date"] . '</li>
                                                </ul>
                                                <h5><a href="blog-details.php?post=' . $row["post_id"] . '">' . $row["post_title"] . '</a></h5>
                                                <p style = "overflow:hidden; height:50px;">' . $row["post_description"] . '</p>
                                                <a href="blog-details.php?post=' . $row["post_id"] . '" class="blog__btn">READ MORE <span class="arrow_right"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                ';
                            }
                        } else {
                            echo "0 results";
                        }
                        ?>
                        <div class="col-lg-12">
                            <div class="product__pagination blog__pagination">
                                <a href="#">1</a>
                                <a href="#">2</a>
                                <a href="#">3</a>
                                <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->

    <!-- Footer Section Begin -->
    <?php include('footer.html') ?>
    <!-- Footer Section End -->

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
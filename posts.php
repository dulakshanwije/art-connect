<?php
  require_once("dbConfig/connect.php");
  if(!isset($_SESSION["current_user_id"])){
    header("location:index.php");
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.101.0">
    <title>Dashboard | ArtConnect</title>

    <!-- <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/dashboard/"> -->

    

    <!-- Bootstrap core CSS -->
<!-- <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet"> -->



    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
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
    
<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">Art Connect</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <p class="text-white m-auto"><?php echo $_SESSION["current_user"];?></p>
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="logout.php">Sign out</a>
    </li>
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">
    
  <?php include ("dashboard-side-menu.html")?>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="post-wrapper">
        <div class="post-holder">

          <div class="post-header">
          <h3>Your Posts</h3>
          <a href="add_new_post.php"><button>ADD NEW POST</button></a>
          </div>

          <?php
                $user_id = $_SESSION["current_user_id"];
                $get_all_recent_posts_sql = "SELECT post_id, post_title, post_date,post_photo FROM posts WHERE u_id = '$user_id' ORDER BY post_id DESC";
                $result_recent = mysqli_query($conn, $get_all_recent_posts_sql);

                if (mysqli_num_rows($result_recent) > 0) {
                    // output data of each row
                    while ($row_posts = mysqli_fetch_assoc($result_recent)) {
                        echo '
                            <div class="single-post-holder">
                            <div class="post-holder-left">
                              <div class="post-img">
                                <img src="img/blog/'.$row_posts["post_photo"].'" alt="">
                              </div>
                              <div class="post-content">
                                <p class="post-title">'.$row_posts["post_title"].'</p>
                                <p class="post-date">'.$row_posts["post_date"].'</p>
                              </div>
                            </div>
                            <div class="post-btn">
                              <a href="edit_post.php?post='.$row_posts["post_id"].'"><button>EDIT</button></a>
                            </div>
                          </div>
                        ';
                    }
                }
                ?>
        </div>
      </div>
    </main>
  </div>
</div>


    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
      <!-- <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.min.js"></script> -->

<!--       
        <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script> -->
        <!-- <script src="dashboard.js"></script> -->

        <script src="../js/jquery-3.3.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/jquery.nice-select.min.js"></script>
        <script src="../js/jquery-ui.min.js"></script>
        <script src="../js/jquery.slicknav.js"></script>
        <script src="../js/mixitup.min.js"></script>
        <script src="../js/owl.carousel.min.js"></script>
        <!-- <script src="../js/main.js"></script> -->

        <script>
          document.getElementById("posts-menu-item").classList.add("active");
        </script>
  </body>
</html>

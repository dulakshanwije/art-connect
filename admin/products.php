<?php
require_once("../dbConfig/connect.php");
if (!isset($_SESSION["admin"])) {
    header("location:index.php");
}

function validateInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function getRandomWord($len = 5)
{
    $word = array_merge(range('a', 'z'), range('A', 'Z'));
    shuffle($word);
    return substr(implode($word), 0, $len);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $p_name = validateInput($_POST['p_name']);
    $p_category = validateInput($_POST['p_category']);
    $p_desc = validateInput($_POST['p_desc']);
    $p_availability = validateInput($_POST['p_availability']);
    $p_price = validateInput($_POST['p_price']);
    $p_image = $_FILES['p_image']['tmp_name'];
    $p_image_name = $_FILES['p_image']['name'];

    if (empty($p_name) || empty($p_category) || empty($p_desc) || empty($p_availability) || empty($p_price)) {
        echo "Empty!!";
    } else {

        $random_word = getRandomWord();

        $p_name_new = str_replace(" ", "", strtolower(strlen($p_name) > 7 ? substr($p_name, 0, 8) : $p_name));

        $img_extesion = strtolower(pathinfo($p_image_name, PATHINFO_EXTENSION));

        $new_image_name = "pro-img-" . $p_name_new . "-" . $random_word . "." . $img_extesion;

        move_uploaded_file($p_image, "../img/products/" . $new_image_name);

        $sql = "INSERT INTO products (p_name, p_category, p_desc, p_availability, p_price, p_image_url)
VALUES ('$p_name', '$p_category', '$p_desc', '$p_availability', '$p_price', '$new_image_name')";

        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
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
    <link href="dashboard.css" rel="stylesheet">
    <!-- Css Styles -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="../css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="../css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="../css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="../css/style.css" type="text/css">
</head>

<body>

    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">Art Connect</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <p class="text-white m-auto"><?php echo $_SESSION["admin"]; ?></p>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="logout.php">Sign out</a>
            </li>
        </ul>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="sidebar-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php">
                                <i class="fa fa-home" aria-hidden="true"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fa fa-file-o" aria-hidden="true"></i>
                                Orders
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="products.php">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                Products
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fa fa-users" aria-hidden="true"></i>
                                Customers
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fa fa-bar-chart" aria-hidden="true"></i>
                                Reports
                            </a>
                        </li>
                    </ul>

                    <!-- <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Saved reports</span>
          <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Current month
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Last quarter
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Social engagement
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Year-end sale
            </a>
          </li>
        </ul> -->
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <ul class="nav nav-pills mt-3 d-flex justify-content-around" id="pills-tab" role="tablist">
                    <li class="nav-item col-4 p-0" role="presentation">
                        <button class="nav-link active col-12" id="pills-home-tab" data-toggle="pill" data-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">View All Products</button>
                    </li>
                    <li class="nav-item col-4 p-0" role="presentation">
                        <button class="nav-link col-12" id="pills-profile-tab" data-toggle="pill" data-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Add New Products</button>
                    </li>
                    <li class="nav-item col-4 p-0" role="presentation">
                        <button class="nav-link col-12" id="pills-contact-tab" data-toggle="pill" data-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Edit Products</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Availability</th>
                            <th>Price</th>
                            <th>Rating</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php
                                $sql = "SELECT * FROM products";
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    // output data of each row
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
                                        echo '
                                        <tr>
                                            <td>'.$row["p_id"].'</td>
                                            <td>'.$row["p_name"].'</td>
                                            <td>'.$row["p_category"].'</td>
                                            <td>'.$row["p_availability"].'</td>
                                            <td>'.$row["p_price"].'</td>
                                            <td>'.$row["p_rating"].'</td>
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

                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    
                        <form class="col-md-6 col-sm-12 m-auto py-5" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="">Product Name</label>
                                <input type="text" class="form-control" id="" aria-describedby="emailHelp" name="p_name" required>
                            </div>

                            <div class="form-group">
                                <label for="">Product Category</label>
                                <select name="p_category" class="form-control" id="" required>
                                    <option value="" selected>Choose...</option>
                                    <option value="Colours" >Colours</option>
                                    <option value="Brushes" >Brushes</option>
                                    <option value="Surfaces" >Surfaces</option>
                                    <option value="Mediums" >Mediums</option>
                                    <option value="Accessories" >Accessories</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Product Description</label>
                                <textarea class="form-control" id="" rows="3" name="p_desc" required></textarea>
                            </div>

                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="" name="p_availability" required>
                                <label class="form-check-label" for="">Availability</label>
                            </div>

                            <div class="form-group">
                                <label for="">Price</label>
                                <input type="number" class="form-control" id="" aria-describedby="" placeholder="Rs." name="p_price" required>
                            </div>

                            <div class="form-group">
                                <label for="">Image of the product:</label>
                                <input type="file" class="form-control-file" id="" name="p_image" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    
                </div>

                    <div class="tab-pane fade show" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <form class="form-inline d-flex justify-content-around">
                        <div class="form-group mx-sm-3 mb-2 col-12">
                            <input type="text" class="form-control my-5 mx-0 col-12" id="searchItem" placeholder="Search for Products" onkeyup="showProduct(this.value)">
                        </div>
                    </form>
                    <form method="GET" id="form-id-1" action = "myaction.php">
                        <div class="form-group">
                            <select multiple class="form-control" id="controlSelect" onclick = "document.getElementById('form-id-1').submit();" name = "selectProduct">
                            </select>
                        </div>
                    </form>
                    <script>
                        function showProduct(str) {
                        var xhttp;
                        if (str.length == 0) { 
                            document.getElementById("controlSelect").innerHTML = "";
                            return;
                        }
                        xhttp = new XMLHttpRequest();
                        xhttp.responseType = 'json';
                        xhttp.onreadystatechange = function() {
                            document.getElementById("controlSelect").innerHTML = "";
                            var data;
                            if (this.readyState == 4 && this.status == 200) {
                               data = this.response;
                            }
                            data?.forEach(obj => {
                                let op = document.createElement('option');
                                op.textContent = obj.name;
                                op.value = obj.id;
                                document.getElementById("controlSelect").appendChild(op);
                                console.log(op);
                            });   
                        }
                        xhttp.open("GET", "apis/getProducts.php?q="+str, true);
                        xhttp.send();
                    }
                    </script>
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
</body>

</html>
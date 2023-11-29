<?php
require_once("dbConfig/connect.php");
if (!isset($_SESSION["current_user_id"])) {
    header("location:index.php");
}

$post;

if(isset($_GET["post"])){
    $post_id = ($_GET["post"]);
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

        .form-header {
            margin: 5px 0;
            padding: 10px;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
        }

        .post-form-wrapper {
            margin: 20px 0px;
            background-color: #999;
        }

        .post-form-holder {
            padding: 10px;
        }
        #selected-items-list {
            overflow-y: auto;
        }

        #selected-items-list .selected-input-holder{
            background-color: #e9ecef;
            padding: 6px 12px;
            width: 100%;
            border-radius: 0.25rem;
            border: 1px solid #ced4da;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            margin-bottom:5px;
        }
        #selected-items-list label {
            padding: 0;
            margin: 0;
        }

        #selected-items-list button {
            font-size: x-small;
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
        <p class="text-white m-auto"><?php echo $_SESSION["current_user"]; ?></p>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="logout.php">Sign out</a>
            </li>
        </ul>
    </nav>

    <div class="container-fluid">
        <div class="row">

            <?php include("dashboard-side-menu.html") ?>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="post-form-wrapper">
                    <div class="form-header">
                        <h3>Edit Post</h3>
                        <a href="posts.php"><button>View All Posts</button></a>
                    </div>
                    <?php
                        $sql = "SELECT `post_id`, `post_title`, `post_description`, `post_photo`, `post_category`, `post_date`, `u_id` FROM `posts` WHERE post_id = $post_id";
                        $result = mysqli_query($conn, $sql);
                        
                        if (mysqli_num_rows($result) > 0) {
                          $row = mysqli_fetch_assoc($result);
                        }
                    ?>
                    <div class="post-form-holder">
                        <form action="" id="post_form" method="POST" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="post_name">Post Name</label>
                                    <input type="text" class="form-control" id="post_name" placeholder="Post Name" name="post_name" value ="<?php echo $row["post_title"]?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputState">Category</label>
                                    <select id="inputState" class="form-control" name="post_category">
                                        <option selected>Choose...</option>
                                        <option>Abstract</option>
                                        <option>Portraiture</option>
                                        <option>Still Life</option>
                                        <option>Pop Art</option>
                                        <option>Conceptual Art</option>
                                        <option>Digital Art</option>
                                        <option>Landscape</option>
                                        <option>Illustration</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="post_body">Post Body</label>
                                <textarea class="form-control" id="post_body" rows="5" placeholder="Post Body" name="post_body"><?php echo $row["post_description"]?></textarea>
                            </div>
                            <div class="form-row">
                                <div class="from-group col-md-6">
                                    <label for="post_date">Date</label>
                                    <input type="date" class="form-control" name="post_date" id="post_date" value="<?php echo date('Y-m-d') ?>" readonly>
                                </div>
                                <div class="from-group col-md-6">
                                    <label for="post_image">Post Image</label>
                                    <input type="file" class="form-control" id="post_image" name="post_image">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="searchItem" class="mt-3">Search for Products</label>
                                    <input type="text" class="form-control col-12" id="searchItem" placeholder="Search for Products" onkeyup="showProduct(this.value)">
                                    
                                    <label for="controlSelect" clas>Select Products</label>
                                    <select multiple class="form-control" id="controlSelect" onclick="selectProductItem(this.value , this.options[this.selectedIndex].text)" name="selectProduct">
                                    </select>
                                    </div>
                                    <div class="form-group col-md-6 mt-5" id="selected-items-list">
                                    </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                    </div>
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

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <!-- <script src="../js/main.js"></script> -->

    <script>
        document.getElementById("posts-menu-item").classList.add("active");
    </script>

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
                });
            }
            xhttp.open("GET", "admin/apis/getProducts.php?q=" + str, true);
            xhttp.send();
        }

        let count = 0;

        function selectProductItem(value, text) {
            count++;
            let ele_name = "product_" + count;
            let form_parent = document.getElementById("selected-items-list");
            let new_input = document.createElement("input");
            let label_input = document.createElement("label");
            let div = document.createElement("div");
            let rm_btn = document.createElement("button");

            div.setAttribute("class", "selected-input-holder");
            div.setAttribute("id", "div-" + ele_name);

            new_input.setAttribute("type", "text");
            new_input.setAttribute("value", value);
            new_input.setAttribute("name", ele_name);
            new_input.setAttribute("id", ele_name);
            new_input.style.display = "none";

            label_input.setAttribute("for", ele_name);
            label_input.innerHTML = text;

            rm_btn.innerText = "REMOVE";
            rm_btn.setAttribute("onclick", "removeProductItem('div-"+ele_name+"')");
            rm_btn.setAttribute("type", "button");

            div.appendChild(new_input);
            div.appendChild(label_input);
            div.appendChild(rm_btn);

            form_parent.appendChild(div);

            document.getElementById("post_form").setAttribute("action", "action_new_post.php?count=" + count);
        }

        function removeProductItem(id){
            document.getElementById(id).remove();
        }
    </script>
</body>

</html>
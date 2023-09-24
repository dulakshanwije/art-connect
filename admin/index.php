<?php

require_once("../dbConfig/connect.php");

function validateInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $a_email = validateInput($_POST['admin_email']);
    $a_password = validateInput($_POST['admin_password']);

    if (empty($a_email) || empty($a_password)) {
        echo "Empty!!";
    } else {
        $sql = "SELECT * FROM users WHERE u_email =  '$a_email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                if($row["u_role"] === "admin"){
                    $_SESSION["admin"] = $row["u_email"];
                    header("location:dashboard.php");
                }
            }
        } else {
            echo "0 results";
        }
    }
}

mysqli_close($conn);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.101.0">
    <title>Admin Login</title>

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
    <link href="signin.css" rel="stylesheet">
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

<body class="text-center">

    <form class="form-signin" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
        <img class="mb-4" src="../img/logo.png" alt="" width="auto" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Administrator | Login</h1>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name = "admin_email" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" name = "admin_password" required>
        <div class="checkbox mb-3">
            <!-- <label>
      <input type="checkbox" value="remember-me"> Remember me
    </label> -->
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <!-- <p class="mt-5 mb-3 text-muted">&copy; 2017-2022</p> -->
    </form>



</body>

</html>
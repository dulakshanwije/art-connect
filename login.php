<?php

require_once("dbConfig/connect.php");

if (isset($_SESSION["current_user"])) {
    header("location:dashboard.php");
}

if (isset($_GET['msg'])) {
    if ($_GET['msg'] == 'invalid-auth') {
        echo '
            <script>
                alert("Invalid Credentials!!! Please try again.");
            </script>
        ';
    }

    if ($_GET['msg'] == 'reg-success') {
        echo '
            <script>
                alert("Registration Successfull, Please login again!!!");
            </script>
        ';
    }

    if ($_GET['msg'] == 'cart-login') {
        echo '
        <script>
        alert("You must login to your account first");
        </script>
        ';
    }
}

function validateInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $u_email = validateInput($_POST['user_email']);
    $u_password = validateInput($_POST['user_password']);

    if (empty($u_email) || empty($u_password)) {
        echo "Empty!!";
    } else {
        $sql = "SELECT * FROM users WHERE u_email =  '$u_email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row["u_password"] === $u_password) {
                    if ($row["u_role"] === "user") {
                        $_SESSION["current_user_id"] = $row["u_id"];
                        $_SESSION["current_user"] = $row["u_email"];
                        header("location:index.php");
                    }
                } else {
                    header("location:login.php?msg=invalid-auth");
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
    <link href="css/auth.css" rel="stylesheet">
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

<body class="text-center">

    <form class="form-signin" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <img class="mb-4" src="img/logo.png" alt="" width="auto" height="72">
        <h1 class="h3 mb-3 font-weight-normal">User | Login</h1>
        <label for="inputEmail" class="sr-only">Email Address</label>
        <input type="email" id="inputEmail" class="form-control mb-3" placeholder="Email Address" name="user_email" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="user_password" required>
        <div class="checkbox mb-3">
            <!-- <label>
      <input type="checkbox" value="remember-me"> Remember me
    </label> -->
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <p class="mt-3 mb-3 text-muted">Don't have an account? <a href="signup.php">Register now</a></p>
        <p class="mt-3 mb-3 text-muted"><a href="index.php">Return to Home</a></p>
    </form>



</body>

</html>
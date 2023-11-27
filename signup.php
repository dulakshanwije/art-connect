<?php

require_once("dbConfig/connect.php");

if(isset($_GET['msg'])){
    if($_GET['msg'] == 'email-in-use'){
        echo '
            <script>
                alert("Email is already in use!!!");
            </script>
        ';
    }
    
    if($_GET['msg'] == 'success'){
        echo '
            <script>
                alert("Registration Successfull!!!");
            </script>
        ';
        header("location:login.php");
    }
}

function validateInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function getRandomWord($len = 8)
{
    $word = array_merge(range('a', 'z'), range('A', 'Z'));
    shuffle($word);
    return substr(implode($word), 0, $len);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $u_name = validateInput($_POST['user_name']);
    $u_email = validateInput($_POST['user_email']);
    $u_password = validateInput($_POST['user_password']);

    $check_email = "SELECT u_email FROM users WHERE u_email = '$u_email'";
    $result_email = mysqli_query($conn, $check_email);
    if (mysqli_num_rows($result_email) > 0) {
        echo "Email is already in use!";
        header("location:signup.php?msg=email-in-use");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    $u_isEditor = isset($_POST['is_editor']) ? validateInput($_POST['is_editor']) : "";

    $u_image_temp_name = isset($_FILES['u_photo']['tmp_name']) ? $_FILES['u_photo']['tmp_name'] : "";
    $u_image_name = isset($_FILES['u_photo']['name']) ? $_FILES['u_photo']['name'] : "";

    if (empty($u_email) || empty($u_password) || empty($u_name)) {
        echo "Empty!!";
    } else {
        $pro_img_name = "";
        $editor_check;
        if(!empty($u_image_name) || $u_image_name != ""){
            $img_extesion = strtolower(pathinfo($u_image_name, PATHINFO_EXTENSION));
            $new_image_name = "IMG-". getRandomWord() .".".$img_extesion;
            move_uploaded_file($u_image_temp_name, "img/users/".$new_image_name);
            $pro_img_name = $new_image_name;
        }

        if($u_isEditor == '1'){
            $editor_check = 1;
        }
        else{
            $editor_check = 0;
        }

        $sql = "INSERT INTO users(u_email, u_password, u_role,u_name,u_is_editor, u_profile_pic) VALUES ('$u_email','$u_password','user','$u_name','$editor_check','$pro_img_name')";

        if (mysqli_query($conn, $sql)) {
            header("location:login.php?msg=success");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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

        .hint-text {
            font-size: smaller;
            font-style: italic;
            color: gray;
            text-transform: lowercase;
        }

        .label-text {
            text-align: start;
            width: 100%;
            margin: 0;
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

    <form class="form-signin" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
        <img class="mb-4" src="img/logo.png" alt="" width="auto" height="72">
        <h1 class="h3 mb-3 font-weight-normal">User | Registration</h1>

        <label for="inputName" class="sr-only">Full Name</label>
        <input type="text" id="inputName" class="form-control mb-3" placeholder="Full Name" name="user_name" required autofocus>

        <label for="inputEmail" class="sr-only">Email Address</label>
        <input type="email" id="inputEmail" class="form-control mb-3" placeholder="Email Address" name="user_email" required autofocus>

        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="user_password" required>

        <div class="form-control d-flex">
            <input type="file" id="fileInput" class="d-none" id="" name="u_photo" onchange="imgPreview(this)" hidden>
            <label for="fileInput" class="label-text">
                <img src="img/users/placeholder.jpg" alt="" id="pro_img_display">
            </label>
        </div>
        <p class="hint-text">*profile photo is required to register as an Editor</p>

        <div class="form-group mb-3 mt-3 w-full d-flex justify-content-around form-control align-items-center">
            <input type="checkbox" id="editorCheck" name="is_editor" value="1">
            <label class="m-0" for="editorCheck">Enable Editor Mode</label>
        </div>

        <div class="checkbox mb-3">
            <!-- <label>
      <input type="checkbox" value="remember-me"> Remember me
    </label> -->
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
        <p class="mt-3 mb-3 text-muted">Already have an account? <a href="login.php">Login</a></p>
        <p class="mt-3 mb-3 text-muted"><a href="index.php">Return to Home</a></p>
    </form>

    <script>
        function imgPreview(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('pro_img_display').src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>

</html>
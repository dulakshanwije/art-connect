<?php

require_once("../dbConfig/connect.php");

function validateInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function getRandomWord($len = 5) {
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

        $p_name_new = str_replace(" ", "", strtolower(strlen($p_name) > 7?substr($p_name,0,8):$p_name));

        $img_extesion = strtolower(pathinfo($p_image_name, PATHINFO_EXTENSION));

        $new_image_name = "pro-img-" . $p_name_new. "-" .$random_word . "." . $img_extesion;

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

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

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
    <form class="col-md-6 col-sm-12 m-auto py-5" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">Product Name</label>
            <input type="text" class="form-control" id="" aria-describedby="emailHelp" name="p_name" required>
            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
        </div>

        <div class="form-group">
            <label for="">Product Category</label>
            <input type="text" class="form-control" id="" aria-describedby="" name="p_category" required>
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
            <label for="">Example file input</label>
            <input type="file" class="form-control-file" id="" name="p_image" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>

</html>
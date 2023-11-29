<?php
require_once("dbConfig/connect.php");
if (!isset($_SESSION["current_user_id"])) {
    header("location:index.php");
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

$p_name = validateInput($_POST['post_name']);
$p_category = validateInput($_POST['post_category']);
$p_body = validateInput($_POST['post_body']);
$p_date = validateInput($_POST['post_date']);
$p_image_temp_name = $_FILES['post_image']['tmp_name'];
$p_image_name = $_FILES['post_image']['name'];

$p_date = date('Y-m-d');

$user_id = $_SESSION["current_user_id"];

$count = (int)$_GET["count"];

$img_extesion = strtolower(pathinfo($p_image_name, PATHINFO_EXTENSION));
$new_image_name = "IMG-POST-" . getRandomWord() . "." . $img_extesion;
move_uploaded_file($p_image_temp_name, "img/blog/" . $new_image_name);

$insert_post = "INSERT INTO posts(post_title, post_description, post_photo, post_category, post_date, u_id) VALUES ('$p_name','$p_body','$new_image_name','$p_category','$p_date','$user_id')";

if (mysqli_query($conn, $insert_post)) {

    $last_id = mysqli_insert_id($conn);

    $insert_post_products = "INSERT INTO posts_products(post_id, p_id) VALUES ";
    for ($i = 1; $i <= $count; $i++) {
        $insert_post_products .= "(" . $last_id . "," . $_POST['product_' . $i] . ")";
        if ($i != $count) {
            $insert_post_products .= ",";
        }
    }
    if (mysqli_query($conn, $insert_post_products)) {
        header("location:posts.php");
    } else {
        echo "Error: " . $insert_post_products . "<br>" . mysqli_error($conn);
    }
} else {
    echo "Error: " . $insert_post . "<br>" . mysqli_error($conn);
}

<?php

    require_once("../dbConfig/connect.php");

    if (!isset($_GET["selectProduct"])) {
        header("location:dashboard.php");
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
        $p_availability = validateInput(isset($_POST['p_availability'])?$_POST['p_availability']:0);
        $p_isDiscount = validateInput(isset($_POST['p_isDiscount'])?$_POST['p_isDiscount']:0);
        $p_isFeatured = validateInput(isset($_POST['p_isFeatured'])?$_POST['p_isFeatured']:0);
        $p_discount = validateInput(isset($_POST['p_discount'])?$_POST['p_discount']:0);
        $p_price = validateInput($_POST['p_price']);
        $p_image = $_FILES['p_image']['tmp_name'];
        $p_image_name = $_FILES['p_image']['name'];
    
        if (empty($p_name) || empty($p_category) || empty($p_desc) || empty($p_price)) {
            echo "Empty!!";
        } else {
    
            $random_word = getRandomWord();
    
            $p_name_new = str_replace(" ", "", strtolower(strlen($p_name) > 7 ? substr($p_name, 0, 8) : $p_name));
    
            $img_extesion = strtolower(pathinfo($p_image_name, PATHINFO_EXTENSION));
    
            $new_image_name = "pro-img-" . $p_name_new . "-" . $random_word . "." . $img_extesion;
    
            move_uploaded_file($p_image, "../img/products/" . $new_image_name);
    
            $p_id = $_GET['selectProduct'];
    
            $sql = "UPDATE products SET p_name='$p_name', p_category='$p_category', p_desc='$p_desc',p_isAvailable='$p_availability', p_isFeatured = '$p_isFeatured', p_isDiscount = '$p_isDiscount', p_discount ='$p_discount', p_price='$p_price', p_image_url='$new_image_name' WHERE p_id='$p_id'";
    
            if (mysqli_query($conn, $sql)) {
                echo "Record updated successfully";
                // header("location:products.php");
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        }
    }
?>
<?php

require_once("../dbConfig/connect.php");

if (!isset($_GET["selectProduct"])) {
    header("location:dashboard.php");
}


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
    <div class="m-auto">

        <?php

        $data = array();

        $p_id = $_GET["selectProduct"];
        $sql = "SELECT * FROM products WHERE p_id = '$p_id'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                $data = $row;
            }
        } else {
            echo "0 results";
        }

        mysqli_close($conn);
        ?>

        <form class="col-md-6 col-sm-12 m-auto py-5" method="post" action="update_products.php?selectProduct=<?php echo $p_id?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Product Name</label>
                <input type="text" class="form-control" id="" aria-describedby="emailHelp" name="p_name" value="<?php echo $data["p_name"] ?>" required>
            </div>

            <div class="form-group">
                <label for="">Product Category</label>
                <input type="text" class="form-control" id="" aria-describedby="" name="p_category" value="<?php echo $data["p_category"] ?>" required>
            </div>

            <div class="form-group">
                <label for="">Product Description</label>
                <textarea class="form-control" id="" rows="10" name="p_desc" value="<?php echo $data["p_desc"] ?>" required><?php echo $data["p_desc"] ?></textarea>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="form-group form-check">
                        <?php
                        if ($data["p_isAvailable"] == true) {
                            echo '
                            <input type="checkbox" class="form-check-input" id="" name="p_availability" checked>
                            ';
                        } else {
                            echo '
                            <input type="checkbox" class="form-check-input" id="" name="p_availability !checked">
                            ';
                        }
                        ?>
                        <label class="form-check-label" for="">Availability</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group form-check">
                        <?php
                        if ($data["p_isFeatured"] == true) {
                            echo '
                            <input type="checkbox" class="form-check-input" id="" name="p_isFeatured" checked>
                            ';
                        } else {
                            echo '
                            <input type="checkbox" class="form-check-input" id="" name="p_isFeatured" >
                            ';
                        }
                        ?>
                        <label class="form-check-label" for="">Featured</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group form-check" onchange="setDiscount()">
                        <?php
                        if ($data["p_isDiscount"] == true) {
                            echo '
                            <input type="checkbox" class="form-check-input" id="dis_checker" name="p_isDiscount" checked>
                            ';
                        } else {
                            echo '
                            <input type="checkbox" class="form-check-input" id="dis_checker" name="p_isDiscount">
                            ';
                        }
                        ?>
                        <label class="form-check-label" for="">Discount</label>
                    </div>
                </div>
                <div class="col-6" id="discountHolder" style="<?php echo($data["p_isDiscount"] == true?"display:block;":"display:none;")?>">
                    <label for="">Discount Value: </label>
                    <input type="text" class="form-control" id="" aria-describedby="" name="p_discount" value="<?php echo $data["p_discount"] ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label for="">Price</label>
                <input type="number" class="form-control" id="" aria-describedby="" placeholder="Rs." name="p_price" value="<?php echo $data["p_price"] ?>" required>
            </div>


            <div class="form-group">
                <div>
                    <label for="currentImg">Current Image: </label>
                    <img src="../img/products/<?php echo $data["p_image_url"] ?>" alt="" id="currentImg">
                </div>
                <label for="">Image of the product:</label>
                <input type="file" class="form-control-file" id="" name="p_image">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script>
        function setDiscount() {
            const discountHolder = document.getElementById("discountHolder");
            const discountChecker = document.getElementById("dis_checker");

            if (discountChecker.checked == true) {
                discountHolder.style.display = "block";
            } else {
                discountHolder.style.display = "none";
            }
        }
    </script>
</body>

</html>
<?php

    require_once("../../dbConfig/connect.php");

    $key = $_GET["q"];

    $sql = "SELECT * FROM products WHERE p_id = '$key' OR p_name LIKE '%$key%'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $value = array();
        $idx = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
            $data["id"] = $row["p_id"];
            $data["name"] = $row["p_name"];
            // $value[$idx] = $row["p_id"]. " ". $row["p_name"];
            $value[$idx] = $data;
            $idx++;
        }
        echo json_encode($value);
    } else {
        echo "0 results";
    }
    mysqli_close($conn);
?>

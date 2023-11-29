<?php
echo "count" . $_GET["count"];
echo "<br />";

$count = (int)$_GET["count"];

for ($i=1; $i <= $count; $i++) { 
    echo $_POST["product_".$i];
    echo "<br />";
}
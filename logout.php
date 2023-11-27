<?php
    require_once("dbConfig/connect.php");
    session_destroy();
    header("location:login.php");
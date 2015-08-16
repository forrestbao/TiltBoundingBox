<?php
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "1";
    $db = "image_data";

    mysql_connect($dbhost, $dbuser, $dbpass) or die("failed");
    echo "success";

    mysql_select_db($db);
    echo "success";
?>
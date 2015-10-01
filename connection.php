<?php
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "1";
    $db = "image_data";

    $link = mysql_connect($dbhost, $dbuser, $dbpass);
    if(!$link){
    	header("Location: GetBoundingBox.php?connection=Connection_failed");
    } 
    echo "success";

    mysql_select_db($db);
    echo "success";
?>


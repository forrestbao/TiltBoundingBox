
<html>
<head>

<?php 

    include "connection.php";
    
    $l_u_x = $_GET["X"];
    $l_u_y = $_GET["Y"];
    $height = $_GET["height"];
    $width = $_GET["width"];
    $angle = $_GET["r"];
    $imName = $_GET["name"];
    $obName = $_GET["ObjectName"];
    $zoom = $_GET["zoom"];
    $checkTrun = $_GET["truncated"];
    $index = $_GET["index"];
    $information = "Please fill blank space!";
    
    $trun = 0;
    
    if($checkTrun == "true"){
        $trun = 1;
    }else{
        $trun = 0;
    }
    echo $checkTrun;
    echo $trun;
    
    if($obName == "" || $l_u_x == "" || $l_u_y == "" || $height == "" || $width == ""){
        header("Location: GetBoundingBox.php?name=" . $imName . "&infor=".$information);
        echo "miss something";
    }else{
        $sql = "INSERT INTO getData (ID, object, image, centerx, centery, height, width, angle, truncated)
                VALUES (NULL, '$obName', '$imName','$l_u_x','$l_u_y','$height','$width','$angle','$trun')";
        
    	mysql_query($sql);
     
    	echo "User has been added";
        header("Location: GetBoundingBox.php?index=" . $index . "&name=" . $imName);
    }
    //header("Location: GetBoundingBox.php?index=" . $index . "&name=" . $imName);
?>
</head>
</html>
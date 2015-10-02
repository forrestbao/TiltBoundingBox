
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
    $information = "Please fill blank space!";
    
    if($obName == "" || $l_u_x == "" || $l_u_y == "" || $height == "" || $width == ""){
        header("Location: GetBoundingBox.php?name=" . $imName . "&infor=".$information);
        echo "miss something";
    }else{
        $sql = "INSERT INTO Objects (ID, object, image, left_upper_x, left_upper_y, height, width, angle,zoomlevel)
                VALUES (NULL, '$obName', '$imName','$l_u_x','$l_u_y','$height','$width','$angle','$zoom')";
        
    	mysql_query($sql);
     
    	echo "User has been added";
        header("Location: GetBoundingBox.php?name=" . $imName);
    }

?>
</head>
</html>
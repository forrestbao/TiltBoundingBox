
<html>
<head>

<?php 

    include "connection.php";
    
    $l_u_x = $_POST["x1"];
    $l_u_y = $_POST["y1"];
    $height = $_POST["h"];
    $width = $_POST["w"];
    $angle = $_POST["Deg"];
    $imName = $_GET["name"];
    $obName = $_POST["ObjectName"];
    $information = "Please fill blank space!";
    
    if($obName == "" || $l_u_x == "" || $l_u_y == "" || $height == "" || $width == "" || $angle == ""){
        header("Location: image-boundingbox.php?ImageName=" . $imName ."&Deg=".$angle. "&infor=".$information);
    }else{
        $sql = "INSERT INTO Objects (ID, object, image, left_upper_x, left_upper_y, height, width, angle)
                VALUES (NULL, '$obName', '$imName','$l_u_x','$l_u_y','$height','$width','$angle')";
        
    	mysql_query($sql);
     
    	echo "User has been added";
        header("Location: image-rotation.php?name=" . $imName);
    }

?>
</head>
</html>
<html>
<head>

<link rel="stylesheet" href="css/new.css">
<script src="js/jquery.min.js"></script>
<script src="js/test.js"></script>

</head>

<body>

<?php
// Load name of image from filename.txt
//$file_handle = fopen("filename.txt", "rb");

//while (!feof($file_handle) ) {

//$line_of_text = fgets($file_handle);
//$parts = explode('=', $line_of_text);

////print $parts[0] .  "<BR>";
//array_push($file_name, $parts[0]);

//}

//$arrlength = count($file_name);

//fclose($file_handle);

//load name of image from the $dir file into array $file_name.
$dir = "images";
$file_name = array();
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            //echo "filename: .".$file."<br />";
            //if(strpos($file,"JPEG")){  //check file format.
            array_push($file_name,"$file");
                //fwrite($myfile, "$file\n");
            //}
        }
        closedir($dh);
    }
}

//randomly pick an image
$temp = $file_name[array_rand($file_name)];

//echo $temp;
//keep the same image after modification
$temp_image_name = $_GET["name"];
if($temp_image_name != null){
    $temp = $temp_image_name;
}
//remove "\n" if it exists
$temp = basename($temp,"\n");

//three conditions may cause problems. 
if($temp == null || $temp == ".." || $temp == "."){
    $temp = "image_error.png";
}
//track the information from the database connection
$connection = $_GET["Connection"];

//track information about the database transferring
$information = $_GET["infor"];

?>

<!--  <input type="button" value ="-" onclick="zoomimage(0.9)"/>
<input type="button" value ="+" onclick="zoomimage(1.1)"/> -->

<!--load image-->
<div class="drawingArea" id="loading">
    <?php
    echo "<img id='zoomedimage' src='images/" . $temp . "' alt='mobile'>";
    ?> 
   <!--  <img id="zoomedimage" src="http://cf-wp-prod.sharethis.com/wp-content/uploads/2014/07/Its-Becoming-A-Mobile-World.jpg" alt="mobile"  >  -->
</div>

<?php
//track the size of the current image
list($width, $height) = getimagesize('images/'.$temp);
//echo "width: " . $width . "<br />";
//echo "height: " .  $height;
$width = 2*$width;
$height = 2*$height;
if($width < $height){
    $width = $height;
}
if($height < $width){
    $height = $width;
}
//modify the size of Canvas
echo "<canvas id='canvas' width=".$width." height=".$height."></canvas>"
?>

<script>
$(document).ready(function () {
}
</script>
<!--display instructions and parameters -->
<div class="coords">
    <h4>Instruction:</h4>
    <h5>Step 1: Use mouse to rotate the image and make sure that the object is straight up</h4>
    <h5>Step 2: Click the "Fetch Object" button, and draw bounding box of the object </h4>
    <h5>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp from upper left to the right bottom</h4>
    <h5>Step 3: Enter the name of the object and press the confirm button to send the data to the database</h4>
    <?php
    echo "
    <h3>" . $information. "</h3>
    <h3>" . $connection . "</h3>"
    ?> 
    <!--rotation angle-->
    <p>Angle : <span id="angle"></span>
    </p>
    <!--top left corner coordinates in the canvas based coordinate system-->
    <p>X: <span class="fromX"></span>
    </p>
    <p>Y: <span class="fromY"></span>
    </p>
    <!--width and height of the bounding box-->
    <p>W: <span class="width"></span>
    </p>
    <p>H: <span class="height"></span>
   <!--  <p>Zoom: <span class="zoom"></span> -->
     </p>
    <!--top left corner coordinates in the image-based coordinate system-->
    <!--<p>realX: <span class="xstart"></span>
    </p>
    <p>realY: <span class="ystart"></span>
    </p>-->
     
     <!--control buttons-->
     <label>ObjectName <input type = "text" name = "ObjectName" id = "ObName" value = "" /></label> 
     <br>

    <button id="anglebutton">Fetch Object</button>
    <button id="reset">Reset</button>
    <button id="confirm" class="float-left submit-button" >confirm</button>
    <br >
    <button id="New" class="float-left submit-button" >New Image</button>

</div>
<?php
    echo "
    <style>
    .coords {
        margin-left:" .$width."; 
        margin-top: 0px;
        position:absolute;
        top: 100px;
    }
    </style>
    "
?>


<script type="text/javascript">
document.getElementById("confirm").onclick = function () {
    var obname = document.getElementById("ObName").value
    //var zoomvalue = $(".zoom").html();
    //if(zoomvalue == ""){
    //    zoomvalue = 0;
    //}
    //zoomvalue = parseInt(zoomvalue);

    if(r == undefined){
        r = 0;
    }
    //calculate the top left corner coordinate in the image-based coordinate system
    var realImage = document.getElementById("zoomedimage");
    var realImageWidth = realImage.clientWidth;
    var realImageHeight = realImage.clientHeight;
    //var ImageWidth = 400*(1+(parseInt(zoomvalue)/10));
    //var ImageHeight = ImageWidth;
    var realStartX = Xcenter - realImageWidth/2;
    var realStartY = Ycenter - realImageHeight/2;
    var a_1 = Math.atan2((Ycenter - realStartY),(Xcenter - realStartX));

    var r_a = (r/180)*Math.PI;
    var a_2 = a_1 + r_a;
    var l_1 = Math.sqrt(Math.pow(Ycenter - realStartY,2) + Math.pow(Xcenter - realStartX,2));
    var xTrue = Xcenter - l_1*Math.cos(a_2);
    var yTrue = Ycenter - l_1*Math.sin(a_2);
    var l_2 = Math.sqrt(Math.pow(startX - xTrue,2) + Math.pow(startY - yTrue,2));
    var a_3 = Math.atan2(startY - yTrue,startX - xTrue);
    var a_4 = a_3 - r_a;
    var yy = Math.floor(l_2*Math.sin(a_4));
    var xx = Math.floor(l_2*Math.cos(a_4));
    $('.ystart').html(yy); 
    $('.xstart').html(xx); 

    //console.log(realImageWidth);
    //console.log(realImageHeight);
    //console.log(xx);
    //console.log(yy);
    //console.log(a_1);
    //console.log(r_a);
    //console.log(a_2);
    //console.log(a_3);
    //console.log(realImageWidth);
    //console.log(realImageHeight);
    //console.log(xTrue);
    //console.log(yTrue);
    // console.log(l_1);

    console.log(Xcenter);
    console.log(Ycenter);
    //console.log(realWidth);
    //console.log(realHeight);
    //console.log(zoomvalue);
    //console.log(zoomLevel);
    //console.log(zoomvalue);
    //console.log(ImageWidth);
    //console.log(ImageHeight);
    //console.log(startX);
    //console.log(startY);
    //console.log(realStartX);
    //console.log(realStartY);
    // console.log(width);
    // console.log(height);
    <?php
    echo "location.href = 'insert.php?ObjectName=' + obname + '&X=' + xx + '&Y=' + yy + '&width=' + width + '&height=' + height + '&r=' + r + '&name=" . $temp . "';"
    ?>

};



document.getElementById("New").onclick = function () {

    location.href = "GetBoundingBox.php"
};
</script> 

</body>
</html>
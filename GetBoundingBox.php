<html>
<head>

<link rel="stylesheet" href="css/new.css">
<script src="js/jquery.min.js"></script>
<script src="js/test.js"></script>

</head>

<body>

<?php
$file_name = array();
$file_handle = fopen("filename.txt", "rb");

while (!feof($file_handle) ) {

$line_of_text = fgets($file_handle);
$parts = explode('=', $line_of_text);

//print $parts[0] .  "<BR>";
array_push($file_name, $parts[0]);

}

$arrlength = count($file_name);

fclose($file_handle);
$temp = $file_name[array_rand($file_name)];

$temp_image_name = $_GET["name"];
if($temp_image_name != null){
    $temp = $temp_image_name;
}
$temp = basename($temp,"\n"); 
$information = $_GET["infor"];
$connection = $_GET["Connection"];
?>

 <input type="button" value ="-" onclick="zoomimage(0.9)"/>
<input type="button" value ="+" onclick="zoomimage(1.1)"/>

<div class="drawingArea" id="loading">
    <?php
    echo "<img id='zoomedimage' src='images/" . $temp . "' alt='mobile'>";
    ?> 
   <!--  <img id="zoomedimage" src="http://cf-wp-prod.sharethis.com/wp-content/uploads/2014/07/Its-Becoming-A-Mobile-World.jpg" alt="mobile"  >  -->
</div>
<canvas id="canvas" width="1000px" height="980px"></canvas>


<div class="coords">
    <h4>Step 1: Press the "-" or "+" button at the upper left corner to </h4>
    <h4>zoom in or out the image to make sure that the object has a suitable size.</h4>
    <h4>Step 2: Use mouse to rotate the image make sure that the object is straight up</h4>
    <h4>Step 3: Press the "Fetch Object" button, and draw bounding box of</h4>
    <h4> the object from upper left to the right botton</h4>
    <h4>Step 4: Enter the name of the object and press the confirm button to send the data to the database</h4>
    <?php
    echo "
    <h3>" . $information. "</h3>
    <h3>" . $connection . "</h3>"

    ?> 
    <p>Angle : <span id="angle"></span>
    </p>
    <p>X: <span class="fromX"></span>
    </p>
    <p>Y: <span class="fromY"></span>
    </p>
    <div>
    <p>W: <span class="width"></span>
    </p>
    <p>H: <span class="height"></span>
    <p>Zoom: <span class="zoom"></span>
     </p>



 <label>ObjectName <input type = "text" name = "ObjectName" id = "ObName" value = "" /></label> 
 <br>

<button id="anglebutton">Fetch Object</button>
<button id="reset">Reset</button>
<button id="confirm" class="float-left submit-button" >confirm</button>
<br >
<button id="New" class="float-left submit-button" >New Image</button>

</div>
<script type="text/javascript">
document.getElementById("confirm").onclick = function () {
    var obname = document.getElementById("ObName").value
    var zoomvalue = $(".zoom").html();
    if(zoomvalue == ""){
        zoomvalue = 0;
    }
    zoomvalue = parseInt(zoomvalue);

    if(r == undefined){
        r = 0;
    }
    //var ImageWidth = 400*(1+(parseInt(zoomvalue)/10));
    //var ImageHeight = ImageWidth;
    //var realStartX = Xcenter - ImageWidth/2;
    //var realStartY = Ycenter - ImageHeight/2;
    // var a_1 = Math.atan2((Ycenter - realStartY),(Xcenter - realStartX));

    // var r_a = (r/180)*Math.PI;
    // var a_2 = a_1 + r_a;
    // var l_1 = Math.sqrt(Math.pow(Ycenter - realStartY,2) + Math.pow(Xcenter - realStartX,2));
    // var xTrue = Xcenter - l_1*Math.cos(a_2);
    // var yTrue = Ycenter - l_1*Math.sin(a_2);
    // var l_2 = Math.sqrt(Math.pow(startX - xTrue,2) + Math.pow(startY - yTrue,2));
    // var a_3 = Math.atan2(startY - yTrue,startX - xTrue);
    // var a_4 = a_3 - r_a;
    // var xx = Math.floor(l_2*Math.sin(a_4));
    // var yy = Math.floor(l_2*Math.cos(a_4));
    
    //console.log(a_1);
    //console.log(r_a);
    //console.log(a_1);
    console.log(r);
    // console.log(xTrue);
    // console.log(yTrue);
    // console.log(l_1);

    //console.log(Xcenter);
    //console.log(Ycenter);
    //console.log(realWidth);
    //console.log(realHeight);
    console.log(zoomvalue);
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
    echo "location.href = 'insert.php?ObjectName=' + obname + '&X=' + startX + '&Y=' + startY + '&width=' + width + '&height=' + height + '&r=' + r + '&name=" . $temp . "';"
    ?>

};

document.getElementById("New").onclick = function () {

    location.href = "GetBoundingBox.php"
};
</script> 

</body>
</html>
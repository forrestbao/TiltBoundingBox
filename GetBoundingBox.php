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
     </p>

</div>

 <label>ObjectName <input type = "text" name = "ObjectName" id = "ObName" value = "" /></label> 
 <br>

<button id="anglebutton">Fetch Angle</button>
<button id="reset">Reset</button>
<button id="confirm" class="float-left submit-button" >confirm</button>

<script type="text/javascript">
document.getElementById("confirm").onclick = function () {
    var obname = document.getElementById("ObName").value
    // console.log(startX);
    // console.log(startY);
    // console.log(r);
    // console.log(width);
    // console.log(height);
    // console.log(obname);
    <?php
    echo "location.href = 'insert.php?ObjectName=' + obname + '&X=' + startX + '&Y=' + startY + '&width=' + width + '&height=' + height + '&r=' + r + '&name=" . $temp . "';"
    ?>
};
</script> 

</body>
</html>
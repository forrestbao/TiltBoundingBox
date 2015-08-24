
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <!--css and js file for image rotation-->
        <link rel="stylesheet" href="css/demo.css" media="screen">
        <link rel="stylesheet" href="css/demo-print.css"media="print">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/turbine.css">
        <script src="js/raphael.js"></script>
        <script src="js/propeller.js"></script>
        <!--css and js file for bounding box-->
        <link rel="stylesheet" type="text/css" href="css/imgareaselect-default.css" />
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery.imgareaselect.js"></script>    
        
        <!--applying the image rotation function-->
        <script>
            window.onload = function () {
                var src = document.getElementById("target").src,
                    angle = 0;
                document.getElementById("holder").innerHTML = "";
                var R = Raphael("holder", 640, 480);
                R.circle(320, 240, 200).attr({fill: "#000", "fill-opacity": .5, "stroke-width": 5});
                //var txt = R.text(100, 100, "print", r.getFont("Museo"), 30);
                var img = R.image(src, 160, 120, 320, 240);
                document.onkeydown = function(e) {
                    switch (e.keyCode) {
                        case 37:
                            angle -= 5;
                            angle = angle%360;
                            img.stop().animate({transform: "r" + angle}, 1000, "<>");
                            $('#angle').val(angle);
                            break;
                        case 38:
                            angle += 5;
                            angle = angle%360;
                            img.stop().animate({transform: "r" + angle}, 1000, "<>");
                            $('#angle').val(angle);
                            break;
                        case 39:
                            angle += 5;
                            angle = angle%360;
                            img.stop().animate({transform: "r" + angle}, 1000, "<>");
                            $('#angle').val(angle);
                            break;
                        case 40:
                            angle -= 5;
                            angle = angle%360;
                            img.stop().animate({transform: "r" + angle}, 1000, "<>");
                            $('#angle').val(angle);
                            break;
                    }
                };
                // setTimeout(function () {R.safari();});
                //$('#angle').val(angle);
            };
        </script>

    </head>
    <body>


        <!--upload the image-->
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
/*        for($x = 0; $x < $arrlength; $x++) {
        //    echo $file_name[$x];
            //echo "image/" . $file_name[$x];
            //echo "<br>";

            //echo "<img src = 'image/" . $file_name[$x] . "'>";
            break;
        }*/

        fclose($file_handle);
        $temp = $file_name[array_rand($file_name)];
        //$temp = basename($temp);
        
        //$temp = $file_name[1];
        $temp_image_name = $_GET["name"];
        if($temp_image_name != null){
            $temp = $temp_image_name;
        }
        $temp = basename($temp,"\n"); 
        ?>

<!--         <div id="holder">
            <img id="target" src="image/n02992529_108.JPEG" width="320" height="240" alt="Target">
        </div> -->
        


        <div id="holder">
            <?php
            
            echo "<img id='target' src='images/" . $temp . "' width='320' height='240' alt='Target'>";
            ?> 
        </div>

        <script>
            var degree = 0;
            new Propeller(document.getElementById('holder'), {
                inertia: 0.5,
                angle: 0,

                onRotate: function () {
                    console.log('onRotate');
                    //console.log(this.angle);
                    degree = this.angle;
                    $('#degree').val(degree);
                    //console.log(degree);
                }
                //console.log(degree);
            });
            //console.log(degree);
        // </script>

         <script type="text/javascript">
        // var x1,y1,w,h;
        // //var deg,xa,ya c_d,o_d, t_v; 
        // $(document).ready(function () {
            
        //     $('#holder').imgAreaSelect({
        //     handles: true,
        //     onSelectEnd: function (img, selection) {
                
        //         //for calculate the x,y coordinate referring to the upper-left corner of the image
        //         var deg = ($('#angle').val()/180)*Math.PI;
        //         var xa = selection.x1;
        //         var ya = selection.y1;
        //         var c_d = Math.atan2(240-ya,320-xa);
        //         var o_d = c_d - deg;
        //         var t_v = Math.sqrt(Math.pow(xa-320,2) + Math.pow(ya-240,2));
                
        //         //for test
        //         console.log(o_d);
        //         console.log(t_v);
        //         console.log(xa);
        //         console.log(ya);
        //         console.log(c_d);
        //         console.log(deg);
                 
        //         $('#x1').val(Math.round(160 - t_v*Math.cos(o_d)));
        //         $('#y1').val(Math.round(120 - t_v*Math.sin(o_d)));
        //         //$('#x1').val(selection.x1);
        //         //$('#y1').val(selection.y1);
        //         $('#w').val(selection.width);
        //         $('#h').val(selection.height);
        //         //console.log('left-upper coordinates is: ' + '( ' + x1 + ',' + y1 + ' ); ' + 'width: ' + w + '; height: ' + h); 
        //         }   
        //     });
        // });            
        // </script>

        <!-- Display the related data -->
        <button id="change_image" class="float-left submit-button" >Change Image</button> 
        <div id="text-format">
        <?php
        echo "
        <form action = 'image-boundingbox.php?name=" . $temp ."' method = 'post'>
        "
        ?>
       <!-- <label>
        <?php
        echo "ImageName <input type = 'text' name = 'ImageName' value ='" . $temp . "'/>"
        ?>
        </label>
        <br />-->
        <label>X1 <input type="text" size="4" id="x1" name="x1" /></label> <!-- x coordinate of the upper-left corner of the image -->
        <label>Y1 <input type="text" size="4" id="y1" name="y1" /></label> <!-- y coordinate of the upper-left corner of the image -->
        <br />
        <label>W <input type="text" size="4" id="w" name="w" /></label>  <!-- width of the bounding box -->
        <label>H <input type="text" size="4" id="h" name="h" /></label>  <!-- height of the bounding box -->
        <label>Deg <input type="text" size="4" id="degree" name="Deg" /></label> <!--rotation angle-->
        <br />
        <label>ObjectName <input type = "text" name = "ObjectName" value = "" /></label>
        <br />
        <label><button id="myButton" class="float-left submit-button" >confirm</button><label> 
        </form>

        </div>

<!--         <div id = "text-indicator-1"> Use Array Keys on the keyboard to rotate the image</div>

        <div id = "text-indicator-2">Left Rotation (down or left), Right Rotation (up or right)</div> -->

        
        <!--<script type="text/javascript">
            document.getElementById("myButton").onclick = function () {
                location.href = "image-rotation.php";
            };
        </script>-->
        <script type="text/javascript">
            document.getElementById("change_image").onclick = function () {
                location.href = "image-rotation.php";
            };
        </script> 
    </body>
</html>

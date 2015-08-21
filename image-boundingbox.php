
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
        <?php
           $degree = $_POST["Deg"];
           $imageName = $_POST["ImageName"];
        ?>
        <script>
            window.onload = function () {
                var src = document.getElementById("target").src,
                    angle = '<?php echo $degree; ?>';
                    $('#angle').val(angle);
                document.getElementById("holder").innerHTML = "";
                var R = Raphael("holder", 640, 480);
                R.circle(320, 240, 200).attr({fill: "#000", "fill-opacity": .5, "stroke-width": 5});
                //var txt = R.text(100, 100, "print", r.getFont("Museo"), 30);
                var img = R.image(src, 160, 120, 320, 240);
                img.stop().animate({transform: "r" + angle}, 1000, "<>");
/*                document.onkeydown = function(e) {
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
                };*/
                // setTimeout(function () {R.safari();});
                //$('#angle').val(angle);
            };
        </script>

    </head>
    <body>


<!--         <div id="holder">
            <img id="target" src="image/n02992529_108.JPEG" width="320" height="240" alt="Target">
        </div> -->

        <div id="holder">
            <?php
            
            echo "<img id='target' src='images/" . $imageName . "' width='320' height='240' alt='Target'>";
            ?> 
        </div>

        <script type="text/javascript">
        var x1,y1,w,h;
        //var deg,xa,ya c_d,o_d, t_v; 
        $(document).ready(function () {
            
            $('#holder').imgAreaSelect({
            handles: true,
            onSelectEnd: function (img, selection) {
                
                //for calculate the x,y coordinate referring to the upper-left corner of the image
                var deg = ($('#angle').val()/180)*Math.PI;
                var xa = selection.x1;
                var ya = selection.y1;
                var c_d = Math.atan2(240-ya,320-xa);
                var o_d = c_d - deg;
                var t_v = Math.sqrt(Math.pow(xa-320,2) + Math.pow(ya-240,2));
                
                //for test
                console.log(o_d);
                console.log(t_v);
                console.log(xa);
                console.log(ya);
                console.log(c_d);
                console.log(deg);
                 
                $('#x1').val(Math.round(160 - t_v*Math.cos(o_d)));
                $('#y1').val(Math.round(120 - t_v*Math.sin(o_d)));
                //$('#x1').val(selection.x1);
                //$('#y1').val(selection.y1);
                $('#w').val(selection.width);
                $('#h').val(selection.height);
                //console.log('left-upper coordinates is: ' + '( ' + x1 + ',' + y1 + ' ); ' + 'width: ' + w + '; height: ' + h); 
                }   
            });
        });            
        </script>

        <!-- Display the related data -->
        <div id="text-format">
        <form action = "insert.php" method = "post">
        <label>X1 <input type="text" size="4" id="x1" name="x1" /></label> <!-- x coordinate of the upper-left corner of the image -->
        <label>Y1 <input type="text" size="4" id="y1" name="y1" /></label> <!-- y coordinate of the upper-left corner of the image -->
        <br />
        <label>W <input type="text" size="4" id="w" name="w" /></label>  <!-- width of the bounding box -->
        <label>H <input type="text" size="4" id="h" name="h" /></label>  <!-- height of the bounding box -->
        <label>Deg <input type="text" size="4" id="angle" name="Deg" /></label> <!--rotation angle-->
        <br />
        <label>
        <?php
        echo "ImageName <input type = 'text' name = 'ImageName' value =" . $imageName . "/>";
        ?>
        <label>
        <br />
        <label>ObjectName <input type = "text" name = "ObjectName" value = "" /></label>
        <br />
        <label><input type = "submit" name = "submit"></label>
        </form>
        </div>

        <div id = "text-indicator-1"> Use Array Keys on the keyboard to rotate the image</div>

        <div id = "text-indicator-2">Left Rotation (down or left), Right Rotation (up or right)</div>
        
    </body>
</html>

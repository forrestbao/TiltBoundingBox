var zoomLevel = 100;
var maxZoomLevel = 105;
var minZoomLevel = 100;
var mouseIsDown = 0;
var canvas, context, startX, endX, startY, endY, r, width, height, Xcenter, Ycenter, ImageWidth, ImageHeight,realStartX, realStartY, zoomvalue, xx, yy, a_1, r_a;

function zoomimage(zm) {
    
    var zoomimg=document.getElementById("zoomedimage");
    if(zm > 1){
        if(zoomLevel < maxZoomLevel){
            zoomLevel++;
        }else{
            return;
        }
    }else if(zm < 1){
        if(zoomLevel > minZoomLevel){
            zoomLevel--;
        }else{
            return;
        }
    }
    wid = zoomimg.width;
    ht = zoomimg.height;
    zoomimg.style.width = (wid*zm)+"px";
    zoomimg.style.height = (ht*zm)+"px";

    $(".zoom").html(zoomLevel-100);
}

$(document).ready(function () {
   
    (function() {  /*the function is to rotate the object*/
        var rote=$("#zoomedimage");
        Xcenter = rote.offset().left + rote.width() / 2;
        rote.center_x = Xcenter;
                     /*this returns the center of object or image  taken in the x-direction,offset.left gives position from left and later gives midvalue of object*/
        Ycenter = rote.offset().top + rote.height() / 2             
        rote.center_y = Ycenter;
              /*this returns the center of object or image  taken in the y-direction,offset.top gives position from top and later gives midvalue of object*/  
        
        var offset, dragging=false;
        rote.mousedown(function(e) {
        e.preventDefault(); /*prevents default function of event from happening*/
        dragging = true;
        offset = Math.atan2(rote.center_y - e.pageY, e.pageX - rote.center_x);
        });/*binding an event handler and call function when that event occurs */
        

        $(document).mouseup(function(e) { 
           dragging = false
        });
        $(document).mousemove(function(e) {
            if (dragging) { 
                
            var newOffset = Math.atan2(rote.center_y - e.pageY, e.pageX - rote.center_x);
            r = (offset - newOffset) * 180 / Math.PI;
            
            rote.css('transform', 'rotate(' + r + 'deg)');
            console.log('Rotate: ' + r + 'deg');
              if (r < 0) {
                r = r + 360;
            }
             $("#angle").html(r + 'deg'); 
                  
            }
              
        }) 
        
        
        // ImageWidth = 400*(1+((100-100)/10));
        // ImageHeight = ImageWidth;
        // realStartX = Xcenter - ImageWidth/2;
        // realStartY = Ycenter - ImageHeight/2;
        // a_1 = Math.atan2((Ycenter - realStartY),(Xcenter - realStartX));
        // r_a = (r/180)*Math.PI;
        // var a_2 = a_1 + r_a;
        // var l_1 = Math.sqrt(Math.pow(Ycenter - realStartY,2) + Math.pow(Xcenter - realStartX,2));
        // var xTrue = Xcenter - l_1*Math.cos(a_2);
        // var yTrue = Ycenter - l_1*Math.sin(a_2);
        // var l_2 = Math.sqrt(Math.pow(startX - xTrue,2) + Math.pow(startY - yTrue,2));
        // var a_3 = Math.atan2(startY - yTrue,startX - xTrue);
        // var a_4 = a_3 - r_a;
        // xx = Math.floor(l_2*Math.sin(a_4));
        // yy = Math.floor(l_2*Math.cos(a_4));
        
        //startX = xx;
        //startY = yy;
          

    }());

    $("#anglebutton").click(function () {    
        $('canvas').css('z-index','+1');
        $('#loading').css('opacity','0.8');     
        $("#anglebutton").css('display','none');
        
    /*the below code is selection of bounding box and find its position,width,height*/

    mouseIsDown = 0;
 
    init();   

    });
    
    function init() {
        
        canvas = document.getElementById("canvas");
        context = canvas.getContext("2d");

        canvas.addEventListener("mousedown", mouseDown, false);
        canvas.addEventListener("mousemove", mouseXY, false);
        canvas.addEventListener("mouseup", mouseUp, false);
    
    }/*in init function we are adding event listeners mouseup,mousedown,mousemove and calling respective functions*/
  
    function mouseUp(eve) {  /*to find coordinates when we mouse up*/
        if (mouseIsDown !== 0) {
            mouseIsDown = 0;
            var pos = getMousePos(canvas, eve);
            endX = pos.x;
            endY = pos.y;
            
            if(endX>startX && endY>startY){
                drawSquare();
            }else{
                return null;
            }
           
            //update on mouse-up    
        }
    }

    function mouseDown(eve) { /*to find coordinates when we mouse down*/
        mouseIsDown = 1;
        var pos = getMousePos(canvas, eve);
        startX = endX = pos.x;
        startY = endY = pos.y;
        if(endX>startX && endY>startY){
            drawSquare(); 
        }else{
            return null;
        }
        
    }

    function mouseXY(eve) { /*to find coordinates when we move the mouse*/

        if (mouseIsDown !== 0) {
            var pos = getMousePos(canvas, eve);
            endX = pos.x;
            endY = pos.y;

            if(endX>startX && endY>startY){
                drawSquare();
            }else{
                return null;
            }
            
        }
    }


    
    function drawSquare() {   /*draw square using coordinates when we mouseup and mousedown */
        // creating a square
        var w = endX - startX;
        var h = endY - startY;
        $(".fromX").html(startX);
        $(".fromY").html(startY);
        
        var offsetX = (w < 0) ? w : 0;
        var offsetY = (h < 0) ? h : 0;
        width = Math.abs(w);
        height = Math.abs(h);

        context.clearRect(0, 0, canvas.width, canvas.height);

        context.beginPath();
        context.rect(startX + offsetX, startY + offsetY, width, height);
        context.lineWidth = 1;
        context.strokeStyle = 'black';
        context.stroke();
        $(".width").html(width);
        $(".height").html(height);

    }

    function getMousePos(canvas, evt) { /*this function provides the position of mouse*/
        var rect = canvas.getBoundingClientRect();
        
        return {
            x: evt.clientX - rect.left,
            
            y: evt.clientY - rect.top
            
        };
        
    }





    $("#reset").click(function(){
    	$('canvas').css('z-index','-1');
        $('#loading').css('opacity','1');     
        $("#anglebutton").show();
        
        $(".fromX").html("");
        $(".fromY").html("");
        $(".width").html("");
        $(".height").html("");
        
        var canvas,context;
      
        canvas = document.getElementById("canvas");
        context = canvas.getContext("2d");

        canvas.removeEventListener("mousedown", mouseDown, false);
        canvas.removeEventListener("mousemove", mouseXY, false);
        canvas.removeEventListener("mouseup", mouseUp, false);
        
        context.clearRect(0, 0, canvas.width, canvas.height);
    
    });


});
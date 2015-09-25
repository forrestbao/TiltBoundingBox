var zoomLevel = 100;
var maxZoomLevel = 105;
var minZoomLevel = 100;
var mouseIsDown = 0;
var canvas, context, startX, endX, startY, endY, r, width, height;

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
    
}
$(document).ready(function () {
   
    (function() {  /*the function is to rotate the object*/
       var rote=$("#zoomedimage");
      
     rote.center_x = rote.offset().left + rote.width() / 2;
                     /*this returns the center of object or image  taken in the x-direction,offset.left gives position from left and later gives midvalue of object*/
      rote.center_y = rote.offset().top + rote.height() / 2;
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
           
            drawSquare();
           
            //update on mouse-up
            
        }
    }

    function mouseDown(eve) { /*to find coordinates when we mouse down*/
        mouseIsDown = 1;
        var pos = getMousePos(canvas, eve);
        startX = endX = pos.x;
        startY = endY = pos.y;
            
            drawSquare(); 
        
    }

    function mouseXY(eve) { /*to find coordinates when we move the mouse*/

        if (mouseIsDown !== 0) {
            var pos = getMousePos(canvas, eve);
            endX = pos.x;
            endY = pos.y;
            drawSquare();
            
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
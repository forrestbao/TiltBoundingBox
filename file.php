<?php

/*$fp = fopen($file, 'w');
fwrite($fp, $content);
fclose($fp);*/
//chmod("filename.txt", 0744); 
$myfile = fopen("filename.txt", "w") or die("Unable to open file!");
$dir = "images";
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            //echo "filename: .".$file."<br />";
            if(strpos($file,"JPEG")){
                fwrite($myfile, "$file\n");
            }

        }
        closedir($dh);
    }
}
/*$txt = "John Doe\n";
fwrite($myfile, $txt);
$txt = "Jane Doe\n";
fwrite($myfile, $txt);
fclose($myfile);*/
?> 
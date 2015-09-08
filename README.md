
Steps to step up the LAMP (Linux, Apache, MySQL, PHP):

1. Worked with ubuntu 14.04.

2. Install apache, mysql, php, and related documents:<br>
  sudo apt-get update;<br>
  sudo apt-get install apache2;<br>
  sudo apt-get install php5;<br>
  sudo apt-get install mysql-server mysql-client;<br>
  sudo apt-get install libapache2-mod-php5;<br>
  sudo apt-get install php5-mysql;

3. Enter localhost on the web browser to test if it workd well.

4. We used phpmyadmin to help with building database<br>
   sudo apt-get install phpmyadmin<br>
  
   or apply sql to build the database<br>
   //image_data is the name of the database we use in the php file<br> 
   //Objects is the name opf the table we use in the php file<br> 
   //8 attributes: ID, object, image, upper_left_x, upper_left_y, height, width, angle<br>  
   create database image_data;<br>   
   use image_data;<br> 
   create table Objects(ID INI(11) UNSIGNED auto_increment primary key,
                        object varchar(25), 
                        image varchar(100), 
                        left_upper_x INI(11), 
                        left_upper_y INI(11),
                        height INI(11), 
                        width INI(11), 
                        angle INI(11));

5. Put images in a folder named "images" in current directory, and run the file.php. 
   Then, filename.txt should appear in the current directory with all the name of the images inside.

6. In connect.php, Enter the host name after $dbhost and password after $dbpass.

7. Run image-rotation.php

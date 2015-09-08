
Steps to step up the LAMP (Linux, Apache, MySQL, PHP):

1. Worked with ubuntu 14.04.

2. Install Apache, MySQL, PHP, and related documents:

~~~~  
  sudo apt-get update && sudo apt-get install apache2 php5 mysql-server mysql-client libapache2-mod-php5 php5-mysql phpmyadmin
~~~~

3. Enter localhost on the web browser to test if it workd well.

4. Use the following SQL command to create the database and a table in it: 
~~~~
   create database image_data;
   use image_data;
   create table Objects(ID INI(11) UNSIGNED auto_increment primary key,
                        object varchar(25), 
                        image varchar(100), 
                        left_upper_x INI(11), 
                        left_upper_y INI(11),
                        height INI(11), 
                        width INI(11), 
                        angle INI(11));
~~~~
where `image_data` is the name of the database, `Objects` is the name of the table, which has 8 attributes: `ID`, `object`, `image`, `upper_left_x`, `upper_left_y`, `height`, `width`, and `angle`. 

5. Put images in a folder named `images` in current directory, and run the `file.php`. 
   Then, `filename.txt` should appear in the current directory with all the name of the images inside.

6. In `connect.php`, Enter the host name after `$dbhost` and password after `$dbpass`.

7. Run `image-rotation.php`

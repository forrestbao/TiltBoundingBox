# TiltBoundingBox
The web front end for labeling objects in training dataset by tilting bounding boxes. 
Forget about upright traning samples! 

## License
Copyleft (C) 2015 Forrest Sheng Bao and YiChuan Zhao

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU Affero General Public License as
published by the Free Software Foundation, either version 3 of the
License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.


Steps to step up the LAMP (Linux, Apache, MySQL, PHP).
1.We worked with ubuntu 14.04, and the following steps works well for me.
2.install apache, mysql , php, and related documents:
  sudo apt-get update
  sudo apt-get install apache2
  sudo apt-get install php5 
  sudo apt-get install mysql-server mysql-client 
  sudo apt-get install libapache2-mod-php5  
  sudo apt-get install php5-mysql
3.Enter localhost on the web browser to test if it workd well.
4.We used phpmyadmin to help with building database
  sudo apt-get install phpmyadmin
5.We should build up the database with the help of phpmyadmin
  database name : image_data
  table name: Objects
6.8 attributes: ID, object, image, upper_left_x, upper_left_y, height, width, angle  
7.Then, run the image-rotation.php in TiltBoundingBox
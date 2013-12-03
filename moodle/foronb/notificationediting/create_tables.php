<?php

$con=mysql_connect("localhost", "vinod", "omegaman") or die(mysql_error());
mysql_select_db("onboard",$con) or die(mysql_error());


mysql_query("create table onb_details(
USN varchar(11) PRIMARY KEY,
 name varchar(30) not null, 
 semester int not null,
 email varchar(50) not null,
 mobile varchar(33),
 subscribed int default 0  )",$con)
 or die(mysql_error());  

 mysql_query("create table onb_notifications(
noti_id int PRIMARY KEY auto_increment,
 noti_date date not null, 
 notification varchar(200) not null,
 description text not null,
 file_name varchar(100) ,
 noti_type int not null)",$con)
 or die(mysql_error());  
 mysql_close();
echo "Tables Created!";

?> 

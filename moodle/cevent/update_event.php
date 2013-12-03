<?php
require_once("../config.php");
session_start();
$con=mysql_connect("localhost","$CFG->dbuser","$CFG->dbpass");
mysql_select_db("$CFG->dbname",$con);
$temp_id=$_SESSION['id'];
$temp_name="'".$_POST['ename']."'";
$temp_des="'".$_POST['description']."'";
$temp_day=$_POST['Day'];
$temp_month=$_POST['Month'];
$temp_year=$_POST['Year'];
$cur_date=time();
$date=$temp_day."-".$temp_month."-".$temp_year;
$timestamp=strtotime($date);
echo $timestamp;

mysql_query("UPDATE onb_event SET name=$temp_name WHERE id=$temp_id");
mysql_query("UPDATE onb_event SET description=$temp_des WHERE id=$temp_id");
mysql_query("UPDATE onb_event SET timestart=$timestamp WHERE id=$temp_id");
mysql_query("UPDATE onb_event SET timemodified=$curr_date WHERE id=$temp_id");
mysql_close($con);

header("location:$CFG->wwwroot");

?>

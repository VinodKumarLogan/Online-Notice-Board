<html>
<?php
require_once("../../config.php");
session_start();
$con=mysql_connect("localhost", "$CFG->dbuser", "$CFG->dbpass") or die(mysql_error());
mysql_select_db("$CFG->dbname",$con) or die(mysql_error());
$result = mysql_query ("SELECT noti_id FROM onb_notifications"); 
if($_POST['mod']!=10)
{

    //echo "In mod_noti.php";
    while($row=mysql_fetch_array($result))
    	if($row['noti_id']==$_POST['mod'])
    	{
      		$_SESSION['id']=$_POST['mod'];
		//echo "Before echoing";
      		require("modify.php");
    	}
}
else
	header("location:$CFG->wwwroot");
//mysql_close($con);
?>
</html>

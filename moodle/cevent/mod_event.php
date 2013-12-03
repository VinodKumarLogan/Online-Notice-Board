<html>
<?php
require_once("../config.php");
session_start();
$con=mysql_connect("localhost", "$CFG->dbuser", "$CFG->dbpass") or die(mysql_error());
mysql_select_db("$CFG->dbname",$con) or die(mysql_error());
$result = mysql_query ("SELECT id FROM onb_event"); 
if($_POST['mod']!=10)
{

    while($row=mysql_fetch_array($result))
    if($row['id']==$_POST['mod'])
    {
      $_SESSION['id']=$_POST['mod'];
      require("modify_selection.php");
    }
}
else
{
   	//echo "Redirect";
	header("location:$CFG->wwwroot");
}
//mysql_close($con);
?>
</html>
 

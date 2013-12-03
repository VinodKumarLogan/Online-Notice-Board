
<html>
<?php
require_once("../config.php");                         

$con=mysql_connect("localhost", "$CFG->dbuser", "$CFG->dbpass") or die(mysql_error());
mysql_select_db("$CFG->dbname",$con) or die(mysql_error());

$result=mysql_query("SELECT USN FROM onb_details");    

while($row=mysql_fetch_array($result))
{
  $temp_id=$row['USN'];  
  if(isset($_POST[$temp_id]))
      {
	        echo $_POST[$temp_id];
		mysql_query("DELETE FROM onb_details WHERE USN='$temp_id'");
		mysql_query("DELETE FROM onb_user WHERE username='$temp_id'"); 
      }

}     
mysql_close($con);
header( "location:$CFG->wwwroot" ) ;


  ?> 
</html> 
 

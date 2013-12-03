
<html>
<?php
require_once("../../config.php");                         

$con=mysql_connect("localhost", "$CFG->dbuser", "$CFG->dbpass") or die(mysql_error());
mysql_select_db("$CFG->dbname",$con) or die(mysql_error());
function tableExists($tablename, $database = false) {

    if(!$database) {
        $res = mysql_query("SELECT DATABASE()");
        $database = mysql_result($res, 0);
    }

    $res = mysql_query("
        SELECT COUNT(*) AS count 
        FROM information_schema.tables 
        WHERE table_schema = '$database' 
        AND table_name = '$tablename'
    ");

    return mysql_result($res, 0) == 1;

}
if(tableExists('onb_tempdelete'))
  mysql_query("delete from onb_tempdelete");
else  
  mysql_query("create table onb_tempdelete (Id int primary key)");

$result=mysql_query("SELECT noti_id,file_name FROM onb_notifications");    

while($row=mysql_fetch_array($result))
{
  $temp_id=$row['noti_id'];
 if(isset($_POST[$temp_id]))
      {
	    $res=mysql_query("SELECT * FROM onb_tempdelete WHERE $temp_id=Id");
	    if(!mysql_fetch_array($res))
	    {
	        mysql_query("INSERT INTO onb_tempdelete VALUES ($temp_id)"); 
		$temp_file=$row['file_name'];
		if($temp_file!="")
			if(file_exists("uploadedfiles/$temp_file"))
			{
				unlink("uploadedfiles/$temp_file");
				echo "File Deleted";
			}
	    }
      }

}     
mysql_query("DELETE FROM onb_notifications WHERE noti_id IN
		  (SELECT Id FROM onb_tempdelete)");
mysql_close($con);
header( "location:$CFG->wwwroot" ) ;
  ?> 
</html> 

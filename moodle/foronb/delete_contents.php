<?php

    require_once('../config.php');
    require_once($CFG->dirroot.'/course/lib.php');
    require_once($CFG->libdir.'/filelib.php');

                             
                     
                              $admins = get_admins();
                              $isadmin = false;
                              foreach ($admins as $admin)
                              { 
                                
                                //echo $admin->id;
                              if ($USER->id == $admin->id)
                              {
                             $isadmin = true;
                              break;
                              }
                               }
                             if($isadmin)
                             {
$con=mysql_connect("localhost", "$CFG->dbuser", "$CFG->dbpass") or die(mysql_error());
mysql_select_db("$CFG->dbname",$con) or die(mysql_error());
$result=mysql_query("SELECT file_name FROM onb_notifications");
while($res=mysql_fetch_array($result))
{
	$temp_file=$row["file_name"];
	if(is_file($temp_file))
		unlink("/notificationediting/uploadedfiles/$temp_file");
}
mysql_query ("DELETE FROM onb_notifications");
mysql_query ("DELETE FROM onb_details");
mysql_query ("DELETE FROM onb_user WHERE secret!=NULL");
mysql_close($con);      
header("location:$CFG->wwwroot");
}
else
  echo "Access Denied";
?> 

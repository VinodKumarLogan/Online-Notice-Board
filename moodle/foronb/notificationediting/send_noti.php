<?php
    require_once('../../config.php');
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
  session_start();
  global $addrs;
  $temp_file="'"."'";

if(is_uploaded_file($_FILES['file']['tmp_name'])) 
{
echo "File uploaded\n";
 $target_path = "uploadedfiles/";
$temp_file="'".$_FILES['file']['name']."'";
$target_path = $target_path.basename( $_FILES['file']['name']); 
if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
    echo "The file ".  basename( $_FILES['file']['name']). 
    " has been uploaded";
} else{
    echo "There was an error uploading the file, please try again!";
}
} 
  echo "This notification will be sent to the following mobile numbers<br/>";
  $type_sem=0;
  if($_POST['noti_type']!="public")
  {
    $type_sem=$_POST['sem'];
  }
  $_SESSION['notification']=$notif=$_POST['notification'];
  $_SESSION['noti_type']=$type_sem;
  $semester=$type_sem;
  $temp_noti="'".$notif."'";
  $temp_desc="'".$_POST['description']."'";
  echo "</br>".$semester;
  $con=mysql_connect("localhost","$CFG->dbuser","$CFG->dbpass") or die(mysql_error());
  mysql_select_db("$CFG->dbname",$con) or die(mysql_error());
  
   $temp_date=time();
   $temp_uploader="'".$USER->username."'";
   //echo $temp_uploader;
   mysql_query("INSERT INTO onb_notifications (noti_date,notification,description,file_name,noti_type,uploader) VALUES ($temp_date,$temp_noti,$temp_desc,$temp_file,$semester,$temp_uploader)") or die(mysql_error());
    echo "Notice Successfully Added";
    $body ="Notification Alert </br>".$_SESSION['notification']."Please visit Online Notice Board for further details. Uploaded by ".$temp_uploader." Thank You.";
$type =$_SESSION['noti_type'];
$txtwebmessage = '<html><head><meta name="txtweb-appkey" content="f13836b1-eefd-4756-9ce0-7c8e7dc16019" /></head><body>'.$body.'</body></html>';

$result=mysql_query("SELECT mobile FROM onb_details WHERE ($type=semester OR $type=0 OR $type=9) AND subscribed=1") or die(mysql_error());

while($row=mysql_fetch_array($result))
{
$fields = array(
"txtweb-mobile"=>$row['mobile'],
"txtweb-pubkey"=>"5d9915b6-6e63-418c-b618-5d95e5401e62",
"txtweb-message"=>$txtwebmessage,
);
$url="api.txtweb.com/v1/push";
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_POST,count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($fields));
$str = curl_exec($ch);
curl_close($ch);
}
mysql_close($con);
  
header( "location: $CFG->wwwroot") ;
}
else
  echo "Access Denied";
?>

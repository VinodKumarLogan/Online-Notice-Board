<html>
<?php
require_once("../../config.php");
session_start();
$con=mysql_connect("localhost", "$CFG->dbuser", "$CFG->dbpass") or die(mysql_error());
mysql_select_db("$CFG->dbname",$con) or die(mysql_error());
$temp_id=$_SESSION['id'];
$temp_date=time();
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


if($_POST['noti_type']=='public')
  $temp_type=0;
else
  $temp_type=$_POST['sem'];

$temp_noti="'".$_POST['notification']."'";
$temp_desc="'".$_POST['description']."'";
mysql_query ("UPDATE onb_notifications SET noti_date=$temp_date WHERE $temp_id=noti_id") or die(mysql_error());
mysql_query ("UPDATE onb_notifications SET notification=$temp_noti WHERE $temp_id=noti_id") or die(mysql_error());
mysql_query ("UPDATE onb_notifications SET description=$temp_desc WHERE $temp_id=noti_id") or die(mysql_error());
mysql_query ("UPDATE onb_notifications SET noti_type=$temp_type WHERE noti_id=$temp_id") or die(mysql_error());
mysql_query ("UPDATE onb_notifications SET file_name=$temp_file WHERE noti_id=$temp_id") or die(mysql_error());
$result=mysql_query("SELECT mobile FROM onb_details WHERE ($temp_type=semester OR $temp_type=0 OR $temp_type=9) AND subscribed=1") or die(mysql_error());

$body ="Notification Alert </br>".$_SESSION['notification']."Please visit Online Notice Board for further details. Thank You.";
$type =$_SESSION['noti_type'];
$txtwebmessage = '<html><head><meta name="txtweb-appkey" content="f13836b1-eefd-4756-9ce0-7c8e7dc16019" /></head><body>'.$body.'</body></html>';

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
header("location:$CFG->wwwroot");
?>
</html> 

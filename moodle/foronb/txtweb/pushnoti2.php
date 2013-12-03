<?php 

$body =$_SESSION['notification'];
$type =$_SESSION['type_sem'];
$txtwebmessage = '<html><head><meta name="txtweb-appkey" content="f13836b1-eefd-4756-9ce0-7c8e7dc16019" /></head><body>'.$body.'</body></html>';
$con=mysql_connect("localhost","sandeepr_onb","linuxroot") or die(mysql_error());
mysql_select_db("sandeepr_aju",$con) or die(mysql_error());
$result=mysql_query("SELECT mobile FROM onb_details WHERE ($type=semester OR $type=0 OR $type=9) AND subscribed=1") or die(mysql_error());

while($row=mysql_fetch_array($result))
{
$fields = array(
"txtweb-mobile"=>"'".$row['mobile']."'",
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

echo $str;

}
mysql_close($con);
?>
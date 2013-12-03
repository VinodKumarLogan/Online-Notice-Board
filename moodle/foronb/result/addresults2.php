
<?php
require("../../config.php");                                                                                                 require_once 'reader.php';
// ExcelFile($filename, $encoding);
$data = new Spreadsheet_Excel_Reader();


// Set output Encoding.
$data->setOutputEncoding('CP1251');

/***
* if you want you can change 'iconv' to mb_convert_encoding:
* $data->setUTFEncoder('mb');
*
["file"]["type"]

/***
* By default rows & cols indeces start with 1
* For change initial index use:
* $data->setRowColOffset(0);
*
**/



/***
*  Some function for formatting output.
* $data->setDefaultFormat('%.2f');
* setDefaultFormat - set format for columns with unknown formatting
*
* $data->setColumnFormat(4, '%.3f');
* setColumnFormat - set format for column (apply only to number fields)
*
**/

$data->read($_FILES["file"]["name"]);

/*


 $data->sheets[0]['numRows'] - count rows
 $data->sheets[0]['numCols'] - count columns
 $data->sheets[0]['cells'][$i][$j] - data from $i-row $j-column

 $data->sheets[0]['cellsInfo'][$i][$j] - extended info about cell
    
    $data->sheets[0]['cellsInfo'][$i][$j]['type'] = "date" | "number" | "unknown"
        if 'type' == "unknown" - use 'raw' value, because  cell contain value with format '0.00';
    $data->sheets[0]['cellsInfo'][$i][$j]['raw'] = value if cell without format 
    $data->sheets[0]['cellsInfo'][$i][$j]['colspan'] 
    $data->sheets[0]['cellsInfo'][$i][$j]['rowspan'] 
*/

error_reporting(E_ALL & ~E_NOTICE);

$nr = $data->sheets[0]['numRows'];
$nc = $data->sheets[0]['numCols'];
 
for ($i = 1; $i <= $nr; $i++) {
	for ($j = 1; $j <= $nc; $j++) 
		$a1[$i][$j] = $data->sheets[0]['cells'][$i][$j];
	
}

$con = mysql_connect("localhost","$CFG->dbuser","$CFG->dbpass") or die(mysql_error());
mysql_select_db("$CFG->dbname",$con) or die(mysql_error());
mysql_query("drop table onb_results");
$sql = "create table onb_results (USN varchar(11) primary key,sgpa real NOT NULL)";
mysql_query($sql) or die(mysql_error()); 
for($i=1;$i<$nr;$i++)
  for($j=1;$j<$nc;$j++)
    if($data->sheets[0]['cells'][$i][$j]=="USN")
    {
      $temp_i=$i;
      $temp_j=$j;
      break;
    }
for($i=$temp_j;$i<=$nc;$i++)
	if($data->sheets[0]['cells'][$temp_i][$i]=="SGPA")
	{
		$k=$i;
		echo $k." ";
		break;
	}
$i=$temp_i+1;
$j=$temp_j;
echo $i." ".$j; 
	for(;$i<=$nr;$i++)
	  {
	  $d1="'".$data->sheets[0]['cells'][$i][$j]."'"; 
	$d2=$data->sheets[0]['cells'][$i][$k];
	echo "\n".$d1." ".$d2;
	  mysql_query("insert into onb_results values ($d1,$d2)")or die(mysql_error());
}
$result=mysql_query("SELECT d.USN,d.semester,d.mobile,r.sgpa FROM onb_details d , onb_results r WHERE d.USN IN (SELECT USN FROM onb_results) AND d.subscribed=1") or die(mysql_error());

while($row=mysql_fetch_array($result))
{
$body="</br>Semester ".$row['semester']." results have been announced </br>USN : ".$row['USN']."</br>SGPA : ".$row['sgpa']."</br>";
$txtwebmessage = '<html><head><meta name="txtweb-appkey" content="f13836b1-eefd-4756-9ce0-7c8e7dc16019" /></head><body>'.$body.'</body></html>';
//echo $body;
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

//echo $str;
}
mysql_query("drop table onb_results");
mysql_close($con);

header("location:$CFG->wwwroot");
?>

</body>
</html>

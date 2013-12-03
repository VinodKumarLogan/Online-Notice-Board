
<?php

if ($_FILES["file"]["error"] > 0)
  {
  echo "Error: " . $_FILES["file"]["error"] . "<br />";
  }
else
  {
  echo "Upload: " . $_FILES["file"]["name"] . "<br />";
  echo "Type: " . $_FILES["file"]["type"] . "<br />";
  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
  echo "Stored in: " . $_FILES["file"]["tmp_name"];
  if($_FILES["file"]["type"] != 'application/vnd.ms-excel')
	{
		echo "\n";
		exit ("Error!!You can only upload an Excel file.");
	}      

 move_uploaded_file($_FILES["file"]["tmp_name"], $_FILES["file"]["name"]) or die ('error');
        
 }
                                                                                                                                                                                                                                                                                                                                                                                                                                                
require_once 'reader.php';


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

$con = mysql_connect("localhost","onb","linuxroot") or die(mysql_error());
mysql_select_db("sandeepr_aju",$con) or die(mysql_error());
$sql = "create table results (USN varchar(11),sgpa real NOT NULL)";
mysql_query($sql,$con) or die(mysql_error()); 
//mysql_close();
$a = "insert into results (USN,sgpa) values (";


for($i=1; $i<=$nr;$i++){
	$s = $a;
	for($j=1;$j<=$nc;$j++){
		//echo "\"".$a1[$i][$j]."\",";
		if($j == 2){
		$s = $s.$a1[$i][$j];
		break;
		}
		else
		$s = $s."'". $a1[$i][$j]."'".",";
	}
	$s = $s.")";
	echo $s;
	mysql_query($s,$con) or die(mysql_error());
	echo "\n";
}
mysql_close();

//print_r($data);
//print_r($data->formatRecords);
?>

</body>
</html>

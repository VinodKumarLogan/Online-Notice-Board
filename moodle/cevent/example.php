<?php
// Test CVS
require_once("../config.php");
require_once 'reader.php';


// ExcelFile($filename, $encoding);
$data = new Spreadsheet_Excel_Reader();


// Set output Encoding.
$data->setOutputEncoding('CP1251');


 //if you want you can change 'iconv' to mb_convert_encoding:
//$data->setUTFEncoder('mb');
/*
**/

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

$data->read($addrs->path);

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
$con =  mysql_connect("localhost", "$CFG->dbuser", "$CFG->dbpass") or die(mysql_error());
mysql_select_db("$CFG->dbname",$con) or die(mysql_error());
//error_reporting(E_ALL ^ E_NOTICE);

for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) 
{ 
   $date="hi";
   $event="hello";
   $desc="there";
   for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) 
   {
    //	echo "".$data->sheets[0]['cells'][$i][$j]."";
    
    if($j==1)
     $date=$data->sheets[0]['cells'][$i][$j];
    else if($j==2) 
          $event=$data->sheets[0]['cells'][$i][$j];
         else
            $desc=$data->sheets[0]['cells'][$i][$j];     
   }
      $timestamp = strtotime($date);
      $curr=time();
       echo "".$date."  ".$event."  ".$desc."  ".$timestamp."";
       echo "\n";
        mysql_query("INSERT INTO onb_event (`name`,`description`,`format`,`courseid`,`groupid`,`userid`,`repeatid`,`modulename`,`instance`,`eventtype`,`timestart`,`timeduration`,`visible`,`sequence`,`timemodified`) VALUES ('$event', '$desc', 1, 1, 0, 2, 0, 0, 0, 'site', '$timestamp', 0, 1, 1, '$curr' )") or die(mysql_error());
      
}

header("location:$CFG->wwwroot");
//dprint_r($data);
//print_r($data->formatRecords);
?>

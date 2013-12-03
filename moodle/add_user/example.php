<?php
// Test CVS

require_once 'reader.php';
require_once "php/Mail.php";

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

$data->read($_FILES["file"]["tmp_name"]);

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

function hash_internal_user_password($password) {
    global $CFG;
    $CFG->passwordsaltmain = 'U]EU@Q?r5 ,EuQ/n3`*+{/UYk';
     return md5($password.$CFG->passwordsaltmain);
    }
$con = mysql_connect("localhost","dbuser","dbpass") or die ("mysql_error()");
   mysql_select_db("onb",$con) or die ("unable to select");  
/*$con = mysql_connect("$CFG->dbhost","$CFG->dbuser","$CFG->dbpass") or die ("mysql_error()");
   mysql_select_db("$CFG->dbname",$con) or die ("unable to select");*/
//error_reporting(E_ALL ^ E_NOTICE);

mysql_query("CREATE TABLE IF NOT EXISTS onb_details(
    USN varchar(11) PRIMARY KEY,
    name varchar(30) not null, 
    semester int not null,
    email varchar(50) not null,
    mobile varchar(33),
    subscribed int default 0  )",$con) or die(mysql_error());

$host = "ssl://smtp.gmail.com";        // Authentication for email id,
        $port = "465";
        $username = "onbpesit@gmail.com";
        $onbpass = "@moodleONB1";
        $from = "onbpesit@gmail.com";

        $subject = "Hi! Your Online Notice Board account registration details are : ";
        $bodystart = "Your Username for ONB is : ";
        $bodymiddle="\nYour Password is: ";
        $bodyend = "\nPlease change your password after your first login.\nSend a text message via your mobile to 9243342000 having the following content ' @onbreg <your username> <your password> ', to subscribe to notification alert.\n\n\tWith Regards , \n\tONB Team.";


for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) 
{ 
   $usn="null";
   $name="null";
   $sem="null";
   $email="null";
   for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) 
   {
    //	echo "".$data->sheets[0]['cells'][$i][$j]."";
    
    if($j==1)
     $usn=$data->sheets[0]['cells'][$i][$j];
    else if($j==2) 
          $name=$data->sheets[0]['cells'][$i][$j];
         else if($j==3)
              $sem=$data->sheets[0]['cells'][$i][$j];    
              else
               $email=$data->sheets[0]['cells'][$i][$j]; 
   }
   $tmp_pass=rand();
   $password=hash_internal_user_password($tmp_pass);
   $usr=strtolower($usn);
  // echo "name: ".$usr." pass: ".$tmp_pass."\n";
   
   mysql_query("INSERT INTO onb_details(USN,name,semester,email) VALUES('$usr','$name','$sem','$email')",$con) or die(mysql_error());
  
   $to = "$email";
        //echo $to;
        $body ="Hello ".$name."\n".$bodystart.$usr.$bodymiddle.$tmp_pass.$bodyend;

        $headers = array ('From' => $from,
          'To' => $to,
          'Subject' => $subject);
        $smtp = Mail::factory('smtp',
          array ('host' => $host,
            'port' => $port,
            'auth' => true,
            'username' => $username,
            'password' => $onbpass));

        $mail = $smtp->send($to, $headers, $body);

        if (PEAR::isError($mail)) {
          echo($mail->getMessage());
         } else {
          echo("Message successfully sent!");
         }
   mysql_query("INSERT INTO onb_user(confirmed,mnethostid,username,password,firstname,lastname,email) VALUES (1,1,'$usn','$password','$name',' ','$email')",$con) or die(mysql_error());
  header("location:$CFG->wwwroot");    
}

?>

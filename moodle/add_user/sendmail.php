<?php 

       include "uploader.php"; 
       //require_once "/usr/share/php/Mail.php";
       
/*	$con = mysql_connect("localhost","root","ssklenovo") or die(mysql_error());
        mysql_select_db("onb",$con) or die(mysql_error());
        //$s = "drop table usnpsw";
        //mysql_query($s,$con) or die(mysql_error()) ;
        $sql = "create table usnpsw (USN varchar(11),pass int NOT NULL,FOREIGN KEY (USN) REFERENCES onb_details(USN))";
        mysql_query($sql,$con) or die(mysql_error());
        $sql2 = "insert into usnpsw (USN,pass) VALUES (";
        $result = mysql_query("SELECT * FROM onb_details", $con);
        $numRows = mysql_num_rows($result);

        $j=1;
        while ($row = mysql_fetch_object($result)) {
		$emailarr[$j] = $row->email;
                $usnarr[$j] = $row->USN;
		$namearr[$j] = $row->name;
		$j++;
        }
        for($i=1;$i<$j;$i++)
        { 
                $a = $sql2;
		$tmpass = rand();
                mysql_query($a.'\''.$usnarr[$i].'\''.','.$tmpass.')',$con);
		$passarr[$i] = $tmpass;
		$passarr2[$i] = hash_internal_user_password($tmpass); 
                echo $a.'\''.$usnarr[$i].'\''.','.$tmpass.')';
                echo "\n".$passarr2[$i]."\n";

        }

	function hash_internal_user_password($password) {
    		global $CFG;
    		$CFG->passwordsaltmain = '7.x^dK~%:a1Q+X[_rzPLm@V0=a';
     		return md5($password.$CFG->passwordsaltmain);
    	}
	for($i=1;$i<$j;$i++)
	{
	mysql_query("DELETE FROM onb1user WHERE username='$usnarr[$i]'")or die(mysql_error());
 	mysql_query("INSERT INTO onb1user(confirmed,mnethostid,username,password,firstname,lastname,email,city) VALUES (1,1,'$usnarr[$i]','$passarr2[$i]','$namearr[$i]',' ','$emailarr[$i]','bangalore')") or die(mysql_error()); 

//	echo "INSERT INTO onb1user(confirmed,mnethostid,username,password,firstname,lastname,email,city) VALUES (1,1,'$usnarr[$i]','$passarr2[$i]','$namearr[$i]',' ','$emailarr[$i]','bangalore')";

	}

	$host = "ssl://smtp.gmail.com";
        $port = "465";
        $username = "onbpesit@gmail.com";
        $password = "@moodleONB1";
	$from = "onbpesit@gmail.com";
       
        $subject = "Hi!";
	$bodystart = "Your Password for ONB is : ";
	$bodyend = "\nPlease change your password after your first login.\n\n\tWith Regards , \n\tONB Team.";

//	for($i=1;$i<$j;$i++)
//	{	
       	
        $to = "s.kanchan1992@gmail.com";
	echo $to;
        $body = rand()%;

        $headers = array ('From' => $from,
          'To' => $to,
          'Subject' => $subject);
        $smtp = Mail::factory('smtp',
          array ('host' => $host,
            'port' => $port,
            'auth' => true,
            'username' => $username,
            'password' => $password));

        $mail = $smtp->send($to, $headers, $body);

        if (PEAR::isError($mail)) {
          echo($mail->getMessage());
         } else {
          echo("Message successfully sent!");
         }
//   }
	//$s = "drop table usnpsw";
        //mysql_query($s,$con) or die(mysql_error()) ;
*/ 
echo "\n All finished ";
?>  

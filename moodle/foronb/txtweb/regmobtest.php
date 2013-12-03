 <html>
    <head>
    <title> Testing </title>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
 
    <meta name='txtweb-appkey' content='f13836b1-eefd-4756-9ce0-7c8e7dc16019' />

    </head>
    <body>
    <?php
            require_once("../../config.php");
	    $con=mysql_connect("localhost","$CFG->dbuser","$CFG->dbpass") or die(mysql_error());
            mysql_select_db("$CFG->dbname",$con) or die(mysql_error());
            $str=$_GET['txtweb-message'];
            $mob=$_GET['txtweb-mobile'];
            if($str!="UNSUBSCRIBE")
	    {
	      $str=trim($str);
	      if(strpbrk($str," ") && substr_count($str," ")==1)
	      {
		$divisions = explode(" ", $str);
		$uname= "'".$divisions[0]."'"; 
		$pass= md5($divisions[1]."U]EU@Q?r5 ,EuQ/n3`*+{/UYk");
		$result=mysql_query("SELECT password FROM onb_user WHERE username=$uname",$con) or die(mysql_error());
		$row=mysql_fetch_array($result);
		if($row!=FALSE)
		{
		  $temp="'".$mob."'";
		  if($pass==$row['password'])
		  {
		    mysql_query("UPDATE onb_details SET subscribed=1 WHERE $uname=USN ",$con);
		    mysql_query("UPDATE onb_details SET mobile=$temp WHERE $uname=USN ",$con);
		    echo "Thank You for registering to Online Notice Board     Reply UNSUBSCRIBE to @onbreg to stop this service";
		  }
		  else
		    echo "Wrong Password";
		}
		else
		  echo "Invalid Username/Password";
	      }
	      else
		echo "Invalid Input";
	   }
	    else
	    {
	      $temp_mob="'".$_GET['txtweb-mobile']."'";
	      mysql_query("UPDATE onb_details SET subscribed=0 WHERE mobile=$temp_mob ",$con);
	      echo "Thank You for using this service.   You have successfully unsubscribed";
	    }           
	  mysql_close($con);
    ?>
    </body>
    </html> 

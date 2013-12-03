<html>
 <head>
 </head>
 <body>
   <?php
   //  require_once("/var/www/lib/moodlelib.php");
  // Make a MySQL Connection
 $conn = mysql_connect("localhost", "root", "ssklenovo") or die(mysql_error());
  mysql_select_db("onb",$conn) or die(mysql_error());
   echo "connected";
  $result=mysql_query("SELECT * FROM onb_user ",$conn) or die(mysql_error());
 while( $row=mysql_fetch_array($result)){
  echo '<br/>';
  print $row['password'];
  
  }
  echo '<br/>';
  echo "hai";
  $pass=hash_internal_user_password('@superalien10SSK');
  echo "password:";
   
 ?>
 </body>
</html>

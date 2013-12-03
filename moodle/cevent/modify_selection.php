<?php
    require_once('../config.php');
    require_once($CFG->dirroot.'/course/lib.php');
    require_once($CFG->libdir.'/filelib.php');
?>
<html>
<script>
function validateForm()
{
var x=document.forms["input"]["name"].value;
if (x==null || x=="")
  {
  alert("Name of the event must be filled");
  return false;
  }
  else
    alert("Event Updated and Published");
}
</script>
<head>
<?php
echo <<<disp
<link rel="stylesheet" type="text/css" href="$CFG->wwwroot/theme/boxxie/style/core.css" />
disp;
?>
<style type="text/css">
div.adduser{
            width:100%;
            height:auto;
            border:2px solid black;
            background:silver;
           }
img.pes_logo{
            padding:20px;
            position:absolute;
            
            left:50%;
            margin-left:-125px;
            width:250px;
            height:90px;

            }
input.button
{
border-top: 1px solid #96d1f8;
    background: #0A84FF;
   background: -webkit-gradient(linear, left top, left bottom, from(#B43104), to(#1C1C1C));
   background: -webkit-linear-gradient(top, #419AFB, #7EA3FF);
   background: -moz-linear-gradient(top, #419AFB, #7EA3FF);
   background: -ms-linear-gradient(top, #419AFB, #7EA3FF);
   background: -o-linear-gradient(top, #419AFB, #7EA3FF);
   padding: 1px 10px;
   -webkit-border-radius: 8px;
   -moz-border-radius: 8px;
   border-radius: 8px;
   -webkit-box-shadow: rgba(0,0,0,1) 0 1px 0;
   -moz-box-shadow: rgba(0,0,0,1) 0 1px 0;
   box-shadow: rgba(0,0,0,1) 0 1px 0;
   text-shadow: rgba(0,0,0,.4) 0 1px 0;
   color: white;
   font-size: 14px;
   font-family: Georgia, serif;
   text-decoration: none;
   vertical-align: middle;
}
</style>
</head>
<body>

<div id="page-wrapper">
  <div id="page" class="clearfix">
    <div id="page-header" class="clearfix">
      
<?php  
echo <<<disp
<img src="$CFG->wwwroot/pes_img/newlogo.png" /><a title="Go to pes home" href="http://pes.edu" ><img class="pes_logo" src="$CFG->wwwroot/pes_img/pesit-logo.png" /></a>
disp;
?>
        <div class="headermenu">
        </div>
      </div>
    <div id="page-content">
        <div id="region-main-box">
            <div id="region-post-box">
                 <div id="region-main-wrap">
                    <div id="region-main">
                        <div class="region-content">
                           <?php echo '<h3  align="middle" style="font-family:calibre; font-size:18; padding:0px; color:#2E2E2E " >EVENT EDITOR</h3><br/>' ?>
                           
                           <div class="adduser">
<?php
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

require_once('../config.php');
$con=mysql_connect("localhost", "$CFG->dbuser", "$CFG->dbpass") or die(mysql_error());
mysql_select_db("$CFG->dbname",$con) or die(mysql_error());
session_start();
$temp_id=$_SESSION['id'];  
$result = mysql_query ("SELECT id,name,timestart,description FROM onb_event WHERE $temp_id=id");
$row=mysql_fetch_array($result);

        $_SESSION['id']=$temp_id=$row['id'];
	$temp_name=$row['name'];
	$temp_des=$row['description'];
	$temp_day=intval(date("d",($row['timestart'])));
	$temp_month=intval(date("m",($row['timestart'])));
	$temp_year=intval(date("Y",($row['timestart'])));
	
mysql_close($con);      

echo <<<disp
<form name="input" action="update_event.php" method="post" onsubmit="return validateForm()">
Date &nbsp &nbsp &nbsp Day
<select name="Day" id="Day">
disp;
$day_count=1;
while($day_count<=31)
{ 
  if($day_count!=$temp_day)
  {echo <<<disp
<option value="$day_count">$day_count</option>;
disp;
  }
  else
  {
  echo <<<disp
<option value="$day_count" selected="selected">$day_count</option>;
disp;
  }
 $day_count++;
}
echo <<<disp
</select>
&nbsp Month
<select name="Month" id="Month">
disp;
$month_count=1;
while($month_count<=12)
{
   if($month_count!=$temp_month)
  {echo <<<disp
<option value="$month_count">$month_count</option>;
disp;
  }
  else
  {
  echo <<<disp
<option value="$month_count" selected="selected">$month_count</option>;
disp;
  }
 $month_count++;
}
echo <<<disp
  </select>
&nbsp Year
<select name="Year" id="Year">
disp;
$date_count1=intval(date("Y"));
$date_count2=$date_count1+1;
if($date_count1==$temp_year)
{
echo <<<disp
<option value="$date_count1" selected="selected">$date_count1</option>
<option value="$date_count2">$date_count2</option>
disp;
}
else
{
echo <<<disp
<option value="$date_count1" >$date_count1</option>
<option value="$date_count2" selected="selected">$date_count2</option>
disp;
}
echo <<<disp
</select>
</br>
disp;
echo <<<disp
Name : <input type="text" name="ename" id="name" size="50" value="$temp_name" placeholder="Enter the name of the event here"></br>
Description : </br><textarea id="des" name="description" cols="50" rows="10"
 placeholder="Enter the description here" value="$temp_desc">
</textarea>
</br><input class="button" type="submit" value="Submit">
<a href="$CFG->wwwroot"><input class="button"  type="button" name="Cancel" value="Cancel"></a>
</form>
disp;
}
else
  echo "Access Denied";
?>
                             

                           </div>
                       </div>
                    </div>
                </div>
                <div id="region-pre">
                    <div class="region-content">
                     

                     
                     

                    </div>
                </div>
                <div id="region-post">
                    <div class="region-content">
                    </div>
                </div>
             </div>
        </div>

    </div><div class="clearfix"></div>


    <div id="page-footer" class="clearfix">
      <p class="helplink"></p>
      </div>





        <div class="myclear"></div>
  </div> <!-- END #page -->

</div> <!-- END #page-wrapper -->



<div id="page-footer-bottom">

</div>
</body>
</html>
 

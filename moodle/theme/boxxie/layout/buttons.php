<html>
<script>
   function showmenu(elmnt)
          {
              document.getElementById(elmnt).style.visibility="visible";
          }
          function hidemenu(elmnt)
          {
            document.getElementById(elmnt).style.visibility="hidden";
          }
  function confirmDelete()
{
var r=confirm("This will delete all the data. Press Ok to continue ");
if (r==true)
  {
  alert("Deletion Success !!!");
  return true;
  }
else
  {
  alert("Deletion Canceled !!!");
  return false;
  }
}
 </script>

<?php
if($_SESSION['skill']==100)
{
//require_once("../../../config.php");
?>

<head>
<style>
div.ad_settings{
                width:205px;
                height:355px;
                background:#A1CAF1;   
                border: 2px solid #1c1c1c;
                padding:0px;
                float:left;
                
                filter: alpha(opacity:40);

        }
form.not_hiding
{
 margin-left:3px;
 visibility:hidden;
}
input.button
{
 border-top: 1px solid #96d1f8;
/*   background: #3B170B;
   background: -webkit-gradient(linear, left top, left bottom, from(#B43104), to(#1C1C1C));
   background: -webkit-linear-gradient(top, #3B170B, #8A2908);
   background: -moz-linear-gradient(top, #3B170B, #8A2908);
   background: -ms-linear-gradient(top, #3B170B, #8A2908);
   background: -o-linear-gradient(top, #3B170B, #8A2908);
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
   vertical-align: middle;  */

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
h4.not_set
{
 padding:5px;
 margin:0px;
 color:#2E2E2E;
 }
</style>
</head>
<body>


<div class="ad_settings" >

<h4 class="not_set">Notification settings</h4>

<?php
$_SESSION['skill']=100;
echo <<<disp
&nbsp<a href="$CFG->wwwroot/foronb/notificationediting/add_notification.php"><input class="button" type="button" value="Add" /></a>&nbsp
disp;

echo <<<disp
<a href="$CFG->wwwroot/foronb/notificationediting/delete_notifications.php" ><input class="button" type="button" value="Delete" /></a>&nbsp
disp;


echo <<<disp
<a href="$CFG->wwwroot/foronb/notificationediting/modify_notification.php"><input class="button" type="button" value="Modify" /></a>
disp;
echo <<<disp
<hr/> 
<h4 class="not_set">User Account Settings</h4>
disp;


echo <<<disp
&nbsp<a href="$CFG->wwwroot/add_user/adduser.php"><input class="button" type="button" value="Add Users" /></a>&nbsp
disp;
echo <<<disp
&nbsp<a href="$CFG->wwwroot/add_user/delete_users.php"><input class="button" type="button" value="Delete Users" /></a>&nbsp
disp;
echo <<<disp
<hr/>
<h4 class="not_set">Calender of Events Settings</h4>
disp;
echo <<<disp
&nbsp<a href="$CFG->wwwroot/cevent/upload.php"><input class="button" type="button" value="Add" /></a>&nbsp
disp;
echo <<<disp
<a href="$CFG->wwwroot/cevent/delete_events.php"><input class="button" type="button" value="Delete" /></a>&nbsp
disp;
echo <<<disp
<a href="$CFG->wwwroot/cevent/modify_event.php"><input class="button" type="button" value="Modify" /></a>&nbsp
disp;
echo <<<disp
<hr/>
<h4 class="not_set">Semester Results</h4>
disp;

echo <<<disp
&nbsp<a href="$CFG->wwwroot/foronb/result/addresults.php"><input class="button" type="button" value="Upload Results" /></a>&nbsp
disp;
echo <<<disp
<hr/>
<h4 class="not_set">Delete All Data</h4>&nbsp
disp;

echo <<<disp
<a href="$CFG->wwwroot/foronb/delete_contents.php"><input class="button" type="button" value="Delete" onclick=" return confirmDelete()" /></a>
disp;
echo <<<disp
</div>

</body>
disp;
}
else
	echo "Access Denied";
?>
 

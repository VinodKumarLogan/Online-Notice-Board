<?php
    require_once('../config.php');
    require_once($CFG->dirroot.'/course/lib.php');
    require_once($CFG->libdir.'/filelib.php');
?> 
<html>

<script>
function confirmDelete()
{
var agree=confirm("Are you sure that you want to delete the selected users?");
if (agree)
{
	alert("Selected users have been deleted !!! ");
	return true ;
}
else
	return false ;
}
function selectAll(field)
{
for (i = 0; i < field.length; i++)
	field[i].checked = true ;
}
function unselectAll(field)
{
for (i = 0; i < field.length; i++)
	field[i].checked = false ;
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
            overflow:auto;
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
                           <?php echo '<h3  align="middle" style="font-family:calibre; font-size:18; padding:0px; color:#2E2E2E " >NOTIFICATION EDITOR</h3><br/>' ?>
                           
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
$con=mysql_connect("localhost", "$CFG->dbuser", "$CFG->dbpass") or die(mysql_error());
mysql_select_db("$CFG->dbname",$con) or die(mysql_error());

  
$result = mysql_query ("SELECT USN,name,semester FROM onb_details");
echo <<<disp
<form action="delusers.php" method="post" name="list" onsubmit="return confirmDelete()" >
<table width="100%">
<tr>
    <td><b>ID</b></td>
    <td><b>USN</b></td>
    <td><b>Name</b></td>
    <td><b>Semester</b></td>	
    </tr>
disp;
$count_id=0;
     while($row = mysql_fetch_assoc($result)) 
     {	$temp_usn=$row['USN'];
	$temp_name=$row['name'];
	$temp_sem=$row['semester'];
	$count_id++;
	echo <<<disp
	<tr><td>{$count_id}</td>
	<td>{$temp_usn}</td>
	<td>{$temp_name}</td>
	<td>{$temp_sem}</td>
		     <td><input type='checkbox' name="$temp_usn" /></td></tr>
disp;
      }
      echo "</table>";
      echo <<<disp
      <input class="button" type="button" name="selectall" value="Select All"
onClick="selectAll(document.list)">
  <input class="button" type="button" name="unselectall" value="Unselect All" 
onClick="unselectAll(document.list)"></br>
disp;
      echo <<<disp
      	<input type="submit" value="Confirm" class="button">
<a href="$CFG->wwwroot"><input class="button"  type="button" name="Cancel" value="Cancel"></a>
</form>
disp;
mysql_close($con);      
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

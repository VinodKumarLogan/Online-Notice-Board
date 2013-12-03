<?php
    require_once('../config.php');
    require_once($CFG->dirroot.'/course/lib.php');
    require_once($CFG->libdir.'/filelib.php');
?>
<html>
<head>
<?php
echo <<<disp
<link rel="stylesheet" type="text/css" href="$CFG->wwwroot/theme/boxxie/style/core.css" />
disp;
?>
<style type="text/css">
<style type="text/css">
p{
        font-size:18;
        font-color:#2E2E2E;
}
div.add2{
	padding-top:20px;
        padding-left:75px;
}

div.adduser{
            width:100%;
            height:auto;
            border:2px solid black;
            background:#AFBDD9;
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
<img src="$CFG->wwwroot/pes_img/newlogo.png" /> <a title="Go to pes home" href="http://pes.edu" ><img class="pes_logo" src="$CFG->wwwroot/pes_img/pesit-logo.png" /></a> 
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
				<div class="add2">
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

  
$result = mysql_query ("SELECT id,name,timestart FROM onb_event");
echo <<<disp
<form action="mod_event.php" method="post">
<table width="100%">
<tr>
    <td><b>ID</b></td>
    <td><b>Name</b></td>
    <td><b>Date</b></td>	
    </tr>
disp;
$count=0;
     while($row = mysql_fetch_assoc($result)) 
     {	$count++;
	$temp_id=$row['id'];
	$temp_name=$row['name'];
	$temp_date=date("m/d/Y",($row['timestart']));
	echo <<<disp
	<tr><td>{$count}</td>
	<td>{$temp_name}</td>
	<td>{$temp_date}</td>
		     <td><input type='radio' name="mod" value="$temp_id" /></td></tr>
disp;
      }
      echo <<<disp
      <tr><td>Do not modify anything<input type='radio' name="mod" value="10"/></td></tr>
      </table>
disp;
      echo <<<disp
      	<input class="button" type="submit" value="Modify" >
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

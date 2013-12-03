<?php
    require_once('../config.php');
    require_once($CFG->dirroot.'/course/lib.php');
    require_once($CFG->libdir.'/filelib.php');
?>
<html>
<script>
function validateForm()
{
var x=document.forms["input"]["file"].value;
extArray=new Array(".xls",".xlsx");
var file=document.forms["input"]["file"].value;
if (x==null || x=="")
  {
  alert("File must be selected");
  return false;
  }
  else
  {
    var form=document.forms["input"];

    allowSubmit = false;
    if (!file){ 
    
    var y=confirmSubmit();
    return y;
    }
    while (file.indexOf("\\") != -1)
    file = file.slice(file.indexOf("\\") + 1);
    ext = file.slice(file.indexOf(".")).toLowerCase();
    for (var i = 0; i < extArray.length; i++) {
    if (extArray[i] == ext) { allowSubmit = true; break; }
    }
    if (allowSubmit) 
    {
      var y=confirmSubmit();
      return y;
    }
    else
    alert("Please only upload files that end in types:  "
    + (extArray.join("  ")) + "\nPlease select a new "
    + "file to upload and submit again.");
    return false;
  }
}

function confirmSubmit()
{
var agree=confirm("Are you sure you want to continue?");
if (agree)
	return true ;
else
	return false ;
}
</script>
<head>
<?php
echo <<<disp
<link rel="stylesheet" type="text/css" href="$CFG->wwwroot/theme/boxxie/style/core.css" />
disp;
?>
<style type="text/css">
pre.tp{
        font-size:18;
        font-color:#2E2E2E;
}
div.add2{
	padding-top:30px
        padding-left:175px;
}

div.adduser{
            width:100%;
            height:300px;
            border:2px solid black;
            background:#afbdd9;
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
                           <?php echo '<h3  align="middle" style="font-family:calibre; font-size:18; padding:0px; color:#2E2E2E " >BULK USER EDITOR</h3><br/>' ?>
                           
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

echo <<<disp
<p style="font-size:18;font-color:#2E2E2E;">
  Upload a excel sheet which contains student details in specified format 
</p>
<form name="input" action="uploader.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
<label for="file">Filename:</label>
<input class="button"  type="file" name="file" id="file" /> 
<br />
<input class="button" type="submit" name="submit" value="Submit" />
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
















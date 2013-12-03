<html>

<script type="text/javascript">

function RadioGroup1_toggle(c)
{
   if (c.value == 'semester')
   {
    document.getElementById('hidedata').style.visibility='visible';
    document.getElementById('semtype').style.visibility='visible';
    if(document.getElementById('semtype').value=="even")
    {
      document.getElementById('odd').style.visibility='hidden';
      document.getElementById('even').style.visibility='visible';
      document.getElementById('defcheck2').checked='checked';
    }
    else
    {
      document.getElementById('even').style.visibility='hidden';
      document.getElementById('odd').style.visibility='visible';
      document.getElementById('defcheck1').checked='checked';
    }
   }
   else
   {
    document.getElementById('hidedata').style.visibility='hidden';
    document.getElementById('semtype').style.visibility='hidden';
    document.getElementById('even').style.visibility='hidden';
    document.getElementById('odd').style.visibility='hidden';
   }
}


function validateForm()
{
var x=document.forms["input"]["notification"].value;
extArray=new Array(".jpg",".png",".bmp",".gif",".doc",".docx",".xls",".xlsx",".ppt",".pptx",".pdf");
var file=document.forms["input"]["file"].value;
if (x==null || x=="")
  {
  alert("Notification must be filled");
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
var agree=confirm("This will republish the notification. Are you sure you want to continue?");
if (agree)
	return true ;
else
	return false ;
}

function selectToggle(c)
{
  if(c.value=="even")
  {
    document.getElementById('odd').style.visibility='hidden';
    document.getElementById('even').style.visibility='visible';
    document.getElementById('defcheck2').checked='checked';
  }
  else
  {
    document.getElementById('even').style.visibility='hidden';
    document.getElementById('odd').style.visibility='visible';
    document.getElementById('defcheck1').checked='checked';
  }
}

</script>



<head>
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
<link rel="stylesheet" type="text/css" href="$CFG->wwwroot/boxxie/style/core.css" />
disp;

  
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
                           <?php 
				require_once("../../config.php");	
echo '<h3  align="middle" style="font-family:calibre; font-size:18; padding:0px; color:#2E2E2E " >NOTIFICATION EDITOR</h3><br/>' ?>
                           
                           <div class="adduser">
               
                                
                                <?php
//session_start();
$temp_id=$_SESSION['id'];
$con=mysql_connect("localhost", "$CFG->dbuser", "$CFG->dbpass") or die(mysql_error());
mysql_select_db("$CFG->dbname") or die(mysql_error());
$result = mysql_query ("SELECT * FROM onb_notifications WHERE $temp_id=noti_id");  
$row=mysql_fetch_array($result);
$_SESSION['date']=$row['noti_date'];
$_SESSION['noti']=$temp_noti=$row['notification'];
$_SESSION['type']=$row['noti_type'];
$_SESSION['desc']=$temp_desc=$row['description'];
echo <<<disp
<p>Welcome to Notification Editor</br></p>


<form name="input" action="upd_noti.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
<div name="input0">
<input type="radio" name="noti_type" value="public" id="no" onClick="RadioGroup1_toggle(this)" /> Public<br />
<input type="radio" name="noti_type" value="semester" id="yes" onClick="RadioGroup1_toggle(this)" checked="checked"/> Semester-wise
<select name="input4" id="semtype"  onclick="selectToggle(this)">
<option value="odd" selected="selected">Odd</option>
<option value="even">Even</option>
</select>
<br />
</div>


<div name="input1" id="hidedata" >
<p style="opacity:2.0" ">For which semester is this notification for?</p>  
<table>
<tr>
<div id="odd"> 
 <input type="radio" name="sem" value="1" id="defcheck1" checked="checked"/> 1st
<input type="radio" name="sem" value="3" /> 3rd
<input type="radio" name="sem" value="5" /> 5th
<input type="radio" name="sem" value="7" /> 7th
<input type="radio" name="sem" value="9" /> All
</div>

<div id="even" style="visibility:hidden"> 
 <input type="radio" name="sem" value="2" id="defcheck2" /> 2nd
<input type="radio" name="sem" value="4" /> 4th
<input type="radio" name="sem" value="6" /> 6th
<input type="radio" name="sem" value="8" /> 8th
<input type="radio" name="sem" value="9" /> All
</div>
</tr>
</table>
</div> 

<div name="input2" >
<p>Notification</p>
<input type="text" name="notification" placeholder="Enter your notification here" size="50" value="$temp_noti"/>
</div>
<p>Description</p>
<textarea id="txtarea" name="description" cols="50" rows="10"
 placeholder="Enter the description here" value="$temp_desc">
</textarea>
<br />
<br/>
<label for="file">Filename:</label>
<input type="file" name="file" id="file" /> 
<div name="input3" >
<br/>
<input class="button" type="submit" name="Submit" >
<a href="$CFG->wwwroot"><input class="button"  type="button" name="Cancel" value="Cancel"></a>
</div>
</form>
disp;
mysql_close($con);
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


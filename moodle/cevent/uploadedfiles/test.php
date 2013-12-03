<?php

    require_once('../../../config.php');
    require_once($CFG->dirroot .'/course/lib.php');
    require_once($CFG->libdir .'/filelib.php');

?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../style/core.css" />
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

function displayConfirmation()
{
  alert("Notification Published");
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
<style type="text/css">
div.adduser{
            width:100%;
            height:540px;
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
</style>
</head>
<body>

<div id="page-wrapper">
  <div id="page" class="clearfix">
    <div id="page-header" class="clearfix">
      
        <?php  echo'<img src="../../../../pes_img/logo.png" />'. ' <a title="Go to pes home" href="http://pes.edu" ><img class="pes_logo" src="../../../../pes_img/pesitnew1.gif" /></a>'; ?>
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
                              echo <<<disp
</head>
<body>

<p>Welcome to Notification Editor</br></p>


<form name="input" action="send_noti.php" method="post" enctype="multipart/form-data">
<div name="input0">
<input type="radio" name="noti_type" value="public" id="no" onClick="RadioGroup1_toggle(this)" /> Public<br />
<input type="radio" name="noti_type" value="semester" id="yes" onClick="RadioGroup1_toggle(this)" checked="checked"/> Semester-wise
<select name="input" id="semtype"  onclick="selectToggle(this)">
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
<input type="text" name="notification" placeholder="Enter your notification here" size="50" />
</div>
<p>Description</p>
<textarea id="txtarea" name="description" cols="50" rows="10"
 placeholder="Enter the description here" >
</textarea>
<br />
<br/>
<label for="file">Filename:</label>
<input type="file" name="file" id="file" /> 
<div name="input3" >
<br/>
<input type="submit" name="Submit" onClick="displayConfirmation()">
</div>
</form>

</body>
disp;
                              
                              
                             }
                             else{
                                echo "Currently you dont have access to this page ";
                                 }
                                
                             ?>

                           </div>
                       </div>
                    </div>
                </div>
                <div id="region-pre">
                    <div class="region-content">
                        <?php 
                         if($isadmin)
                         {
                         //include("buttons.php");
                         }
                        ?>


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

<?php
  //echo $OUTPUT->home_link();
  //echo $OUTPUT->standard_footer_html();
?>
</div>
</body>
</html>

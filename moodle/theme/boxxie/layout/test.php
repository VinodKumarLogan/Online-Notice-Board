<?php
//if (!file_exists('../../.././config.php')) {
  //      header('Location: install.php');
    //    die;
    //}
//define('CLI_SCRIPT','true');
    require_once('../../../config.php');
    require_once($CFG->dirroot .'/course/lib.php');
    require_once($CFG->libdir .'/filelib.php');
//include("../../../lib/datalib.php");
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../style/core.css" />
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
                           <?php echo '<h3  align="middle" style="font-family:calibre; font-size:18; padding:0px; color:#2E2E2E " >DEPARTMENT OF ISE</h3><br/>' ?>
                           <?php
                                // include("department.php");
                            ?>
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
                              // echo "You can edit :)";
                              include($CFG->wwwroot.'../add_user/adduser.html');
                             }
                             else{
                                echo "Currently you dont have access to this page :(";
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

<html>
<title>Department</title>
<head>
 <style>
   a{color:white;text-decoration:none;font:bold}
      a:hover{color:#606060}
     
      h3.department{
                    padding:0px;
                    color:white;
                    margin:0px;
                    font-family:calibre;
                    text-align:center;
                    }
      div.setforbook
       {
        padding:55px;
        padding-top:30px;
        background-image:url("http://sandeepraju.in/onb/project/pes_img/book.png");
        background-repeat:no-repeat;
        background-position:center;
        background-size:100% 100%;
        width:737px%;
        height:500px;
        min-width:400px;
     /*   border:2px solid black;    */      
  
       }
      div.public_ntc{
                width:45%;
                height:540px;
	     /*	background:silver; 
                border: 2px solid #330000; */
                padding:0px;
                float:left;
		opacity:.8;
		filter: alpha(opacity:40);

        }
      div.sem{  
             /* background:silver;*/
              opacity:.8;
              width :45%;
              height:540px;
            /*  border: 2px solid #330000;*/
            
              padding:0px;
              float:right;
              }
     
     div.set_scroll{
        background-image:url("http://sandeepraju.in/onb/project/pes_img/scroll.gif");
        background-repeat:no-repeat;
        background-position:center;
        background-size:100% 100%;
        height:750px;
        padding:0px;            
        }
     div.notices{
        position:absolute;
        width:400px;
        height:400px;
        left:57%; 
        margin-left:-200px; 
        margin-top:100px;
     /*   border: 5px solid black;   */
        line-height: 18px;
        color:blue; 
        font-size: 13px
        font-family:impact,arial;
        }
div.div3{ 
              background:#5882FA;
              opacity:.8;
              width :60%;
              height:540px;
              border:0px solid black;
              padding:0px;
              visibility:hidden;
              position:absolute;
             }
 </style>

 
<script type="text/javascript">
function showmenu(elmnt)
{
document.getElementById(elmnt).style.visibility="visible";
document.getElementById(elmnt).style.display = "block";
}
function hidemenu(elmnt)
{
document.getElementById(elmnt).style.visibility="hidden";
document.getElementById(elmnt).style.display="none";
}
</script>
</head>

 <body>
  <?php
   $conn = mysql_connect("$CFG->dbhost","$CFG->dbuser","$CFG->dbpass") or die ("mysql_error()");
   mysql_select_db("$CFG->dbname",$conn) or die ("unable to select");
   $ntc_select = mysql_query("SELECT * FROM onb_notifications");
  // $row= mysql_fetch_array($ntc_select); 
   if(isloggedin())
   { 
    $admins = get_admins();
    $isadmin = false;
    foreach ($admins as $admin) 
    {
        if ($USER->id == $admin->id)
        {
            $isadmin = true;
            break;
        }
    }
      ?>
   <div class="setforbook"> 
     <div class="public_ntc" id="ntc_div1">
       <h4 align="middle" style="font-family:impact; text-shadow: 1px 1px white, -1px -1px #444; color:#8A4117">PUBLIC NOTICE</h4>
        <marquee style="padding-left:15;"onmouseover="this.stop();" onmouseout="this.start();" direction="up" height="450" scrollamount="4">
         <?php
          while($row= mysql_fetch_array($ntc_select))
          if($row["noti_type"] == 0)
          {
           echo '<h5 align="center" style="color:#7E3517; text-shadow: 0.1em 0.1em #333">'.$row["notification"].'</h5></br>';
           echo '<p align="center" style="color:#7E3517">'.$row["description"].'</p>';
           echo'</br>';
          }
          ?>
         </marquee>
     </div>
     <div class="sem" id="ntc_div2">
      <h4 align="middle" style="font-family:impact; text-shadow: 1px 1px white, -1px -1px #444; color:#8A4117">SEMESTER NOTICE</h4>
        <marquee style="padding-left:15;"onmouseover="this.stop();" onmouseout="this.start();" direction="up" height="450" scrollamount="4">
         <?php
         $ntc_select = mysql_query("SELECT * FROM onb_notifications");
         $sem_sql=mysql_query("SELECT semester FROM onb_details WHERE USN = '$USER->username'");
         $sem = mysql_fetch_array($sem_sql);
         $semester= $sem["semester"];
         if($isadmin)
          {
           echo "LOL :D Admin trolled ... :) ";							/* Remove this 	*/
          }
         else
         {											/* if not admin display notice */
         //echo $semester;                                     					/* Checking the semester of user */
         while($row= mysql_fetch_array($ntc_select))
          if($row["noti_type"] == $semester || $row["noti_type"] == 9)
          {
           echo '<h5 align="middle" style="color:#7E3517; text-shadow: 0.1em 0.1em #333">'.$row["notification"].'</h5></br>';
           echo '<p align="middle" style="color:#7E3517">'.$row["description"].'</p>';
           echo'</br>';
          }
         }
       ?>
        </marquee>
     </div>
    </div>
     
          
    <?php
    } 
    else
      { ?>
         
         <div class="set_scroll">
          <div class="notices">
           <h3 align="middle" style="font-family:impact; text-shadow: 1px 1px white, -1px -1px #444; color:#8A4117">PUBLIC NOTICE</h3>  
           <marquee style="padding-left:15;"onmouseover="this.stop();" onmouseout="this.start();" direction="up" height="500px"  scrollamount="4">
           <?php
           while($row= mysql_fetch_array($ntc_select))
           if($row["noti_type"] == 0)
           {
            echo '<h5 align="middle" style="color:#7E3517; text-shadow: 0.1em 0.1em #333">'.$row["notification"].'</h5></br>';
            echo '<p align="middle"style="color:#7E3517">'.$row["description"].'</p>';
            echo'</br>';
           }
           ?>
          </marquee>
         </div>
        </div> 
   <?php
     }
    ?>
 </body>
</html>


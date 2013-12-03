
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
      p.up_by{
     	color:#3E62AD;
       float:left;
       text-align:left;
       padding:5px;
       margin-left:10px;
	}
      img.new_icon
       {
        padding: 0px;
        padding-left:10px;
        width:29px;
        height:12px;
       }
      img.arrow
      {
       width:15px;
       height:15px;
       padding:0px;
      }
      
      p.date_ntc
      {
       color:#3E62AD;
       float:right;
       text-align:right;
       padding:5px;
       margin-right:10px;
      }
      h3.h_ntc
      {
       font-family:anton; 
       text-shadow: 1px 1px white, -1px -1px #444; 
       color:#006;
       }
      h5.name_ntc
      {
       float:left; 
       font-family:anton; 
       text-align:left;
       padding:10px;
       margin:0px;
       padding-bottom:1px;
       color:#092256; 
       text-shadow: 0.1em 0.1em #333;
       }
      p.p_ntc
      {
       color:#020014;
       font-family: cursive;
       padding:5px;
       margin-left:15px;
       text-align:left;
      }
      p.file_ntc
      {
      text-align:right;
       padding:5px;
       margin-right:10px;
 
      }
       
      div.block_public
      {
       
       -moz-box-shadow: 3px 3px 4px #000;
       -webkit-box-shadow: 3px 3px 4px #000;
       box-shadow: 10px 10px 4px #7D7D7D;
       background-color:#AFBDD9;
       width:inherit;
       height:auto;
       min-height:110px;
       margin-left:15px;
       margin-top:15px;
       margin-right:15px;
       margin-bottom:20px;
       border-radius:20px;
       -webkit-border-radius:20px;
       -moz-border-radius:20px;
     /*  border:2px solid blue;*/
       }
      
           
     div.set_scroll{
      /*  background-image:url("<?php echo $CFG->wwwroot."/pes_img/scroll.gif" ?>" ); */
        padding:10px;
        width:inherit;
        height:auto;
        padding:0px; 
      /*  border:2px solid blue; */        
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
   $ntc_select = mysql_query("SELECT * FROM onb_notifications ORDER BY noti_date DESC");
   date_default_timezone_set(UTC);
   $date2=time();
   $show=21;
   $base_path = $CFG->wwwroot.'/foronb/notificationediting/uploadedfiles/';
  
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
     <div class="set_scroll">
     	<h3 class="h_ntc">SEMESTER NOTICE</h3>  
        <?php
        $sem_sql=mysql_query("SELECT semester FROM onb_details WHERE USN = '$USER->username'") or die();
        $sem = mysql_fetch_array($sem_sql);
        $semester= $sem['semester'];
        if($isadmin)
        { 
           $ntc_select = mysql_query("SELECT * FROM onb_notifications ORDER BY noti_date DESC");
           $flag=true;
           while($row= mysql_fetch_array($ntc_select))
               {
                        $date1= $row['noti_date'];
                        $diff = floor(abs($date2 - $date1) / 86400);
                        $file_path= $base_path.$row['file_name'];
			$uploader_name=$row['uploader'];
                        $noti_time = date('d-m-Y', $date1);
                        if($row["noti_type"] == 1 ||$row["noti_type"] == 2 ||$row["noti_type"] == 3 ||$row["noti_type"] == 4 ||$row["noti_type"] == 5 ||$row["noti_type"] == 6 ||$row["noti_type"] == 7 ||$row["noti_type"] ==8  && $diff<$show )
                        { $flag=false;
                        ?>
                                <div class="block_public">
                                        <h5 class="name_ntc"><img class="arrow" src="<?php echo $CFG->wwwroot.'/pes_img/arrow.png'?>" /> <?php echo $row["notification"];if($diff==0){
   echo <<<disp
   <img class="new_icon" src="$CFG->wwwroot/pes_img/new.gif" /> 
disp;
}
 ?></h5> <p class="date_ntc"><?php echo 'Sem: '.$row['noti_type'].', Date: '.$noti_time; ?></p></br>
                                        <p class="p_ntc"> <?php echo $row["description"]?></p>
                                        </br>
					<p class="up_by">By : <?php echo $uploader_name; ?></p>
                                        <?php
                                        if($row['file_name'] != '')
                                        {?>
                                                <p class="file_ntc"> To download file click here <a href="<?php echo $file_path; ?>" target="_blank">DOWNLOAD</a></p>
                                                <?php
                                        }
                                echo '</div>';

                        }
               }
               if($flag)
               {
			?>
                <div class="block_public">
                        <h5 class="name_ntc"><img class="arrow" src="<?php echo $CFG->wwwroot.'/pes_img/arrow.png'?>" />Empty</h5></br>
                        <p class="p_ntc">No notices to display</p>
                        </br>
                </div>
           <?php
 		}
        }
        else
        { 
          $ntc_select = mysql_query("SELECT * FROM onb_notifications ORDER BY noti_date DESC");
          $flag=true;
          while($row= mysql_fetch_array($ntc_select))
               {
              		$date1= $row['noti_date'];
                        $diff = floor(abs($date2 - $date1) / 86400);
                        $file_path= $base_path.$row['file_name'];
			$uploader_name=$row['uploader'];
                        $noti_time = date('d-m-Y', $date1);
         		if($row["noti_type"] == $semester && $diff<$show)
                	{$flag=false;
                  	?>
              			<div class="block_public">
                			<h5 class="name_ntc"><img class="arrow" src="<?php echo $CFG->wwwroot.'/pes_img/arrow.png'?>" /> <?php echo $row["notification"];if($diff==0){
   echo <<<disp
   <img class="new_icon" src="$CFG->wwwroot/pes_img/new.gif" /> 
disp;
}
 ?></h5> <p class="date_ntc">Date: <?php echo $noti_time; ?></p></br>
                			<p class="p_ntc"> <?php echo $row["description"]?></p>
                			</br>
					<p class="up_by">By : <?php echo $uploader_name; ?></p>
                			<?php
                			if($row['file_name'] != '')
                			{?>
                				<p class="file_ntc"> To download file click here <a href="<?php echo $file_path; ?>" target="_blank">DOWNLOAD</a></p>
               			 		<?php
                			}
                 		echo '</div>';
                
               		}	
               }
    
               if($flag)
               {
			?>
                <div class="block_public">
                        <h5 class="name_ntc"><img class="arrow" src="<?php echo $CFG->wwwroot.'/pes_img/arrow.png'?>" />Empty</h5></br>
                        <p class="p_ntc">No notices to display</p>
                        </br>
                </div>
           <?php
               }	
         }
         ?>
          <h3 class="h_ntc">DEPARTMENT NOTICE</h3>
          <?php
           	$ntc_select = mysql_query("SELECT * FROM onb_notifications ORDER BY noti_date DESC");
           	$flag=true;
                while($row= mysql_fetch_array($ntc_select))
          	{
                  $date1= $row['noti_date'];
                                $diff = floor(abs($date2 - $date1) / 86400);
                                $file_path= $base_path.$row['file_name'];
				$uploader_name=$row['uploader'];
                                $noti_time = date('d-m-Y', $date1);	
			if($row["noti_type"] == 9 && $diff<$show)
           		{ $flag=false; ?>
            		<div class="block_public">
             		<h5 class="name_ntc"><img class="arrow" src="<?php echo $CFG->wwwroot.'/pes_img/arrow.png'?>" /> <?php echo $row["notification"];if($diff==0){
   echo <<<disp
   <img class="new_icon" src="$CFG->wwwroot/pes_img/new.gif" /> 
disp;
} ?></h5> <p class="date_ntc">Date: <?php echo $noti_time; ?></p></br>
            			<p class="p_ntc"> <?php echo $row["description"]?></p>
            			</br>
				<p class="up_by">By : <?php echo $uploader_name; ?></p>
            			<?php
            			if($row['file_name'] != '')
            			{?> 
            				<p class="file_ntc"> To download file click here <a href="<?php echo $file_path; ?>" target="_blank">DOWNLOAD</a></p>
            			<?php
            			}		 
            		echo ' </div>';
           		}
                }
                if($flag)
                {
          		?>
                <div class="block_public">
                        <h5 class="name_ntc"><img class="arrow" src="<?php echo $CFG->wwwroot.'/pes_img/arrow.png'?>" />Empty</h5></br>
                        <p class="p_ntc">No notices to display</p>
                        </br>
                </div>
           <?php
                }
            echo '</div>';
            	
        } 
    else
      { ?>
         <div class="set_scroll">
         	<h3 class="h_ntc">PUBLIC NOTICE</h3>  
           	 <?php
           	$ntc_select = mysql_query("SELECT * FROM onb_notifications ORDER BY noti_date DESC");
             	$flag=true;
                while($row= mysql_fetch_array($ntc_select))
             	{
               		$date1= $row['noti_date'];
             	  	$diff = floor(abs($date2 - $date1) / 86400);
               		$file_path= $base_path.$row['file_name'];
			$uploader_name=$row['uploader'];
               		$noti_time = date('d-m-Y', $date1);
               		if($row["noti_type"] == 0 && $diff<$show)
               		{ $flag=false; ?>
                		<div class="block_public">
                		<h5 class="name_ntc"><img class="arrow" src="<?php echo $CFG->wwwroot.'/pes_img/arrow.png'?>" /> <?php echo $row["notification"];if($diff==0){
   echo <<<disp
   <img class="new_icon" src="$CFG->wwwroot/pes_img/new.gif" /> 
disp;
}
 ?>
				</h5> <p class="date_ntc">Date: <?php echo $noti_time; ?></p></br>
   				<p class="p_ntc"> <?php echo $row["description"];?></p>
                		</br>
				<p class="up_by">By : <?php echo $uploader_name; ?></p>
                		<?php 
                		if($row['file_name'] != '')
               			{?> 
                  			<p class="file_ntc"> To download file click here <a href="<?php echo $file_path; ?>" target="_blank">DOWNLOAD</a></p>
                  			<?php
                		}
				//echo '<p class="up_by">By : '.$uploader_name.'</p>';
                		echo '</div>';
               		}
             	}
               if($flag)
               {
			?>
                <div class="block_public">
                        <h5 class="name_ntc"><img class="arrow" src="<?php echo $CFG->wwwroot.'/pes_img/arrow.png'?>" />Empty</h5></br>
                        <p class="p_ntc">No notices to display</p>
                        </br>
                </div>
           <?php
               }
          echo '</div>';
      }	
    ?>
 </body>
</html>


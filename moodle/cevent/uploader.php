<?php
global $addrs;
if ($_FILES["file"]["error"] > 0)
  {
  echo "Error: " . $_FILES["file"]["error"] . "<br />";
  }
else
  {
   if($_FILES["file"]["type"] != 'application/vnd.ms-excel')
    {
     echo "Please upload a excel file";
    }
   else
    {
     $addrs->path= "" . "uploadedfiles/" . $_FILES["file"]["name"]."";
     require("example.php");
    }
  }
?>
<?php
 /*  
  echo "Upload: " . $_FILES["file"]["name"] . "<br />";
  echo "Type: " . $_FILES["file"]["type"] . "<br />";
  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
  echo "Stored in: " . $_FILES["file"]["tmp_name"];
  }

 /* if (file_exists("uploadedfiles/" . $_FILES["file"]["name"]))
     {
       echo $_FILES["file"]["name"] . " already exists. ";
      }
    else 
      {
      $addrs->path= "" . "uploadedfiles/" . $_FILES["file"]["name"]."";
   if( move_uploaded_file($_FILES["file"]["tmp_name"],"uploadedfiles/" . $_FILES["file"]["name"]))
      {
        require("example.php");
      }
      echo "Stored in: " . "uploads/" . $_FILES["file"]["name"];
         
 }
?>  */

<?php

if(isset($_FILES['file']['name'])){


    $code = $_POST['coding'];

     $filename = $code."-".$_FILES['file']['name'];

     // Location
     $location = 'documentos/csf/'.$filename;
  
     // file extension
     $file_extension = pathinfo($location, PATHINFO_EXTENSION);
     $file_extension = strtolower($file_extension);
  
     // Valid extensions
     $valid_ext = array("pdf");
  
     $response = "";
     if(in_array($file_extension,$valid_ext)){
          // Upload file
          if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
               $response = $location;
          } 
     }
  
     echo $response;
     exit;
   
}


    
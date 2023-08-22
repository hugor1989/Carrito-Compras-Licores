<?php

if(isset($_FILES['file']['name'])){
   // file name
  // $filename = $_FILES['file']['name'];

   $response = "";


   $filename = $_FILES['file']['name'];

   // Location
   $location = 'documentos/csf/'.$filename;

   // file extension
   $file_extension = pathinfo($location, PATHINFO_EXTENSION);
   $file_extension = strtolower($file_extension);

   // Valid extensions
   $valid_ext = array("pdf");

   //$response = 0;
   if(in_array($file_extension,$valid_ext)){
        // Upload file
        if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
             $response = $location;
        } 
   }

  
/* 
   $response = 0;
   if(in_array($file_extension,$valid_ext)){
        // Upload file
        if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
             $response = 1;
        } 
   } */

   echo $response;
   exit;
}
<?php

if(isset($_FILES['file']['name'])){
   // file name
  // $filename = $_FILES['file']['name'];


$longitud = 10;
$key = '';
$pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
$max = strlen($pattern)-1;
for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};

   $response = "";


   $filename = $_FILES['file']['name'];

   
   $nombre = $key.'-'.$filename;

   // Location
   $location = 'documentos/csf/'.$nombre;

   // file extension
   $file_extension = pathinfo($location, PATHINFO_EXTENSION);
   $file_extension = strtolower($file_extension);

   // Valid extensions
   $valid_ext = array("pdf");

   

   //$response = 0;
   //if(in_array($file_extension,$valid_ext)){
        // Upload file
        if(move_uploaded_file($nombre,$location)){
             $response = $location;
        } 
   //}

  
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


    
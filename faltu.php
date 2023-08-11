<?php

$message = 'adiós';
$result = mb_substr($message, 3, 1);

echo $result;
 $prgm = "M.tech.";
 $batch = 2020;
if($prgm == "B.tech."){
    $pref = $batch;
  }
  else if($prgm == "M.tech."){
   $b = $batch%2000;
   $pref = $b.'MT';
 }
 else if($prgm == "MCA"){
   $pref = "20CA";
 
 }
 $suff = 0001;
 echo $pref;


?>
<?php 
error_reporting(0);
session_start();
include_once "fbaccess.php";
//echo json_encode($_SESSION['gplusuer']);

echo "testing";
//print_r($_SESSION);
//print_r($user_info);

 if(count($user_info)>0)
{

$gender=$user_info['gender'];

 
 $email=$user_info['email'];
 
  
 $firstname=$user_info['first_name'];
 
  
 $lastname=$user_info['last_name'];

$fullname=$firstname.' '.$lastname;

} 
?>



<?php
include_once('dbfunction.php');
$obj = new dbfunction();
$name=$_REQUEST['name'];
$lastname=$_REQUEST['lastname'];
$gender=$_REQUEST['gender'];
$imgnewFilePath="";
$address=$_REQUEST['address'];
$mobileno=$_REQUEST['mobileno'];
$email=$_REQUEST['email'];
$password=$_REQUEST['password'];
$accounttype=$_REQUEST['accounttype'];
$commsg=$obj->regesteruser($name,$lastname,$gender,$imgnewFilePath,$address,$mobileno,$email,$accounttype,$password);
if($commsg){
$admob='9000500600';
$message1 ="Hi,Dear ".$name."  ".$lastname." Your login Credentials:<br>Username:".$email."  or ".$mobileno." Password=".$password."  .Thank you www.rushforme.com";
$message = str_replace(" ","%20",$message1);
$link="http://login.rocktosms.com/api/web2sms.php?workingkey=1499313h210b69009aw9f&sender=RUSHME&to=$mob&message=$message";
$homepage = file_get_contents($link);
if($homepage=="Invalid Mobile Numbers")
{
$status="Not send";
}
else
{
$status="Send";
}
}
else
header('Content-type: application/json');
echo json_encode(array('status' => $status));
?>
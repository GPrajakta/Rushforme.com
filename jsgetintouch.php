​<?php
include_once('dbfunction.php');
$obj = new dbfunction();
$mob=$_GET['mob'];
$email=$_REQUEST['email'];
$msgs=$_REQUEST['msg'];
$commsg=$obj->createcomsg($mob,$email,$msgs);
if($commsg){
$admob='9000500600';
$message2 ="Hi,Dear Admin meassage:".$msgs."</br> Send by ".$mob." and ".$email." .Thank you www.rushforme.com";
$messageadmin = str_replace(" ","%20",$message2);
$linkadmin="http://login.rocktosms.com/api/web2sms.php?workingkey=1499313h210b69009aw9f&sender=RUSHME&to=$admob&message=$messageadmin";   
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
header('Content-type: application/json');
echo json_encode(array('status' => $status));
?>​
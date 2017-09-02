<?php
include_once('dbfunction.php');
 $obj = new dbfunction();
 // print_r($_FILES);
 // print_r($_POST);
// if(isset($_POST['user']))
// {
// print_r($_POST);
// echo "jkhfsfh";

$name=$_POST['name'];
$lastname=$_POST['lastname'];
$gender=$_POST['gender'];
//echo "gend".$image=$_POST['image'];
$password=$_POST['password'];
$address=$_POST['address'];
$accounttype=$_POST['accounttype'];
$mobileno=$_POST['mobileno'];
$email=$_POST['email'];
$time=round(microtime(true) * 1000);
$img_name=$_FILES['image']['name'];
$imgfile_tmp=$_FILES["image"]["tmp_name"];
if($img_name!="")
{
  $filename=$time.'_'.$img_name;
$path_parts = pathinfo($filename);
   $fname1=str_replace(' ','',$path_parts['filename']);
  // echo $fname1;
    $fname1=str_replace('@','',$fname1);
    $name1=$fname1.'.'.$path_parts['extension'];
     $imgnewFilePath = $name1;
	 // echo $newFilePath;
	 //print_r($file_tmp);
	 //echo $file_tmp;
	 $filpat="./admin/img/users/".$imgnewFilePath;
move_uploaded_file($imgfile_tmp,$filpat);

}
else 
{
$imgnewFilePath="";
}
// echo "dsfsdfsd".$imgnewFilePath ;
// echo $name;
$qq=$obj->regesteruser($name,$lastname,$gender,$imgnewFilePath,$address,$mobileno,$email,$accounttype,$password);
if($qq==1)
{
///////////
$mno=$mobileno;
 $message1 ="Dear ".$name." ".$lastname." ,Your www.rushforme.com Password is ".$password."  please do not share this password any one.Thank you www.rushforme.com";
$message = str_replace(" ","%20",$message1);
$to=explode(";",$mno);
foreach( $to as $index )
  { 
   $link="http://login.rocktosms.com/api/web2sms.php?workingkey=1499313h210b69009aw9f&sender=RUSHME&to=$index&message=$message";
          
$homepage = file_get_contents($link);
if($homepage=="Invalid Mobile Numbers")
{

$status="Not send";
}
else
{

$status="Send";
}
$report=$obj->varifyrepor($index,$status,$homepage,$message1);
$to=$_POST['email'];
$subject="Rush for me";
$message="<h1  style='margin-left:35%'><img src='http://issworx.com/ravi/rushforme/images/logo.png'></h1> Dear ".$_POST['name'] .",<br/><br/>Thankyou for the registration.Dear ".$name." ".$lastname." ,Your www.rushforme.com Password is ".$password."  please do not share this password any one.Thank you www.rushforme.com'</b>";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <info@rushforme.com>' . "\r\n";
//$headers .= 'Cc: info@ishasofwares.com' . "\r\n";
mail($to,$subject,$message,$headers);

////////////
header("Location:index.php");
}
}
else
{
$error="Enter details";
}
//}
//print_r($ordetails);

?>
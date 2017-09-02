<?php
session_start();
include_once('dbfunction.php');

  $baseurl="http://issworx.com/ravi/rushforme"; 
 
 $obj = new dbfunction();
  
$_SESSION['tempmobile']=$_POST['mobileno'];

$_SESSION['mvemail']=$_POST['mvemail'];
$mno=$_SESSION['tempmobile'];
$mail = $_SESSION['mvemail'];
echo $mno.$mail;
$query="SELECT count(userid) as cour FROM userdetails where mobileno='".$mno."' and emailid='".$mail."'" ;
//error to be correctr.
		
$sql=mysql_query($query);
$cro=mysql_num_rows($sql);
		
	if($cro['cour']>=1)
{
	
echo '7';

}

else
{	

    $i = 0; //counter
    $pin = ""; //our default pin is blank.
    while($i < 4){
        //generate a random number between 0 and 9.
        $pin.= mt_rand(0,9);
        $i++;
	}


$_SESSION['mverifycode']=$pin;
 $message1 ="Dear Customer,Your mobile verification code is  ".$pin."  please do not share this codewith any one.Thank you www.rushforme.com";
$message = str_replace(" ","%20",$message1);
$to=explode(";",$mno);


foreach( $to as $index )
{ echo $index;}}
   /*$link='http://login.rocktosms.com/api/web2sms.php?workingkey=1499313h210b69009aw9f&sender=RUSHME&to="9866436535"&message="somthin"';
          
	$homepage = file_get_contents($link);
	if($homepage=="Invalid Mobile Numbers")
	{
		$pin="Not send";
		$status="Not send";
	}
	else
	{
		$pin;
		$status="Send";
	}
	$report=$obj->varifyrepor($index,$status,$homepage,$pin);
	$to=$_POST['mvemail'];
	$subject="Rush for me";
		$message="<h1  style='margin-left:35%'><img src='".$baseurl."/images/logo.png'></h1> Dear Customer<br/><br/>Your mobile verification code is  ".$pin."  please do not share this codewith any one.Thank you <a href='". $baseurl."/register.php'>www.rushforme.com</a>";
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: <info@rushforme.com>' . "\r\n";
	//$headers .= 'Cc: info@ishasofwares.com' . "\r\n";
	mail($to,$subject,$message,$headers);
	//echo $homepage;

	echo $pin;

	 }


}
 // if($agedelete==1)
 // {
 // header("Location:admin/viewagents.php");
 // }
 // if($agedelete!=1)
 // {
 // header("Location:viewagents.php");
 // }
*/
 ?>
<?php
 include_once('dbfunction.php');
  $obj = new dbfunction();
 if((isset($_POST['loguser']) && isset($_POST['logpass'])) || ($_POST['loguser']!='' || $_POST['logpass']!=''))
{
$emailid=$_POST['loguser'];
$password=$_POST['logpass'];
$log=$obj->checkuserLogin($emailid,$password);
if($log!=0)
	{

	$get_det=mysql_fetch_array($log);
	//print_r($get_det);
 $_SESSION['email']=$get_det['emailid'];
$_SESSION['username']=$get_det['name'];
	$_SESSION['mobileno']=$get_det['mobileno'];	
	$_SESSION['address']=$get_det['address'];	
	$_SESSION['uid']=$get_det['userid'];
	$_SESSION['ucityid']=1;
	//print_r($_SESSION);
echo '1';
		
	}
	else 
	{
	$_SESSION['errorlogin']='Invalid User name and Password';
	echo '0';
	}
}
	else 
	{
	$_SESSION['errorlogin']='Invalid User name and Password';
	echo '0';
	}
?>
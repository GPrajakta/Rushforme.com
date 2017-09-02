<?php    
//error_reporting(0);
//session_start();
include('dbConnect.php');  
class dbfunction
{
 function __construct() {  
              
            // connecting to database  
            $db = new dbConnect();
          // session_start();    
        }   
		// destructor  
        function __destruct() {  
              
        }

 public function add_user($name,$mobileno,$emailid,$password,$accounttype)
   {
   $user="CREATE TABLE IF NOT EXISTS `userdetails`(
  `userid` int(100) NOT NULL ,
  `name` varchar(300) NOT NULL,
  `mobileno` varchar(300) NOT NULL,
  `emailid` varchar(300) NOT NULL UNIQUE,
  `password` varchar(300) NOT NULL,
  `accounttype` varchar(300) NOT NULL,
  `date` datetime NOT NULL,
     PRIMARY KEY (userid)
 ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ";
mysql_query($user) or die(mysql_error());
$qry=mysql_query("INSERT INTO  `userdetails` (`userid` ,`name` ,`mobileno` ,`emailid` ,`password` ,`accounttype`,`date` )
VALUES ('','$name','$mobileno','$emailid','$password','$accounttype',NOW())") or die(mysql_error());
if($qry)
{
return 1;
}
}
public function checkuserLogin($email,$password)	
{
// echo $email;
// echo $password;
 //echo "select * from userdetails where (mobileno='$email' OR emailid = '$email') AND password='".$password."'";
// exit;
 $sql=mysql_query("select * from userdetails where (mobileno='".$email."' OR emailid = '".$email."') AND password='".$password."'");	
$ret=mysql_num_rows($sql);
if($ret>=1)
{
//echo "Ok";
return $sql;
}
else
{
//echo "No";
return 0;
}

}
 public function insertorderdetails($destnat,$ffrom,$tto,$itemweight,$fpicup,$fdistance,$userid,$fname,$fmobile,$picupaddress,$toname,$tomobile,$toaddress,$waitintime,$itemprice,$itemname,$comment)
   {
 // $random = '';
  // for ($i = 0; $i < 5; $i++) {
   // $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('A'), ord('Z')));
  // }SELECT MAX(field)FROM yourtable
  //$ucityid=$_SESSION['ucityid'];
  $ucityid=1;
  $cityid=1;
 $getorderid= mysql_query("SELECT orderid FROM orderdetails ORDER BY orderid DESC LIMIT 1");
 $gettorderid= mysql_query("SELECT tempid FROM orderdetails ORDER BY tempid DESC LIMIT 1");
  $orderidr=mysql_fetch_array($getorderid);
  $torderidr=mysql_fetch_array($gettorderid);
 $oid=$orderidr['orderid']; 
 if($oid!="")
 {
 $soid =str_split($oid,3);
$soidd= $soid[1]; 
  $random = str_pad((int) $soidd+1, 3,"0",STR_PAD_LEFT);
 $random=$soid[0].$random;
 }
 else
 {
 $random="RFM001";
 }
  $toid=$torderidr['tempid'];
 if($toid!="" and $toid!=0)
 {
  $tsoid =str_split($toid, 3);
 $stoidd= $tsoid[1];
 $trandom = str_pad((int) $tsoidd+1, 3,"0",STR_PAD_LEFT);
 $trandom=$tsoid[0].$trandom;
 }
 else
 {
 $trandom="TEMP001";
 }
  $orderstatus="PENDING";
  $paymentmode="PROCESS";
  $ocreated='User';
// echo "INSERT INTO `orderdetails`
 // (`id`, `orderid`, `pickupaddress`, `destination`, `priceperkm`, `totalkm`,`itemWeight`,`waitingtime`, `orderstatus`,`shipingaddress`, `pickupmobileno`, `createddate`, `pickupname`, `asssignedeliveryboyid`, `orderuserid`,`toname`,`tomobile`,`toaddress`,`itemprice`,`itemname`,`comments`)
 // ('', '$random', '$ffrom', '$tto', '$fpicup', '$fdistance', '$itemweight','$waitintime','$orderstatus','$picupaddress' ,'$fmobile', NOW(), '$fname', '0','$userid','$toname','$tomobile','$toaddress','$itemprice','$itemname','$comment')";

   $qry=mysql_query("INSERT INTO `orderdetails`
        (`id`, `orderid`, `pickupaddress`, `destination`, `priceperkm`, `totalkm`,`itemWeight`,`waitingtime`, `orderstatus`,`paddress`, `pickupmobileno`, `createddate`, `pickupname`, `asssignedeliveryboyid`, `orderuserid`,`toname`,`tomobile`,`toaddress`,`itemprice`,`itemname`,`comments`,`paymentmode`,`tempid`,`ucityid`,`cityid`,`ocreated`,`destinations`)
 values ('', '$random', '$ffrom', '$tto', '$fpicup', '$fdistance', '$itemweight','$waitintime','$orderstatus','$picupaddress' ,'$fmobile', NOW(), '$fname', '0','$userid','$toname','$tomobile','$toaddress','$itemprice','$itemname','$comment','$paymentmode','$trandom','$ucityid','$cityid','$ocreated','$destnat')") or die(mysql_error());
if($qry)
{
$last_id= mysql_insert_id();
//$_SESSION['orderid']=$qq;
return $last_id;
}
}
 public function insertfirstorderdetails($midladd,$destnat,$ffrom,$tto,$itemweight,$fpicup,$fdistance,$userid,$fname,$fmobile,$picupaddress,$toname,$tomobile,$toaddress,$waitintime,$itemprice,$itemname,$comment)
   {
 // $random = '';
  // for ($i = 0; $i < 5; $i++) {
   // $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('A'), ord('Z')));
  // }SELECT MAX(field)FROM yourtable
  //$ucityid=$_SESSION['ucityid'];
  $ucityid=1;
  $cityid=1;
 $getorderid= mysql_query("SELECT orderid FROM orderdetails ORDER BY orderid DESC LIMIT 1");
 $gettorderid= mysql_query("SELECT tempid FROM orderdetails ORDER BY tempid DESC LIMIT 1");
  $orderidr=mysql_fetch_array($getorderid);
  $torderidr=mysql_fetch_array($gettorderid);
 $oid=$orderidr['orderid']; 
 if($oid!="")
 {
 $soid =str_split($oid,3);
$soidd= $soid[1]; 
  $random = str_pad((int) $soidd+1, 3,"0",STR_PAD_LEFT);
 $random=$soid[0].$random;
 }
 else
 {
 $random="RFM001";
 }
  $toid=$torderidr['tempid'];
 if($toid!="" and $toid!=0)
 {
  $tsoid =str_split($toid, 3);
 $stoidd= $tsoid[1];
 $trandom = str_pad((int) $tsoidd+1, 3,"0",STR_PAD_LEFT);
 $trandom=$tsoid[0].$trandom;
 }
 else
 {
 $trandom="TEMP001";
 }
  $orderstatus="PENDING";
  $paymentmode="PROCESS";
  $ocreated='User';
// echo "INSERT INTO `orderdetails`
 // (`id`, `orderid`, `pickupaddress`, `destination`, `priceperkm`, `totalkm`,`itemWeight`,`waitingtime`, `orderstatus`,`shipingaddress`, `pickupmobileno`, `createddate`, `pickupname`, `asssignedeliveryboyid`, `orderuserid`,`toname`,`tomobile`,`toaddress`,`itemprice`,`itemname`,`comments`)
 // ('', '$random', '$ffrom', '$tto', '$fpicup', '$fdistance', '$itemweight','$waitintime','$orderstatus','$picupaddress' ,'$fmobile', NOW(), '$fname', '0','$userid','$toname','$tomobile','$toaddress','$itemprice','$itemname','$comment')";

   $qry=mysql_query("INSERT INTO `orderdetails`
        (`id`, `orderid`, `pickupaddress`,`middleadd`,`destination`, `priceperkm`, `totalkm`,`itemWeight`,`waitingtime`, `orderstatus`,`paddress`, `pickupmobileno`, `createddate`, `pickupname`, `asssignedeliveryboyid`, `orderuserid`,`shipingname`,`shippingmobile`,`shipingaddress`,`itemprice`,`itemname`,`comments`,`paymentmode`,`tempid`,`ucityid`,`cityid`,`ocreated`,`destinations`)
 values ('', '$random', '$ffrom','$midladd', '$tto', '$fpicup', '$fdistance', '$itemweight','$waitintime','$orderstatus','$picupaddress' ,'$fmobile', NOW(), '$fname', '0','$userid','$toname','$tomobile','$toaddress','$itemprice','$itemname','$comment','$paymentmode','$trandom','$ucityid','$cityid','$ocreated','$destnat')") or die(mysql_error());
if($qry)
{
$last_id= mysql_insert_id();
// $_SESSION['orderid']=$last_id;
return $last_id;
}
} 
public function insertsecorderdetails($orderuid,$itemweight,$fname,$fmobile,$picupaddress,$toname,$tomobile,$toaddress,$waitintime,$itemprice,$itemname,$comment)
   {
   $qry=mysql_query("update  `orderdetails` set itemweight2='$itemweight',shipingname2='$fname',shipingmobile2='$fmobile',shipingadd2='$picupaddress',toname='$toname',tomobile='$tomobile',toaddress='$toaddress',waitngtime2='$waitintime',itemprice2='$itemprice',itemname2='$itemname',itcomment2='$comment' where id='".$orderuid."'")or die(mysql_error());
   if($qry)
{
//$_SESSION['orderid']=$qq;
return 1;
}
}

 public function getorderbd($insertorder)
   {
  $sql=mysql_query("select * from orderdetails where id='".$insertorder."'");
return $sql;

}
 public function edit_user($name,$mobileno,$emailid,$address,$uid)
   {
  $update_qry=mysql_query("update userdetails set name='$name',mobileno='$mobileno',emailid='$emailid',address='$address'   
where userid='$uid'") or die(mysql_error());
if($update_qry)
{
return 1;
}
}
public function  email_report_create($to,$status)
 {
//echo "insert into email_report (email_report_name,email_report_status,email_report_date) values ('$to','$status',NOW())";
$qry=mysql_query("insert into email_report (emailid,email_report_name,email_report_status,email_report_date)
 values ('','$to','$status',NOW())") or die(mysql_error());

 if($qry)
{
return 1;
}
 }
 public function getcitys()
{

$query="SELECT * FROM citys ";
 $sql=mysql_query($query);

return $sql;

}
public function varifyrepor($index,$status,$homepage,$pin)
{
$cityid=$_SESSION['cityid'];
$qry=mysql_query("INSERT INTO  `smsvarify` (`smsvarifyid`,`varifymobileno` ,`varifystatus`,`smsrepot`,`varifycode`,`date`,`cityid`)
VALUES ('','$index','$status','$homepage','$pin',NOW(),'$cityid')") or die(mysql_error());
if($qry)
{
return 1;
}
}
public function regesteruser($name,$lastname,$gender,$imgnewFilePath,$address,$mobileno,$email,$accounttype,$password)
{
 $cityid=1;
if($imgnewFilePath=="")
{
$imgnewFilePath="default.png";
}
$status="Active";
// echo "INSERT INTO  `userdetails` (`userid`,`name` ,`lastname`,`gender`,`image` ,`address`,`mobileno`,`emailid`,`Date`,`status`,`accounttype`,`password` )
// VALUES ('','$name','$lastname','$gender','$imgnewFilePath','$address','$mobileno','$email',NOW(),'','$accounttype','$password')";
$loginwith='rushforme';
$qry=mysql_query("INSERT INTO  `userdetails` (`userid`,`name` ,`lastname`,`gender`,`image` ,`address`,`mobileno`,`emailid`,`Date`,`status`,`accounttype`,`password`,`cityid`,`loginwith` )
VALUES ('','$name','$lastname','$gender','$imgnewFilePath','$address','$mobileno','$email',NOW(),'$status','$accounttype','$password','$cityid','$loginwith')") or die(mysql_error());
if($qry)
{
return 1;
}
}
public function createcomsg($mmsg,$memail,$mmobile)
{
 $cityid=1;
 // echo "INSERT INTO  `cmmsg` (`cmsgid`,`cmmob` ,`cmemail`,`cmmsg`,`cmcityid` )
// VALUES ('','$mmobile','$memail','$mmsg','$cityid')";
// exit;
$qry=mysql_query("INSERT INTO  `cmmsg` (`cmsgid`,`cmmob` ,`cmemail`,`cmmsg`,`cmcityid` )
VALUES ('','$mmobile','$memail','$mmsg','$cityid')") or die(mysql_error());
if($qry)
{
return 1;
}
}
public function getordersbyid($useid)
{

$query="SELECT * FROM orderdetails where orderuserid=$useid";
 $sql=mysql_query($query);

return $sql;

}
public function getorderbymob($oridmob,$TrackOrdertype)
{
if($TrackOrdertype=='OrderNo')
{
$query="SELECT * FROM orderdetails where orderid='".$oridmob."'";
 $sql=mysql_query($query);
}
else if($TrackOrdertype=='MobileNo')
{
$query="SELECT * FROM orderdetails INNER JOIN userdetails ON orderdetails.orderuserid=userdetails.userid where (userdetails.mobileno=9441089969 or pickupmobileno=9441089969 or tomobile=9441089969)";
$sql=mysql_query($query);
}
// echo $query;exit;
return $sql;

}

//////////////////////andriod fun//////////////////////////////////
function deliveryboy_login($agmobileno,$agpassword){
		$qury ="select * from agents where agmobileno = '$agmobileno' and agpassword = '$agpassword' and status = 'Active';";
		return mysql_query($qury);
	}
	
	function get_priceforkm_details(){
		$qury ="select * from priceforkm;";
		return mysql_query($qury);
	}
	
	function insert_orderdetails($orderid,$pickupaddress,$destination,$priceperkm,$totalkm,$totalprice,$itemWeight,$waitingtime,
		$orderstatus,$pickupmobileno,$createddate,	$pickupname,$pickuptime,$paddress,$shipingaddress,	$shipingname,$shippingmobile,
		$shippingdate,$toname,$tomobile,$toaddress,$itemprice,$itemname,$comments,$asssignedeliveryboyid,$orderuserid,$orderassigntime,	
		$orderclosingtime,$Paymentmode,$Billammount,$Dateofpayment,$Paymentstatus,$cityid,$tempid,$ucityid) { 
			
			$create = mysql_query("CREATE TABLE if not exists `orderdetails` (  `id` int(50) NOT NULL AUTO_INCREMENT,
			  `orderid` varchar(300) NOT NULL,  `pickupaddress` varchar(1000) NOT NULL,  `destination` varchar(1000) NOT NULL,
			  `priceperkm` varchar(300) NOT NULL,  `totalkm` varchar(300) NOT NULL,  `totalprice` varchar(300) NOT NULL,
			  `itemWeight` varchar(300) NOT NULL,  `waitingtime` varchar(50) NOT NULL,  `orderstatus` varchar(300) NOT NULL,
			  `pickupmobileno` varchar(300) NOT NULL,  `createddate` datetime NOT NULL,  `pickupname` varchar(300) NOT NULL,
			  `pickuptime` varchar(300) NOT NULL,  `paddress` varchar(500) NOT NULL,  `shipingaddress` varchar(300) NOT NULL,
			  `shipingname` varchar(300) NOT NULL,  `shippingmobile` varchar(300) NOT NULL,  `shippingdate` varchar(300) NOT NULL,
			  `toname` varchar(300) NOT NULL,  `tomobile` varchar(300) NOT NULL,  `toaddress` varchar(300) NOT NULL,
			  `itemprice` varchar(300) NOT NULL,  `itemname` varchar(300) NOT NULL,  `comments` text NOT NULL,
			  `asssignedeliveryboyid` int(11) NOT NULL,  `orderuserid` int(50) NOT NULL,  `orderassigntime` datetime NOT NULL,
			  `orderclosingtime` datetime NOT NULL,  `Paymentmode` varchar(500) NOT NULL,  `Billammount` varchar(500) NOT NULL,
			  `Dateofpayment` datetime NOT NULL,  `Paymentstatus` varchar(500) NOT NULL,  `cityid` varchar(1) NOT NULL,
			  `tempid` varchar(200) NOT NULL,  `ucityid` int(200) NOT NULL,  PRIMARY KEY (`id`),  UNIQUE KEY `orderid` (`orderid`));") or die(mysql_error());
					
				$s =mysql_query("select max(id) from orderdetails");
				$arr=mysql_fetch_array($s);
				$sno=$arr[0]+1;
				$sno1 = str_pad($sno, 3, "0", STR_PAD_LEFT);
				$order_id='RFM'.$sno1;
					
			$insert=mysql_query("INSERT INTO `orderdetails` (`id`, `orderid`, `pickupaddress`,`destination`,`priceperkm`,`totalkm`,`totalprice`, `itemWeight`,
			`waitingtime`,`orderstatus`,`pickupmobileno`,`createddate`,	`pickupname`, `pickuptime`, `paddress`,`shipingaddress`,`shipingname`,
			`shippingmobile`,	`shippingdate`, `toname`, `tomobile`,`toaddress`,`itemprice`,`itemname`,`comments`, `asssignedeliveryboyid`, 
			`orderuserid`,`orderassigntime`,`orderclosingtime`,`Paymentmode`,`Billammount`, `Dateofpayment`, `Paymentstatus`,`cityid`,`tempid`,`ucityid`	) 
			VALUES ('', '$order_id', '$pickupaddress', '$destination', '$priceperkm','$totalkm', '$totalprice', '$itemWeight', '$waitingtime',
			'$orderstatus', '$pickupmobileno', now(), '$pickupname','$pickuptime', '$paddress', '$shipingaddress', '$shipingname',
			'$shippingmobile', '$shippingdate', '$toname', '$tomobile','$toaddress', '$itemprice', '$itemname', '$comments',
			'$asssignedeliveryboyid', '$orderuserid', '$orderassigntime', '$orderclosingtime','$Paymentmode', '$Billammount', '$Dateofpayment', '$Paymentstatus',
			'$cityid', '$tempid', '$ucityid');") or die(mysql_error());  
					
				
			if ($insert){  
				return	$order_id;	
			}else {	
				return	-1;	
			}      
		}
		
		public function insert_track_points($userid,$latitude,$longitude,$address) { 
		
			$create = mysql_query("CREATE TABLE IF NOT EXISTS `track_points` (  `id` int(20) NOT NULL AUTO_INCREMENT,`userid` varchar(20) NOT NULL, 
			`latitude` varchar(30) NOT NULL,  `longitude` varchar(30) NOT NULL, `address` varchar(200) NOT NULL,  `adddate` date NOT NULL,
			`addtime` time NOT NULL, PRIMARY KEY (`id`));") or die(mysql_error());
									
			$insert=mysql_query("INSERT INTO `track_points` (`id`, `userid`, `latitude`,`longitude`,`address`,`adddate`, `addtime`) VALUES ('', '$userid', '$latitude', '$longitude', '$address',date(now()),time(now()));") or die(mysql_error());  
						 
			if ($insert){  
				return	mysql_insert_id();	
			}else {	
				return	-1;	
			}      
		} 
		
		public function insert_feedback($ordrid,$feedback,$rating)   {
		   $cityid=$_SESSION['cityid'];
			mysql_query("CREATE TABLE if not exists `feedback` (  `fid` int(250) NOT NULL AUTO_INCREMENT,  `ordrid` varchar(250) NOT NULL,
			`feedback` text NOT NULL,  `rating` varchar(250) NOT NULL,  `cityid` varchar(100) NOT NULL,  PRIMARY KEY (`fid`)) ");
			$qry=mysql_query("INSERT INTO  `feedback` (	`fid` ,`ordrid` ,`feedback` ,`rating` ,`cityid` )
			VALUES ('','$ordrid','$feedback','$rating','$cityid')") or die(mysql_error());
			if($qry){
				return 1;
			}else{
				return 0;
			}
			
		}
		
//////////////////////end classssssss////////////////////////////// 
}
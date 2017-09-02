<?php 
 include_once('dbfunction.php');
 $cn = new dbfunction();

$orderid=$_REQUEST['orderid'];
$pickupaddress=$_REQUEST['pickupaddress'];
$totalkm=$_REQUEST['totalkm'];
$destination=$_REQUEST['destination'];
$priceperkm=$_REQUEST['priceperkm'];
$totalprice=$_REQUEST['totalprice'];
$itemWeight=$_REQUEST['itemWeight'];
$waitingtime=$_REQUEST['waitingtime'];
$orderstatus=$_REQUEST['orderstatus'];
$pickupmobileno=$_REQUEST['pickupmobileno'];
$createddate=$_REQUEST['createddate'];
$pickupname=$_REQUEST['pickupname'];
$pickuptime=$_REQUEST['pickuptime'];
$paddress=$_REQUEST['paddress'];
$shipingaddress=$_REQUEST['shipingaddress'];
$shipingname=$_REQUEST['shipingname'];
$shippingmobile=$_REQUEST['shippingmobile'];
$shippingdate=$_REQUEST['shippingdate'];
$toname=$_REQUEST['toname'];
$tomobile=$_REQUEST['tomobile'];
$toaddress=$_REQUEST['toaddress'];
$itemprice=$_REQUEST['itemprice'];
$itemname=$_REQUEST['itemname'];
$comments=$_REQUEST['comments'];
$asssignedeliveryboyid=$_REQUEST['asssignedeliveryboyid'];
$orderuserid=$_REQUEST['orderuserid'];
$orderassigntime=$_REQUEST['orderassigntime'];
$orderclosingtime=$_REQUEST['orderclosingtime'];
$Paymentmode=$_REQUEST['Paymentmode'];
$Billammount=$_REQUEST['Billammount'];
$Dateofpayment=$_REQUEST['Dateofpayment'];
$Paymentstatus=$_REQUEST['Paymentstatus'];
$cityid=$_REQUEST['cityid'];
$tempid=$_REQUEST['tempid'];
$ucityid=$_REQUEST['ucityid'];

echo $insert = $cn->insert_orderdetails($orderid,$pickupaddress,$destination,$priceperkm,$totalkm,$totalprice,$itemWeight,$waitingtime,
	$orderstatus,$pickupmobileno,$createddate,	$pickupname,$pickuptime,$paddress,$shipingaddress,	$shipingname,$shippingmobile,
	$shippingdate,$toname,$tomobile,$toaddress,$itemprice,$itemname,$comments,$asssignedeliveryboyid,$orderuserid,$orderassigntime,	
	$orderclosingtime,$Paymentmode,$Billammount,$Dateofpayment,$Paymentstatus,$cityid,$tempid,$ucityid);
	
	

?>
<?php
session_start();
include_once('dbfunction.php');
 $obj = new dbfunction();
if(isset($_POST['trackorder']))
{
$oridmob=$_POST['oridmob'];
 $TrackOrdertype=$_POST['TrackOrdertype'];

 $taroggg=$obj->getorderbymob($oridmob,$TrackOrdertype);
 
 }
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php
include("header.php");
?>
</head>
  <body onload="initialize()">
  <div class="inner-bg">
<nav>
<?php

include("menu.php");
?>
</nav>


<!-- body Carousel -->
<div class="background"></div>
<!-- body Carousel -->
    
	

</div>
<div class="container">
	<div class="row">
    	<div class="col-md-12">
		<div class="devider1"></div>
			<h4>Order Status</h4>
          <div class="table-responsive">
			<table class="table" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="track_bg">ORDERID</td>
    <td class="track_bg">DATE</td>
    <td class="track_bg">PICKUP</td>
    <td class="track_bg">DESTINATION</td>
    <td class="track_bg">PRICE</td>
    <td class="track_bg">STATUS</td>
    <td class="track_bg">MOBILE</td>
    <td class="track_bg">ASSIGN TO</td>
  </tr>
  <?php 
  while($tarog=mysql_fetch_array($taroggg))
				{
				  ?>
  <tr>
<td><?php echo $tarog['orderid'] ?></td>
<td><?php echo $tarog['createddate'] ?></td>
<td><?php echo $tarog['pickupaddress'] ?></td>
<td><?php echo $tarog['destination'] ?></td>
<td><?php echo $tarog['totalprice'] ?></td>
<td><?php echo $tarog['orderstatus'] ?></td>
    <td>&nbsp;</td>
  </tr>
<?php }  ?>
</table>
		  </div>  
            

        </div>

    </div>
</div>
<div class="devider1"></div>
	
<?php

include("footer.php");
?>


</body>

</html>
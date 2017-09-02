<!DOCTYPE html>
<html lang="en">
<head>
<?php
session_start();
// print_r($_SESSION);
 include_once('dbfunction.php');
 $obj = new dbfunction();



include("header.php");
?>
</head>

<body onload="initialize()" >
<div class="inner-bg">
<nav>
<?php

include("menu.php");
?>
</nav>

 <style type="text/css">
#map {
	/min-height:490px;
	height:100%;
	top: 0px;
    z-index: -1;
    position: absolute;
}
#over_map_right { 
	/position: absolute; 
	margin:50px 0px; 
	/left:0px;
    z-index: 98;
    /width: 970px; 
	background: white;
}
#over_map_left { 
	/position: absolute; 
	background-color:transparent;
	margin-top:50px; 
	/left:10px; 
	z-index: 98; 
	background: white;
	/width:320px;
	padding: 15px;
}
#over_map_left ul{ 
	padding:0px;
	margin-bottom:10px;
}
#over_map_left ul li{ 
	padding:0px;
	margin: 1px 7px;
	list-style:none;
	float: left;
	font-size: 13px;
}
#over_map_left span{
    clear: left;
    color: #C856A0;
    /float: left;
    line-height: 20px;
}
#wrapper { 
position: relative; }
#tableorderhd
{
	   / background: #E2E2E2;
    /border: 1px solid #eee;
}
    </style>
	     

<!-- body Carousel -->
<div class="background"></div>
<!-- body Carousel -->

<script>
//calculateRoute('<?php echo $_SESSION["ffrom"];?>','<?php echo $_SESSION["fto"];?>');
$(document).ready(function() {
	alert('<?php echo $_SESSION["ffrom"];?>');
window.onload=calculateRoute('<?php echo $_SESSION["ffrom"];?>','<?php echo $_SESSION["fto"];?>');
});
</script>
</div>

<div id="wrapper" style="bottom:2%;top:0%;">

<div class="container-fluid">
<div class="row">
<!--
<div class="col-md-3 col-sm-3">
<div id="over_map_left">
<ul>
<li><a href=""><img src="images/directions_blue.jpg" alt=""></a></li>
</ul>
<form  method="post" action="" id="fomroute">
	<div class="control-group form-group">
		<div class="controls">
<input type="text" class="form-control location-ico from" name="fromaddress" id="autocomplete" required="required"
 onclick="this.value='';"  placeholder="PICKUP LOCATION"
onblur="this.value=!this.value?'':this.value;"   value="<?php //echo $_SESSION['ffrom'];?>" />
		</div>
	</div>
			<div class="controls">
		<?php
		// echo $_SESSION["adades"];
		// if($_SESSION["adades"]!=1)
		// {
		// $middadd=$_SESSION["middleaddd"];
			// $display="block";
		// }
		// else{
		// $_SESSION["middleaddd"]='';
		// $middadd='';
			// $midd='';
			// $display="none";
		// }
		?>
	<div class="control-group form-group" id="addaddressval" style="display:<?php //echo $display;?>">

<input type="text" class="form-control location-ico from" name="middleadd"   id="addaddressvaluee"
 onclick="this.value='';"  placeholder="Add LOCATION" value="<?php //echo $middadd;?>"
onblur="this.value=!this.value?'':this.value;"    />
<a href="javascript:void();" onclick ="hideaddres();" style="font-size:12px;"><i class="fa fa-times" ></i> Remove Location</a>
		</div>
	</div>
	<div class="control-group form-group">
		<div class="controls">
	     <div class="controls">
<input type="text" class="form-control location-ico to" name="toaddress" required="required"  onclick="this.value='';" 
 placeholder="DROPING LOCATION" onblur="this.value=!this.value?'':this.value;" 
value="<?php //echo $_SESSION['fto'];?>"  id="txtDestinationAddress"/>
		</div>
	</div>
	<ul>
		<li>Total destinations<br/>
			<span><?php //echo $_SESSION["adades"];?></span>
		</li>
		<li>Total KM'S<br/>
			<span><?php //echo $_SESSION["fdistance"] ;?></span>
		</li>
		<li>Total Price<br/>
			<span><i class="fa fa-inr"></i><?php //echo round($_SESSION["fdistance"]*$_SESSION["fpicup"]);?></span>
		</li>
		<div class="clearfix"></div>
	</ul>
<input type="button" class="btn btn-success" id="addbutton" onclick="addroute()" value="Add Location"
 style="margin-right:10px; margin-bottom: 10px;"/>
	<input type="submit" class="btn btn-success" name="searchaddroute" value="Search Route" style="margin-bottom: 10px;">
</form>
	
</div>

</div>
</div>-->
<div class="col-md-9 col-md-offset-2">
<div id="over_map_right">

 		<div class="modal-header login_modal_header">
	
        		<h4 class="modal-title" id="myModalLabel">Order Summary</h4>
      		</div>
	<div class="modal-body login-modal" >
	<div class="table-responsive" >
		      			<table class="table table-striped responsive-utilities jambo_table bulk_action">
                                   
										<tr>
<td width="1%"><b>Name :</b></td>
<td width="1%"><?php echo $_SESSION['username'] ?></td>
<td width="1%"><b>Mobile No :</b></td>
<td width="1%"><?php echo $_SESSION['mobileno']; ?></td>
</tr>
</table>
	<table class="table table-striped responsive-utilities jambo_table bulk_action">
<tr>
<th>Stage</th>
<th>Source</th>
<th>Destination</th>
<th>Distance</th>

</tr>					   
										<?php
										$odid=$_SESSION['orderid'];
		$oride= mysql_query("SELECT * FROM orderdetails where id='".$odid."'");
  $ode=mysql_fetch_array($oride);

  //print_r($ode);
			$priceperkm=$ode['priceperkm'];	
$pkm= mysql_query("SELECT * FROM priceforkm where id='".$priceperkm."'");
$pkmv=mysql_fetch_array($pkm);
// print_r($pkmv);
// echo "sss".$ode['totalkm'];
// echo "ddd".$pkmv['price'];
$firstd=$_SESSION[''];
$secdistance=$_SESSION["secdistance"];
$firstdistance=$_SESSION["firstdistance"];
$middleaadd=$_SESSION["middleaddd"];
		$tamount=$ode['totalkm']*$pkmv['price'];
//$tamount=String.format("%.2f",$tamount);		
	 $ser=($tamount*12.36)/100;
		 $ser=number_format($ser, 2, '.', '');
	 $fwaa=$ode['waitingtime']*50;
	 $swaa=$ode['waitngtime2']*50;
	 $waa=$fwaa+$swaa;
	$tota=$waa+$swaa+$tamount+$ser+$ode['itemprice']+$ode['itemprice2'];
	$tota= round($tota);
 $addtot=mysql_query("update orderdetails set totalprice='$tota' where id='$odid'")
		?>

<tr> 

<td width="1%">Stage - 1</td>
<td width="1%"><?php echo $ode['pickupaddress'];?></td>

<td width="1%"><?php echo $ode['middleadd'];?></td>

<td width="1%"><?php echo $firstdistance;?></td>
</tr>
<tr> 
<td width="1%">Stage - 2</td>
<td colspan="1"><?php echo $ode['middleadd'];?></td>

<td colspan="1"><?php echo $ode['destination'];?></td>

<td colspan="1"><?php echo $secdistance;?></td>
</tr>
<tr>
<td colspan="2"> </b></td>
<td > <b>Total Distance :</b></td>
<td><?php echo $ode['totalkm']."Kms";  ?></td>
</tr>
</table>
	<table class="table table-striped responsive-utilities jambo_table bulk_action">
<tr> 
<td id="tableorderhd"><b>Vehicle&nbsp;Type</b></td>
<td><b>:</b></td>
<td ><?php echo $pkmv['vehicletype']."Wheeler";?></td>

<td id="tableorderhd"><b>Total&nbsp;Estimated&nbsp;Time </b></td>
<td><b>:</b></td>
<td><?php echo $pkmv['hours']."Hrs";?></td>

<td id="tableorderhd"><b>Amount </b></td>
<td><b>:</b></td>
<td><i class="fa fa-inr"></i> <?php echo $tamount;?></td>
<td id="tableorderhd"><b>Service&nbsp;Tax </b></td>
<td><b>:</b></td>
<td><i class="fa fa-inr"></i> <?php echo $ser;  ?> (12.36%)</td>
</tr>
</table> 

	<table class="table table-striped responsive-utilities jambo_table bulk_action">
        
<tr> 
<td id="tableorderhd"><b>Waiting&nbsp;Time&nbsp;Cost</b></td>
<td><b>:</b></td>
<td ><i class="fa fa-inr"></i><?php echo '('.$fwaa. '+'.$swaa.') '.$waa; ?></td>
<td id="tableorderhd"><b>Item&nbsp;weight</b></td>
<td><b>:</b></td>
<td><?php echo '('.$ode['itemWeight'].'+'.$ode['itemweight2'].')'.($ode['itemWeight']+$ode['itemweight2']);?> Grams</td>
<td id="tableorderhd"><b>Item&nbsp;price</b></td>
<td><b>:</b></td>
<td ><i class="fa fa-inr"></i> <?php echo '('.$ode['itemprice'].'+'.$ode['itemprice2'].')'.($ode['itemprice']+$ode['itemprice2']); ?></td>
</tr> 
 </table>  
	<table class="table table-striped responsive-utilities jambo_table bulk_action">
                                          
<tr> 
<td id="tableorderhd"><b>Total&nbsp;Amount </b></td>
<td><b>:</b></td>
<td ><i class="fa fa-inr"></i> <?php echo $tota."\n(Item Cost + Service Cost + Tax + Waiting Time )"; ?></td>

</tr> 
                                             
 
                      

   </table>
</div>   
      		</div>
			<div class="modal-footer"  >
	 <!--   <button type='button' class='' data-toggle='modal'data-target='#fulldetails'>PROCEED</button>
	      <button class='' onclick="paydetails(<?php //echo $ode['tempid'] ;?>)">Proceed to Pay</button>-->

		   <input type="submit" class="btn btn-success" onClick="location.href='payment.php'"  value="Make Payment" />

       <!-- <button type="button" class="" data-dismiss="modal">Close</button>-->
      </div>
</div>
</div>
	</div>
	</div>
	<div id="map" style="width:100%;"></div>
</div>
	<!--<button onclick="calculateRoute('<?php //echo $_SESSION["ffrom"];?>','<?php //echo $_SESSION["fto"];?>')"
style="float:right;">Click me</button>
<!--<a href='#' id='table-modal' data-toggle="modal" data-target="#login-modal">Sign in</a>-->
	<div class="devider1" style="margin: 0px;"></div>	
<?php
include("footer.php");
?>
<div class="modal " id="table-modal" tabindex="-1" role="dialog"
 aria-labelledby="myModalLabel" aria-hidden="true" style="display:none;">
 <div class="modal-backdrop fade in" style="height: 501px;"></div>
	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header login_modal_header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        		<h2 class="modal-title" id="myModalLabel">Assigned Route Details</h2>
      		</div>
      		<div class="modal-body login-modal">
      			<p>Max Weight 5kg's Rs.10 Per KM Either Side.Minimum duration of waiting 15 min</p>
      			<br/>
      			<div class="clearfix"></div>
      			<div id='social-icons-conatainer'>
	        	<table class="table table-striped responsive-utilities jambo_table bulk_action">
                                        <thead>
                                            <tr class="headings">
                                               <th class="column-title">Destination</th>
                                                <th class="column-title">Type</th>
                                                <th class="column-title">Duration</th>
                                                <th class="column-title">Total KM</th>
                                                <th class="column-title">Total price </th>
                                               <th class="column-title">Task </th>
									          <th class="column-title">Action</th>
                                  </tr><tr>
                                              <th class="column-title"><img src="images/destinations_icon.jpg" alt=""></th>
                                                <th class="column-title"><img src="images/type_icon.png" alt=""></th>
                                                <th class="column-title"><img src="images/duration_icon.jpg" alt=""></th>
                                                <th class="column-title"><img src="images/total_km_icon.jpg" alt=""></th>
                                                <th class="column-title"><img src="images/total_price_icon.jpg" alt=""></th>
                                               <th class="column-title"><img src="images/tast_icon.jpg" alt=""></th>
									          <th class="column-title"><img src="images/destinations_icon.jpg" alt=""></th>
                                      </tr>
                            </thead>
	                            <tbody>
									<?php
 $dr=$_SESSION["fpicup"];
 $de=$_SESSION["fdistance"];
 $dsm=$dr*$de;
				//print_r($_SESSION);
				?>
                                <tr class="even pointer">
								<td class=" " style="color:red;font-size:12px;"><?php echo $_SESSION["ffrom"];?>.  <br> &nbsp&nbsp&nbsp&nbsp&nbsp to &nbsp&nbsp&nbsp <br> <?php echo $_SESSION["fto"] ;?></td>
                                <td class=" ">wheeler </td>
                                  <td class=" "><?php echo  "Hrs" ?><i class="success fa fa-long-arrow-up"></i></td>
                                    <td class=" "><?php echo  $_SESSION["fdistance"] ?></td>
                                    <td class=" "><?php echo $dsm ;?></td>
                                    <td class=" "><?php echo "Delivery" ?></td>
                                    <td class=" "><?php echo "Delivery" ?></td>
				                              </tr>
                          </tbody>
   </table>
	        	</div>																												
        		<div class="clearfix"></div>
        		
        		<div class="form-group modal-register-btn">
      	<?php 
		if($_SESSION['uid']=="")
			{
			?>
	  <a href="register.php" ><button class="btn btn-default"> New User Please Register</button>
        <?php }	else {	?>
			  <a href="orderfulldetails.php" class="" >PROCEED</a>
<?php   }  ?>			  
				</div>
      		</div>
      		<div class="clearfix"></div>
      		<div class="modal-footer login_modal_footer">
      		</div>
    	</div>
  	</div>
</div>


</body>
<script>
function addroute()
{

 // document.getElementById('addaddressvaluee').value =middleadd;
$('#addaddressval').show();
$('#addbutton').hide();
}
</script>
<script>
        function hideaddres() {
            //alert(a);
            // $('#div' + a).html("");
			 $('#addbutton').show();
            document.getElementById('addaddressval').style.display='none';
         document.getElementById('addaddressvaluee').value="";
                       
                     return false;
        }
</script>

</html>
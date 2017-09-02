<?php
session_start();
 include_once('dbfunction.php');
 $obj = new dbfunction();
if(isset($_POST['orderdetails']))
{
/////////////////////
// $ffrom=$_POST['ffrom'];
// $tto=$_POST['tto'];
// $fpicup=$_POST['fpicup'];
// $fdistance=$_POST['fdistance'];
// $userid=$_POST['userid'];
// $fname=$_POST['fname'];
// $fmobile=$_POST['fmobile'];
// $picupaddress=$_POST['picupaddress'];
// $toname=$_POST['toname'];
// $tomobile=$_POST['tomobile'];
// $toaddress=$_POST['toaddress'];
// $waitintime=$_POST['waitintime'];
// $itemweight=$_POST['itemweight'];
// $itemprice=$_POST['itemprice'];
// $itemname=$_POST['itemname'];
// $comment=$_POST['comment'];
///////////////////
$fname=$_POST['fname'];
$fmobile=$_POST['fmobile'];
$picupaddress=$_POST['picupaddress'];
$toname=$_POST['toname'];
$tomobile=$_POST['tomobile'];
$toaddress=$_POST['toaddress'];
$waitintime=$_POST['waitintime'];
$itemweight=$_POST['itemweight'];
$itemprice=$_POST['itemprice'];
$itemname=$_POST['itemname'];
$comment=$_POST['comment'];
$orderuid=$_SESSION['orderid'];
$qq=$obj->insertsecorderdetails($orderuid,$itemweight,$fname,$fmobile,$picupaddress,$toname,$tomobile,$toaddress,$waitintime,$itemprice,$itemname,$comment);
if($qq==1)
{
// $_SESSION['orderid']=$qq;
header("Location:procedtopaymet.php");
}
else
{
$error="Enter details";
}
}
if(isset($_POST['loginlogin']))
{
$emailid=$_POST['email'];
$password=$_POST['password'];
 $objj = new dbfunction();
$log=$obj->checkuserLogin($emailid,$password);
if($log)
	{

	$get_det=mysql_fetch_array($log);
	
 $_SESSION['email']=$get_det['emailid'];
$_SESSION['username']=$get_det['name'];
		
header("Location:procedtopay.php");
		
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

<?php
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
	padding:20px;
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
    </style>
	     

<script>
//calculateRoute('<?php echo $_SESSION["ffrom"];?>','<?php echo $_SESSION["fto"];?>');
$( document ).ready(function() {
	alert('<?php echo $_SESSION["ffrom"];?>');
window.onload=calculateRoute('<?php echo $_SESSION["ffrom"];?>','<?php echo $_SESSION["fto"];?>');
});
</script>
</div>
<div class="gray-container2">   
<div class="container">
	<div class="row">
    	<div class="col-md-12">
			<ol class="breadcrumb" style="color:red;font-weight: bold" >
				<li>
				<?php 
		echo $_SESSION["ffrom"]; ?> </li>
				<li class="active"> TO </li>
				<li>
				<?php if($_SESSION['adades']==1)
		{
		?>
			<span><?php echo $_SESSION["fto"] ;?></span>
		<?php
		}
		else
		{
		?> 
		<span><?php echo $_SESSION["middleaddd"] ;?></span>
	 <?php 	}?>
				</li>	<li>
			<?php if($_SESSION['adades']==1) { echo $_SESSION["fdistance"]; } else { echo $_SESSION["firstdistance"];  }?>
				</li>
				<li>
				<i class="fa fa-inr"></i>
			<?php if($_SESSION['adades']==1) { echo round($_SESSION["fdistance"]*$_SESSION["fpicup"]); } else { echo round($_SESSION["firstdistance"]*$_SESSION["fpicup"]); }?>
				</li>
			</ol>
        </div>
    </div>
</div>
</div>
<div id="wrapper" style="">
<div class="container-fluid">
<div class="row">
<div class="col-md-3 col-sm-3">
<div id="over_map_left">
<ul>
<li><a href=""><img src="images/directions_blue.jpg" alt=""></a></li>
</ul>
<form  method="post" action="showroute.php" id="fomroute">
	<div class="control-group form-group">
		<div class="controls">
<input type="text" class="form-control location-ico from" name="fromaddress" id="autocomplete" required="required"
 onclick="this.value='';"  placeholder="PICKUP LOCATION"
onblur="this.value=!this.value?'':this.value;"   value="<?php echo $_SESSION['ffrom'];?>" />
		</div>
	</div>
			<div class="controls">
		<?php
		// echo $_SESSION["adades"];
		if($_SESSION["adades"]!=1)
		{
		$middadd=$_SESSION["middleaddd"];
			$display="block";
		}
		else{
		$_SESSION["middleaddd"]='';
		$middadd='';
			$midd='';
			$display="none";
		}
		?>
	<div class="control-group form-group" id="addaddressval" style="display:<?php echo $display;?>">

<input type="text" class="form-control location-ico from" name="middleadd"   id="addaddressvaluee"
 onclick="this.value='';"  placeholder="Add LOCATION" value="<?php echo $middadd;?>"
onblur="this.value=!this.value?'':this.value;"    />
<a href="javascript:void();" onclick ="hideaddres();" style="font-size:12px;"><i class="fa fa-times" ></i> Remove Location</a>
		</div>
	</div>
	<div class="control-group form-group">
		<div class="controls">
	     <div class="controls">
<input type="text" class="form-control location-ico to" name="toaddress" required="required"  onclick="this.value='';" 
 placeholder="DROPING LOCATION" onblur="this.value=!this.value?'':this.value;" 
value="<?php echo $_SESSION['fto'];?>"  id="txtDestinationAddress"/>
		</div>
	</div>
	<ul>
		<li>Total destinations<br/>
			<span><?php echo $_SESSION["adades"];?></span>
		</li>
		<li>Total KM'S<br/>
			<span><?php echo $_SESSION["fdistance"] ;?></span>
		</li>
		<li>Total Price<br/>
			<span><i class="fa fa-inr"></i><?php echo round($_SESSION["fdistance"]*$_SESSION["fpicup"]);?></span>
		</li>
		<div class="clearfix"></div>
	</ul>

	<input type="button" class="btn btn-success" id="addbutton" onclick="addroute()" value="Add Location"
 style="margin-right:10px; margin-bottom: 10px;"/>
	<input type="submit" class="btn btn-success" name="searchaddroute" value="Search Route" style="margin-bottom: 10px;">
</form>
	
</div>


</div>


</div>
<div class="col-md-9 col-sm-9">
<div id="over_map_right">

<form  name="orderdetails" method="post" action="" style="">
		<div class="">
<div class="row">
	<div class="col-md-12"><h4><b style="color:#ED2F4B">Enter Shipping details:</b> </h4></div>
      <div  class="col-md-6 col-sm-6">
	  <?php 
	  //$_SESSION["userid"]=2;
$efrom = explode(",",$_SESSION["ffrom"]);
$eto = explode(",",$_SESSION["fto"]);
$emto = explode(",",$_SESSION["middleaddd"]);
	  ?>
	  <span style="color:red;" id="formerror">Please fill all mandatory fields</span>
<h5><b>From</b> </h5>
<small style="color:red;" size="2"> <?php echo $emto[0]; ?> </small><br>
<label>Name <span style="color:red;">*</span></label>
<input type="text" class="form-control2"  name="fname" placeholder="Name of the person" size="35" class="to" style="text-transform:uppercase;" required >
<label>Mobile <span style="color:red;">*</span></label>
<input type="text" class="form-control2" name="fmobile" placeholder="Enter mobile No" maxlength="10" size="35" class="to" onkeypress="return isNumberKey(event)" required>
<label>Address <span style="color:red;">*</span></label>
<input type="text" class="form-control2" name="picupaddress" placeholder="Address and landmark" size="35" class="to" required>
<input type="text" class="form-control2"  placeholder="<?php echo $_SESSION["middleaddd"]; ?>" size="35" readonly class="to" >	  
	  </div> 
    <div class="col-md-6 col-sm-6">
		  <span style="color:red;" id="formerror"></span>
	<h5><b>To </b></h5>
	<small style="color:red;" size="2"> <?php  echo $eto[0];?> </small><br>
<label>Name <span style="color:red;">*</span></label>
	<input type="text" name="toname" class="form-control2" placeholder="Name of the person" size="35" class="to" required>
<label>Mobile No <span style="color:red;">*</span></label>
	<input type="text" name="tomobile" class="form-control2" placeholder="Enter mobile No" maxlength="10" size="35" class="to" onkeypress="return isNumberKey(event)" required>
<label>Address <span style="color:red;">*</span></label>
	<input type="text" name="toaddress" class="form-control2" placeholder="Address and landmark" size="35" class="to"  required>
<input type="text" class="form-control2" placeholder="<?php  echo $_SESSION["fto"];  ?>" readonly size="35" class="to">	  
	</div> 
 <div class="clearfix"></div>	
 <div class="col-md-12" style="margin-bottom:15px;">
<h5><b>Pick Up details:</b> </h5>

	Waiting Time :<select name="waitintime" class="to" name="waitingtime" class="form-control2" style="width:100px; height:25px; border:solid 1px #ccc;">
	<option value="0">None</option>
	<option value="1">30Min &nbsp &nbsp </option>
	<option value="2">60Min &nbsp &nbsp </option>
	<option value="3">90MIn &nbsp &nbsp </option>
	<option value="4">2Hr &nbsp &nbsp </option>
	<option value="6">3Hr &nbsp &nbsp </option>
	<option value="8">4Hr &nbsp &nbsp </option>
	<option value="10">5Hr &nbsp &nbsp </option>
	</select>
	Rs.50/- for every 30min
	</div>
	</div>
	<div class="row">
	<div class="col-md-6" >
	<input type="text" name="itemweight" class="form-control2" placeholder="Weight in Grams" class="to" onkeypress="return isNumberKey(event)">
	<input type="text" class="form-control2" onkeypress="return isNumberKey(event)" name="itemprice" placeholder="Item Price-Input only when we have to buy any item for you" size="59" class="to">
	</div>
		<div class="col-md-6" >
	<input type="text" class="form-control2" name="itemname" placeholder="Item Name" size="35" class="to">
	</div>
   <div class="clearfix"></div>	
   <div class="col-md-12" >
<textarea name="comment" class="form-control2" style="height:60px;" rows="5" cols="100" tabindex="12" class="address_message" placeholder="comments or suggestion in shipping"></textarea>

 <div class="clearfix"></div>
 <div style="float:right">
 <!----<a href="showroute.php"><input type="button" name="ordec"  class="btn btn-cancel" value="CANCEL"  /></a>-->
  <input type="submit" name="orderdetails" class="btn btn-success" value="PROCEED"  />
 </div>
   </div>
</form>
</div>
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

</html>
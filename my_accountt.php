<!DOCTYPE html>
<html lang="en">
<head>

<?php
session_start();
 include_once('dbfunction.php');
 $obj = new dbfunction();
if(isset($_POST['chnagepass']))
{

$oldpass=$_POST['oldpass'];
$newpass=$_POST['newpass'];
$cnewpass=$_POST['cnewpass'];
$emailll=$_SESSION['email'];
 $log=$obj->checkuserLogin($emailll,$oldpass);
if($newpass==$cnewpass && $log!=0)
{
$update_qry=mysql_query("update userdetails set password='$newpass' where emailid='$emailll'") or die(mysql_error());
}
else if($newpass!=$cnewpass || $log==0 )
{
if($newpass!=$cnewpass )
{
//echo "<script> $('#divCheckPasswordMatch').html('Passwords do not match!').css('color', 'red'); </script>"   ;
//echo "<script>$(document).ready(function(){ $('#divCheckPasswordMatch').html('Passwords do not match!').css('color', 'red');  });</script>";
 $_SESSION['comerror']='Passwords do not match!';

}
if($log==0)
{
$_SESSION['comerror']='Old Password Incorrect ';
}
}
echo "<script> $('#divCheckPasswordMatch').load('my_account.php');</script>"   ;

}

include("header2.php");
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

    </style>
	     

<!-- body Carousel -->
<div class="background"></div>
<!-- body Carousel -->

<script>
//calculateRoute('<?php echo $_SESSION["ffrom"];?>','<?php echo $_SESSION["fto"];?>');
$( document ).ready(function() {
	alert('<?php echo $_SESSION["ffrom"];?>');
window.onload=calculateRoute('<?php echo $_SESSION["ffrom"];?>','<?php echo $_SESSION["fto"];?>');
});
</script>
</div>

<div class="container myaccount_div" style="">
	<div class="row">
		<div class="col-md-12"></div>
		<div class="col-md-10 col-md-push-1">
<h1>MY ACCOUNT</h1>
                <ul id="myTab" class="nav nav-tabs nav-justified">
                    <li class="active"><a href="#service-one" data-toggle="tab">My Profile</a>
                    </li>
                    <li class=""><a href="#service-two" data-toggle="tab">My Orders</a>
                    </li>
                    <li class=""><a href="#service-three" data-toggle="tab">My Credits</a>
                    </li>
                    </ul>

                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="service-one">
                        <h5><strong>USER DETAILS</h5></strong>
                        <div class="row">
						<form  id="contactForm" method="post"  enctype="multipart/form-data" >
							<div class="col-md-5">
								<div class="control-group form-group">
                        <div class="controls">
                            <input type="password" class="form-control2" id="name" name="oldpass" placeholder="OLD PASSWORD">
                        </div>
                    </div>
					<div id="divCheckPasswordMatch" style="color:red"><?php echo $_SESSION['comerror'];   $_SESSION['comerror']="";?></div>
					<div class="control-group form-group">
                        <div class="controls">
                            <input type="password" class="form-control2" id="nepass" name="newpass" placeholder="NEW PASSWORD">
                        </div>
                    </div>
					<div class="control-group form-group">
                        <div class="controls">
                            <input type="password" class="form-control2" id="cpass" name="cnewpass" placeholder="CONFIRM PASSWORD" >
                        </div>
                    </div>
					<button type="submit" name="chnagepass" class="btn btn-primary" style="width:40%;">Change Password</button>
							</div>
							</form>
						</div>
						<div class="row" id="deashow">
						<hr/>
						<div class="col-md-12"><h5><strong>CONTACT DETAILS</h5></strong></div>
							<div class="col-md-5">
								<div class="control-group form-group">
									<div class="controls">
										<label>Name:</label>
										<input type="text" class="form-control2" id="name" placeholder="" value="<?php echo $_SESSION['username']; ?>" readonly>
									</div>
								</div>
								<div class="control-group form-group">
									<div class="controls">
										<label>Email:</label>
										<input type="text" class="form-control2" id="name" placeholder="" value="<?php echo $_SESSION['email']; ?>" readonly>
									</div>
								</div>
							</div>
							<div class="col-md-5">
								<div class="control-group form-group">
									<div class="controls">
										<label>Mobile:</label>
										<input type="text" class="form-control2" id="name" placeholder="" value="<?php echo $_SESSION['mobileno']?>" readonly>
									</div>
								</div>
								<div class="control-group form-group">
									<div class="controls">
										<label>Address:</label>
										<input type="text" class="form-control2" id="name" placeholder="" value="<?php echo $_SESSION['address']; ?>" readonly>
									</div>
								</div>
								<button onclick="deailshide()" class="btn btn-primary" style="width:40%;">Edit</button>
							</div>
						</div>
                   		<div class="row" id="deashow">
						<hr/>
						<div class="col-md-12"><h5><strong>CONTACT DETAILS</h5></strong></div>
							<div class="col-md-5">
								<div class="control-group form-group">
									<div class="controls">
										<label>Name:</label>
										<input type="text" class="form-control2" id="name" placeholder="" value="<?php echo $_SESSION['username']; ?>">
									</div>
								</div>
								<div class="control-group form-group">
									<div class="controls">
										<label>Email:</label>
										<input type="text" class="form-control2" id="name" placeholder="" value="<?php echo $_SESSION['email']; ?>">
									</div>
								</div>
							</div>
							<div class="col-md-5">
								<div class="control-group form-group">
									<div class="controls">
										<label>Mobile:</label>
										<input type="text" class="form-control2" id="name" placeholder="" value="<?php echo $_SESSION['mobileno']?>">
									</div>
								</div>
								<div class="control-group form-group">
									<div class="controls">
										<label>Address:</label>
										<input type="text" class="form-control2" id="name" placeholder="" value="<?php echo $_SESSION['address']; ?>">
									</div>
								</div>
								<button type="submit" name="user" class="btn btn-primary" style="width:40%;">Save</button>
							</div>
						</div>
                   

				   </div>
                    <div class="tab-pane fade" id="service-two">
                        <h5><strong>USER hgbhhjbjbjhbjhklkklDETAILS</h5></strong>
                        <p>This page gives you the snapshot of all orders placed from this account.You can also track the status of your orders / shipments from here.</p>
                        <hr/>
						<h5><strong>ORDERS DETAILS</h5></strong>
						<table cellspacing="0" border="0" id="" class="table-responsive table">
		<tbody><tr style="background-color:#1767AF;">
			<th style="color: #fff;">DATE</th>
			<th style="color: #fff;">ORDERID</th>
			<th style="color: #fff;">SOURCE</th>
			<th style="color: #fff;">DESTINATION</th>
			<th style="color: #fff;">AMOUNT PAID</th>
		</tr>
		<tr>
			<td>6/30/2015 5:20:46 PM</td>
			<td>RFM0020</td>
			<td>Kukatpally, Secunderabad, Telangana, India</td>
			<td>Khairatabad, Hyderabad, Telangana, India</td>
			<td>242.00</td>
		</tr>
		<tr>
			<td>6/30/2015 1:17:25 PM</td>
			<td>RFM0019</td>
			<td>Kukatpally, Hyderabad, Telangana, India</td>
			<td>Abids, Hyderabad, Telangana, India</td>
			<td>290.00</td>
		</tr>
		<tr>
			<td>6/29/2015 9:46:06 PM</td>
			<td>RFM0018</td>
			<td>Kukatpally, Hyderabad, Telangana, India</td>
			<td>Khairatabad, Hyderabad, Telangana, India</td>
			<td>484.00</td>
		</tr>
	</tbody></table>
                    </div>
                    <div class="tab-pane fade" id="service-three">
						<h5><strong>Mr . naveen - 9642424545</h5></strong>
						<table cellspacing="0" border="0" id="" class="table-responsive table">
		<tbody>
		<tr>
			<td width="20%">Membership Type</td>
			<td>----</td>
		</tr>
		<tr>
			<td>Balance Amount</td>
			<td>----</td>
		</tr>
		<tr>
			<td>Expiry Date</td>
			<td>----</td>
		</tr>
		</tbody></table>
						<div class="clearfix"></div>
                        </div>
                     </div>

            </div>
	</div>
</div>
	<!--<button onclick="calculateRoute('<?php //echo $_SESSION["ffrom"];?>','<?php //echo $_SESSION["fto"];?>')"
style="float:right;">Click me</button>
<!--<a href='#' id='table-modal' data-toggle="modal" data-target="#login-modal">Sign in</a>-->
	<div class="devider1" style="margin: 0px;"></div>
<script>
$('#cpass').on('keyup', function () {
    if ($(this).val() == $('#nepass').val()) {
        $('#divCheckPasswordMatch').html('Passwords match.').css('color', 'green');
    } else $('#divCheckPasswordMatch').html('Passwords do not match!').css('color', 'red');
});
</script>	
<script>
function deailshide()
{

}
</script>	
<?php
include("footer.php");
?>


</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
<?php
 include_once('dbfunction.php');
 $obj = new dbfunction();
$baseurl="http://www.rushforme.com/";
if(isset($_POST['emailsubmit']))
{
$to=$_POST['email'];

$message="<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head><meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Rushforme</title>
</head><body style='margin:0px;'>
<table width='600' border='0' align='center' bgcolor='#FFFFFF'     style='background-color: #eee;' cellpadding='0px' cellspacing='0px'>
  <tr><th style='border:#E0E0E0 solid 1px; padding:0px;'>
	<table width='100%' border='0' cellpadding='0px' cellspacing='0px'>
  <tr>    <th align='center' valign='top' style='padding:0px;'>
  <img src='".$baseurl."images/logo.png' border='0' style='width: 20%;'/></th>
  </tr>  <tr>
    <td>&nbsp;</td>
  </tr>  <tr>    <td>&nbsp;</td>
  </tr>  <tr>    <td>&nbsp;</td>
  </tr>  <tr>    <td style='font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#2f2f2f; font-weight:500;
	text-align:left; padding:0px 10px;'>Dear User,<br />
	<p>Please click the following link to reset your password...<br/>
	<b>".$baseurl."reset.php?code=".base64_encode($_POST['email'])."</b></p></td>
  </tr>  <tr>    <td>&nbsp;</td>
  </tr>
  <tr>    <td>&nbsp;</td>
  </tr>
</table>
</th>  </tr></table></body>
</html>";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <support@rushforme.com>' . "\r\n";
$mail_sent =mail($to,"Forgot Password",$message,$headers);

if($mail_sent)
{
	$mssg="A link has been sent to your mail.Please follow instructions as per the mail...";
}
else
{
	$mssg="Something went wrong please try again latter!";

}

}

include("header2.php");
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
    
	
<div class="gray-container">   
<div class="container">
	<div class="row">
    	<div class="col-md-12">
        	<h3 align="center">Forget Password ?</h3>
        </div>
    </div>
</div>
</div>
</div>
<div class="container">
	<div class="row">
    	<div class="col-md-12">
        <div class="devider1"></div>
            <!--<p align="center"> Please Enter Your Registered Mobile Number and Password To Login</p>-->
            
            <!-- Form Module-->
<div class="module form-module">
  <div class="toggle"><i class="fa fa-lock"></i>
  </div>
  <div class="form">
    <h3>Registered Email ID</h3>
	<p style="color:green;">
	<?php
	if(isset($mssg))
	{
	echo $mssg;
	}
	?></p>
    <form action="" method="post">
      <input type="text" placeholder="Email ID" class="form-control2" name="email"/>
      <button class="btn btn-primary" name="emailsubmit">Submit</button>
    </form>
  </div>

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
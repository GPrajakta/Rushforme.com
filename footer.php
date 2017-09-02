<?php
 //include_once "fbaccess.php";
if(isset($_POST['serviceset']))
{
	$_SESSION["estimation"]='';
 $fromm=$_POST['fromaddress']; 
 $too=$_POST['toaddress'];
 if($fromm=='')
 {
	echo "<script>alert('Please enter Pickup Location');</script>"; 
 }
 else if( $too=='')
 {
	 	echo "<script>alert('Please enter Dropping Location');</script>"; 
 }
 else{

 $picup=$_POST['pickup'];
  //$insertorder=$obj->insertorderdetails($from,$to,$picup);
  $from = urlencode($fromm);
 $to = urlencode($too);
$data = file_get_contents("http://maps.googleapis.com/maps/api/distancematrix/json?origins=$from&destinations=$to&language=en-EN&sensor=false");
$data = json_decode($data);
$time = 0;
$distance = 0;
foreach($data->rows[0]->elements as $road) {
    $time += $road->duration->value;
    $distance += $road->distance->value;
}
$distance=$distance/1000;
$distance=number_format($distance, 2, '.', '');
$time=$time/60;
$time=number_format($time, 2, '.', '');
$_SESSION["ffrom"]=$fromm;
$_SESSION["fto"]=$too;
$_SESSION["fpicupid"]=$picup;
$_SESSION["time"]=$time;
$_SESSION["adades"]=1;
$pkm= mysql_query("SELECT * FROM priceforkm where id='".$picup."'");
$pkmv=mysql_fetch_array($pkm);
// echo $pkmv['price'];

$_SESSION["fpicup"]=$pkmv['price'];
$_SESSION["fdistance"]=$distance;

 $_SESSION["estimation"]=round($_SESSION["fdistance"]*$pkmv['price']);
if($_SESSION['estimation']<100)
{
$_SESSION["estimation"]=100;
}
else{
$_SESSION["estimation"]=$_SESSION["estimation"];
}

 // $orderbd=$obj->getorderbd($insertorder);
 // $orderdet=mysql_fetch_array($orderbd);
 // echo "search details <br/>";
// print_r($_POST);
 $sho="block";
 }
 }


 
if(isset($_POST['msgcom']))
{
 $mmobile=$_POST['mmobile'];
 $memail=$_POST['memail'];
 $mmsg=$_POST['mmsg'];
 if($mmobile=='')
 {
	 echo "<script>alert('Please enter mobile number')</script>";
 }
 else if($memail=='')
 {
	 echo "<script>alert('Please enter Email Id')</script>";
 }
  else if($mmsg=='')
 {
	 echo "<script>alert('Please enter message')</script>";
 }
  else
  {
$log=$obj->createcomsg($mmsg,$memail,$mmobile);
if($log==1)
{
$admob='9000500600';
$message2 ="Hi,Dear Admin message:".$mmsg." Send by ".$memail." having mobile no: ".$mmobile.".<br/>Thank you www.rushforme.com";
$messageadmin = str_replace(" ","%20",$message2);
$linkadmin="http://login.rocktosms.com/api/web2sms.php?workingkey=1499313h210b69009aw9f&sender=RUSHME&to=$admob&message=$messageadmin";   

$admobuser=$_POST['mmobile'];
$message2user="Thank you for choosing Rushforme.com, our agent would get back to you soon";
$messageadminuser = str_replace(" ","%20",$message2user);
$linkadminuser="http://login.rocktosms.com/api/web2sms.php?workingkey=1499313h210b69009aw9f&sender=RUSHME&to=$admobuser&message=$messageadminuser";
$homepage2 = file_get_contents($linkadminuser);

if($homepage=="Invalid Mobile Numbers")
{
$status="Not send";
}
else
{
	$to=$_POST['memail'];

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
	<p>Thank you for choosing Rushforme.com, our agent would get back to you soon...<br/>
	<b><a href='".$baseurl."'>www.rushforme.com</a></b></p></td>
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
$mail_sent =mail($to,"Thankyou ! Rushforme",$message,$headers);
echo "<script>alert('Your message was sent successfully')</script>";
}
}
 }
 }
 //$insertorder=$obj->inse
?>
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">


<!-- footer --> 
 <footer>
 
 <div class="container">
    	<div class="row">
        	<div class="col-md-3 col-sm-3">
            	<h4>news letter subscribe</h4>
                <p>Allow customers to subscribe ti your MailChimp or Campaign Monitor mailling list(s) via a widget or by opting in during 
checkout.</p>
            </div>
            <div class="col-md-2 col-sm-2">
            	<h4>my account</h4>
                <ul>
                	<li><a href="">My account</a></li>
                    <li><a href="">Partner With Us</a></li>
                    <li><a href="">Track order</a></li>
                    <li><a href="">Blog</a></li>
                    <li><a href="">What We Do</a></li>
                   
                </ul>
            </div>
            <div class="col-md-2 col-sm-2">
            	<h4>our services</h4>
                <ul>
                <!---
                	<li><a href="">shipping & return</a></li>
                    <li><a href="">secure shipping</a></li>
                    <li><a href="">affiliates</a></li>
                    <li><a href="">careers</a></li>--->
                    <li><a href="">faq's</a></li>
					<li><a href="blog/index.php">Blog</a></li>
                </ul>
            </div>
            
            <div class="col-md-3 col-sm-3">
            	<h4>contact information</h4>
                <ul>
                <li>6-2-659/3/2/1,White house <br>
opp Shadan college lane,<br />behind sayani's healthcare,<br>chintal basthi, khairtabad</br>hyderabad, telangana, 500004</li>
</ul>

	<h4>phone</h4>
                <ul>
                <li>9000500600</li>
</ul>
            </div>
            
            
            <div class="col-md-2 col-sm-2">
            	
            	<h4>Connect Us :</h4>
                <div class="float-rgt" style="float:left">
                	<ul class="list-unstyled list-inline list-social-icons" style="margin-top:0px">
                    <li>
                        <a href="https://www.facebook.com/search/top/?q=rushforme%20sai"><i class="fa fa-facebook-square fa-2x"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-linkedin-square fa-2x"></i></a>
                    </li>
                    <li>
                        <a href="https://twitter.com/info_rushforme"><i class="fa fa-twitter-square fa-2x"></i></a>
                    </li>
					<li>
						<a href= "https://plus.google.com/u/0/104131179250818009450"><i class="fa fa-google-plus-square fa-2x"></i></a>
					</li>
					<li>
						<a href=""><i class="fa fa-instagram fa-2x"></i></a>
					</li>
                </ul>
				<br>
				<br>
				<ul>
                <li>Terms and Conditions</li>
				
                <li><a href="admin/assets/Terms&Conditions.pdf" target="_blank"><span>Condtions.pdf</a></span></li>

				</ul>
                </div>
            </div>
            
            
        </div>
    </div>
 
 





<script>
   $(document).ready(function(){
	   $(window).bind('scroll', function() {
	   var navHeight = $( window ).height() - 10;
	 if ($(window).scrollTop() > navHeight) {
	 $('nav').addClass('fixed');
	 }
	 else {
	 $('nav').removeClass('fixed');
	 }
	});
	});
</script>
<!-- menu end -->
<script type="text/javascript">
	window.alert = function(){};
	var defaultCSS = document.getElementById('bootstrap-css');
	function changeCSS(css){
	if(css) $('head > link').filter(':first').replaceWith('<link rel="stylesheet" href="'+ css +'" type="text/css" />'); 
	else $('head > link').filter(':first').replaceWith(defaultCSS); 
	}
	$( document ).ready(function() {
	  var iframe_height = parseInt($('html').height()); 
	  window.parent.postMessage( iframe_height, '');
	});
</script>


 </footer>
<!-- footer -->



<!-- popups -->
<!-- services popups -->
<div style="display:none">

<div id="content">
<form name="sentMessage" action="" id=" sentMessage" method="post" >
                    <div class="control-group form-group">
                        <div class="controls">
<input type="text" class="form-control location-ico from" name="fromaddress" id="autocomplete" required="required"
 onclick="this.value='';"  placeholder="PICKUP LOCATION"
onblur="this.value=!this.value?'PICKUP LOCATION':this.value;"   value="PICKUP LOCATION" />
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
<input type="text" class="form-control location-ico to" name="toaddress" required="required"  onclick="this.value='';" 
 placeholder="DROPING LOCATION" onblur="this.value=!this.value?'DROPING LOCATION':this.value;" 
value="DROPING LOCATION"  id="txtDestinationAddress"/>

                        </div>
                    </div>
	
                    <div class="control-group form-group">
                        <div class="controls select-style">
                            <select name="pickup" class="form-control">
                              <?php
	 $priceperkm=mysql_query("select * from priceforkm") or die(mysql_error());
	 while($priceforkm=mysql_fetch_array($priceperkm))
	{
	?>	
	<option  value="<?php echo $priceforkm['id']; ?>"  ><?php echo $priceforkm['textdropdowen'];  ?></option>
	<?php
	}
	?>
                            </select>
                        </div>
                    </div>
	<div class="popModal_footer">
	<button type="submit" class="btn btn-default" id="calculate-route" name="serviceset">Search Your Services</button></div>
      </form>
	

</div>
</div>

<!-- search details -->
<?php

if($sho=='block')
{
?>
<div class="modal-backdrop fade in" style="height: 100%; opacity: .5;position: fixed; z-index: 99;"></div>
<div class="modal in" id="search-modal" tabindex="-1" role="dialog"
 aria-labelledby="myModalLabel" aria-hidden="true" style="display:block;">
	<div class="modal-dialog">
    	<div class="modal-content">
      	<div class="modal-header login_modal_header">
        	<button type="button" class="" onclick="closesearch()" style="float: right; background: transparent; border: 0; color: #C6C6C6; font-size: 21px;">&times;</button>
        	<h2 class="modal-title" id="myModalLabel">Search Details</h2>
      	</div>
	<div class="modal-body login-modal" style="line-height: 30px;">
      	    <p><strong>Pick Up Address</strong>: <?php echo $_SESSION["ffrom"];?></p>
	
    <p><strong>Destination Address</strong>: <?php echo $_SESSION["fto"];?></p>
    <p><strong>Distance</strong>: <?php echo $_SESSION["fdistance"];?></p>
    <p><strong>Time</strong>: <?php echo $_SESSION["time"]."Mins";?></p>
    <p><strong>Price</strong>: <i class="fa fa-rupee"></i> <?php echo $_SESSION["fpicup"];?></p> 
	<p><strong>Estimation charge</strong>: <i class="fa fa-rupee"></i> <?php echo $_SESSION["estimation"];?></p>
     	<?php //print_r($_SESSION);?>  	
        	
      	</div>
      	<div class="clearfix"></div>
      	<div class="modal-footer login_modal_footer">
	<div class="form-group modal-register-btn" style="margin:0px;">
        	<a href="showroute.php" class="btn btn-default" style="width:100%;">PROCEED</a>
        	</div>
      	</div>
    	</div>
  	</div>
</div>
           


<?php

}
?>





<!--other services popups -->
<div style="display:none">
<div id="content2">
	<form action="" id="" method="post" onvalidate>
                    <div class="control-group form-group">
                        <div class="controls">
                            <input type="text" class="form-control mobile-ico" name="mmobile" id="name" onclick="this.value='';" onfocus="this.select()" onblur="this.value=!this.value?'Please Enter Mobile Number':this.value;" value="Please Enter Mobile Number">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <input type="tel" class="form-control email-ico" name="memail" id="name" onclick="this.value='';" onfocus="this.select()" onblur="this.value=!this.value?'Please Enter Email Address':this.value;" value="Please Enter Email Address">
                        </div>
                    </div> 
	<div class="control-group form-group">
                        <div class="controls">
                            <input type="tel" class="form-control email-ico" name="mmsg" id="name" onclick="this.value='';" onfocus="this.select()" onblur="this.value=!this.value?'Please Enter Your Messages':this.value;" value="Please Enter Messages ">
                        </div>
                    </div>
                	<div class="popModal_footer"><button type="submit" name="msgcom" class="btn btn-default">GO</button></div>
	</form>

</div>
</div>

<!--trackorder popups -->
<div style="display:none">
<div id="trackorder">
	<form name="sentMessage" id="contactForm" action="trackorder.php" method="post">
	<div class="control-group form-group">
	Enter Order / Mobile Number to track your Order
	</div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <input type="text" class="form-control2" name="oridmob" id="name" placeholder="Enter Order / Mobile Number">
                        
                    </div>
	</div>
	<div class="control-group form-group">
	<div class="controls">
	<span style="width: 50%; float: left;">
	<input value="OrderNo" name="TrackOrdertype" type="radio" id="" validationgroup="track" checked="checked">
                            <label for="rd01">Order Number</label>
	</span>
	<span style="width: 50%; float: left;">
	<input value="MobileNo" name="TrackOrdertype" type="radio" id="" validationgroup="track" checked="checked">
                            <label for="rd01">Mobile Number</label>
	</span>
	<div class="clearfix"></div>
	</div>
	</div>
	<div class="popModal_footer"><button type="submit" name="trackorder" class="btn btn-default">Track Order</button></div>
	</form>
	

</div>
</div>

<!-- resources popups -->
<div style="display:none">
<div id="content3">
    <ol id="myTab" class="nav nav-tabs nav-justified">
    <div class=""><a href="#service-one" data-toggle="tab">National</a></div>
    <div class=""><a href="#service-two" data-toggle="tab">International</a></div>
    </ol>
    <div id="myTabContent" class="tab-content">
    <div class="tab-pane fade active in" id="service-one">
        <table width="100%" border="0" class="table-responsive">
  <tr>
    <td align="left" valign="middle">Select Days</td>
    <td align="left" valign="middle"><input type="text" class="form-control2" name="name"></td>
    <td align="left" valign="middle">&nbsp;</td>
    <td align="left" valign="middle"><input type="text" class="form-control2" name="name"></td>
  </tr>
  <tr>
    <td align="left" valign="middle">Select Shift</td>
    <td align="left" valign="middle" colspan="3"><select class="form-control2"><option selected="">Select shift Type</option><option>Morning</option><option>Night</option></select></td>
  </tr>
  <tr>
    <td align="left" valign="middle">Select No Of Hours</td>
    <td align="left" valign="middle" colspan="3"><select class="form-control2"><option selected="">Hours</option><option>5 Hours</option><option>9 Hours</option></select></td>
  </tr>
  <tr>
    <td align="left" valign="middle">Select Time</td>
    <td align="left" valign="middle"><input type="text" class="form-control2" name="name"></td>
    <td align="left" valign="middle">&nbsp;</td>
    <td align="left" valign="middle"><input type="text" class="form-control2" name="name"></td>
  </tr>
  <tr>
    <td align="left" valign="middle">Amount</td>
    <td align="left" valign="middle"><input type="text" class="form-control2" name="name"></td>
    <td align="left" valign="middle">&nbsp;</td>
    <td align="left" valign="middle">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="middle" colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="middle" colspan="4">NOTE : Every Additional Hour Would Be Charged 150/- Extra</td>
  </tr>
</table>
	<div class="popModal_footer"><button type="submit" class="btn btn-default">Pay</button><button type="submit" class="btn btn-default">Use Credit</button></div>
    </div>
    <div class="tab-pane fade" id="service-two">
      	<table width="100%" border="0" class="table-responsive">
  <tr>
    <td align="left" valign="middle">Select Days</td>
    <td align="left" valign="middle"><input type="text" class="form-control2" name="name"></td>
    <td align="left" valign="middle">&nbsp;</td>
    <td align="left" valign="middle"><input type="text" class="form-control2" name="name"></td>
  </tr>
  <tr>
    <td align="left" valign="middle">Select Shift</td>
    <td align="left" valign="middle" colspan="3"><select class="form-control2"><option selected="">Select shift Type</option><option>Morning</option><option>Night</option></select></td>
  </tr>
  <tr>
    <td align="left" valign="middle">Select No Of Hours</td>
    <td align="left" valign="middle" colspan="3"><select class="form-control2"><option selected="">Hours</option><option>5 Hours</option><option>9 Hours</option></select></td>
  </tr>
  <tr>
    <td align="left" valign="middle">Select Time</td>
    <td align="left" valign="middle"><input type="text" class="form-control2" name="name"></td>
    <td align="left" valign="middle">&nbsp;</td>
    <td align="left" valign="middle"><input type="text" class="form-control2" name="name"></td>
  </tr>
  <tr>
    <td align="left" valign="middle">Amount</td>
    <td align="left" valign="middle"><input type="text" class="form-control2" name="name"></td>
    <td align="left" valign="middle">&nbsp;</td>
    <td align="left" valign="middle">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="middle" colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="middle" colspan="4">NOTE : Every Additional Hour Would Be Charged $ 2.6 Extra</td>
  </tr>
</table>
	<div class="popModal_footer"><button type="submit" class="btn btn-default">Pay</button><button type="submit" class="btn btn-default">Use Credit</button></div>
    </div>
    </div>
	
</div>
</div>

<script>
function signin()
{
// alert('');

}
</script>

<!--<script src="js/login/modernizr-2.6.2.min.js"></script>-->
<?php
if(isset($page))
{
	if($page=='orderfulldetails')
	{
		$page2=$page;
	}
	else{
		$page2=='';
	}
}
	else{
		$page2=='';
	}
?>
<script>
 $(document).ready(function()
{
	var page='<?php echo $page2;?>';
		// alert(page);
	if(page=="orderfulldetails")
	{
	
$('#login-modal').modal('show');

	}
});


</script>
<div class="modal fade <?php echo $clas;?>" id="login-modal" tabindex="-1" role="dialog"
 aria-labelledby="myModalLabel" aria-hidden="<?php echo $hid;?>" style="<?php echo $opacity;?>">
<div class="modal-backdrop fade in"  style="<?php echo $bgopa;?>"></div>
	<div class="modal-dialog">
    	<div class="modal-content" id="logihhnid">
      	<div class="modal-header login_modal_header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="<?php echo $hid;?>"
	<?php echo $hidfun;?>>&times;</button>
        	<h2 class="modal-title" id="myModalLabel">Login to  Your Account</h2>
      	</div>
      	<div class="modal-body login-modal">
      	<p>Rushforme one-stop destination for all your personal and business needs</p>
      	<br/>
      	<div class="clearfix"></div>
      	<div id='social-icons-conatainer'>
	        	<div class='modal-body-left'>
	<span style="color:red">
	<?php 
	if(isset($_SESSION['errorlogin']))
	{
	echo $_SESSION['errorlogin'];
	}?></span>
<form id="defaultForm" method="post" action=""  enctype="multipart/form-data"">
	        	<div class="form-group">
	              	<input type="text" id="username" placeholder="Enter your Email or Mobileno" name="email" class="form-control2 login-field">
	              	<i class="fa fa-user login-field-icon"></i>
	            	</div>
	
	            	<div class="form-group">
	            	  	<input type="password" id="login-pass" placeholder="Password" name="password" class="form-control2 login-field">
	              	<i class="fa fa-lock login-field-icon"></i>
	            	</div>
	
<input type="submit" class="btn btn-success" name="login"  value="Login" style="display:block; width:100%;margin-bottom:15px;"/>

	            	<a href="forget.php" class="login-link text-center">Lost your password?</a>
	        	</form>
	</div>
	        	
	        	<div class='modal-body-right'>
	        	<div class="modal-social-icons">
<a class="btn btn-default facebook" onclick="FBLogin();"  alt="Fb Connect"> 
<i class="fa fa-facebook modal-icons"></i> Sign In with Facebook </a>
	<!---<img src="facebook-connect.png" alt="Fb Connect" title="Login with facebook" onclick="FBLogin();"/>---->
<?php
  // if(isset($authUrl)) {
    // print "<a class='login' href='$authUrl'>Google Account Login</a>";
  // } else {
   // print "<a class='logout' href='?logout'>Logout</a>";
  // }
?>	        	
<a href='javascript:' onclick="googlelog();" class="btn btn-default google"> 
<i class="fa fa-google-plus modal-icons"></i> Sign In with Google </a>
	        	
	        	</div> 
	        	</div>	
	        	<div id='center-line'> OR </div>
	        	</div>	
        	<div class="clearfix"></div>
        	</div>
      	<div class="clearfix"></div>
      	<div class="modal-footer login_modal_footer">
	<div class="form-group">
      <a href="register.php" ><button class="btn btn-default"> New User Please Register</button></a>
        	</div>
      	</div>
    	</div>
  	</div>
</div>
<script>
function closesearch()
{
	$('#search-modal').hide();
$(".modal-backdrop").hide();
}
</script>
<script>
function loginform()
{
	//alert("123testing");
var loguser = $('#lopass').val();
var logpass = $('#username').val();
$.post("logincheck.php",{loguser:loguser,logpass:logpass},function(data) {
if(data==1)
{
 location.reload();
}
else
{
	$('#login-modal').modal('show');
}
 ///$(".delresult").html(data);
});
}
</script>


<script type="text/javascript">
window.fbAsyncInit = function() {
	FB.init({
	appId      : '1685465574999055', // replace your app id here
	channelUrl : 'http://rushforme.com/index.php', 
	status     : true, 
	cookie     : true, 
	xfbml      : true  
	});
};
(function(d){
	var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
	if (d.getElementById(id)) {return;}
	js = d.createElement('script'); js.id = id; js.async = true;
	js.src = "//connect.facebook.net/en_US/all.js";
	ref.parentNode.insertBefore(js, ref);
}(document));

function FBLogin(){
	FB.login(function(response){
	if(response.authResponse){
	var pathname = window.location.pathname; 
var url      = window.location.href; 
// alert(pathname);
// alert(url);

	window.location.href = "index.php?action=fblogin";
	}
	}, {scope: 'email,user_likes'});
}
</script>
<script>
function googlelog()
{
// alert("alekhyaaaaaaaaaaaa");
	window.location="<?php echo $authUrl; ?>";
}
</script>
<!--
<link type="text/css" rel="stylesheet" href="js/popmodel/popmodal.css"/>
<script src="js/popmodel/popmodal.js"></script>
<script>
$(function(){
	
	$('#notifyModal_ex1').click(function(){
	$('#content').notifyModal({
	duration : 2500,
	placement : 'center',
	overlay : true,
	type : 'notify',
	onClose : function() {}
	});
	});

	
	$('#notifyModal_ex2').click(function(){
	$('#content2').notifyModal({
	duration : 2500,
	placement : 'center',
	overlay : true,
	type : 'notify',
	onClose : function() {}
	});
	});
	
	$('#notifyModal_ex3').click(function(){
	$('#content3').notifyModal({
	duration : 2500,
	placement : 'center',
	overlay : true,
	type : 'notify',
	onClose : function() {}
	});
	});
	
	$('#notifyModal_ex4').click(function(){
	$('#trackorder').notifyModal({
	duration : 2500,
	placement : 'center',
	overlay : true,
	type : 'notify',
	onClose : function() {}
	});
	});
	

	/* tab */
(function($) {
	$.fn.tab = function(method){
	
	var methods = {
	init : function(params) {

	$('.tab').click(function() {
	var curPage = $(this).attr('data-tab');
	$(this).parent().find('> .tab').each(function(){
	$(this).removeClass('active');
	});
	$(this).parent().find('+ .page_container > .page').each(function(){
	$(this).removeClass('active');
	});
	$(this).addClass('active');
	$('.page[data-page="' + curPage + '"]').addClass('active');
	});
	
	}
	};

	if (methods[method]) {
	return methods[method].apply( this, Array.prototype.slice.call(arguments, 1));
	} else if (typeof method === 'object' || ! method) {
	return methods.init.apply(this, arguments);
	}
	
	};
	$('html').tab();
})(jQuery);
	
});
</script>
   <script>
   function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
   </script>-->
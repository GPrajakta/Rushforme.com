<?php
// session_start();
//print_r($user_info);
 include_once('dbfunction.php');
  include_once "fbaccess.php";
  $obj = new dbfunction();
// if (!isset($_SESSION['google_data'])) {
   // Redirection to login page twitter or facebook
   // header("location: index2.php");
// }
// else
//print_r($_SESSION['google_data']);
if (isset($_SESSION['google_data'])) {
    // Redirection to login page twitter or facebook
    //header("location: index.php");
//}
//else
// if (isset($_SESSION['google_data']))
//{
//echo 
$userdata=$_SESSION['google_data'];
//print_r($userdata);
$email =$userdata['email'];
$googleid =$userdata['id'];
$fullName =$userdata['name'];
$firstName=$userdata['given_name'];
$lastName=$userdata['family_name'];
$gplusURL=$userdata['link'];
 $avatar=$userdata['picture'];
$gender=$userdata['gender'];
$dob=$userdata['birthday'];
$cityid=1;
$sqle=mysql_query("select * from userdetails where emailid='".$email."'");
$ret=mysql_num_rows($sqle);	
	 $get_det=mysql_fetch_array($sqle);
if($ret<1)
{
//echo "insert into register(`email`,`fullname`,`firstname`,`lastname`,`google_id`,`gender`,`dob`,`profile_image`,`gpluslink`) values
//('$email','$fullName','$firstName','$lastName','$googleid','$gender','$dob','$avatar','$gplusURL')";
//Execture query
$loginwith='gmail';
$sql=mysql_query("insert into register(`email`,`fullname`,`firstname`,`lastname`,`google_id`,`gender`,`dob`,`profile_image`,`gpluslink`) values
('$email','$fullName','$firstName','$lastName','$googleid','$gender','$dob','$avatar','$gplusURL')");
$qry=mysql_query("INSERT INTO  `userdetails` (`userid`,`name` ,`lastname`,`gender`,`image` ,`address`,`mobileno`,`emailid`,`Date`,`status`,`accounttype`,`password`,`cityid`,`loginwith` )
VALUES ('','$firstName','$lastName','$gender','$avatar','','','$email',NOW(),'Active','','','$cityid','$loginwith')") or die(mysql_error());
 
 $_SESSION['email']=$email;
 $_SESSION['img']=$avatar;
$_SESSION['username']=$firstName." ".$lastName;
	//$_SESSION['mobileno']='';	
	//$_SESSION['address']=$get_det['address'];	
	$_SESSION['uid']=mysql_insert_id();
	$_SESSION['ucityid']=1;


}
else
{
 // $get_det=mysql_fetch_array($log);
	//print_r($get_det);
 $_SESSION['email']=$get_det['emailid'];
 $_SESSION['img']=$get_det['image'];
$_SESSION['username']=$get_det['name']." ".$get_det['lastname'];
	$_SESSION['mobileno']=$get_det['mobileno'];	
	$_SESSION['address']=$get_det['address'];	
	$_SESSION['uid']=$get_det['userid'];
	$_SESSION['ucityid']=1;
	}
	}

	?>


<!DOCTYPE html>
<html lang="en">

<head>
<?php
if(isset($_POST['login']))
{
$emailid=$_POST['email'];
$password=$_POST['password'];
 $objj = new dbfunction();
$log=$obj->checkuserLogin($emailid,$password);
if($log)
	{

	$get_det=mysql_fetch_array($log);
	//print_r($get_det);
 $_SESSION['email']=$get_det['emailid'];
$_SESSION['username']=$get_det['name']." ".$get_det['lastname'];
	$_SESSION['mobileno']=$get_det['mobileno'];	
	$_SESSION['address']=$get_det['address'];	
	$_SESSION['uid']=$get_det['userid'];
	$_SESSION['ucityid']=1;
	//print_r($_SESSION);
header("Location:index.php");
		
	}
}


include("header.php");
?>
</head>

  <body onload="initialize()">
<nav>
<?php

include("menu.php");
?>
</nav>


<!-- body Carousel -->
<div class="background"></div>
<!-- body Carousel -->
    
<!-- Page Content -->
<div class="yellow-container">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-8">
                <h1>r u still waiting?</h1>
                <h3>Rushforme<br>
one-stop destination<br>
for all your personal and business needs</h3>
<p>Express logistics services to be expanded to 4+ cities in india,Middle-East and South-Asia<br>
12 more fulfilment centers being expanded to offer Delhivery Fulfilment Services. </p>
<div class="plus-icon"><a href=""><img src="images/plus-icon.png" width="47" height="47"></a></div>
            </div>
            <div class="col-md-4 col-sm-4 text-right"><img src="images/telephone.png" class="img-responsive"></div>
        </div>
    </div>
</div>
<!-- /.container -->

<!-- middle container -->
<div class="container">
    <div class="row">
        <div class="col-md-7 col-sm-7">
        	<div class=" devices-container">
        		<img src="images/devices.png" class="img-responsive">
            </div>
            </div>
        <div class="col-md-5 col-sm-5">
        	<div class="devices-text">
            Where ever you are<br>
we assure you<br>
<strong>serve your goods</strong> intimeley
<p><a href="">how it works?</a></p>
        </div>
        </div>
    </div>
</div>
<!-- container end -->
    
<!-- Page waterfall -->
<div class="mosaicflow" data-item-height-calculation="attribute">
		<div class="mosaicflow__item">
			<img width="390" height="300" src="images/service-1.png" alt="">
			<p>DOCUMENT DELIVERY</p>
		</div>

		<div class="mosaicflow__item">
			<img width="300" height="200" src="images/service-3.png"  alt="">
			<p>FOOD DELIVERY</p>
		</div>

		<div class="mosaicflow__item">
			<img width="300" height="300" src="images/service-5.png"  alt="">
			<p>PRESONAL FILES DELIVERY</p>
		</div>

		<div class="mosaicflow__item last_item">
			<img width="300" height="200" src="images/service-7.png"  alt="">
			<p>PERSONAL GIFTS</p>
		</div>

		<div class="mosaicflow__item">
			<img width="300" height="200" src="images/service-2.png"  alt="">
			<p>Dessi Meets the Sea</p>
		</div>

		<div class="mosaicflow__item">
			<img width="300" height="200" src="images/service-4.png"  alt="">
			<p>FOOD DELIVERY</p>
		</div>

		<div class="mosaicflow__item">
			<img width="300" height="100" src="images/service-6.png"  alt="">
			<p>PERSONAL GIFTS</p>
		</div>

		<div class="mosaicflow__item last_item">
			<img width="300" height="300" src="images/service-8.png"  alt="">
			<p>PERSONAL FOOD</p>
		</div>

		
	
	</div>
<!-- waterfall end -->     
<div class="content2"></div> 
<div class="devider1"></div> 
 
<!-- why rush box -->      
<div class="container">
	<div class="row">
    	<div class="col-md-2 col-sm-2"></div>
        <div class="col-md-4 col-sm-4">
        	<div class="why-use-container">
            	<h1>why use<br>
 <strong>rush for me</strong></h1>
 <p>Express logistics services to be expanded to 4+ cities in India, Middle-East and South-Asia 12 more fulfilment center being
expanded to offer Delhivery Fulfilment Services across India (over 0.5 million sq ft of space) Expansion of processing capacity to over 2,50,000 shipments/day</p>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 why-use-rgt">
        	<h5>save your time</h5>
            <p>Helps you live smarter and apend more time relaxing and doing what's important to you</p>
            <h5>get it right</h5>
            <p>Skilled labor and errand services to manage your productive and unproductive – but necessary tasks with trusted people who are 100% accountable for 
quality service</p>
            <h5>Professional Service</h5>
            <p>Professional runners, trained and background verified, who can make the difference between customer satisfaction and client delight.</p>
            <h5>Secure you product</h5>
            <p>Shipment or item is protected by a password, photocopy of the item and a tag duly signed by you.</p>
            <h5>Track your order</h5>
            <p>Professional service with latest technology, runner tracking, option to chat; Track your order and receive SMS at each stage of execution</p>
            <h5>Save your money</h5>
            <p>Affordable and reliable personal assistance and errand running service, helps you save your energy and time, </p>
        </div>
    </div>
</div>       
<!-- box end -->

<!-- testmonials -->    
<div class="testmonials-bg">
	<div class="container">
<div class="row">
                    <div class="col-md-12" data-wow-delay="0.2s">
                        <div class="carousel slide" data-ride="carousel" id="quote-carousel">
                            <!-- Bottom Carousel Indicators -->
                             <ol class="carousel-indicators">
                                <li data-target="#quote-carousel" data-slide-to="0" class=""><img class="img-responsive" src="images/testi-3.jpg" alt=""/></li>
                                <li data-target="#quote-carousel" data-slide-to="1" class=""><img class="img-responsive" src="images/testi-2.jpg" alt=""/></li>
                                <li class="active" data-target="#quote-carousel" data-slide-to="2"><img class="img-responsive" src="images/testi-1.jpg" alt=""/></li>
                                <li data-target="#quote-carousel" data-slide-to="3" class=""><img class="img-responsive" src="images/testi-5.jpg" alt=""/></li>
                                <li data-target="#quote-carousel" data-slide-to="4" class=""><img class="img-responsive" src="images/testi-4.jpg" alt=""/></li>
                                <div class="clear"></div>
                            </ol>
								<div class="clear"></div>
                            <!-- Carousel Slides / Quotes -->
                           		<div class="carousel-inner text-center">

                                <!-- Quote 1 -->
                                <div class="item">
                                    <blockquote>
                                        <div class="row">
                                            <div class="col-sm-10 col-sm-offset-1">

                                                <p>Express logistics services to be expanded to 4+ cities in India, Middle-East and South-Asia 12 more fulfilment centers being expanded to offer Delhivery Fulfilment Services across India (over 0.5 million sq ft of space) Expansion of processing capacity to over 2,50,000 shipments/day</p>
                                                <small>Anil Bharadwaj (Business men)</small>
                                            </div>
                                        </div>
                                    </blockquote>
                                </div>
                                <!-- Quote 2 -->
                                <div class="item">
                                    <blockquote>
                                        <div class="row">
                                            <div class="col-sm-10 col-sm-offset-1">

                                                <p>Express logistics services to be expanded to 4+ cities in India, Middle-East and South-Asia 12 more fulfilment centers being expanded to offer Delhivery Fulfilment Services across India (over 0.5 million sq ft of space) Expansion of processing capacity to over 2,50,000 shipments/day</p>
                                                <small>Anil Bharadwaj (Business men)</small>
                                            </div>
                                        </div>
                                    </blockquote>
                                </div>
                                <!-- Quote 3 -->
                                <div class="item active">
                                    <blockquote>
                                        <div class="row">
                                            <div class="col-sm-10 col-sm-offset-1">

                                                <p>Express logistics services to be expanded to 4+ cities in India, Middle-East and South-Asia 12 more fulfilment centers being expanded to offer Delhivery Fulfilment Services across India (over 0.5 million sq ft of space) Expansion of processing capacity to over 2,50,000 shipments/day</p>
                                                <small>Anil Bharadwaj (Business men)</small>
                                            </div>
                                        </div>
                                    </blockquote>
                                </div>
                                <!-- Quote 4 -->
                                <div class="item">
                                    <blockquote>
                                        <div class="row">
                                            <div class="col-sm-10 col-sm-offset-1">

                                                <p>Express logistics services to be expanded to 4+ cities in India, Middle-East and South-Asia 12 more fulfilment centers being expanded to offer Delhivery Fulfilment Services across India (over 0.5 million sq ft of space) Expansion of processing capacity to over 2,50,000 shipments/day</p>
                                                <small>Anil Bharadwaj (Business men)</small>
                                            </div>
                                        </div>
                                    </blockquote>
                                </div>
                                <!-- Quote 5 -->
                                <div class="item">
                                    <blockquote>
                                        <div class="row">
                                            <div class="col-sm-10 col-sm-offset-1">

                                                <p>Express logistics services to be expanded to 4+ cities in India, Middle-East and South-Asia 12 more fulfilment centers being expanded to offer Delhivery Fulfilment Services across India (over 0.5 million sq ft of space) Expansion of processing capacity to over 2,50,000 shipments/day</p>
                                                <small>Anil Bharadwaj (Business men)</small>
                                            </div>
                                        </div>
                                    </blockquote>
                                </div>
                            </div>
                            
                            <!-- Carousel Buttons Next/Prev -->
                            <!--<a data-slide="prev" href="#quote-carousel" class="left carousel-control"><i class="fa fa-chevron-left"></i></a>
                            <a data-slide="next" href="#quote-carousel" class="right carousel-control"><i class="fa fa-chevron-right"></i></a>-->
                        </div>
                    </div>
                </div>
</div>
</div>       
<!-- testmonials end  --> 

<!-- contact information -->
<div class="contact-container">        
	<div class="container">
    	<div class="row">
        	<div class="col-md-4 col-sm-4">
            	<div class="contact-information clearfix">
            	<div class="icon"><img src="images/icons-support.png"></div>
                <h4>
                	<p>Customer support</p>
                     +91-9000 500 600
                </h4>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
            <div class="contact-information clearfix">
            	<div class="icon"><img src="images/icons-mail.png"></div>
                <h4>
                	<p>Email support</p>
                     <span class="yellow-clr">info@rushforme.com</span>
                </h4>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
            <div class="contact-information clearfix">
            	<div class="icon"><img src="images/icons-mobile.png"></div>
                <h4>
                	<p>Mobile and email updates</p>
                     <span class="blue-clr">keep logon</span>
                </h4>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- contact information -->
 
<!-- timers -->      
<div class="timers-container">
	<div class="container">
    	<div class="row">
        	<div class="col-md-2 col-sm-2 text-center red-clr" id="counter">
            	<div class="prod-top count">52</div>
        		<div class="prod-text">Active Customers</div>
            </div>
            <div class="col-md-2 col-sm-2 text-center red-clr" id="counter">
            	<div class="prod-top count">25000</div>
        		<div class="prod-text">Online users</div>
            </div>
            <div class="col-md-2 col-sm-2 text-center red-clr" id="counter">
            	<div class="prod-top count">250</div>
        		<div class="prod-text">Registerd users</div>
            </div>
            <div class="col-md-2 col-sm-2 text-center red-clr" id="counter">
            	<div class="prod-top count">120</div>
        		<div class="prod-text">Registerd clients</div>
            </div>
            <div class="col-md-2 col-sm-2 text-center red-clr" id="counter">
            	<div class="prod-top count">24</div>
        		<div class="prod-text">Employees</div>
            </div>
            <div class="col-md-2 col-sm-2 text-center red-clr" id="counter">
            	<div class="prod-top count">670</div>
        		<div class="prod-text">Goods delivered</div>
            </div>
        </div>
    </div>
</div>      
<!-- timers end-->       
        


    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>
<!-- slider -->   
<link rel="stylesheet" href="js/slider/jquery.fadeshow-0.1.1.min.css" />
<script src="js/slider/jquery.fadeshow-0.1.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){
var fadeShow = $(".background").fadeShow({
    correctRatio: true,
    shuffle: true,
    speed: 10000,
    images: ['images/banner.jpg',
             'images/banner2.jpg',
             ]
});
});
</script>
<!-- slider end --> 
 <script type="text/javascript"><!--
 google_ad_client = "pub-6904774409601870";
 /* 728x90, created 2/8/10 */
 google_ad_slot = "4242245788";
 google_ad_width = 728;
 google_ad_height = 90;
 //-->
 </script> 
 <script type="text/javascript"
 src="http://pagead2.googlesyndication.com/pagead/show_ads.js"> 
 </script> 
<h1></h1>
<div>
<?php include('google_login.php'); ?>
</div>


<!-- waterfall -->
<script src="js/waterfall/jquery.mosaicflow.js"></script>
<!-- waterfall -->

<!-- counters -->
<script src="js/index.js"></script>

<!-- testmonials indicators -->
<link rel="stylesheet" href="css/indicators.css"/>

<?php

include("footer.php");
?>
</body>

</html>

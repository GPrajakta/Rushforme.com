<?php
	//print_r($_SESSION);
/*	echo'	<script>
window.onload=function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
	}
function showPosition(position) {
document.cookie="latttitude=" + position.coords.latitude;
document.cookie="longitude=" + position.coords.longitude;

}
</script>';
	*/?>
	
<!DOCTYPE html>
<html lang="en">
<head>
<?php
session_start();
include("header.php");
include_once('dbfunction.php');
 $obj = new dbfunction();
if(isset($_POST['login']))
{
$emailid=$_POST['email'];
$password=$_POST['password'];
 $objj = new dbfunction();
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
$erroor=='';
header("Location:".$_SESSION['urlll']);
			}
	else
	{
	$_SESSION['errorlogin']='Invalid User name and Password';
	// echo " <li class='sign-bg'><a href='#' id='modal-launcher' data-toggle='modal' data-target='#login-modal'>Sign in</a></li>";
	 // echo "<script>
// var erroor='1';	 
		 // alert(erroor);
	   // </script>";	
	
//echo "<script type='text/javascript'> $(document).ready(function(){   document.getElementById('login-modal').style.display = 'inline';	});</script>";
	//echo $erroor='1';
	// header("Location:".$_SESSION['urlll']);
	}
}


?>

</head>

  <body onload="initialize()">
<nav>
<?php

include("menu.php");

?>
</nav>

<div class="container">
	<div class="row">
		<div class="col-md-5 col-sm-7 col-md-push-7 col-sm-push-5">
		<div style="   position: absolute;    top: 220px;    z-index: 9;width:80%;">
		
		<ul id="myTab" class="nav nav-tabs nav-justified">
                    <li class="active"><a href="#service-one" data-toggle="tab" aria-expanded="false">Services</a>
                    </li>
                    <li class=""><a href="#service-two" data-toggle="tab" aria-expanded="true">Other Services</a>
                    </li>
                    <!-----<li class=""><a href="#service-three" data-toggle="tab">My Credits</a>
                    </li>--->
                    </ul>
		<div id="myTabContent" class="tab-content" style="background:white;padding:2%;border:0;border-bottom-right-radius: 10px;
    border-bottom-left-radius: 10px;    border-top-right-radius: 10px;">
                    <div class="tab-pane fade active in" id="service-one" style="border:0;">
              
                        <div class="row">
						 <form name="sentMessage" action="" id=" sentMessage" method="post" >
                    <div class="control-group form-group">
                        <div class="controls">
<input type="text" class="form-control location-ico from" name="fromaddress" id="autocomplete" required
 onclick="this.value='';" placeholder="Pickup Location" value="" />
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
<input type="text" class="form-control location-ico to" name="toaddress" required  onclick="this.value='';" 
 placeholder="Dropping Location" 
value=""  id="txtDestinationAddress"/>

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
	<button type="submit" class="btn btn-default" id="calculate-route" name="serviceset"
	style="width: 100%;">Submit</button></div>
      </form>

						</div>
			
			
					</div>
                    <div class="tab-pane fade table-responsive " id="service-two"  style="border:0;">
                          
     
                        <div class="row">
						   <form action="" id="" method="post" onvalidate>
                    <div class="control-group form-group">
                        <div class="controls">
                            <input type="text" class="form-control mobile-ico" name="mmobile" id="name"
							Placeholder="Please Enter Mobile Number">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <input type="tel" class="form-control email-ico" name="memail" id="name"
													Placeholder="Please Enter Email Address">
                        </div>
                    </div> 
	<div class="control-group form-group">
                        <div class="controls">
                            <input type="tel" class="form-control email-ico" name="mmsg" id="name" 
							Placeholder="Please Enter Message "/>
                        </div>
                    </div>
                	<div class="popModal_footer"><button type="submit" name="msgcom" 
					class="btn btn-default" style="width: 100%;">GO</button></div>
	</form>
 
						</div>
			
			
					</div>
					
                    </div>
                    </div>
		
		

		
		
		</div>
	</div>
</div>
<!-- body Carousel -->
<div class="background"></div>
<!-- body Carousel -->
 
<!-- Page Content -->
<div class="yellow-container">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-8" style="margin-top:30px">
                <h1>r u still waiting?</h1>
                <h3>Rushforme<br>
one-stop destination<br>
for all your personal and business needs</h3>

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
            <Div class="style-top" style="margin-top:150px;">
            	<h1>why use<br>
 <strong>rush for me</strong></h1>
 </Div>
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

<p>
Rushforme makes our life's easy, I have been using this service for past one year, 
now I can't imagine my life without it, half of my work is taken care by them, I use their services every now and then

</p>
                                                <small>Jyothi (Artist)</small>
                                            </div>
                                        </div>
                                    </blockquote>
                                </div>
                                <!-- Quote 2 -->
                                <div class="item">
                                    <blockquote>
                                        <div class="row">
                                            <div class="col-sm-10 col-sm-offset-1">

<p>
I had to deliver an important item to one of my friends at the airport with in few hours, I kept calling my friends and relatives to get the job done, however, did not get help from them, Rushforme become my savior, it got the delivery done on time


</p>
                                                <small>Meenakshi (Fashion Designer)</small>
                                            </div>
                                        </div>
                                    </blockquote>
                                </div>
                                <!-- Quote 3 -->
                                <div class="item active">
                                    <blockquote>
                                        <div class="row">
                                            <div class="col-sm-10 col-sm-offset-1">

<p>
I used to spend my weekends just to take care of my mundane tasks, now I am able to spend more time with my kids and family, because most of things are taken care by Rushforme during the weekdays itself


</p>
                                                <small>Praveen (Works at TCS)</small>
                                            </div>
                                        </div>
                                    </blockquote>
                                </div>
                                <!-- Quote 4 -->
                                <div class="item">
                                    <blockquote>
                                        <div class="row">
                                            <div class="col-sm-10 col-sm-offset-1">

<p>
Wonderful service, fast and efficient, just like the name indicates, they rush for me.


</p>
                                                <small>Megha (Student)</small>
                                            </div>
                                        </div>
                                    </blockquote>
                                </div>
                                <!-- Quote 5 -->
                                <div class="item">
                                    <blockquote>
                                        <div class="row">
                                            <div class="col-sm-10 col-sm-offset-1">

<p>
A unique service, I have not seen such kind of service before, they act as per our instructions with complete professionalism, they wait if the parcel is not ready, they bargain for me if I ask them to buy something, send me the photos in whatsapp for me to select the item, thanks rushforme 



</p>
                                                <small>Sunitha (Business Woman)</small>
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
            	<div class="prod-top count">500</div>
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
            	<div class="prod-top count">1670</div>
        		<div class="prod-text">Stores</div>
            </div>
        </div>
    </div>
</div>      
<!-- timers end-->       
        



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

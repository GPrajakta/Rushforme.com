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
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="format-detection" content="telephone=no">
<title>Rushforme</title>

<!-- SET: FAVICON -->
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
<!-- END: FAVICON -->

<!-- SET: STYLESHEET -->
<link href="Kkreativecss/style.css" rel="stylesheet" type="text/css" media="all">
<link href="Kkreativecss/responsive.css" rel="stylesheet" type="text/css" media="all">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
<link href="Kkreativecss/bxslider.css" rel="stylesheet" type="text/css" media="all">
<link href="css/modern-business.css" rel="stylesheet" type="text/css" media="all">
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all">



<!-- END: STYLESHEET -->

<!-- SET: SCRIPTS -->
	<script type="text/javascript" src="Kkreativejs/kkjquery-1.10.2.js"></script>
    <script type="text/javascript" src="Kkreativejs/bxslider.js"></script>
	<script type="text/javascript" src="Kkreativejs/jquery-filestyle.min.js"></script>
    <script type="text/javascript">
		$(document).ready(function() {
			$(":file").jfilestyle({
				input: false,
				buttonText: "",
				input:[name='attachment[]']
			});
            $('.banner .bxslider').bxSlider({
				  auto: 'true',
				  autoControls: true,
				  pause:6000
				
			});
            $('#slide_2 .bxslider').bxSlider({
				  auto: true,
				  autoControls: false,
				  pause:5000
			});
			
	
			$('#menu').click(function(){
				$('.nav_bar nav ul').slideToggle('slow', function(){
					if($('.nav_bar nav ul').is(':visible')){
						$('#menu').addClass('active');
					}else{
						$('#menu').removeClass('active');
					}
				});
			});
			if ($(window).width() > 767) {
				$( 'nav ul li' ).hover(
						function(){
							$(this).children('nav ul li ul').slideDown(200);
						},
						function(){
							$(this).children('nav ul li ul').slideUp(500);
						});
						
				}
			if ($(window).width() <=767) {
				$( '.nav_bar nav > ul > li > a' ).click(function() {
                    $(this).parent().find('.nav_bar nav ul li ul').slideDown('slow');
                    $(this).parent().siblings().find('.nav_bar nav ul li ul').slideUp('slow');
                });
				
				}

			$(window).scroll(function() {    
						 if ($(document).scrollTop() >30 ) {
							$("#sticky").addClass("sticky1");
							}
							else{
								$('#sticky').removeClass('sticky1');
								}
						});



        });
	</script>
<!-- END: SCRIPTS -->

<!-- SET: IE SCRIPTS -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<!-- END: IE SCRIPTS -->


</head>

<body>



            <!-- maincontent Starts -->
            <div class="main_content_about careers">
                 
            	<div class="about_left">
                	<img src="images/banner_pic_about.jpg" alt="Innovation Is The Way You Apply Ideas" >
                    <h3>careers<span>Innovation is the way you apply ideas</span></h3>
                    <div class="over_view_block creers">
                    	<h2>careers / current openings </h2>
                        <p>Below are the current open positions with Rushforme. 
                        Please view the details for more information and apply if you are interested. Alternatively, you may <small>submit you’re resume</small> 
                        for general consideration.</p>
                        <h5>Careers / Employee Referral Program  (Refer a Friend) </h5>
                        <p>We welcome referrals of any candidates who would make an outstanding addition to the Rushforme team. We are looking for 
                        professionals committed to creating, developing and implementing innovative technology and business solutions for our customers.</p>

                        
						
                        <h5>Candidate information </h5>
                        
                        <div class="careers_form">
                        	<ul>
                            	<li><!--Hello this is newly  edited comment!  -->
                             	   <input type="text" value="Candidate name " onclick="if(this.value=='Candidate name ')(this.value='')" 
                                   onblur="if(this.value=='')(this.value='Candidate name ')">
                                </li>
                            	<li><input type="text" value="Candidate phone number " onclick="if(this.value=='Candidate phone number ')(this.value='')" 
                                	onblur="if(this.value=='')(this.value='Candidate phone number ')">
                                </li>
                            	<li>
                                	<input type="text" value="Rushforme Job ID ( or type “general”)" onclick="if(this.value=='Rushforme Job ID ( or type “general”)')(this.value='')" 
                                    onblur="if(this.value=='')(this.value='Rushforme Job ID ( or type “general”)')">
                                </li>
                            	<li>
                                	<input type="text" value="Candidate email" onclick="if(this.value=='Candidate email')(this.value='')" 
                                    onblur="if(this.value=='')(this.value='Candidate email')">
                                </li>
                            	<li>
                                	<input type="text" value="Candidate Current Working company" onclick="if(this.value=='Candidate Current Working company')(this.value='')" 
                                    onblur="if(this.value=='')(this.value='Candidate Current Working company')">
                                </li>
                            	<li>
                                    <input type="file" name="attachment[]?" class="jfilestyle" data-buttonText="Attach Resume">
                                    <div class="tooltip"><p>Select Your Resume</p></div>
                                </li>
                            </ul>
                            <span class="clear">&nbsp;</span>
                            
                            <h5>You’re information</h5>
							<p>Are you a current Rushforme employee? 
                            	<label><span>Yes</span> <input type="radio" name="employee"></label>
                                <label><span>NO</span> <input type="radio" name="employee"></label>
                            </p>
                        	<ul>
                            	<li>
                             	   <input type="text" value="You’re Name" onclick="if(this.value=='You’re Name')(this.value='')" 
                                   onblur="if(this.value=='')(this.value='You’re Name')">
                                </li>
                            	<li><input type="text" value="You’re Phone number" onclick="if(this.value=='You’re Phone number')(this.value='')" 
                                	onblur="if(this.value=='')(this.value='You’re Phone number')">
                                </li>
                            	<li>
                                	<input type="text" value="Name of Current Employer" onclick="if(this.value=='Name of Current Employer')(this.value='')" 
                                    onblur="if(this.value=='')(this.value='Name of Current Employer')">
                                </li>
                            	<li>
                                	<input type="text" value="You’re Email" onclick="if(this.value=='You’re Email')(this.value='')" 
                                    onblur="if(this.value=='')(this.value='You’re Email')">
                                </li>
                               	<li class="submit_prnt"><input type="submit" value="SUBMIT" name="submit"><span class="clear">&nbsp;</span></li> 
                               
                            </ul>
                            <span class="clear">&nbsp;</span>
                        
                        </div>
                        
                    </div>
                    
                </div>        
               
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

<script>
var TxtType = function(el, toRotate, period) {
        this.toRotate = toRotate;
        this.el = el;
        this.loopNum = 0;
        this.period = parseInt(period, 10) || 2000;
        this.txt = '';
        this.tick();
        this.isDeleting = false;
    };

    TxtType.prototype.tick = function() {
        var i = this.loopNum % this.toRotate.length;
        var fullTxt = this.toRotate[i];

        if (this.isDeleting) {
        this.txt = fullTxt.substring(0, this.txt.length - 1);
        } else {
        this.txt = fullTxt.substring(0, this.txt.length + 1);
        }

        this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

        var that = this;
        var delta = 200 - Math.random() * 100;

        if (this.isDeleting) { delta /= 2; }

        if (!this.isDeleting && this.txt === fullTxt) {
        delta = this.period;
        this.isDeleting = true;
        } else if (this.isDeleting && this.txt === '') {
        this.isDeleting = false;
        this.loopNum++;
        delta = 500;
        }

        setTimeout(function() {
        that.tick();
        }, delta);
    };

    window.onload = function() {
        var elements = document.getElementsByClassName('typewrite');
        for (var i=0; i<elements.length; i++) {
            var toRotate = elements[i].getAttribute('data-type');
            var period = elements[i].getAttribute('data-period');
            if (toRotate) {
              new TxtType(elements[i], JSON.parse(toRotate), period);
            }
        }
        // INJECT CSS
        var css = document.createElement("style");
        css.type = "text/css";
        css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
        document.body.appendChild(css);
    };
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

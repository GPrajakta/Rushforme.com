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
	
	}
}




?>
  <body onload="initialize()">
<nav>
<?php

include("menu.php");

?>


</nav>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="format-detection" content="telephone=no">


<!-- SET: FAVICON -->
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
<!-- END: FAVICON -->

<!-- SET: STYLESHEET -->
<link href="kkreativecss/style.css" rel="stylesheet" type="text/css" media="all">
<link href="kkreativecss/responsive.css" rel="stylesheet" type="text/css" media="all">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
<link href="kkreativecss/bxslider.css" rel="stylesheet" type="text/css" media="all">
<!-- END: STYLESHEET -->

<!-- SET: SCRIPTS -->
	<script type="text/javascript" src="kkreativejs/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="kkreativejs/bxslider.js"></script>
	<script type="text/javascript" src="kkreativejs/jquery-filestyle.min.js"></script>
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
	<script>
$(document).ready(function(){
  //alert("hi..");
  
  
  $("#submit").click(function(){
	  pname = $("#name").val();
	  pnumber = $("#number").val();
	  pemail =  $("#email").val();
	  if( (pname.length === 0)&&(pnumber.length===0)&&(pemail.length===0) ) {
        alert("fields are empty!");
    }
	else{
	  cdata = pname+" has applied,Candidate's details are:- number: " +pnumber+ ", Email_id: "+pemail;
	  alert(cdata);
	$.get( 'http://login.rocktosms.com/api/web2sms.php',
		{workingkey:'1499313h210b69009aw9f',sender:'RUSHME',to:'9767709459',message:cdata}, function( data,status ) {

	});}
	 
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

<!-- wrapper starts -->

    <!-- container starts -->
    <section class="container">

            <!-- maincontent Starts -->
            <div class="main_content_about careers">
                 
            	<div class="about_left">
                	<img src="images/partn.jpg">
                    <!--<h3>careers<span>Innovation is the way you apply ideas</span></h3>-->
                    <div class="over_view_block creers">
                    	<h2>Partner With Us </h2>
                        <p>WE ARE JUST A HANDSHAKE AWAY! 
                        Rushforme.com, is your one-stop destination for all your personal and business needs as we provide professional services to our customers, giving priority to safety and satisfaction. Partner with us and add value to your business.</p>
                        <!--<h5>Careers / Employee Referral Program  (Refer a Friend) </h5>
                        <p>We welcome referrals of any candidates who would make an outstanding addition to the Rushforme team. We are looking for 
                        professionals committed to creating, developing and implementing innovative technology and business solutions for our customers.</p>-->

                        
						
                        <h5>Your Information </h5>
                        <form action="sendmail2.php" method="post" enctype="multipart/form-data">
                        <div class="careers_form">
                            <form action="sendmail2.php" method="post" enctype="multipart/form-data">
                        	<ul>
                            	<li>
                             	   <input type="text" required="required" placeholder="Name" name= "name" id = "name">
                                </li>
                            	<li><input type="text" required="required" placeholder="Contact Number" name= "number" id = "number">
                                </li>
                            	<li>
                                	<input type="text" required="required" placeholder="Email" name= "email" id = "email">
                                </li>
                            	<li>
                                	<input type="text" required="required" placeholder="Address" name= "address" id = "address">
                                </li>
                            	<li>
                                	<textarea rows="4" cols="50" placeholder = "Message" name= "message" id = "message"
									style= "width:725px; font-family: 'Open Sans', sans-serif; padding: 10px 20px; border: solid 1px #bcbcbc; font-size: 14px;font-weight: 300; color: #545454; border-radius: 3px;"></textarea>
									
									
									 
                                </li>
                            	
                            </ul>
                            <span class="clear">&nbsp;</span>
                            
                            <!-- <h5>You’re information</h5>
							<p>Are you a current Rushforme employee? 
                            	<label style="display: inline-flex;"><span>Yes</span><input type="radio" name="employee" style="margin: 4px 2px 0";></label>
                                <label style="display: inline-flex;"><span>NO</span><input type="radio" name="employee" style="margin: 4px 2px 0"></label>
                            </p> -->
                        	<ul>
                            	<!--<li>
                             	   <input type="text" required="required" placeholder="You’re Name" name= "cname1">
                                </li>
                            	<li><input type="text" required="required" placeholder="You’re Phone number" name= "phnumber">
									
                                </li>
                            	<li>
                                	<input type="text"  required="required" placeholder="Name of Current Employer" name= "currentname">
									
                                </li>
                            	<li>
                                	<input type="text" required="required" placeholder="You’re Email" name= "cemail2">
									
                                </li>-->
                               	<li class="submit_prnt" style="margin-top: 40px;">
								<input id = "submit" name="Submit" value="Submit" type="submit" style= "margin-left: 581px;" /><span class="clear">&nbsp;&nbsp;&nbsp;</span></li> 
                            </ul>
                            <span class="clear">&nbsp;</span>
                            </form>
                            
                        
                        </div>
                        
                    </div>
                    
                </div>        
                
            <!-- Maincontent ends -->
            
            
            
    </section>
    <!-- container ends -->
    
</section>
<!-- wrapper ends -->

</body>

</html>  
	  
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
  
   
                    

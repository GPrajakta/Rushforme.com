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
	  name = $("#cname").val();
	  number = $("#cnumber").val();
	  number = '9767709459'+','+number;
		email =  $("#cemail").val();
	  if( (name.length === 0)&&(number.length===0)&&(email.length===0) ) {
        alert("fields are empty!");
    }
	else{
	  cdata = name+" has applied,Candidate's details are:- number: " +number+ ", Email_id: "+email;
	  alert(cdata);
	$.get( 'http://login.rocktosms.com/api/web2sms.php',
		{workingkey:'1499313h210b69009aw9f',sender:'RUSHME',to:number,message:cdata}, function( data,status ) {

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
                	<img src="images/Career-Page-Banner.jpg">
                    <!--<h3>careers<span>Innovation is the way you apply ideas</span></h3>-->
                    <div class="over_view_block creers">
                    	<h2>careers / current openings </h2>
                        <p>Below are the current open positions with Rushforme. 
                        Please view the details for more information and apply if you are interested. Alternatively, you may <small>submit you’re resume</small> 
                        for general consideration.</p>
                        <h5>Careers / Employee Referral Program  (Refer a Friend) </h5>
                        <p>We welcome referrals of any candidates who would make an outstanding addition to the Rushforme team. We are looking for 
                        professionals committed to creating, developing and implementing innovative technology and business solutions for our customers.</p>

                        
						
                        <h5>Candidate information </h5>
                        <form action="sendmail.php" method="post" enctype="multipart/form-data">
                        <div class="careers_form">
                            <form action="sendmail.php" method="post" enctype="multipart/form-data">
                        	<ul>
                            	<li>
                             	   <input type="text" required="required" placeholder="Candidate name" name= "cname" id = "cname">
                                </li>
                            	<li><input type="text" required="required" placeholder="Candidate phone number" name= "cnumber" id = "cnumber">
                                </li>
                            	<li>
                                	<input type="text" required="required" placeholder="Experience" name= "experience" id = "experience">
                                </li>
                            	<li>
                                	<input type="text" required="required" placeholder="Candidate email" name= "cemail" id = "cemail">
                                </li>
                            	<li>
                                	<input type="text" required="required" placeholder="Candidate Current Working company" name= "company" id = "company">
									 
                                </li>
                            	<li>
                                    <input name="fileToUpload" id="fileToUpload" size="30" type="file" class="jfilestyle" data-buttonText="Attach Resume">
                                    <div class="tooltip"><p>Select Your Resume</p></div>
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
  
   
                    

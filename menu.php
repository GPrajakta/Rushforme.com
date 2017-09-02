	
	<head>
	
	
	<style>




	</style>
	</head>
	
	
	<div class="container-fluid">
    <!-- Navigation -->
    <nav class="navbar navbar-fixed-top navbar-inverse" role="navigation" style="z-index: 99;">
        	<div class="col-md-12 top-container">
			<div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               </div>
            	<div class="row">
            		<div class="col-md-2 col-sm-2 col-xs-0"><a class="navbar-brand" href="index.php">
					<img src="images/logo.png" alt="rushforme"></a>
					</div>
               		<div class="col-md-8 col-sm-8 col-xs-12">
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right" style= "margin-right: -16px;">
<li><a href='index.php' id="" data-popmodal-bind="#content" style="padding: 30px 22px;">Home</a></li>
<li><a href='http://rushforme.com/what we do.php' id="" data-popmodal-bind="#content">What We Do</a></li>
<li><a href='http://rushforme.com/partner.php' id="" data-popmodal-bind="#content">Partner With Us</a></li>
<li><a href='http://rushforme.com/blog/index.php' id="" data-popmodal-bind="#content">Blog</a></li>
<li><a href='http://rushforme.com/career.php' id="" data-popmodal-bind="#content">Careers</a></li>
<li><a href='http://rushforme.com/trackorder.php' id="" data-popmodal-bind="#content">Track Order</a></li>

<!--<li class="dropdown hidden-xs"> <a href="#" class="ddtrigger blue1" > <span class=" hometrackordericon hidden-sm hidden-xs"> </span>Track Order<b class="caret"></b> </a>
          <div class="ddbox dropdown-menu">
            <form class="trackroderform">
              <span class="mb0"> Enter Waybill/Order Numbers. To track multiple orders, sperate numbers using space. </span> <span>
              <input class="tracktext" type="text" placeholder="Enter Waybill/Order Numbers">
              </span> <span class="invalidtrack mb10">Please Enter  the Number</span> <span class="mb0"> Please Select the type of Identification number: </span> <span class="trackoption iblock"> <span class="iblock">
              <input class="trackradio" type="radio" value="waybill" checked="true" id="rd01">
              </span> <span class="iblock">
              <label for="rd01">Waybill Number</label>
              </span> </span> <span class="trackoption iblock"> <span class="iblock">
              <input class="trackradio" type="radio" value="ref_ids" id="rd02">
              </span> <span class="iblock">
              <label for="rd02">Order Number</label>
              </span> </span> <span class="ofh">
              <button type="submit" id="submittrack" class="btn btn-success pull-right pde1">Track</button>
              </span>
            </form>
            <div class="waiting hidden"> Fetching your order status.... </div>
            <div class="loginseperator text-right"><strong>Contact Us:</strong> +91 (124) 4718900</div>
          </div>
        </li>-->




<!--<li class='active'><a href='#' id="notifyModal_ex3" data-popmodal-bind="#content3">resources</a></li>-->
<!--      <li><a href='#' id="notifyModal_ex2" data-popmodal-bind="#content2">other services</a></li>-->
<!--<li><a href='#'>house keeping</a></li>
<li><a href='#'>delivery boys</a></li>-->
                           
						   
						   
						   
						   
						   <?php
			if($_SESSION['uid']=="")
			{
			?>
<li class="sign-bg"><a href='#' id='modal-launcher' data-toggle="modal" data-target="#login-modal">Sign in</a></li>
							
	  <?php 
			}
			else
			{
			?>

<li class="dropdown"><a class="dropdown-toggle sign-bg"" data-toggle="dropdown" href="#">Hi<?php echo " ".$_SESSION['username']; ?><span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="my_accountdetails.php">My Account</a></li>
          <li><a href="logout.php">Logout</a></li>
          </ul>
      </li>
	  	<?php
			}
			?>
                        </ul>
                    </div>
                </div>
				<div class="col-md-2 col-sm-2 col-xs-0" style="padding:0px;">
				<div class="help-bg">helpline<span class="clearfix">9000-500-600</span></div>
				</div>
            

		
			       </div>
            </div>
			
    </nav>
	
</div>

<script>
$('ul.nav li.dropdown').hover(function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(100);
}, function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeOut(100);
});
</script>
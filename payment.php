<!DOCTYPE html>
<html lang="en">

<head>

<?php
session_start();
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
#tableorderhd
{
	   / background: #E2E2E2;
    /border: 1px solid #eee;
}
    </style>
	     

<!-- body Carousel -->
<div class="background"></div>
<!-- body Carousel -->

<script>
//calculateRoute('<?php echo $_SESSION["ffrom"];?>','<?php echo $_SESSION["fto"];?>');
$(document).ready(function() {
	alert('<?php echo $_SESSION["ffrom"];?>');
window.onload=calculateRoute('<?php echo $_SESSION["ffrom"];?>','<?php echo $_SESSION["fto"];?>');
});
</script>
</div>
 <style type="text/css">
      #map {
        height: 400px;

      }
	      #over_map_right { position: absolute; background-color: transparent;
		  top: 30px; right: 10px; z-index: 98; background: white; }
		      #wrapper { position: relative; }
    </style>
	     

<!-- body Carousel -->
<div class="background"></div>
<!-- body Carousel -->

<script>
//calculateRoute('<?php echo $_SESSION["ffrom"];?>','<?php echo $_SESSION["fto"];?>');


</script>

<div style="padding-top: 10px;"  class="col-md-10 col-md-push-1  myaccount_div">
<ul id="myTab" class="nav nav-tabs nav-justified">
                    <li class="active"><a href="#service-one" data-toggle="tab">Order Details</a>
                    </li>
    
                    </ul>
<div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="service-one">
                  
               <?php
include("payumoney/PayUMoney_form.php");
?>
					
					
					</div>
                  </div>


</div>
	<div class="devider1" style="margin: 0px;"></div>	
<?php
include("footer.php");
?>

</html>
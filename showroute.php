<?php
session_start();
 include_once('dbfunction.php');
  $obj = new dbfunction();
if(isset($_POST['searchaddroute']))
{
$fromm=$_POST['fromaddress'];
 $middleaadd=$_POST['middleadd'];
 $too=$_POST['toaddress'];
 $fromcity=explode(',',$fromm);
 $ccfr=count($fromcity);
 $middleaaddcity=explode(',',$middleaadd);
  $ccmid=count($middleaaddcity);
 $toocity=explode(',',$too);
  $ccto=count($toocity);//echo trim($fromcity[$ccfr-3]);
 // echo $fromm;
 // print_r($fromcity);
  // echo "<br>****************"; 
// array_search('root/base', $restricted)
// echo array_search("Hyderabad/Secunderabad",$fromcity);
// $citys='Hyderabad'

 // echo "____gotit";
 // }
 // else
 // {
 // echo '++++Hyderabad'.' fgfdf';
 // }
 // exit;
if((strpos($fromm,"Hyderabad") || strpos($fromm,"Secunderabad")) && (strpos($too,"Hyderabad") || strpos($too,"Secunderabad")) == true && ($middleaadd=='' || (strpos($middleaadd,"Hyderabad") || strpos($middleaadd,"Secunderabad") == true)))
  {
 if($middleaadd=='' || $fromm=='' || $too=='')
 {
 if($middleaadd=='' || ($fromm!='' && $too!=''))
 {
 $from = urlencode($fromm);
 $to = urlencode($too);
 }
 if($fromm=='' || ($middleaadd!='' && $too!=''))
 {
 $from = urlencode($middleaadd);
 $to = urlencode($too);
 } 
 if($too=='' || ($middleaadd!='' && $fromm!=''))
 {
 $from = urlencode($fromm);
 $to = urlencode($middleaadd);
 }
 else
 {
 $from = urlencode($_SESSION["ffrom"]);
 $to = urlencode($_SESSION["fto"]);
 }
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
$picup=$_SESSION["fpicupid"];
$_SESSION["time"]=$time;
$_SESSION["adades"]=1;
$_SESSION["middleaddd"]='';
$pkm= mysql_query("SELECT * FROM priceforkm where id='".$picup."'")  or die(mysql_error());
$pkmv=mysql_fetch_array($pkm);
$_SESSION["fpicup"]=$pkmv['price'];
$_SESSION["fdistance"]=$distance;
 }
 else
 {
  //$insertorder=$obj->insertorderdetails($from,$to,$picup);
  $from = urlencode($fromm);
  $middleadd = urlencode($middleaadd);
 $to = urlencode($too);
$data = file_get_contents("http://maps.googleapis.com/maps/api/distancematrix/json?origins=$from&destinations=$middleadd&language=en-EN&sensor=false");
$data = json_decode($data);
$time = 0;
$distance = 0;
foreach($data->rows[0]->elements as $road) {
    $time += $road->duration->value;
    $distance += $road->distance->value;
}
$distance=$distance/1000;
 $firstdistance=number_format($distance, 2, '.', '');
$time=$time/60;
$firsttime=number_format($time, 2, '.', '');
$data = file_get_contents("http://maps.googleapis.com/maps/api/distancematrix/json?origins=$middleadd&destinations=$to&language=en-EN&sensor=false");
$data = json_decode($data);
$time = 0;
$distance = 0;
foreach($data->rows[0]->elements as $road) {
    $time += $road->duration->value;
    $distance += $road->distance->value;
}
$distance=$distance/1000;
 $secdistance=number_format($distance, 2, '.', '');
$time=$time/60;
$sectime=number_format($time, 2, '.', '');
$distance=$secdistance+$firstdistance;
$$time=$firsttime+$sectime;
$_SESSION["ffrom"]=$fromm;
$_SESSION["fto"]=$too;
$_SESSION["secdistance"]=$secdistance;
$_SESSION["firstdistance"]=$firstdistance;
$_SESSION["middleaddd"]=$middleaadd;
 $picup=$_SESSION["fpicupid"];
$_SESSION["time"]=$time;
$_SESSION['adades']=2;
$pkm= mysql_query("SELECT * FROM priceforkm where id='".$picup."'");
$pkmv=mysql_fetch_array($pkm);
$_SESSION["fpicup"]=$pkmv['price'];
$_SESSION["fdistance"]=$distance;
$_SESSION["estimation"]=round($_SESSION["fdistance"]*$_SESSION["fpicup"]);
if($pkmv['estimation']<100)
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
 }
 }
else
 {
 echo "<script>alert('PickUp and Destination Address should be in Hyderabad or Secunderbad. Service available only in Hyderabad or Secunderbad' );</script>";
 }
 }

?>
<!DOCTYPE html>
<html lang="en">
<head>

<?php
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
    </style>
	     

<!-- body Carousel -->
<div class="background"></div>
<!-- body Carousel -->

<script>
//calculateRoute('<?php echo $_SESSION["ffrom"];?>','<?php echo $_SESSION["fto"];?>');
$( document ).ready(function() {
	//alert('<?php echo $_SESSION["ffrom"];?>');
	// if (document.getElementById("addaddressval").style.display = "block") {
	// $("#addbutton").show();
	// }
window.onload=calculateRoute('<?php echo $_SESSION["ffrom"];?>','<?php echo $_SESSION["fto"];?>');


});
</script>
</div>
<div class="gray-container2">   
<div class="container">
	<div class="row">
    	<div class="col-md-12">
		<?php if($_SESSION["adades"]==1) 
		{
		?>
			<ol class="breadcrumb" style="color:#EC1652;font-weight: bold" >
				<li>
				<?php 
		echo $_SESSION["ffrom"]; ?> </li>
				<li class="active"> TO </li>
				<li>
				<?php  echo $_SESSION["fto"]; ?>
				</li>	<li>
			<?php echo $_SESSION["fdistance"]; ?>
				</li>
				<li>
				<i class="fa fa-inr"></i>
		<?php echo ($_SESSION["fdistance"]*$_SESSION["fpicup"])."."; ?>
				</li>
			</ol>
			<?php  } else { ?>
		<ol class="breadcrumb" style="color:#EC1652;font-weight: bold" >
				<li>
				<?php 
		echo $_SESSION["ffrom"]; ?> </li>
				<li class="active"> TO </li>
				<li>
				<?php  echo $_SESSION["fto"]; ?>
				</li>	<li>
			<?php echo $_SESSION["fdistance"]; ?>
				</li>
				<li>
				<i class="fa fa-inr"></i>
		<?php echo ($_SESSION["fdistance"]*$_SESSION["fpicup"])."."; ?>
				</li>
			</ol>
			<?php } ?>


			
        </div>
    </div>
</div>
</div>
<div id="wrapper" style="bottom:2%;top:0%;">

<div class="container-fluid">
<div class="row">
<div class="col-md-4 col-sm-4">
<div id="over_map_left">
<ul>
<li><a href=""><img src="images/directions_blue.jpg" alt=""></a></li>
</ul>
<form  method="post" action="" id="fomroute">
	<div class="control-group form-group">
		<div class="controls">
<input type="text" class="form-control location-ico from" name="fromaddress" id="autocomplete" required
 onclick="this.value='';"  placeholder="PICKUP LOCATION"
onblur="this.value=!this.value?'':this.value;"   value="<?php echo $_SESSION['ffrom'];?>" />
		</div>
	</div>
			<div class="controls">
		<?php
		// echo $_SESSION["adades"];
		if($_SESSION["adades"]!=1)
		{
		$middadd=$_SESSION["middleaddd"];
			$display="block";
		}
		else{
		$_SESSION["middleaddd"]='';
		$middadd='';
			$midd='';
			$display="none";
		}
		?>
	<div class="control-group form-group" id="addaddressval" style="display:<?php echo $display;?>">

<input type="text" class="form-control location-ico from addaddressvaluee" name="middleadd"   id="autocomplete"  
onclick="this.value='';"  placeholder="Add LOCATION" onblur="this.value=!this.value?'':this.value;" value="<?php echo $middadd;?>"/>


<a href="javascript:void();" onclick ="hideaddres();" style="font-size:12px;"><i class="fa fa-times" ></i> Remove Location</a>
		</div>
	</div>
	<div class="control-group form-group">
		<div class="controls">
	     <div class="controls">
<input type="text" class="form-control location-ico to" name="toaddress" required  onclick="this.value='';"  placeholder="DROPING LOCATION" onblur="this.value=!this.value?'':this.value;" 
value="<?php echo $_SESSION['fto'];?>"  id="txtDestinationAddress"/>
		</div>
	</div>
	<ul>
		<li>Total destinations<br/>
			<span><?php echo $_SESSION["adades"];?></span>
		</li>
		<li>Total KM'S<br/>
			<span><?php echo $_SESSION["fdistance"] ;?></span>
		</li>
		<li>Total Price<br/>
			<span><i class="fa fa-inr"></i><?php echo $_SESSION["estimation"];?></span>
		</li>
		<div class="clearfix"></div>
	</ul>

	<input type="button" class="btn btn-success" id="addbutton" onclick="addroute()" value="Add Location"
 style="margin-right:10px; margin-bottom: 10px;"/>
	<input type="submit" class="btn btn-success" name="searchaddroute" value="Search Route" style="margin-bottom: 10px;">
</form>
	
</div>

</div>


</div>
<div class="col-md-8 col-sm-8">
<div id="over_map_right">

 		<div class="modal-header login_modal_header">

        		<h4 class="modal-title" id="myModalLabel">Assigned Route Details</h4>
      		</div>
	<div class="modal-body login-modal" >
		      			<p>Maximum Weight 5 KGs, Weighting charges of Rs 50 for every half hour</p>
      			<br/>
      			<div class="clearfix"></div>
		<div id='social-icons-conatainer' class="table-responsive">
	        	<table class="table responsive-utilities jambo_table bulk_action">
                                        <thead>
                                            <tr class="headings">
                                               <th class="column-title">Destination</th>
                                                <th class="column-title">Type</th>
                                                <th class="column-title">Duration</th>
                                                <th class="column-title">Total KM</th>
                                                <th class="column-title">Total price </th>
                                               <th class="column-title">Task </th>
									          <th class="column-title">Action</th>
                                  </tr><tr>
                                    <th class="column-title"><img src="images/destinations_icon.jpg" alt=""></th>
                                                <th class="column-title"><img src="images/type_icon.png" alt=""></th>
                                                <th class="column-title"><img src="images/duration_icon.jpg" alt=""></th>
                                                <th class="column-title"><img src="images/total_km_icon.jpg" alt=""></th>
                                                <th class="column-title"><img src="images/total_price_icon.jpg" alt=""></th>
                                               <th class="column-title"><img src="images/tast_icon.jpg" alt=""></th>
									          <th class="column-title"><img src="images/destinations_icon.jpg" alt=""></th>
                                      </tr>
                            </thead>
	                            <tbody>
									<?php
 $dr=$_SESSION["fpicup"];
 if($_SESSION['adades']==1)
 {
 $de=$_SESSION["fdistance"];
 }
 else
 {
 $de=$_SESSION["firstdistance"];
 }
 $dsm=$dr*$de;
 if( $dsm<100)
 {
	 $dsm=100;
 }
 else
 {
	 $dsm=$dsm;
 }
				//print_r($_SESSION);
				?>
                                <tr class="even pointer">
								<td class=" " style="color:;font-size:12px; line-height:20px"><?php 
										$addfirs=explode(',',$_SESSION["ffrom"]);
								echo $addfirs[0];?>  <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; to &nbsp;&nbsp;&nbsp; <br> <?php 
									if($_SESSION['adades']==1)
								{
								$toofirs=explode(',',$_SESSION["fto"]);
								}
								else
								{
								$toofirs=explode(',',$_SESSION["middleaddd"]);
								}
								echo $toofirs[0];?></td>
                                <td class=" ">Two Wheeler </td>
                                  <td class=" "><?php echo  "Hrs" ?><i class="success fa fa-long-arrow-up"></i></td>
                                    <td class=" "><?php if($_SESSION['adades']!=2) { echo  $_SESSION["fdistance"]; }
									else { echo  $_SESSION["firstdistance"];  }?>&nbsp;&nbsp;Km</td>
                                    <td class=" "><?php echo round($dsm) ;?>/-</td>
                                    <td class=" "><?php echo "Delivery" ?></td>
                                    <td class=" "><?php echo "Delivery" ?></td>
				                              </tr>
                          </tbody>
						  <?php 
						  if($_SESSION['adades']==2)
						  {
						  ?>
						  <tbody>
									<?php
 $dr=$_SESSION["fpicup"];
 $de=$_SESSION["secdistance"];
 $dsm=$dr*$de;
 if( $dsm<100)
 {
	 $dsm=100;
 }
 else
 {
	 $dsm=$dsm;
 }
				//print_r($_SESSION);
				?>
                                <tr class="even pointer">
								<td class=" " style="font-size:12px;line-height:22px!important; color:#333!important"><?php 
								$addfirs=explode(',',$_SESSION["middleaddd"]);
								echo $addfirs[0];?>.   to &nbsp;&nbsp;&nbsp; <br> <?php 
								$toofirs=explode(',',$_SESSION["fto"]);
								echo $toofirs[0];?></td>
                                <td class=" ">wheeler </td>
                                  <td class=" "><?php echo  "Hrs" ?><i class="success fa fa-long-arrow-up"></i></td>
                                    <td class=" "><?php echo  $_SESSION["secdistance"] ?>Km</td>
                                    <td class=" "><?php echo round($dsm) ;?>/-</td>
                                    <td class=" "><?php echo "Delivery" ?></td>
                                    <td class=" "><?php echo "Delivery" ?></td>
				                              </tr>
                          </tbody>
						  <?php } ?>
						  <tbody>
									<?php
 $dr=$_SESSION["fpicup"];
 $de=$_SESSION["fdistance"];
 $dsm=$dr*$de;
 if( $dsm<100)
 {
	 $dsm=100;
 }
 else
 {
	 $dsm=$dsm;
 }
				//print_r($_SESSION);
				?>
                                <tr class="even pointer">
								<td class=" " style="font-size:12px;">Destinations - <span style="color:black"><?php echo $_SESSION['adades'];  ?></span></td>
                                <td class=" ">wheeler </td>
                                  <td class=" "><?php echo  "Hrs" ?><i class="success fa fa-long-arrow-up"></i></td>
                                    <td class=" "><?php echo  $_SESSION["fdistance"] ?>Km</td>
                                    <td class=" "><?php echo round($dsm) ;?>/-</td>
                                    <td class=" "><?php echo "Delivery" ?></td>
                                    <td class=" "><?php echo "Delivery" ?></td>
				                              </tr>
                          </tbody>
   </table>
	        	</div>																												
        		<div class="clearfix"></div>
        		
        		<div class="form-group modal-register-btn">

		<input type="submit" class="btn btn-success" onClick="location.href='orderfulldetails.php'"  value="Proceed to Pay" />
	
	  
				</div>
      		<!--	    <p><strong>Pick Up Address</strong>: <?php //echo $_SESSION["ffrom"];?></p>
    <p><strong>Destination Address</strong>: <?php //echo $_SESSION["fto"];?></p>
    <p><strong>Distance</strong>: <?php //echo $_SESSION["fdistance"];?></p>
    <p><strong>Time</strong>: <?php //echo $_SESSION["time"];?></p>
    <p><strong>Price</strong>: <i class="fa fa-rupee"></i> <?php //echo $_SESSION["fpicup"];?></p>
     	        		
        		<div class="form-group modal-register-btn">
        			<a href="showroute.php" class="btn btn-default" >proceed</a>
        		</div>-->
				
      		</div>
</div>
</div>
	</div>
	</div>
	<div id="map" style="width:100%;height:100%;"></div>
</div>
	<!--<button onclick="calculateRoute('<?php //echo $_SESSION["ffrom"];?>','<?php //echo $_SESSION["fto"];?>')"
style="float:right;">Click me</button>
<!--<a href='#' id='table-modal' data-toggle="modal" data-target="#login-modal">Sign in</a>-->
	<div class="devider1" style="margin: 0px;"></div>	
<?php
include("footer.php");
?>
<div class="modal " id="table-modal" tabindex="-1" role="dialog"
 aria-labelledby="myModalLabel" aria-hidden="true" style="display:none;">
 <div class="modal-backdrop fade in" style="height: 501px;"></div>
	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header login_modal_header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="">&times;</button>
        		<h2 class="modal-title" id="myModalLabel">Assigned Route Details</h2>
      		</div>
      		<div class="modal-body login-modal">
      			<p>Max Weight 5kg's Rs.10 Per KM Either Side.Minimum duration of waiting 15 min</p>
      			<br/>
      			<div class="clearfix"></div>
      			<div id='social-icons-conatainer'>
	        	<table class="table table-striped responsive-utilities jambo_table bulk_action">
                                        <thead>
                                            <tr class="headings">
                                               <th class="column-title">Destination</th>
                                                <th class="column-title">Type</th>
                                                <th class="column-title">Duration</th>
                                                <th class="column-title">Total KM</th>
                                                <th class="column-title">Total price </th>
                                               <th class="column-title">Task </th>
									          <th class="column-title">Action</th>
                                  </tr><tr>
                                              <th class="column-title"><img src="images/destinations_icon.jpg" alt=""></th>
                                                <th class="column-title"><img src="images/type_icon.png" alt=""></th>
                                                <th class="column-title"><img src="images/duration_icon.jpg" alt=""></th>
                                                <th class="column-title"><img src="images/total_km_icon.jpg" alt=""></th>
                                                <th class="column-title"><img src="images/total_price_icon.jpg" alt=""></th>
                                               <th class="column-title"><img src="images/tast_icon.jpg" alt=""></th>
									          <th class="column-title"><img src="images/destinations_icon.jpg" alt=""></th>
                                      </tr>
                            </thead>
	                            <tbody>
									<?php
 $dr=$_SESSION["fpicup"];
 $de=$_SESSION["fdistance"];
 $dsm=$dr*$de;
 if( $dsm<100)
 {
	 $dsm=100;
 }
 else
 {
	 $dsm=$dsm;
 }
				//print_r($_SESSION);
				?>
                                <tr class="even pointer">
<td class=" " style="color:;font-size:12px; line-height:22px"><?php echo $_SESSION["ffrom"];?>.  <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; to &nbsp;&nbsp;&nbsp; <br> <?php echo $_SESSION["fto"] ;?></td>
                                <td class=" ">wheeler </td>
                                  <td class=" "><?php echo  "Hrs" ?><i class="success fa fa-long-arrow-up"></i></td>
                                    <td class=" "><?php echo  $_SESSION["fdistance"] ?></td>
                                    <td class=" "><?php echo $dsm ;?></td>
                                    <td class=" "><?php echo "Delivery" ?></td>
                                    <td class=" "><?php echo "Delivery" ?></td>
				                              </tr>
                          </tbody>
   </table>
	        	</div>																												
        		<div class="clearfix"></div>
        		
        		<div class="form-group modal-register-btn">
			  <a href="orderfulldetails.php" class="" >PROCEED</a>
			  
				</div>
      		</div>
      		<div class="clearfix"></div>
      		<div class="modal-footer login_modal_footer">
      		</div>
    	</div>
  	</div>
</div>


</body>
<script>
function addroute()
{

 // document.getElementById('addaddressvaluee').value =middleadd;
$('#addaddressval').show();
$('#addbutton').hide();
}
</script>
<script>
        function hideaddres() {
            //alert(a);
			var mid='';
            // $('#div' + a).html("");
			 $('#addbutton').show();
            document.getElementById('addaddressval').style.display='none';
       $('.addaddressvaluee').val("");
		//alert('sdyfytdsfytf');

		// $('s#addaddressval').html('');
// if($('#fomroute').submit(e))
// {
// e.preventDefault();
// $.post('resetsession.php',function(){

// });
// }     
                     return false;
        }
</script>

</html>
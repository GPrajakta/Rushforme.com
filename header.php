<?php
 // print_r($_SESSION['google_data']);
 include_once('dbfunction.php');
  include_once ("google_login.php");
  $obj = new dbfunction();
  $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
 $_SESSION['urlll']=$actual_link;
// print_r($_SESSION['google_data']);
  $baseurl="http://rushforme.com/";
if(isset( $_REQUEST["action"]))
{
$action = $_REQUEST["action"];
switch($action){
	case "fblogin":
	include 'facebook.php';
	$appid 		= "1685465574999055";
	$appsecret  = "6dbed57fa8e22d030b7836da3c983c7e";
	$facebook   = new Facebook(array(
  		'appId' => $appid,
  		'secret' => $appsecret,
  		'cookie' => TRUE,
	));
$fbuser = $facebook->getUser();

	if ($fbuser) {
	  try {
	 // $json = $facebook->api('/me');
		    $user_profile = $facebook->api('/me?fields=id,name,email,gender,birthday' );
///print_r($user_profile);
			
		}
		catch (Exception $e) {
			echo $e->getMessage();
			exit();
		}
		//print_r($user_profile);
					//print_r($json);
					
		$user_fbid	= $fbuser;
		$user_email = $user_profile["email"];
		$user_fnmae = $user_profile["name"];
		$gender = $user_profile["gender"];
		$user_image = "https://graph.facebook.com/".$user_fbid."/picture?type=large";
		/////////////////////////////////
		$cityid=1;
$sqle=mysql_query("select * from userdetails where emailid='".$user_email."'");
$ret=mysql_num_rows($sqle);	
	 $get_det=mysql_fetch_array($sqle);
if($ret<1)
{
//echo "insert into register(`email`,`fullname`,`firstname`,`lastname`,`google_id`,`gender`,`dob`,`profile_image`,`gpluslink`) values
//('$email','$fullName','$firstName','$lastName','$googleid','$gender','$dob','$avatar','$gplusURL')";
//Execture query
$loginwith='facebook';
$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
  $password = substr( str_shuffle( $chars ), 0, 8 );
$sql=mysql_query("insert into register(`email`,`fullname`,`firstname`,`lastname`,`google_id`,`gender`,`dob`,`profile_image`,`gpluslink`) values
('$user_email','$user_fnmae','$user_fnmae','$user_fnmae','$user_fbid','$gender ','','$user_image','')");
$qry=mysql_query("INSERT INTO  `userdetails` (`userid`,`name` ,`lastname`,`gender`,`image` ,`address`,`mobileno`,`emailid`,`Date`,`status`,`accounttype`,`password`,`cityid`,`loginwith` )
VALUES ('','$user_fnmae','','$gender ','$user_image','','','$user_email',NOW(),'Active','','$password','$cityid','$loginwith')") or die(mysql_error());
 
 $_SESSION['email']=$user_email;
 $_SESSION['img']=$user_image;
$_SESSION['username']=$user_fnmae;
	//$_SESSION['mobileno']='';	
	//$_SESSION['address']=$get_det['address'];	
	$_SESSION['uid']=mysql_insert_id();
	$_SESSION['ucityid']=1;
	$to=$user_email;
	$subject="Rush for me";
$message="<h1  style='margin-left:35%'><img src='http://rushforme.com/images/logo.png'></h1> Dear ".$user_fnmae .",<br/><br/>Thankyou for the Login with Facebook.Dear ".$user_fnmae." ,Your www.rushforme.com UserID is:".$user_email."Password is ".$password."  please do not share this password any one.Thank you www.rushforme.com'</b>";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <info@rushforme.com>' . "\r\n";
//$headers .= 'Cc: info@ishasofwares.com' . "\r\n";
mail($to,$subject,$message,$headers);
header("Location:".$_SESSION['urlll']);

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
	// header("Location:".$_SESSION['urlll']);
	}
		
		/////////////////////////////////////
		$check_select = mysql_num_rows(mysql_query("SELECT * FROM `fblogin` WHERE email = '$user_email'"));
if($check_select > 0){
mysql_query("INSERT INTO `fblogin` (fb_id, name, email, image, postdate) VALUES ('$user_fbid', '$user_fnmae', '$user_email', '$user_image', '$now')");
		}
	}
			break;
}
}
if (isset($_SESSION['google_data']) || isset($_GET['code']))
 {
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
$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
  $password = substr( str_shuffle( $chars ), 0, 8 );
$loginwith='gmail';
$sql=mysql_query("insert into register(`email`,`fullname`,`firstname`,`lastname`,`google_id`,`gender`,`dob`,`profile_image`,`gpluslink`) values
('$email','$fullName','$firstName','$lastName','$googleid','$gender','$dob','$avatar','$gplusURL')");
$qry=mysql_query("INSERT INTO  `userdetails` (`userid`,`name` ,`lastname`,`gender`,`image` ,`address`,`mobileno`,`emailid`,`Date`,`status`,`accounttype`,`password`,`cityid`,`loginwith` )
VALUES ('','$firstName','$lastName','$gender','$avatar','','','$email',NOW(),'Active','','$password','$cityid','$loginwith')") or die(mysql_error());
 
 $_SESSION['email']=$email;
 $_SESSION['img']=$avatar;
$_SESSION['username']=$firstName." ".$lastName;
	//$_SESSION['mobileno']='';	
	//$_SESSION['address']=$get_det['address'];	
	$_SESSION['uid']=mysql_insert_id();
	$_SESSION['ucityid']=1;
//header("Location:index.php");
$to=$email;
	$subject="Rush for me";
$message="<h1  style='margin-left:35%'><img src='http://rushforme.com/images/logo.png'></h1> Dear <b>".$_SESSION['username'] .",</b><br/><br/>Thankyou for the Login with Facebook.Dear ".$user_fnmae." ,<br/>Your www.rushforme.com  UserID is:<b><mark><ins>".$email."</ins></mark></b> Password is :<b><mark><ins>".$password."</ins></mark></b>  please do not share this password any one.Thank you www.rushforme.com";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <info@rushforme.com>' . "\r\n";
//$headers .= 'Cc: info@ishasofwares.com' . "\r\n";
mail($to,$subject,$message,$headers);
	header("Location:".$_SESSION['urlll']);
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
	//header("Location:index.php");
		//header("Location:".$_SESSION['urlll']);
	}
		}

?>
	<meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
<title> Pickup And Drop Services | Courier Help | Personal Assistant |</title><META NAME="title" CONTENT=" Pickup And Drop Services | Courier Help | Personal Assistant |">

<META NAME="keywords" itemprop="keywords" content="Errand Services, Errand Running Services, Pickup and Delivery Services, Courier Services, Get a, Peon, Concierge Services, Food Delivery Services, Cheque Collection, Door to Door Services, Desk to Desk Services, Mundane Tasks, Lunch Delivery, Document Delivery, Logistic Services, Personal, Assistant, Resource On Rent, Personal Services, Office Assistant, Mail Delivery, Parcel Services." />

<META NAME="description" CONTENT="Rush For Me Offers Errand Services, Errand Running Services, Pickup and Delivery Services, Courier Services, Get a, Peon, Concierge Services, Food Delivery Services, Cheque Collection, Door to Door Services, Desk to Desk Services, Mundane Tasks, Lunch Delivery, Document Delivery, Logistic Services, Personal, Assistant, Resource On Rent, Personal Services, Office Assistant, Mail Delivery, Parcel Services."/>


    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet"/>

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet"/>
	<link href="css/styles.css" rel="stylesheet"/>
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700,800&amp;subset=latin,latin-ext'
	rel='stylesheet' type='text/css'/>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,700,500,100' rel='stylesheet' type='text/css'/>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
	<!-- script src="http://code.jquery.com/jquery-1.9.0.js"></script>
<script
          src="https://code.jquery.com/jquery-2.2.4.min.js"
          integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
          crossorigin="anonymous"></script-->
<!-- menu -->
<link rel="stylesheet" href="js/menu/styles.css"/>
<script src="js/menu/script.js"></script>
    <!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<!-- tabs -->
<script src="js/jquery.hashchange.min.js"></script>
<script src="js/jquery.easytabs.min.js"></script>
<script type="text/javascript">
$(document).ready( function() {
  $('#tab-container').easytabs();
});

</script>

	<link rel="stylesheet" href="js/login/login-style.css" />
<link type="text/css" rel="stylesheet" href="js/popmodel/popmodal.css"/>
<script src="js/popmodel/popmodal.js"></script>
<?php
if(isset($_POST['login']))
{
	//print_r($_POST);
$emailid=$_POST['email'];
$password=$_POST['password'];
 $objj = new dbfunction();
$log=$obj->checkuserLogin($emailid,$password);
if($log!=0)
	{
		 $_SESSION['errorlogin']='';
	  $_SESSION['opacity']=0;
	  	$_SESSION['popisplay']="none";
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
// header("Location:".$_SESSION['urlll']);
//echo '<script> $("nav").load("menu.php");;</script>';
			}
	else
	{
	$_SESSION['popisplay']="block";
	 $_SESSION['errorlogin']='Invalid User name and Password';
	  $_SESSION['opacity']=1;
  // echo "<script type='text/javascript'>
  // ShowModalPopup();
  // alert('ddd');
  // document.getElementById('test').innerHTML='sdfsndvhshg';
  // </script>";

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
 <!--<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places&sensor=true"></script>-->

<script type="text/javascript"  src="http://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&dummy=.js"></script>


<script>
function initialize() {
/*
 autocomplete = new google.maps.places.Autocomplete(
   (document.getElementById('autocomplete')),
     { types: ['geocode'] });

 google.maps.event.addListener(autocomplete, 'place_changed', function() {
   fillInAddress();
 });
     addressLookup();
	*/
	    // addressLookup();
		// alert();
}
 $(document).ready(function () {
	 	    addressLookup();
		// alert();
});
    // addressLookup();

function addressLookup() {

	var southWest = new google.maps.LatLng(14.214089670332298, 74.09216874999993);
var northEast = new google.maps.LatLng(20.501915586194915, 82.88123124999993);
var hyderabadBounds = new google.maps.LatLngBounds( southWest, northEast );
      var options = {
		  //bounds: hyderabadBounds,
		  //types: ['(cities)'],
	
        componentRestrictions: {
            country: 'in'
        }
    };

    var address = document.getElementsByClassName('form-control location-ico');

// autocomplete.addListener('place_changed', fillInAddress);
    for(var i=0; i< address.length; i++){
    autocompletefield=new google.maps.places.Autocomplete(address[i], options);
	// google.maps.event.addListener(autocompletefield, 'place_changed', function() {
		// alert('');
		
  // fillInAddress();
// });
    }
        //new google.maps.places.Autocomplete(address, options);
}
function fillInAddress() {
   var place = autocomplete.getPlace();

    for (var component in component_form) {
      document.getElementById(component).value = "";
      document.getElementById(component).disabled = false;
    }

    for (var j = 0; j < place.address_components.length; j++) {
      var att = place.address_components[j].types[0];
      if (component_form[att]) {
        var val = place.address_components[j][component_form[att]];
		alert(val);
        document.getElementById(att).value = val;
      }
    }
}

</script>



 <script>
    
      $(document).ready(function() {
        // If the browser supports the Geolocation API
        if (typeof navigator.geolocation == "undefined") {
          $("#error").text("Your browser doesn't support the Geolocation API");
          return;
        }

        $("#from-link, #to-link").click(function(event) {
          event.preventDefault();
          var addressId = this.id.substring(0, this.id.indexOf("-"));

          navigator.geolocation.getCurrentPosition(function(position) {
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({
              "location": new google.maps.LatLng(position.coords.latitude, position.coords.longitude)
            },
            function(results, status) {
              if (status == google.maps.GeocoderStatus.OK)
                $("#" + addressId).val(results[0].formatted_address);
              else
                $("#error").append("Unable to retrieve your address<br />");
            });
          },
          function(positionError){
            $("#error").append("Error: " + positionError.message + "<br />");
          },
          {
            enableHighAccuracy: true,
            timeout: 10 * 1000 // 10 seconds
          });
        });
	    
		
      });

    </script>

<script>
	
	  function calculateRoute(from,to) {
	  //alert("from");
	       $("#devider1").html(from);
        // Center initialized to Naples, Italy
		// var from=$('#autocomplete').val();
		// var to=$('#txtDestinationAddress').val();
		// alert(from);
		// alert(to);
        var myOptions = {
          zoom: 8,
          center: new google.maps.LatLng(40.84, 14.25),
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        // Draw the map
        var mapObject = new google.maps.Map(document.getElementById("map"), myOptions);

        var directionsService = new google.maps.DirectionsService();
        var directionsRequest = {
          origin: from,
          destination: to,
          travelMode: google.maps.DirectionsTravelMode.DRIVING,
          unitSystem: google.maps.UnitSystem.METRIC
        };
        directionsService.route(
          directionsRequest,
          function(response, status)
          {
            if (status == google.maps.DirectionsStatus.OK)
            {
              new google.maps.DirectionsRenderer({
                map: mapObject,
                directions: response
              });
            }
            else
              $("#error").append("Unable to retrieve your route<br />");
          }
        );
      }

	</script>

<?php
if(isset($_SESSION['opacity']))
{
	$opacity=$_SESSION['opacity'];
	$display=$_SESSION['popisplay'];
	unset($_SESSION['opacity']);
	unset($_SESSION['popisplay']);
	$clas="in";
		$opacity="display:".$display;
		$bgopa="opacity:0.5;display:block;height:100%;";
		$hid="false";
		$hidfun="onclick='modalcloseown();'";
//$bodystyle='class="modal-open" style="padding-right: 17px;"';
		}
else{
	$hidfun='';
		$clas="";
	$opacity='';
	$hid="true";
	$bgopa="";
	//$bodystyle='';
}

?>
<script>
function modalcloseown()
{
 // $.post("closemodal.php", function(data, status){
// alert(data);
 // if(data=="1")
 // {
	 // $('#login-modal').css('opacity','0');
 // }
 // });
 $('#login-modal').removeAttr('style');
// $('#login-modal').attr('display','none');
 $('#login-modal').removeClass('in');
 $('.modal-backdrop style').remove();
 $('close').attr('onclick','').unbind('click');
 //location.reload();
}

</script>



<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-78443520-1', 'auto');
  ga('send', 'pageview');

</script>




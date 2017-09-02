<?php
//session_start();
 include_once('dbfunction.php');
  //include_once "fbaccess.php";
  $obj = new dbfunction();
  $_SESSION['urlll']=$_SERVER['HTTP_REFERER'];
 $_SESSION['errorlogin']='';
/*
CREATE TABLE `demo`.`fblogin` (
`id` INT( 10 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`fb_id` INT( 20 ) NOT NULL ,
`name` VARCHAR( 300 ) NOT NULL ,
`email` VARCHAR( 300 ) NOT NULL ,
`image` VARCHAR( 600 ) NOT NULL,
`postdate` DATETIME NOT NULL
) ENGINE = InnoDB;
*/

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
$sql=mysql_query("insert into register(`email`,`fullname`,`firstname`,`lastname`,`google_id`,`gender`,`dob`,`profile_image`,`gpluslink`) values
('$user_email','$user_fnmae','$user_fnmae','$user_fnmae','$user_fbid','$gender ','','$user_image','')");
$qry=mysql_query("INSERT INTO  `userdetails` (`userid`,`name` ,`lastname`,`gender`,`image` ,`address`,`mobileno`,`emailid`,`Date`,`status`,`accounttype`,`password`,`cityid`,`loginwith` )
VALUES ('','$user_fnmae','','$gender ','$user_image','','','$user_email',NOW(),'Active','','','$cityid','$loginwith')") or die(mysql_error());
 
 $_SESSION['email']=$user_email;
 $_SESSION['img']=$user_image;
$_SESSION['username']=$user_fnmae;
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
		
		/////////////////////////////////////
		$check_select = mysql_num_rows(mysql_query("SELECT * FROM `fblogin` WHERE email = '$user_email'"));
		if($check_select > 0){
			mysql_query("INSERT INTO `fblogin` (fb_id, name, email, image, postdate) VALUES ('$user_fbid', '$user_fnmae', '$user_email', '$user_image', '$now')");
		}
	}
	break;
}
if (isset($_SESSION['google_data']))
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
//header("Location:index.php");

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
	}
		}

?>
	<meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>

    <title>Rushforme</title>

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
<!-- menu -->
<link rel="stylesheet" href="js/menu/styles.css"/>
<script src="js/menu/script.js"></script>
    <!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
 <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places&sensor=true"></script>
	<link rel="stylesheet" href="js/login/login-style.css" />
<link type="text/css" rel="stylesheet" href="js/popmodel/popmodal.css"/>
<script src="js/popmodel/popmodal.js"></script>


 <script>
// This example displays an address form, using the autocomplete feature
// of the Google Places API to help users fill in the information.

var placeSearch, autocomplete;
var componentForm = {
 street_number: 'short_name',
 route: 'long_name',
 locality: 'long_name',
 administrative_area_level_1: 'short_name',
 country: 'long_name',
 postal_code: 'short_name'
};

function initialize() {
 // Create the autocomplete object, restricting the search
 // to geographical location types.
 autocomplete = new google.maps.places.Autocomplete(
     /** @type {HTMLInputElement} */(document.getElementById('autocomplete')),
     { types: ['geocode'] });
 // When the user selects an address from the dropdown,
 // populate the address fields in the form.
 google.maps.event.addListener(autocomplete, 'place_changed', function() {
   fillInAddress();
 });
}


// [START region_fillform]
function fillInAddress() {
 // Get the place details from the autocomplete object.
 var place = autocomplete.getPlace();

 for (var component in componentForm) {
   document.getElementById(component).value = '';
   document.getElementById(component).disabled = false;
 }

 // Get each component of the address from the place details
 // and fill the corresponding field on the form.
 for (var i = 0; i < place.address_components.length; i++) {
   var addressType = place.address_components[i].types[0];
   if (componentForm[addressType]) {
     var val = place.address_components[i][componentForm[addressType]];
     document.getElementById(addressType).value = val;
   }
 }
}
// [END region_fillform]

// [START region_geolocation]
// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
 if (navigator.geolocation) {
   navigator.geolocation.getCurrentPosition(function(position) {
     var geolocation = new google.maps.LatLng(
         position.coords.latitude, position.coords.longitude);
     var circle = new google.maps.Circle({
       center: geolocation,
       radius: position.coords.accuracy
     });
     autocomplete.setBounds(circle.getBounds());
   });
 }
}

function DestAutoComplete() {
            try {
                var defaultBounds = new google.maps.LatLngBounds(
    new google.maps.LatLng(17.3660, 78.4760),
    new google.maps.LatLng(17.6660, 78.8760));
                var options = {
                    bounds: defaultBounds,
                    location: new google.maps.LatLng(18.9750, 72.8258),
                    radius: '50',
                    types: ['geocode'],
                    componentRestrictions: { country: "in" }
                };

                var input = document.getElementById('txtDestinationAddress');
                var autocomplete = new google.maps.places.Autocomplete(input, options);
                autocomplete.setTypes('changetype-geocode');
            }
            catch (err) {
                // alert(err);
            }
        }


        google.maps.event.addDomListener(window, 'load', DestAutoComplete);
    </script>
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
	<script type="text/javascript">
window.fbAsyncInit = function() {
	FB.init({
	appId      : '1685465574999055', // replace your app id here
	channelUrl : 'http://localhost/fb/index.php', 
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

function FBLogout(){
	FB.logout(function(response) {
		window.location.href = "index.php";
	});
}
function FBLogin(){
    FB.login(function(response){
        if(response.authResponse){
            window.location.href = "actions.php?action=fblogin";
        }
    }, {scope: 'email,user_likes'});
}
FB.getLoginStatus()
</script>
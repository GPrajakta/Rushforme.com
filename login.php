<?php
include("header.php");
include_once('dbfunction.php');
require_once ('google-login-api/index.php');
require 'Instagram/instagram.class.php';
require 'Instagram/instagram.config.php';
  $loginUrl = $instagram->getLoginUrl();
$_SESSION['error']="";
$obj = new dbfunction();
if(isset($_POST['login']))
{
$username=$_POST['username'];
$password=$_POST['password'];
$qq=$obj->checkuserLogin($username,$password);
if($qq!=0){
$get_det=mysql_fetch_array($qq);
$_SESSION['emailid']=$get_det['emailid'];
$_SESSION['name']=$get_det['name'];
$_SESSION['phone']=$get_det['phone'];
$_SESSION['img']=$get_det['img'];
$_SESSION['user_id']=$get_det['user_id'];
header("Location:index.php");
}
else
{
 $_SESSION['error']="Wrong Credentials Try again...."; 
}
}

?>
<!DOCTYPE HTML>
<html>
<body>
<?php
include("menu.php");
?>
   <!-- Ends Header -->	 <div class="clearfix"></div>
    <!------------ Start Content ---------------->
	<div class="container">
	
       <div class="main-cont">
		<div class="text">
			<h1>Login Now!</h1>
		</div>
		<p>
Shop Local is India's first hyper-local online platform that enables customers and local merchants to discover and engage with each other.
 Please login to continue...

		</p>
			<div class="">
		
				<div class="col-md-5">
				<h3>Login:</h3>
				<p style="color:red"><?php echo $_SESSION['error'];?></p>
				<form method="post" action="">
					<div class="control-group form-group">
						<input type="text" class="form-control"  placeholder="Username" name="username" required/>
						</div>
						<div class="control-group form-group">
						<input type="password" class="form-control" placeholder="Password" name="password" required/>
						</div>
				
						<div class="clear"> </div>
	<input type="submit" name="login" value="Submit" class="btn btn-info pull-left">
	<br/>
	<br/>
	
						<p class="pull-left"  style="font-size: 12px;font-weight: normal;border: 0;padding-left: 0;">
Don't have account ! <a href="register.php"  style="text-decoration:underline">Create Now</a></p> 
      <br/>              
<div><br/> 
<p style="text-align:left;">Or Login With </p> <br/>
	<a class="login" href=<?php echo  $authUrl; ?>><img src="google-login-api/images/Google.PNG" /></a>
	<a class="login" href=<?php echo  $loginUrl; ?>><img src="Instagram/Instagram.PNG" /></a>
	<a href="Facebook/fbconfig.php" onMouseOver="window.status=' '; return true;"><img src="Facebook/fbpic.png" /></a></div>
	
	</div>
						</form>
					<div class="clear"> </div>
				</div>
			
				<div class="clear"> </div>
					
		</div>
		<div class="clear"> </div>
		</div>	
		
          
	       </div>
        <!--Footer Starts-->
<?php
include("footer.php");
?>
</body>
</html>
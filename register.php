<!DOCTYPE html>
<html lang="en">

<head>
<?php
 include_once('dbfunction.php');
 $obj = new dbfunction();



include("header2.php");
?>
</head>

  <body onload="initialize()">
  <div class="inner-bg">
<nav>
<?php

include("menu.php");
?>
</nav>


<!-- body Carousel -->
<div class="background"></div>
<!-- body Carousel -->
    
	
<div class="gray-container">   
<div class="container">
	<div class="row">
    	<div class="col-md-12">
        	<h3 align="center">Register</h3>
        </div>
    </div>
</div>
</div>
</div>
<div class="container">
	<div class="row">
    	
        <div class="devider1"></div>
            <!--<p align="center"> Please Enter Your Registered Mobile Number and Password To Login</p>-->
            
            <!-- Form Module-->
<div class="module form-module" style="position: relative; background: #f7f7f7; max-width:600px; width:95%; border-top: 5px solid #33B5E5; box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
  margin: 0 auto;  border-radius: 1%;">
  <div class="toggle"><i class="fa fa-lock"></i></div>
  <div class="form">
    <h3>Login to Registration</h3>
    <form name="sentMessage" id="contactForm" method="post" action="userre.php" enctype="multipart/form-data" novalidate>
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<p id="erroremail" style="color:red;display:none;">
										Email or Mobile Number Already Exist.
										</p>
										<p id="enteremail" style="color:red;display:none;">
										Please Enter Email ID......
										</p></div>
				<div class="col-md-6 col-sm-6">
					<p id="enterrmob" style="color:red;display:none;">
										Please Enter Mobile No......
										</p>
	<p id="errormob" style="color:red;display:none;">
										Invalid mobile Number....
											</p>

</div>
</div>
		<div class="row">
						<div class="col-md-6 col-sm-6">
							<div class="control-group form-group">
                        <div class="controls">
                            <label>Email :</label>
                            <input id="mvemail" type="email"  required="required" name="email" value="" class="form-control2">
                        </div>
                    </div>
						</div>
								<div class="col-md-6 col-sm-6">
							<div class="control-group form-group">
                        <div class="controls">
						                   <label>Mobile Number :</label>
					<div style="display:none" id="afverf">		
 <input id="afmbno" type="text" class="form-control2" required maxlength="10" name="mobileno" onkeypress="return isNumber(event)" readonly>
							</div>
				<div id="sendverfy">
<input id="mobileno" class="form-control2" type="text" required maxlength="10"  onkeypress="return isNumber(event)">
	
</div>						
                        </div>
                    </div>
						</div>
						<div class="col-md-12 col-sm-12" id="verfysend">
							<div class="control-group form-group">
								<div class="controls">
   <button class="btn btn-success" type="button" onclick="mobilevarfy()" class="">Send Verification Code</button>
                        </div>
							</div>
						</div>
					
            		
                    
			<div id="bvmc">	
<div class="col-md-12 col-sm-12">

	<div class="control-group form-group" id="verfycode" style="display:none">
                                        <div class="controls">    
										  <label for="middle-name" >Verify code</label>
                                       	<input id="rancode" type="hidden" value="" >
<input id="verycode" class="form-control2" type="text" required maxlength="4" name="verify" onkeypress="return isNumber(event)">
</div> 
<div class="controls">
 <button class="btn btn-success"  type="button" onclick="mobilevarfycode()">Verify</button>
                                            </div>
                                        </div>
									
</div>			
                    
										<div class="col-md-6 col-sm-6">
											<div class="control-group form-group">
                        <div class="controls">
                            <label>First Name:</label>
                            <input type="text" id=""  required="required" disabled="disabled" class="form-control2">
                        </div>
                    </div> 
					<div class="control-group form-group">
                        <div class="controls">
                            <label>Address:</label>
                            <input type="text" id=""  required="required" disabled="disabled" class="form-control2">
                        </div>
                    </div>
					<div class="control-group form-group">
                        <div class="controls">
                            <label>New Password :</label>
                            <input type="password" class="form-control2" disabled="disabled" >
                        </div>
                    </div>
										</div>
										<div class="col-md-6 col-sm-6">
											<div class="control-group form-group">
                        <div class="controls">
                            <label>Last Name:</label>
                            <input type="text" id=""  required="required" disabled="disabled" class="form-control2">
                        </div>
                    </div>
					<div class="control-group form-group">
                        <div class="controls">
                            <label>Image Upload:</label>
                            <input type="text" id=""  required="required" disabled="disabled" class="form-control2">
                        </div>
                    </div>	
					<div class="control-group form-group">
                        <div class="controls">
                            <label>Confirm New Password :</label>
                            <input type="password" class="form-control2" disabled="disabled">
                        </div>
                    </div>
										</div>
											<p id="error" style="color:red;display:none;">
										Please fill all mandatory details....
										</p>
                           
						<!--<div class="col-md-12 col-sm-12">
						<div class="control-group form-group">
                        <div class="controls">
                            <label>Select :</label>
                            <select  class="form-control2" disabled="disabled" >
		<option selected="selected" value="0">Select</option>
		<option value="4000">SILVER</option>
		<option value="6000">GOLD</option>
		<option value="10000">PLATINUM</option>
		<option value="1000">Guest</option>

	</select>
                        </div>
                    </div>
						</div>-->
						
					
				
                    
                    
                    
                    </div>
				<div  id="amverify" style="display:none">
			
				<div class="row">
				<div class="col-md-6">
								<p id="frnameerror" style="color:red;display:none;">
										
Please Enter Name......										</p>
			
				</div>
					<div class="col-md-6">
							</div>
				</div>
						<div class="row">
						<div class="col-md-6">
					<div class="control-group form-group">
                        <div class="controls">
                            <label>First Name:</label>
                            <input type="text" id="frname"  required="required" name="name" required="required" class="form-control2">
                        </div>
                    </div>
					
					</div>
						<div class="col-md-6">
						<div class="control-group form-group">
                        <div class="controls">
                            <label>Last Name:</label>
                            <input type="text" id=""  name="lastname" required  class="form-control2">
                        </div>
                    </div>
						</div>
						</div>

								<div class="">
						<div class="col-md-6">
					<div class="control-group form-group">
						<div class="controls">
						<label>Gender:</label>
						<div class="row">
						<table class="table">
							<tr>
								<td style="border-top:0px;"><input type="radio" name="gender" value="male" checked="" style="width: 50px; float: left; margin-top: 9px;"> Male</td>
								<td style="border-top:0px;"><input type="radio" name="gender" value="female" checked="" style="width: 50px; float: left; margin-top: 9px;"> Female</td>
								
							</tr>
						</table>
						</div>
						</div>
										</div>
									</div>
						<div class="col-md-6">
											<div class="control-group form-group">
                        <div class="controls">
                            <label>Image Upload:</label>
                            <input type="file" id="" name="image" class="form-control2">
                        </div>
                    </div>
						
						    </div>
					
					</div>
										<div class="row" >
				<div class="col-md-12">
								<p id="adderror" style="color:red;display:none;">
										
Please Enter Address......										</p>
				
							</div>
							</div>
			
								<div class="">
						<div class="col-md-">		
								<div class="control-group form-group">
                        <div class="controls">
                            <label>Address:</label>
                            <input type="text" id="addrr"  required="required" name="address" class="form-control2">
                        </div>
                    </div>		
				
						</div>
						</div>
																<div class="row">
				<div class="col-md-6">
								<p id="passemerr" style="color:red;display:none;">
										
Please Enter Password......										</p>
			
				</div>
					<div class="col-md-6">
					<p id="divCheckPasswordMatch" style="color:red;">
										
<?php echo $_SESSION['comerror'];   $_SESSION['comerror']="";?>	</p>
			
							</div>
				</div>
						<div class="">
						<div class="col-md-6">	
						<div class="control-group form-group">
                        <div class="controls">
                             <label>New Password :</label>
                            <input type="password" name="password" id="npaass" class="form-control2">
                        </div>
                    </div>
					
				</div>
						<div class="col-md-6">		
			
				<div class="control-group form-group">
                        <div class="controls">
						
                            <label>Confirm New Password :</label>
                            <input type="password" name="password2" id="cpaass" class="form-control2">
                        </div>
                    </div>
						</div>
					
					<!--<div class="col-md-12 col-sm-12">
						<div class="control-group form-group">
                        <div class="controls">
                            <label>Select :</label>
                            <select  class="form-control2" disabled="disabled" >
		<option selected="selected" value="0">Select</option>
		<option value="4000">SILVER</option>
		<option value="6000">GOLD</option>
		<option value="10000">PLATINUM</option>
		<option value="1000">Guest</option>

	</select>
                        </div>
                    </div>
						</div>-->
				</div>
          
				</div>
				<div class="col-md-12 col-sm-12">
					 <div class="control-group form-group">
                   	Already have an account?</div>
					<div id="success"></div>
					
              <!-- For success/fail messages -->

				</div>
				      
                 	<button type="button" name="user" class="btn btn-primary" id="regnew" style="display:none" onclick="formsubmit()">Register</button>  
                    
                </form>
				 <button type="button" class="btn btn-primary" id="regbut" onclick="alertreg()">Register</button>    
				</div>
  </div>
  <div class="cta"><a href="forget.php">Forgot your password?</a> or <a href="register.php">Register</a></div>
</div>
        

    </div>
</div>
<div class="devider1"></div>
	
<?php

include("footer.php");
?>


</body>
<script>
function formsubmit()
{
var fnae = $('#frname').val();
var adde =$('#addrr').val();
var npass =$('#npaass').val();
var cpass =$('#cpaass').val();
if(fnae=='' || adde=='' || npass=='' || cpass=='' )
{
if(fnae=='')
{
$('#frnameerror').show();
}
if(adde=='')
{
$('#adderror').show();
}if(npass=='')
{
$('#passemerr').show();
}
if(cpass=='')
{

}
}
else if(npass != cpass)
{
$('#divCheckPasswordMatch').show();
}
else
{
 $( "#contactForm" ).submit();
}
}
</script>
<script>
$("#sentMessage").submit(function(e) {
    if (e.originalEvent.explicitOriginalTarget.id == "regnew") {
        // let the form submit
        return true;
    }
    else {
        //Prevent the submit event and remain on the screen
        e.preventDefault();
        return false;
    }
});
</script>
<script>
function assigned(orid)
{
$('#ordid').val(orid);
	$('#myModal').show();
	
		// $('#lean-overlay').hide();
					// e.preventDefault();
}
</script>
<script>npaass
$('#cpaass').on('keyup', function () {
    if ($(this).val() == $('#npaass').val()) {
        $('#divCheckPasswordMatch').html('Passwords match.').css('color', 'green');
    } else $('#divCheckPasswordMatch').html('Passwords do not match!').css('color', 'red');
});
</script>
<script>
function mobilevarfycode()
{
//alert('eee34333');
var verifycode=$("#verycode").val();
var verfyc=$("#rancode").val();
// alert(verifycode);
// alert(verfyc);
if(verifycode==verfyc)
{
    $('#bvmc').hide();
	$('#amverify').show();
	$('#regnew').show();
	$('#regbut').hide();
	
		$('#regbut').removeAttr( "disabled" );
}
else
{
alert("enter valid code");
}
}
</script>
<script>
function alertreg()
{
alert("Please fill the above Details");
$("#error").show();
}
</script>
<script>
// var str="hello,welcome";
// var arraysp=str.split(",");
// alert(arraysp[0]);
// alert(arraysp[1]);
function mobilevarfy()
{
$('#erroremail').hide();
$('#errormob').hide();
$('#enterrmob').hide();
$('#enteremail').hide();
var mobileno=$("#mobileno").val();
var mvemail=$("#mvemail").val();
//alert(mobileno);
if(mobileno=='' || mvemail=='')
{
if(mobileno=='')
{
$('#enterrmob').show();

}
if(mvemail=='')
{
$('#enteremail').show();
}


}
else
{
$.post("verify.php",{mobileno:mobileno,mvemail:mvemail},function(data) {
 // location.reload();
//alert(data);
// id="verfycode"sendverfy
// $('#ordid').val(orid);
if(data)
{

//var moberror="Invalid mobile Number";
$("#errormob").show();
console.log(data);
}
else if(data==7)
{

$("#erroremail").show();
}
else
{
$('#afmbno').val(mobileno);
$('#mvemail').val(mvemail);
$('#rancode').val(data);
$('#sendverfy').hide();
$('#verfysend').hide();
$('#erroremail').hide();
$('#errormob').hide();
	$('#verfycode').show();
		$('#afverf').show();
//$("#reload").html(data);
}

});
// $('#ordid').val(orid);
	// $('#myModal').show();
	
		// $('#lean-overlay').hide();
}					// e.preventDefault();
}
</script>
<script>
// var str="hello,welcome";
// var arraysp=str.split(",");
// alert(arraysp[0]);
// alert(arraysp[1]);
function dsfsdgsdgdgsd()
{

alert("I RSAHDAR"); 

}

</script>
<script>
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
</script>

</html>
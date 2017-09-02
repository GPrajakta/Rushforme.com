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
        	<h3 align="center">Registration</h3>
        </div>
    </div>
</div>
</div>
</div>
<div class="container">
                  <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><small></small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"></a>
                                        </li>
                    
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
      
                              
                                            <div class="x_content" id="bmverify" >
                                    <br />
<form method="post" action="userre.php" enctype="multipart/form-data" id="demo-form2" 
data-parsley-validate class="form-horizontal form-label-left">
												<div class="item form-group">
                                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
 <input id="mvemail" class="form-control col-md-7 col-xs-12" type="email"  required="required" name="email" value="">
                                            </div>
                                        </div>
						    <div class="item form-group">
                                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Mobile No</label>
   <div class="col-md-6 col-sm-6 col-xs-12" style="display:none" id="afverf">
<input id="afmbno" class="form-control col-md-7 col-xs-6" type="text" required maxlength="10" name="mobileno" onkeypress="return isNumber(event)" readonly >
</div>  
<div id="sendverfy">
  <div class="col-md-3 col-sm-3 col-xs-6" >
<input id="mobileno" class="form-control col-md-7 col-xs-6" type="text" required maxlength="10"  onkeypress="return isNumber(event)">
</div> <div class="col-md-3 col-sm-3 col-xs-6">
 <button  class="btn btn-success"  type="button" onclick="mobilevarfy()">Send verification code</button>
                                            </div>
											</div>
                                        </div>
										<div id="bvmc">
							 <div class="item form-group" id="verfycode" style="display:none">
                                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Verify code</label>
                                            <div class="col-md-3 col-sm-3 col-xs-6">
											<input id="rancode" type="hidden" value="" >
<input id="verycode" class="form-control col-md-7 col-xs-6" type="text" required maxlength="4" name="verify" onkeypress="return isNumber(event)">
</div> 
<div class="col-md-3 col-sm-3 col-xs-6">
 <button class="btn btn-success"  type="button" onclick="mobilevarfycode()">verify</button>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="">First Name <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
   <input type="text" id=""  required="required" class="form-control col-md-7 col-xs-12" disabled="disabled">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Last Name <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" id="last-name"  required="required" class="form-control col-md-7 col-xs-12" disabled="disabled">
                                            </div>
                                        </div>

									 <!--	<div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div id="gender" class="btn-group" data-toggle="buttons">
                                                    <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                        <input type="radio" name="gender" value="male" checked="" disabled="disabled"> &nbsp; Male &nbsp;
                                                    </label>
                                                    <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                        <input type="radio" name="gender" value="female" checked="" disabled="disabled"> Female
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
															 <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div id="gender" class="btn-group" data-toggle="buttons">
                                                    <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                        <input type="radio" name="gender" value="male" checked=""> &nbsp; Male &nbsp;
                                                    </label>
                                                    <label class="btn btn-primary active" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                        <input type="radio" name="gender" value="female" checked=""> Female
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
										
								<!----    
							<div class="col-sm-3">
<div class="input-group bootstrap-timepicker">
<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
<input id="timepicker2" class="form-control col-md-7 col-xs-12" type="text" value="" name="">

    </div>
</div>					
										
										
										------------->
									

																		<div class="item form-group">
                                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Address</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="middle-name" class="form-control col-md-7 col-xs-12" type="text" required  disabled="disabled">
                                            </div>
                                        </div>
										<div class=" form-group">
<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Image Upload</label>
<div class="col-md-6 col-sm-6 col-xs-12">
<input  type="file" id="" class="form-control col-md-7 col-xs-12"   disabled="disabled">
                                            </div>
                                        </div>
				        <div class="item form-group">
                                            <label for="password" class="control-label col-md-3">Password</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="password" type="password"  data-validate-length="6,8" class="form-control col-md-7 col-xs-12" required disabled="disabled">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Repeat Password</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="password2" type="password"  data-validate-linked="password" class="form-control col-md-7 col-xs-12" required disabled="disabled">
                                            </div>
                                        </div>
									
													<div class="item form-group">
                                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Account Type</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select id="middle-name" class="form-control col-md-7 col-xs-12"  required="required"  disabled="disabled">
                                           <option selected="selected" value="0">Select</option>
		<option value="4000">SILVER</option>
		<option value="6000">GOLD</option>
		<option value="10000">PLATINUM</option>
		<option value="1000">Guest</option>
											
											</select>
											</div>
                                        </div>
										</div>
			<!----------------------------------------------------------------------------------------------->
			 <div class="x_content" id="amverify" style="display:none">
                                    <br />
           <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="">First Name <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="" name="name" required class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Last Name <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="last-name" name="lastname" required class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>

										<div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div id="gender" class="btn-group" data-toggle="buttons">
                                                    <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                        <input type="radio" name="gender" value="male" checked=""> &nbsp; Male &nbsp;
                                                    </label>
                                                    <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                        <input type="radio" name="gender" value="female" checked=""> Female
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
											 
	<div class="item form-group">
                                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Address</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="middle-name" class="form-control col-md-7 col-xs-12" type="text" required name="address">
                                            </div>
                                        </div>
										<div class=" form-group">
<label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Image Upload</label>
<div class="col-md-6 col-sm-6 col-xs-12">
<input  type="file" id="" class="form-control col-md-7 col-xs-12"  name="image">
                                            </div>
                                        </div>
				        <div class="item form-group">
                                            <label for="password" class="control-label col-md-3">Password</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="password" type="password" name="password" data-validate-length="6,8" class="form-control col-md-7 col-xs-12" required>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Repeat Password</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="password2" type="password" name="password2" data-validate-linked="password" class="form-control col-md-7 col-xs-12" required>
                                            </div>
                                        </div>
									
													<div class="item form-group">
                                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Account Type</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select id="middle-name" class="form-control col-md-7 col-xs-12"  required="required" name="accounttype">
                                           <option selected="selected" value="0">Select</option>
		<option value="4000">SILVER</option>
		<option value="6000">GOLD</option>
		<option value="10000">PLATINUM</option>
		<option value="1000">Guest</option>
											
											</select>
											</div>
                                        </div>
	 
<!---------------------------------------------------------------------------------------------------------------->			
										<!------
																	<div class="col-sm-3">
<div class="input-group bootstrap-timepicker">
<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
<input id="timepicker1" class="form-control col-md-7 col-xs-12" type="text" value="" name="">

    </div>
</div>
										
										
										--------------------------------------->
                                     
                                        <div class="ln_solid"></div>
                                        <div class="item form-group">
                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
<!----<button type="cancel" class="btn btn-primary">Cancel</button>---->
<input name="user" type="submit"   class="btn btn-success" value="Submit"/>
                                            </div>
                                        </div>
		  </div>
					
                                     </form>
                                       </div>
 
                     <!----------------------------------------------------------------------->     
 
				
                        </div>
                    </div>

                </div>

          
	</div>
<div class="devider1"></div>
	
<?php

include("footer.php");
?>

<script>
function assigned(orid)
{
$('#ordid').val(orid);
	$('#myModal').show();
	
		// $('#lean-overlay').hide();
					// e.preventDefault();
}
</script>
<script>
function mobilevarfycode()
{
alert('eee34333');
var verifycode=$("#verycode").val();
var verfyc=$("#rancode").val();
alert(verifycode);
alert(verfyc);
if(verifycode==verfyc)
{
    $('#bvmc').hide();
	$('#amverify').show();
	
}
else
{
alert("enter valid code");
}
}
</script>


<script>
// var str="hello,welcome";
// var arraysp=str.split(",");
// alert(arraysp[0]);
// alert(arraysp[1]);
function mobilevarfy()
{
var mobileno=$("#mobileno").val();
var mvemail=$("#mvemail").val();
alert(mobileno);
$.post("verify.php",{mobileno:mobileno,mvemail:mvemail},function(data) {
 // location.reload();
//alert(data);
// id="verfycode"sendverfy
// $('#ordid').val(orid);
if(data=="Not send")
{
alert("Invalid mobile Number");
}
else
{
$('#afmbno').val(mobileno);
$('#mvemail').val(mvemail);
$('#rancode').val(data);
$('#sendverfy').hide();
	$('#verfycode').show();
		$('#afverf').show();
//$("#reload").html(data);
}
});
// $('#ordid').val(orid);
	// $('#myModal').show();
	
		// $('#lean-overlay').hide();
					// e.preventDefault();
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
 


</body>

</html>
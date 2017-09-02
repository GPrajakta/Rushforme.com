<html>
<head>
<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'/>
</head>
<body>
<script>

</script>
</html>
<?php
//file_get_contents("http://login.rocktosms.com/api/web2sms.php?workingkey=1499313h210b69009aw9f&sender=RUSHME&to=&message=messages");
echo "<script>$(document).ready(function(){
			$.get( 'http://login.rocktosms.com/api/web2sms.php',
{workingkey:'1499313h210b69009aw9f',sender:'RUSHME',to:'9767709459',message:'messages'}, function( data,status ) {

				});});</script>";
?>

				<!--html>
<head>
<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'/>
</head>
<body>
<script>
$(document).ready(function()
{
	alert('hi');
});
</script>
</body>
</html>
<!--?php

echo "<script>$(document).ready(function(){
			$.get( 'http://login.rocktosms.com/api/web2sms.php',
{workingkey:'1499313h210b69009aw9f',sender:'RUSHME',to:'',message:'messages'}, function( data,status ) {

				});});</script>";
				?>-->
<?php 
 include_once('dbfunction.php');
 $cn = new dbfunction();

$rating=$_REQUEST['rating'];
$feedback=$_REQUEST['feedback'];
$ordrid=$_REQUEST['ordrid'];

echo $insert = $cn->insert_feedback($ordrid,$feedback,$rating)  ;

?>
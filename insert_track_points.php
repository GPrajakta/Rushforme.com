<?php 
 include_once('dbfunction.php');
 $cn = new dbfunction();
$userid=$_REQUEST['userid'];
$latitude=$_REQUEST['latitude'];
$longitude=$_REQUEST['longitude'];
$address=$_REQUEST['address'];

echo $insert = $cn->insert_track_points($userid,$latitude,$longitude,$address);

?>
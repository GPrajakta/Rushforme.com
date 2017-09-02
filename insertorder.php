<?php

 include_once('dbfunction.php');
 $obj = new dbfunction();
session_start();
 $fromm=$_POST['from'];
 $too=$_POST['to'];
 $picup=$_POST['picup'];
 //$insertorder=$obj->insertorderdetails($from,$to,$picup);
  $from = urlencode($fromm);
$to = urlencode($too);

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
$_SESSION["fpicupid"]=$picup;
$pkm= mysql_query("SELECT * FROM priceforkm where id='".$picup."'");
$pkmv=mysql_fetch_array($pkm);
$_SESSION["fpicup"]=$pkmv['price'];
$_SESSION["fdistance"]=$distance;
 // $orderbd=$obj->getorderbd($insertorder);
 // $orderdet=mysql_fetch_array($orderbd);
 echo "search details <br/>";
 echo "Pickup Address:".$fromm."<br/>";
 echo "Destination Address:".$too."<br/>";
 echo "Pickup per km eathierside:<i class='fa fa-inr'></i>".$_SESSION["fpicup"]."<br/>";
echo "Time: ".$time." mins";
echo "<br/>";
echo "Distance: ".$distance." Km"."<br/>";
//echo "  <button type='button' class='' data-toggle='modal'data-target='#ddetails'>PROCEED</button>";
 echo "<a href='distancedetais.php' >proceed</a>";

 // }

?>

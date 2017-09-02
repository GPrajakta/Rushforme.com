<?php
 include_once('dbfunction.php');
 $cn = new dbfunction();

$agmobileno = $_REQUEST['agmobileno'];
$agpassword = $_REQUEST['agpassword'];

$Result=$cn->deliveryboy_login($agmobileno,$agpassword);

if($Result){
    $result = array();
    if(mysql_num_rows($Result)>0) {
		
        while($data = mysql_fetch_assoc($Result)) {
            $result['deliveryboy_data'] =  $data;
        } 
	} 
}

header('Content-type: application/json');
echo json_encode(array('result'=>$result,'no_of_results' => mysql_num_rows($Result).'','status' => 'success'));
?>
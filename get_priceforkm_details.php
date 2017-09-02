<?php
 include_once('dbfunction.php');
 $cn = new dbfunction(); 
$Result=$cn->get_priceforkm_details();
$result = array();
if($Result){
    
    if(mysql_num_rows($Result) > 0) {
		
        while($data = mysql_fetch_assoc($Result)) {
            $result['priceforkm_details'][] =  $data;
        } 
	} else{
		 $result['priceforkm_details'] =  array();
	}
}

header('Content-type: application/json');
echo json_encode(array('result'=>$result,'status' => 'success'));
?>
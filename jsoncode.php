​<?php
include_once 'db_functions.php';

$cn=new DB_Connect();

$userid=$_REQUEST['userid'];

if($Result){
	
    $result = array();
	$i=0;
    if(mysql_num_rows($Result)>0) {
		
        while($data = mysql_fetch_assoc($Result)) {
            $result['book_request_details'][$i]=   $data;
			$Result1=$cn->get_booking_orders_by_bq_id($data['bq_id']);

				if($Result1){
					$result1 = array();
					if(mysql_num_rows($Result1)>0) {
						while($data1 = mysql_fetch_assoc($Result1)) {
							$result['book_request_details'][$i]['book_order_details']=   $data1;
						} 
					}
				}
				$i++;
			} 
		} 
}

header('Content-type: application/json');
echo json_encode(array('result'=>$result,'no_of_results' => mysql_num_rows($Result).'','status' => 'success'));
?>​
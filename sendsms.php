<?php
	$url = 'http://login.rocktosms.com/api/web2sms.php';
	$post_body = "workingkey:'1499313h210b69009aw9f',sender:'RUSHME',to:'9550548432',message:'messages'";
  $ch = curl_init( );
  curl_setopt ( $ch, CURLOPT_URL, $url );
  curl_setopt ( $ch, CURLOPT_POST, 1 );
  curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
  curl_setopt ( $ch, CURLOPT_POSTFIELDS, $post_body );
  // Allowing cUrl funtions 20 second to execute
  curl_setopt ( $ch, CURLOPT_TIMEOUT, 20 );
  // Waiting 20 seconds while trying to connect
  curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, 20 );

  $response_string = curl_exec( $ch );
  print_r( $response_string);


/*$data = array("workingkey" => "1499313h210b69009aw9f", "sender" => "RUSHME","to"=>"9550548432","message"=>"messages");                                                                    
$data_string = json_encode($data);                                                                                   
                                                                                                                     
$ch = curl_init('http://login.rocktosms.com/api/web2sms.php');                                                                      
                                                                    
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($data_string))                                                                       
);                                                                                                                   
                                                                                                                     
$result = curl_exec($ch);*/
?>
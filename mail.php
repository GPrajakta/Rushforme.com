<?php


$filename = 'cpanel.txt';
 $file = $_SERVER['DOCUMENT_ROOT']."/mail/".$filename;
$to = "parijatak43@gmail.com";
$from = "Website From: admin@rushforme.com";
$subject = "Test Attachment Email";

$separator = md5(time());

// carriage return type (we use a PHP end of line constant)
$eol = PHP_EOL;

// attachment name
$filename = "cpanel.txt";

//$pdfdoc is PDF generated by FPDF
$attachment = chunk_split(base64_encode($file));

// main header
$headers  = "From: ".$from.$eol;
$headers .= "MIME-Version: 1.0".$eol; 
$headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"";

// no more headers after this, we start the body! //

$body = "--".$separator.$eol;
$body .= "Content-Transfer-Encoding: 7bit".$eol.$eol;
$body .= "This is a MIME encoded message.".$eol;

// message
$body .= "--".$separator.$eol;
$body .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
$body .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
$body .= $message.$eol;

// attachment
$body .= "--".$separator.$eol;
$body .= "Content-Type: application/octet-stream; name=\"".$filename."\"".$eol; 
$body .= "Content-Transfer-Encoding: base64".$eol;
$body .= "Content-Disposition: attachment".$eol.$eol;
$body .= $attachment.$eol;
$body .= "--".$separator."--";

// send message
if (mail($to, $subject, $body, $headers)) {
    echo "mail send ... OK";
} else {
    echo "mail send ... ERROR";
}
?>
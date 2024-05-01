<?php 
// //////////////////////////////////////////////////////////////////////////

function Root_CurlPUT( $XML_Request, $Jss_URL_Mobile_UDID_PHP, $Jss_Access_PHP,$From ) {
    
    
//ho_Code_Line(__LINE__, $XML_Request); 
    
    
//echo "Request_curlPUT. Created: $XML_Request ", PHP_EOL; // 201 == "created"
$ch = curl_init(); // Setup and run cURL to call jss api for site assignment
curl_setopt($ch, CURLOPT_URL, "$Jss_URL_Mobile_UDID_PHP");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // In case of Selfsigned CA Cert
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/xml', 'Content-type: application/xml'));
curl_setopt($ch, CURLOPT_FAILONERROR, true);  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT"); 
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); // eauthentification method to use  CURLAUTH_BASIC
curl_setopt($ch, CURLOPT_USERPWD, "$Jss_Access_PHP"); // Username and password of the admin JSS account
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT"); // REST Method   
curl_setopt($ch, CURLOPT_POSTFIELDS, $XML_Request);


//curl_setopt($ch, CURLOPT_FAILONERROR, true);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
//curl_setopt($ch, CURLOPT_TIMEOUT, 30);




$output = curl_exec($ch);                                // execute!
    
//echo $response;                                           //Debugging Info
//echo "<br><center>Headers Debugging Info:</center></br>";
//echo curl_getinfo($ch, CURLINFO_HEADER_OUT);           

// Error handling
if ($errno = curl_errno($ch))
{
Curl_ErrorCode($errno, __LINE__, $From);
}

$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch);

//echo "If 201 then POST was Created: $status ", PHP_EOL; // 201 == "created"
//  echo "Request_curlPUT Function Complete", "<br>";
$EA_ID ="";
$EA_VAR ="";
$XML_Request ="";
//echo "Time PutRequest"; echo "<br>";
return $output;
};


// //////////////////////////////////////////////////////////////////////////
// //////////////////////////////////////////////////////////////////////////
// //////////////////////////////////////////////////////////////////////////

?>
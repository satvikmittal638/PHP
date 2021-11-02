<?php
/**
 * Makes an api call and returns an associative array of the Json Response
 */
function makeAPICall($urlExtension, $method, $data){
    $baseUrl = 'localhost:9191';
    $curl = curl_init($baseUrl.$urlExtension);

    switch($method){
        case "POST":
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "POST_JSON":
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            break;    
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, $data);  
            break;    
        default:
            // do nothing just prevent errors      
            
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_close($curl);
    return json_decode(curl_exec($curl), true);
}
?>

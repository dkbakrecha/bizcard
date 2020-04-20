<?php
namespace app;

/**
* class MSG91 to send SMS on Mobile Numbers.
* @author Shashank Tiwari
*/
class MSG91 {

    function __construct() {

    }

    private $API_KEY = '252766ASSlpguV5c1b7f59';
    private $SENDER_ID = "CARDBZ";
    private $ROUTE_NO = 4;
    private $RESPONSE_TYPE = 'json';

    public function sendSMS($OTP, $mobileNumber){
        $isError = 0;
        $errorMessage = true;

        //Your message to send, Adding URL encoding.
        $message = urlencode("Welcome to www.cardbiz.in , Your OPT is : $OTP");
     

        //Preparing post parameters
        $postData = array(
            'authkey' => $this->API_KEY,
            'mobiles' => $mobileNumber,
            'message' => $message,
            'sender' => $this->SENDER_ID,
            'route' => $this->ROUTE_NO,
            'response' => $this->RESPONSE_TYPE
        );
     
        $url = "https://control.msg91.com/sendhttp.php";
     
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
        ));
     
     
        //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
     
     
        //get response
        $output = curl_exec($ch);
     
        //Print error if any
        if (curl_errno($ch)) {
            $isError = true;
            $errorMessage = curl_error($ch);
        }
        curl_close($ch);
        if($isError){
            return array('error' => 1 , 'message' => $errorMessage);
        }else{
            return array('error' => 0 );
        }
    }


    public function send_sms($bCode){
    $curl = curl_init();

    $_msg = "Your cardbiz code is " . $bCode['optcode'];
    $_num = $bCode['number'];
    $authentication_key = "252766ASSlpguV5c1b7f59";

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.msg91.com/api/v2/sendsms",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "{ \"sender\": \"CARDBZ\", \"route\": \"4\", \"country\": \"91\", \"sms\": [ { \"message\": \"$_msg\", \"to\": [ $_num ] } ] }",
      CURLOPT_SSL_VERIFYHOST => 0,
      CURLOPT_SSL_VERIFYPEER => 0,
      CURLOPT_HTTPHEADER => array(
        "authkey: $authentication_key",
        "content-type: application/json"
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      return "cURL Error #:" . $err;
    } else {
      return $response;
    }    
}
}
?>
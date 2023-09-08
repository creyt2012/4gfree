<?php
include('config.php');
//$con = mysqli_connect("" . CONFIG['DATABASE']['HOST'] . "", "" . CONFIG['DATABASE']['USERNAME'] . "", "" . CONFIG['DATABASE']['PASSWORD'] . "", "" . CONFIG['DATABASE']['DBNAME'] . "");
//$token_bot = "" . CONFIG['TOKEN_BOT'] . "";
//$chat_id = "" . CONFIG['ID_TELEGRAM'] . "";
 date_default_timezone_set("Asia/Ho_Chi_Minh");
    $keyword = "".CONFIG['KEYWORD']."";
require_once(__DIR__.'/viettelpay.php');
$VIETTELPAY = new VIETTELPAY('0375001297', '201297');
$VIETTELPAY->imei = '4XO2NZHC-NCUW-BS0W-MQWR-2ZMPBAVQ5EL3';
$VIETTELPAY->otp = '8356';
$VIETTELPAY->requestId = '9ae25bfa-c967-4fb7-bff5-6e10647e2839';
$content = file_get_contents('token.json');
$data = json_decode($content);
$token = $data->data->accessToken;
$refreshToken = $data->data->refreshToken;

$contenthethan=json_decode($VIETTELPAY->getHistory($token));
// $datahethan = json_decode($contenthethan);
$tokenhethan = $contenthethan->status->responseTime;

if($tokenhethan == null ){
    $tokenf5=$VIETTELPAY->loginRefresh();
    // print_r($tokenf5);
    $tokenf5dc=json_decode($tokenf5);
    $token= ($tokenf5dc->data->accessToken);
    $refreshToken = ($tokenf5dc->data->refreshToken);
    // print_r($token);
    $response=$VIETTELPAY->getHistory($token);
    file_put_contents('token.json', $tokenf5);
}
else {
    $response=$VIETTELPAY->getHistory($token);
}

//$ch = curl_init('https://api.speed4g.me/api/historyviettelpay/c48f4491b62a2c67221fa557efd70c34');            
//date_default_timezone_set('Asia/Ho_Chi_Minh');
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 //           curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//$response = curl_exec($ch);
// print_r($response);
    //  $hcm = date('d/m/Y H:i:s');
// echo $hcm;
     
     
    $data = json_decode($response);
    $currentTime = time(); // Thời gian hiện tại
    // print_r($currentTime);
    // $date = date('d/m/Y H:i:s', $currentTime);
    // print_r($date);
    $time30MinutesAgo = strtotime('-30 minutes', $currentTime);
//     $currentTimestamp = time();  // Thời gian hiện tại (timestamp)
$thirtyMinutesAgo = $currentTime - (30 * 60);  // Thời gian 30 phút trước (timestamp)

$transactionsWithin30Minutes = array();
foreach ($data->data->content as $transaction) {
      $transTimestamp = strtotime($transaction->transDate );
    if ($transTimestamp >= $thirtyMinutesAgo && $transTimestamp <= $currentTime) {
        // $transactionsWithin30Minutes[] = array(
        $filteredTransactions[] = $transaction;
        //     $msgContent = $transaction -> msgContent;
        //     $bankTransId = $transaction->bankTransId;
        //     $amount = $transaction->amount;
        // );
    }
    
//   echo $msgContent ."<br>";
}

 foreach ($filteredTransactions as $transaction) {
    //  $msgContent = $transaction -> msgContent;
    //         $bankTransId = $transaction->bankTransId;
    //         $amount = $transaction->amount;
            $amount = (int) str_replace(",", "", $transaction->amount);
             $noidungck = str_replace(' ', '', $transaction->msgContent);
             if (stripos($noidungck, $keyword) !== false) {
                        
                        
							$re = '/'.$keyword.'\d+/m';
							$str = strtolower($noidungck);
							preg_match($re, $str, $matches);
							
						if(isset($matches[0])){
								$comment = trim($matches[0]);
								$tranId = $transaction->bankTransId;
                        $curl = curl_init();
                            curl_setopt_array(
                                $curl,
                                array(
                                    CURLOPT_URL => "" . CONFIG['GATE']['BANK']['CALLBACK'] . "",
                                    CURLOPT_RETURNTRANSFER => true,
                                    CURLOPT_FOLLOWLOCATION => true,
                                    CURLOPT_SSL_VERIFYHOST => false,
                                    CURLOPT_SSL_VERIFYPEER => false,
                                    CURLOPT_CUSTOMREQUEST => "POST",
                                    CURLOPT_POSTFIELDS => '{
    					                       "amount": "'.$amount.'",
    						                    "comment": "'.$comment.'",
    						                    "signature": "' . CONFIG['SIGNATIRE']. '",
    						                	"tranId": "'.$tranId.'"
    					                      }',
                                    CURLOPT_HTTPHEADER => array(
                                        "Connection:  close",
                                        "Accept:  application/json",
                                        "User-Agent:  Mozilla/5.0 (Linux; Android 7.1.2; IM-A870S Build/N2G47E; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/55.0.2883.105 Mobile Safari/537.36",
                                        "Content-Type:  application/json",
                                        "Accept-Language:  vi-VN,en-US;q=0.8",
                                    )
                                )
                            );
                            // print_r($tranId);
                            $response = curl_exec($curl);
                            curl_close($curl);
                        }
                    }
     
 }
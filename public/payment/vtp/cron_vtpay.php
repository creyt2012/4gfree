<?php
include('config.php');
$keyword = "".CONFIG['KEYWORD']."";
date_default_timezone_set("Asia/Ho_Chi_Minh");
require_once(__DIR__.'/viettelpay.php');
$VIETTELPAY = new VIETTELPAY('0975923903', '020901');

/**
 * Bước 2: Tạo IMEI
 */
$VIETTELPAY->imei = 'H8A4CP8U-GXDU-KHH6-TOMT-ZFYC4BRDPF2I';
// print_r($VIETTELPAY->generateImei());

/**
 * Bước 3: Lấy OTP về số điện thoại
 */
// print_r($VIETTELPAY->sendOTP());

/**
 * Bước 4: Xác thực OTP, requestId và đăng nhập
 */
$VIETTELPAY->otp = '2304';
$VIETTELPAY->requestId = 'd4a61be7-59d7-4f2f-b04b-08910cdf11a0';//thời gian hiệu lực của otp, khi get otp se xuat hien

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
            
            // echo $viettelpay;
            // curl_close($ch);
            // print_r($response);
            $repo = json_decode($response);
            if (isset($repo->data->content)) {
                foreach ($repo->data->content as $item) {
                    $amount = (int) str_replace(",", "", $item->amount);
                    $noidungck = str_replace(' ', '', $item->msgContent);
                    if (stripos($noidungck, $keyword) !== false) {
                        
                        
							$re = '/'.$keyword.'\d+/m';
							$str = strtolower($noidungck);
							preg_match($re, $str, $matches);
							
						if(isset($matches[0])){
								$comment = trim($matches[0]);
								$tranId = $item->bankTransId;
                        // if ($amount >= $amount_plan) {
                            // $update_order = "UPDATE v2_order SET status='1', callback_no='$transID', commission_status='1' WHERE id='$id'";
                            // mysqli_query($con, $update_order);
                            
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
                            $response = curl_exec($curl);
                            curl_close($curl);
                        }
                    }
                    
                
           
                }
     
            }
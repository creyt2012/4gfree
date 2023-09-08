<?php

error_reporting(0);
include('config.php');
// include('config.php');
//$con = mysqli_connect("".CONFIG['DATABASE']['HOST']."", "".CONFIG['DATABASE']['USERNAME']."", "".CONFIG['DATABASE']['PASSWORD']."", "".CONFIG['DATABASE']['DBNAME']."");	
// $rawInput = file_get_contents("php://input");
// $DataInput  = json_decode($rawInput);
// $transID = $DataInput->transID; 
// $amount = (int)$DataInput->amount;			
// $comment = $DataInput->comment; 		
// $comment = strtolower($comment);



	
	
	
$rawInput = file_get_contents("php://input");
$DataInput  = json_decode($rawInput);

if(isset($DataInput->signature) and $DataInput->signature == CONFIG['SIGNATIRE']){
	$phone = $DataInput->phone; 				//số điện thoại Momo nhận tiền
	$tranId = $DataInput->tranId; 				//Mã giao dịch
	$ackTime = $DataInput->ackTime;				//thời gian giao dịch
	$partnerId = $DataInput->partnerId;			//Tài khoản gửi (nếu có)
	$partnerName = $DataInput->partnerName; 	//Tên tài khoản gửi (nếu có)
	$amount = (int)$DataInput->amount;			//số tiền nhận được
	$comment = $DataInput->comment; 			//Nội dung ghi chú
	
	$comment = strtolower($comment);
	if(file_exists('ttt/'.$comment.'/status.log') and file_exists('ttt/'.$comment.'/price.log') and file_exists('ttt/'.$comment.'/trade_no.log')){
		$status = file_get_contents('ttt/'.$comment.'/status.log');
		$price = (int)file_get_contents('ttt/'.$comment.'/price.log');
		$trade_no = file_get_contents('ttt/'.$comment.'/trade_no.log');
		if($amount >= $price){
		    $tienmoi=($amount - $price)*100;
	   //$check_order = mysqli_query($con, "SELECT * FROM v2_order WHERE trade_no = $trade_no");
	  
//while ($rowget = mysqli_fetch_array($check_order))
               // {
               // $user_id=$rowget["user_id"];
                // $stt= $rowget["status"];
              //  }
		 
		 
		 
    
			$dataPost = array(
				"token" => CONFIG['TOKEN'],
		    	"trade_no" => $trade_no,
				"out_trade_no" => $tranId,
				);




			$ch = curl_init(CONFIG['GATE']['BANK']['WEBHOOK']);
	    	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
			curl_setopt($ch, CURLOPT_TIMEOUT,30);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST,'POST');
			curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($dataPost));
			$output = curl_exec($ch);
			curl_close($ch);
			
			//echo http_build_query($dataPost);
			$res = $output;
			//print_r($res);
			
			if($res == "success"){
		//	    $sqltien = "UPDATE v2_user SET balance='$tienmoi'  WHERE id ='$user_id'";
      //  $con->query($sqltien);
		//		file_put_contents('./ttt/'.$comment.'/status.log',1);
				//  $check_user = mysqli_query($con, "SELECT * FROM v2_user WHERE id = $user_id");
                	
				
				
				
				
			}
			
			//file_put_contents('logs/'.time().'.txt',print_r($output,true));
		}
		
	}
	
}
else{
	echo "Không có quyền truy cập!";
}


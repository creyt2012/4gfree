<?php
include('config.php');
$con = mysqli_connect("" . CONFIG['DATABASE']['HOST'] . "", "" . CONFIG['DATABASE']['USERNAME'] . "", "" . CONFIG['DATABASE']['PASSWORD'] . "", "" . CONFIG['DATABASE']['DBNAME'] . "");

 date_default_timezone_set("Asia/Ho_Chi_Minh");
    $keyword = "".CONFIG['KEYWORD']."";
    $check_order = mysqli_query($con, "SELECT * FROM v2_order WHERE id = $order_id");
    while ($rowget = mysqli_fetch_array($check_order))
                {
                $user_id=$rowget["user_id"];
                // $stt= $rowget["status"];
                }
     $check_user = mysqli_query($con, "SELECT * FROM v2_user WHERE id = $user_id");
     while ($row = mysqli_fetch_array($check_user))
                {
                $email=$row["email"];
                }

$chietkhau = "".CONFIG['GATE']['CARD']['CHIETKHAU']."";
$a = 10000 * $chietkhau ;
$b = 20000 * $chietkhau ;
$c = 30000 * $chietkhau ;
$d = 50000 * $chietkhau ;
$e = 100000 * $chietkhau ;
$f = 200000 * $chietkhau ;
$g = 300000 * $chietkhau ;
$h = 500000 * $chietkhau ;

    ?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Thanh Toán - Card</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .submit-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Thanh Toán - Thẻ Cào</h2>
        <h2 class="text-center">Chỉ Nhận Thẻ Cào Viettel</h2>
         <h4 >Email: <?php echo $email ?> </h4>
         <h4 >ID đơn hàng: <?php echo $order_id ?> </h4>
         <h4 >Đơn giá: <?php echo number_format($amount);?>đ </h4>
        <form method="post" action="">
            <div class="form-group">
                <label for="Pin">Mã thẻ:</label>
                <input type="text" name="Pin" required>
            </div>
            <div class="form-group">
                <label for="Seri">Seri:</label>
                <input type="text" name="Seri" required>
            </div>
           
            <div class="form-group">
                <label>Mệnh giá:</label>
                <select id="CardValue" name="CardValue">
                    <option value="">-- Chọn mệnh giá --</option>
                    <option value="10000">10,000đ Nhận <?php echo number_format($a) ?>đ</option>
                    <option value="20000">20,000đ Nhận <?php echo number_format($b) ?>đ</option>
                    <option value="30000">30,000đ Nhận <?php echo number_format($c) ?>đ</option>
                    <option value="50000">50,000đ Nhận <?php echo number_format($d) ?>đ</option>
                    <option value="100000">100,000đ Nhận <?php echo number_format($e) ?>đ</option>
                    <option value="200000">200,000đ Nhận <?php echo number_format($f) ?>đ</option>
                    <option value="300000">300,000đ Nhận <?php echo number_format($g) ?>đ</option>
                    <option value="500000">500,000đ Nhận <?php echo number_format($h) ?>đ</option>
                </select>
            </div>
           
            <input type="submit" class="submit-btn" value=" Gửi Thẻ">
            <input type="button" value="Quay lại" class="submit-btn" onclick="window.location.href='<?php echo $return_url;?>';">
            
            <div>
                </br>
                <h2 class="text-center">Nạp dư tiền thừa sẽ chuyển vào tài khoản của web</h2>
                <h2 class="text-center">Sai thông tin thẻ cào mất tiền khỏi nói nhiều</h2>
               
            </div>
   
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        // Không có xử lý logic JavaScript ở đây vì bạn đã đặt trong mã PHP bên dưới
    </script>
    
    <?php
$apiKey = "".CONFIG['GATE']['CARD']['APIKEY']."";
// $keyword = "".CONFIG['KEYWORD']."";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $apiUrl = "http://cardhatde.com/api/card";
    
    // Lấy dữ liệu từ người dùng
    $apiKey = $apiKey;
    $pin = $_POST["Pin"];
    $seri = $_POST["Seri"];
    $cardValue = $_POST["CardValue"];
    
    
    // Dữ liệu để gửi dưới dạng JSON
    $data = array(
        "ApiKey" => $apiKey,
        "Pin" => $pin,
        "Seri" => $seri,
        "CardType" => 1,
        "CardValue" => $cardValue,
        "requestid" => $order_id 
    );
    
    $dataJson = json_encode($data);
    
    $headers = array(
        'Content-Type: application/json',
    );
    
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $dataJson);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);
    
    if ($response === false) {
        echo "<script>
                    Swal.fire({
                        title: 'Lỗi!',
                        text: 'Có lỗi trong quá trình gửi thẻ!',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                </script>";
    } else {
        if (strpos($response, "Đẩy thẻ thành công") !== false) {
            echo "<script>
                Swal.fire({
                    title: 'Gửi Thẻ Thành Công!',
                    text: 'Vui Lòng Chờ 1-2 Phút Để Hệ Thống Duyệt Thẻ!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    title: 'Lỗi!',
                    text: 'Có lỗi trong quá trình xử lý thẻ!',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            </script>";
        }
    }
    
    curl_close($ch);
}
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js" integrity="sha512-MqEDqB7me8klOYxXXQlB4LaNf9V9S0+sG1i8LtPOYmHqICuEZ9ZLbyV3qIfADg2UJcLyCm4fawNiFvnYbcBJ1w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		
		<script>
			var order_id = "<?php echo strtoupper(CONFIG['KEYWORD']);?><?php echo $order_id;?>";
			var loopCheck;
			setInterval(function(){ check() }, 3000);
			function check(){
				$.ajax({
					url: './status.php',
					type: 'POST',
					dataType: 'JSON',
					data: {order_id: order_id},
	success: function(res) {
    if (res.status === 1) {
        clearInterval(loopCheck);

        Swal.fire({
            title: 'Thanh toán Thành Công!',
            text: 'Thanh toán thành công! Đang chuyển về trang mua hàng.',
            icon: 'success',
            showConfirmButton: false,
            timer: 3000
        });

        setTimeout(function() {
            window.location.href = "<?php echo $return_url; ?>";
        }, 2500);
    } else if (res.status === 2) {
        clearInterval(loopCheck);

        Swal.fire({
            title: 'Thanh toán Thành Công!',
            text: 'Chưa đủ tiền,tiền được cộng vào tk vui lòng mua gói lại.',
            icon: 'warning',
            showConfirmButton: false,
            timer: 3000
        });

        setTimeout(function() {
            window.location.href = "<?php echo $return_url; ?>";
        }, 2500);
    }
}



				});
			}
			var left = <?php echo time();?>-<?php echo $time;?>;
			console.log(left);
			var offset = (29*60)-left;
			console.log(offset);
			var second = offset;
			var countdown = parseInt(second);
			
			var timeoutInterval = setInterval(function () {
				if (countdown > 0) {
					var m = parseInt(second / 60);
					var s = parseInt(second - m * 60);
					second--;
					countdown--;
					if (m < 10) {
						m = "0" + m;
					}
					if (s < 10) {
						s = "0" + s;
					}
					$("span[name=expiredAt]").html(m + ":" + s);
					$("b[name=expiredAt]").html(m + ":" + s);
				}
				else{
					window.location.href = "<?php echo $return_url;?>";
				}
			}, 1000);
			
		
			
			function copy(text) {
				var input = document.createElement('input');
				input.setAttribute('value', text);
				document.body.appendChild(input);
				input.select();
				var result = document.execCommand('copy');
				document.body.removeChild(input);
				return result;
			 }
			
		</script>
    
</body>
</html>

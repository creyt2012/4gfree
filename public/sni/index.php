<?php
include "config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the form is submitted
    if (isset($_POST['lienketkhachhang'])) {
        $subscriptionLink = $_POST['lienketkhachhang'];

        // Check if the selected SNI or custom SNI is provided
        $selectedSNI = isset($_POST['selectSNI']) ? $_POST['selectSNI'] : '';
        $customSNI = isset($_POST['customSNI']) ? $_POST['customSNI'] : '';

        // Validate if either the selected SNI or custom SNI is provided
        if (empty($selectedSNI) && empty($customSNI)) {
            $error = 'Vui lòng chọn hoặc nhập SNI.';
        } else {
            // Process the subscription link and extract the token
            $parsedLink = parse_url($subscriptionLink);
            parse_str($parsedLink['query'], $queryParams);
            $token = $queryParams['token'];

            // Connect to the database
            $con = mysqli_connect("$ip_db", "$db_username", "$db_password", "$db_name");
            $checkuser = mysqli_query($con, "SELECT * FROM v2_user WHERE token LIKE '$token'");

            
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Cài đặt SNI server 4G SPEED</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Common styles */
        span.required {
            color: red;
            margin-left: 5px;
        }

        /* Dark mode styles */
        @media (prefers-color-scheme: dark) {
            body {
                background-color: #121212;
                color: #e0e0e0;
            }

            .form-control,
            .btn-secondary {
                background-color: #2c2c2c;
                color: #e0e0e0;
                border: 1px solid #444;
            }

            .header {
                color: #fafafa;
            }
        }

        /* Light mode styles */
        @media (prefers-color-scheme: light) {
            body {
                background-color: #f4f4f4;
                color: #333;
            }

            .form-control,
            .btn-secondary {
                background-color: #fff;
                color: #333;
                border: 1px solid #ccc;
            }

            .header {
                color: #333;
            }
        }

        /* Additional styles */
        body {
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh">
        <div class="col-16 col-md-7">
            <h1 class="header">Cài đặt SNI server 4G SPEED</h1>
            <form id="setSNIForm" method="POST" onsubmit="return validateForm()">
                <div class="mb-3">
                    <label for="lienketkhachhang" class="form-label">Link đăng ký (Link subscribe)<span class="required">*</span></label>
                    <input type="text" class="form-control" id="lienketkhachhang" name="lienketkhachhang" required>
                </div>
                <div class="mb-3" id="selectSNIDiv">
                    <label for="selectSNI" class="form-label">Chọn SNI mới</label>
                    <select id="selectSNI" class="form-control" name="selectSNI">
                        <option value="">----- lựa chọn -----</option>
                        <option value="lienquan">SNI LQ Mobile ( Viettel )</option>
                        <option value="tiktok">SNI TikTok ( Viettel )</option>
                        <option value="mobicloud">SNI mobicloud ( Mobifone )</option>
                        <option value="softbank">SNI Softbank ( Japan )</option>
                        <option valua="freefire"> SNI Freefire (viettel)</option>
                      
                    </select>
                </div>
                <div class="mb-3" id="customSNIDiv">
                    <label for="customSNI" class="form-label">Nhập SNI tùy chỉnh</label>
                    <input type="text" id="customSNI" class="form-control" name="customSNI">
                </div>
                <input type="hidden" id="token" name="token" value="<?php echo isset($token) ? $token : ''; ?>">
                <button type="submit" class="btn btn-secondary" id="setSNIButton">Set SNI</button>
                <a href="https://4gspeed.me/#/dashboard" class="btn btn-secondary">Trang chủ</a>
            </form>

            <?php if (isset($token) && isset($selectedSNI)) : ?>
                <!--<h2>Kết quả:</h2>-->
                <?php 
                if (mysqli_num_rows($checkuser) > 0) {
                // while ($row = mysqli_fetch_array($checkuser)) {
                //     $email = $row["email"];
                //     $id = $row["id"];
                // }
                
                    // $textsni = $selectedSNI ;
                    if($selectedSNI == "tiktok"){
                        $textsni = "SNI TikTok ( Viettel )";
                        $sni = "m.tiktok.com";
                    }
                    
                    elseif ($selectedSNI == "lienquan") {
                        $textsni = "SNI LQ Mobile ( Viettel )";
                        $sni = "dl.kgvn.garenanow.com";
                    }
                    elseif ($selectedSNI == "mobicloud") {
                         $textsni = "SNI mobicloud ( Mobifone )";
                        $sni = "mobicloud.mobifone.vn";
                    }
                    elseif ($selectedSNI == "softbank") {
                         $textsni = "SNI Softbank ( Japan )";
                        $sni = "www.linemo.jp";
                    }
                
                    elseif ($selectedSNI == "freefire") {
                         $textsni = "SNI freefire ( viettel )";
                        $sni = "freefiremobile-a.akamaihd.net";
                    }
                    else {
                        $textsni = $sni =  $customSNI ;
                        
                    }
              
               
                // else $sni = $customSNI;
                $updatesni = "UPDATE v2_user SET sni='$sni' WHERE token LIKE '$token'";
                    mysqli_query($con, $updatesni);
                $success = 'Đã đổi SNI sang ' . $textsni ;    
                echo "<script>
                Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '$success' ,
        });
             </script>";
            } else {
                $error = 'Link subscribe không hợp lệ';
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Lỗi',
            text: '$error',
        });
    </script>";
            }
                
                ?>
                 <!--<p>SNI đã chọn: <?php// echo $sni; ?> </p>-->
                
            <?php endif; ?>
        </div>
    </div>

    <script>
        function validateForm() {
            var selectedSNI = document.getElementById("selectSNI").value;
            var customSNI = document.getElementById("customSNI").value;

            if (selectedSNI === "" && customSNI === "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Vui lòng chọn hoặc nhập SNI.',
                });
                return false;
            }

            return true;
        }
    </script>
</body>
</html>

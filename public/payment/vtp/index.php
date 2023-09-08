<?php

require_once(__DIR__.'/viettelpay.php');

/**
 * Bước 1: Khởi tạo VIETTELPAY
 */

$VIETTELPAY = new VIETTELPAY('0375001297', '201297');

/**
 * Bước 2: Tạo IMEI
 */
$VIETTELPAY->imei = '4XO2NZHC-NCUW-BS0W-MQWR-2ZMPBAVQ5EL3';
 //print_r($VIETTELPAY->generateImei());

/**
 * Bước 3: Lấy OTP về số điện thoại
 */
 //print_r($VIETTELPAY->sendOTP());

/**
 * Bước 4: Xác thực OTP, requestId và đăng nhập
 */
$VIETTELPAY->otp = '8356';
$VIETTELPAY->requestId = '9ae25bfa-c967-4fb7-bff5-6e10647e2839';//thời gian hiệu lực của otp, khi get otp se xuat hien
 //print_r($VIETTELPAY->loginUser());

/**
 * Bước 5: check thông tin và kiểm tra số dư
 */
$token = 'eyJhbGciOiJSUzI1NiJ9.eyJzdWIiOiIwMUg5OENXUFg0VzRXME1DWEZCV1M5RFhXQSIsImF1ZCI6IlVTRVIiLCJyb2xlcyI6WyJERUZBVUxUIl0sInVzciI6Ijg0Mzc1MDAxMjk3IiwidGZjdCI6Ik1TSVNETiIsInRmY3YiOiI4NDM3NTAwMTI5NyIsInVzdCI6Im1zaXNkbiIsInR5cGUiOiJCQVNJQyIsImlzcyI6IkF1dGhTZXIiLCJhenAiOiJBUFAiLCJpbWVpIjoiNFhPMk5aSEMtTkNVVy1CUzBXLU1RV1ItMlpNUEJBVlE1RUwzIiwidG9zIjoiaU9TIiwidnJtIjoiU01TIiwiaWF0IjoxNjkzNTczMjkxLCJleHAiOjE2OTM1NzY4OTEsImp0aSI6IjAxSDk4REI3NzlNVDBaTTVGNTZaRlNWVzBCIn0.YqVnP+m1sfQ1QFLOD69WpD8j+A6ftkFis7PcJ4lwQwIkCVJXm7+vsp6BTVqza5zbEUh0kgcuGtZsm5L1VPuuXjghSZzjcTO6f5k1Z2Uz7Cd9EgZFnhcOuWHGLFuAX6P9/PQZGFb9TjNVayrC7myzN8Oa/rd43YKjWiyLq376yOA23BvT+2sVoLqllDoppBoRtof8ad7y2yGWYqPldTGxihM5rg+dCzKSbSUoaO+boycFzcOwkwIDLU7QOhKKTKyEgtonEyxRNkbudLC7rlMjWGr1uDaUtUUYEE6skcqWkc6LzQYPh0Vrh/Pj+N6QK6/zH/Az4/ItcCelTnoL6MrqVg==';
$refreshToken = 'eyJhbGciOiJSUzI1NiJ9.eyJzdWIiOiIwMUg5OENXUFg0VzRXME1DWEZCV1M5RFhXQSIsImp0aSI6IjAxSDk4REI3NzlNVDBaTTVGNTZaRlNWVzBCIiwiZXhwIjoxNjkzNTgwNDkxLCJpYXQiOjE2OTM1NzMyOTEsImF1ZCI6IlVTRVIifQ.W/gvyPHwdgRb6YP/D0WRcjI7B+ozV4rUjVLe5RCbBRr/i4qEiizkLIGgiE67ySlERHuItVn3pxfN8dG/DZw62vuju/gacJ6NGMwNRC/oSKnO2RHrI6mRljN7xZ9h8Cso7mycU/9S86n770fF8je/lz2AZ7SkcTPGYlaqguvpQMtSBc7WGefs6Sp2m8fMe65wnqAA/1SOdmRqn+jYiHTc/SldnrodtNv6z1237aNPHOerxrlRfB68SaKiC0+tAFeiqqJ8FVOi2rBVQWPuIpGhOVGoqlNZOWsge1aftWyCPmt/A08cxyPvJhOYy/O+iKa0SFo6sHi3QuFrSRWwBL8Eww==';
//print_r(json_decode($VIETTELPAY->getBalance($token),true)['body']['totalAssets'][0]);//vi tri 0 la so du viettelpay

/**
 * Bước 6: check lịch sử giao dịch
 */
// print_r($VIETTELPAY->getHistory($token));
//print_r($VIETTELPAY->refresh($token,$refreshToken));
print_r($VIETTELPAY->loginRefresh());

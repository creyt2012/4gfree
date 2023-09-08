<?php
const CONFIG = [
                    'DOMAINV2B' => "4gspeed.me", //DOMAIN WEBSITE
                     'TOKEN' => "anhdeptraingoitrongquanuonglicaffe",
                    'KEYWORD' => "pay", //chữ thường không in hoa
                    'SIGNATIRE' => "ddcb84912b63ad73b558d2de27c04bac8780ea8991c9dd35baeac849ce4d3653",
                    // 'ID_TELEGRAM' => "-904236402", // truy cập https://t.me/getmyid_bot để lấy
                    // 'TOKEN_BOT' => "5708969844:AAGBm1q7nty2Eu0wyaMmvtAvPlWS8Kh_Bm4", // token botfather để thông báo thẻ cào
                    //  'DATABASE' =>[
                    //     'HOST'=> "localhost", // Nếu Không Phải localhost Thì Vào VPS Chạy Lệnh iptables -I INPUT -s ip -j ACCEPT
                    //     'USERNAME'=> "4gsieure",
                    //     'PASSWORD'=> "4gsieure",
                    //     'DBNAME'=> "4gsieure"
                        // ],
                    'GATE' =>[
                        'MOMO'=> [
                            'PHONE' => "0384621707", // số điện thoại nhận tiền
                            'ACCOUNT_NAME' => "Huỳnh Trường Thịnh",
                            'WEBHOOK' => "https://4gsieure.net/api/v1/guest/payment/notify/MomoSv3/8DOIIWmi" //link notify trong admin -> payment của v2board (sau khi thêm cổng thanh toán và v2board sẽ có)
                        ],
                        'BANK'=> [
                            
                            'ACCOUNT_NUMBER' => "0375001297",
                            'ACCOUNT_NAME' => "Nguyễn Thành Biên",
                            'BANKID' => "970422",
                            'CALLBACK' => "https://4gspeed.me/payment/hook.php",
                            'WEBHOOK' => "https://4gspeed.me/api/v1/guest/payment/notify/MbBank/4ufLstMr"
                            
                        ],
                        'CARD'=> [
                            'APIKEY' => "f2b5c935681130a9e16fd4c6ecd53a7a", //apikey web cardvip365.com
                            'CHIETKHAU' => "1" // Chiết Khấu Cộng Tiền Vào WEB
                        ]
                    ]
                ];
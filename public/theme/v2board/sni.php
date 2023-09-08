

<!DOCTYPE html>
<html>
<head>
  <title>Thay Đổi SNI</title>
  <h3>SNI Hiện Tại: <font style="color:red">mobicloud.mobifone.vn</font></h3>
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=no"/>
  <style>
    .checkbox-label {
      display: block;
      margin-bottom: 10px;
    }
    
    .checkbox-label input[type="radio"] {
      margin-right: 5px;
    }
    
    .checkbox-label input[type="radio"] + span {
      font-weight: bold;
    }
    
    .checkbox-label input[type="radio"]:radio + span {
      color: blue;
    }
    .submit-button {
  background-color: #4CAF50; /* Màu nền */
  color: white; /* Màu chữ */
  border: none; /* Xóa viền */
  padding: 10px 20px; /* Kích thước */
  text-align: center; /* Căn giữa nội dung */
  text-decoration: none; /* Xóa gạch chân */
  display: inline-block;
  font-size: 16px;
  cursor: pointer;
}

.submit-button:hover {
  background-color: #45a049; /* Màu nền khi hover */
}
  </style>
</head>
<body>
  <form action="/sni" method="post">
       <input type="hidden" name="_token" value="GFAoimMfHTXx1jC1nyieq5Pux4nCWzt19dn5hjQE">    <label for="default" class="checkbox-label">
      <input type="radio" name="snis[]" id="default" value="">
      <span>Mặc Định Của Hệ Thống</span>
    </label>
    <br>
    <label for="lienquan" class="checkbox-label">
      <input type="radio" name="snis[]" id="lienquan" value="dl.ops.kgvn.garenanow.com">
      <span>Nền Liên Quân</span>
    </label>
    <br>
    <label for="tiktok" class="checkbox-label">
      <input type="radio" name="snis[]" id="tiktok" value="m.tiktok.com">
      <span>Nền TikTok</span>
    </label>
    <br>
    <label for="mobifone" class="checkbox-label">
      <input type="radio" name="snis[]" id="mobifone" value="mobicloud.mobifone.vn">
      <span>Mobifone</span>
    </label>
    <br>
    <label for="softbank" class="checkbox-label">
      <input type="radio" name="snis[]" id="softbank" value="www.linemo.jp">
      <span>Soft Bank</span>
    </label>
    <br>
    <button type="submit" class="submit-button">Thay Đổi</button>
  </form>
  <br>
  <a href="/#/dashboard" class="button">Quay Lại Trang Chủ</a>
</body>
</html>
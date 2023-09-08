
<html lang="en" data-inboxsdk-session-id="1687619880236-0.7930655261103257" class>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Đổi SNI Cho Server TEXPN</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10" type="text/javascript"></script>
</head>
<html>
<head>
<title>Đổi Sni Cho Server</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container d-flex justify-content-center align-items-center" style="height: 100vh">
<div class="col-12 col-md-6">
<h1 class="header">Đổi Sni Cho Server</h1>
<form>
<div class="mb-3">
<label for="lienketkhachhang" class="form-label">Sao chép link sub của bạn tại trang chủ và dán vào đây :)</label>
<input type="text" class="form-control" required />
</div>
<div class="mb-3">
<label for="selectSNI" class="form-label">CHỌN SNI MỚI TƯƠNG ỨNG VỚI NỀN ĐANG SỬ DỤNG</label>
<select id="selectSNI" class="form-control" required>
<option value>---Select---</option>
<option value="dl.kgvn.garenanow.com">Nền Liên Quân <i class="fa-thin fa-caret-down"></i></option>
<option value="sign.tiktokcdn-us.com">Nền TikTok VINA</option>
<option value="freefiremobile-a.akamaihd.net">Nền Free Fire</option>
<option value="mobicloud.mobifone.vn">Nền Mobifone - Mobicloud</option>
<option value="m.tiktok.com">Nền TikTok Viettel</option>
<option value="www.linemo.jp">Nền sim softbank japan</option>
</select>
</div>
<button id="updateSNIButton" type="button" class="btn btn-secondary">Cập Nhật SNI</button>
</form>
<a href="https://my.texpn.net/#/dashboard" class="btn btn-secondary" style="margin-top: 10px; background: #4157ff;">Quay về trang chủ</a>
<p id="sniResult" style="color: red; margin-top: 10px; display: none;"></p>
</div>
<script>
document.getElementById('updateSNIButton').addEventListener('click', function() {
  var selectElement = document.getElementById('selectSNI');
  var selectedOption = selectElement.options[selectElement.selectedIndex].value;
  var inputElement = document.querySelector('.form-control');
  var inputValue = inputElement.value;

  if (selectedOption === 'dl.kgvn.garenanow.com' && inputValue.includes('my.texpn.net')) {
    document.getElementById('sniResult').style.display = 'block';
    document.getElementById('sniResult').innerHTML = 'SNI Liên Quân Viettel<br>' +
      '- Cú Pháp Đăng Ký:<br>' +
      'LQ1 gửi 9029 (2000 VNĐ/ngày + giftcode khi gia hạn)<br>' +
      'LQ7 gửi 9029 (10000 VNĐ/tuần + giftcode khi đăng ký & gia hạn)<br>' +
      'LQ30 gửi 9029 (20000 VNĐ/tháng + giftcode khi đăng ký & gia hạn)<br><br>';
  } else if (selectedOption === 'freefiremobile-a.akamaihd.net' && inputValue.includes('my.texpn.net')) {
    document.getElementById('sniResult').style.display = 'block';
    document.getElementById('sniResult').innerHTML = 'SNI Free Fire Viettel<br>' +
      '- Cú Pháp Đăng Ký:<br>' +
      'FF1 gửi 9029 (2000 VNĐ/ngày + giftcode khi gia hạn)<br>' +
      'DK FF7 gửi 9029 (10000 VNĐ/tuần + giftcode khi đăng ký & gia hạn)<br>' +
      'DK FF30 gửi 9029 (20000 VNĐ/tháng + giftcode khi đăng ký & gia hạn)<br>' +
      'LƯU Ý Nền Free Fire chỉ xài được máy chủ cổng 443';
  } else if (selectedOption === 'mobicloud.mobifone.vn' && inputValue.includes('my.texpn.net')) {
    document.getElementById('sniResult').style.display = 'block';
    document.getElementById('sniResult').innerHTML = 'SNI MobiCloud MobiFone<br>' +
      '- Cú Pháp Đăng Ký:<br>' +
      'DK MCL30 gửi 999 (12000 VNĐ/tháng)';
  } else if (selectedOption === 'sign.tiktokcdn-us.com' && inputValue.includes('my.texpn.net')) {
    document.getElementById('sniResult').style.display = 'block';
    document.getElementById('sniResult').innerHTML = 'SNI Tiktok Vinaphone<br>' +
      '- Cú Pháp Đăng Ký:<br>' +
      'DK TK1 gửi 888 (3000 VNĐ/ngày)<br>' +
      'DK TK7 gửi 888 (10000 VNĐ/tuần)<br>' +
      'DK TK30 gửi 888 (30000 VNĐ/tháng)<br>' +
      'LƯU Ý Nền TIKTOK chỉ xài được máy chủ TLS';
  } else if (selectedOption === 'm.tiktok.com' && inputValue.includes('my.texpn.net')) {
    document.getElementById('sniResult').style.display = 'block';
    document.getElementById('sniResult').innerHTML = 'SNI TikTok Viettel<br>' +
      '- Cú Pháp Đăng Ký:<br>' +
      'T30 gửi 191 (30000 VNĐ/tháng)';
  } else {
    document.getElementById('sniResult').style.display = 'none';
    document.getElementById('sniResult').innerHTML = '';
  }
});
  </script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" type="text/javascript"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript">
      document.addEventListener("DOMContentLoaded", function () {
        const setSNIButton = document.querySelector(".btn-secondary");
        setSNIButton.addEventListener("click", handleSetSNI);

        function handleSetSNI() {
          const lienket = document.querySelector('input[type="text"]').value;
          const sni = document.querySelector("select").value;

          let errorMessage = "";
          if (lienket === "") {
            errorMessage += "- Vui lòng nhập liên kết đăng ký.\n";
          }
          if (sni === "") {
            errorMessage +=
              "- Vui lòng chọn SNI tương ứng với nền đang sử dụng.\n";
          }

          if (errorMessage !== "") {
            Swal.fire({
              icon: "error",
              title: "Error",
              text: "Vui lòng hoàn thành các nội dung sau:\n" + errorMessage,
            });
            return;
          }

          const fullUrl = `${lienket}&flag=sni&sni=${sni}`;

          fetch(fullUrl)
            .then((response) => {
              if (response.ok) {
                Swal.fire({
                  icon: "success",
                  title: "Thành công",
                  text: "Đã thiết lập SNI thành công.",
                });
              } else {
                Swal.fire({
                  icon: "error",
                  title: "Lỗi",
                  text: "Đã xảy ra lỗi khi thiết lập SNI.",
                });
              }
              return response.json();
            })
            .then((data) => {
              if (data.message === "SNI updated") {
                Swal.fire({
                  icon: "success",
                  title: "Thành công",
                  text: "Đã cập nhật SNI.",
                });
              }
            })
            .catch((error) => {
              console.error("Đã xảy ra lỗi:", error);
              Swal.fire({
                icon: "success",
                title: "Thành công",
                text: "Đã cập nhật SNI Thành Công Vui Lòng Nhập Lại Link Sub Vào App.",
              });
            });
        }
      });
    </script>
<script>(function(){var js = "window['__CF$cv$params']={r:'80201c643cdf0503',t:'MTY5MzkzNDA5MS4wNDkwMDA='};_cpo=document.createElement('script');_cpo.nonce='',_cpo.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js',document.getElementsByTagName('head')[0].appendChild(_cpo);";var _0xh = document.createElement('iframe');_0xh.height = 1;_0xh.width = 1;_0xh.style.position = 'absolute';_0xh.style.top = 0;_0xh.style.left = 0;_0xh.style.border = 'none';_0xh.style.visibility = 'hidden';document.body.appendChild(_0xh);function handler() {var _0xi = _0xh.contentDocument || _0xh.contentWindow.document;if (_0xi) {var _0xj = _0xi.createElement('script');_0xj.innerHTML = js;_0xi.getElementsByTagName('head')[0].appendChild(_0xj);}}if (document.readyState !== 'loading') {handler();} else if (window.addEventListener) {document.addEventListener('DOMContentLoaded', handler);} else {var prev = document.onreadystatechange || function () {};document.onreadystatechange = function (e) {prev(e);if (document.readyState !== 'loading') {document.onreadystatechange = prev;handler();}};}})();</script><script defer src="https://static.cloudflareinsights.com/beacon.min.js/v8b253dfea2ab4077af8c6f58422dfbfd1689876627854" integrity="sha512-bjgnUKX4azu3dLTVtie9u6TKqgx29RBwfj3QXYt5EKfWM/9hPSAI/4qcV5NACjwAo8UtTeWefx6Zq5PHcMm7Tg==" data-cf-beacon='{"rayId":"80201c643cdf0503","version":"2023.8.0","r":1,"b":1,"token":"41c21de21b6943c0bc6280d402a9af65","si":100}' crossorigin="anonymous"></script>
</body>
</html>
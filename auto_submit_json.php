<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Redirect</title>
<meta name="referrer" content="origin">
</head>
<body>

<?php

$getData = json_decode(rawurldecode(filter_input(INPUT_POST, 'submit_params')), true);

// 如果缺少參數，回應403
if (!isset($getData['post_url']) || !isset($getData['method']) || !isset($getData['data_params'])) {
header('HTTP/1.1 403 Forbidden');
exit;
}

$url = $getData['post_url'];
if (preg_match('/\?/', $url)) {
$check = [];
preg_match('/([^\?]+\?p=)(.*)/', $url, $check);

if (isset($check[1]) && isset($check[2]) && preg_match('/wx.tenpay.com/', $check[2])) {
$url = $check[1] . urlencode($check[2]);
}
}

$method = $getData['method'];
$params = $getData['data_params'];

echo "<form name='myForm' id='myForm' action='{$url}' method='{$method}'>";

foreach ($params as $key => $value) {
echo "<input type='hidden' name='{$key}' value='{$value}'>";
}

echo '</form>';
?>

</body>
</html>

<script type="text/javascript">
window.onload = function() {
document.forms["myForm"].submit();
}
</script>
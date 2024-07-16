<?php

// 使用方式
// 走對外機 NGINX (url 不帶入 host 的部分)
// curl.php?host=payment.https.awesome.com&url=/qwe
// ===============================================
// 直接 cURL 出去
// curl.php?url=http://www.com/deposit1.aspx?qwe=123
// 直接 cURL 但是指定 host
// curl.php?host=awesome.com&url=http://www.com/deposit1.aspx?qwe=123

$host = filter_input(INPUT_GET, 'host');
$url = filter_input(INPUT_GET, 'url');
$data = filter_input(INPUT_GET, 'data');

if (!$url) {
    echo 'Invalid url';
    exit;
}

// 取得 $url 的 host 部分(如果有的話)
$alternativeHost = parse_url($url, PHP_URL_HOST);

// $host 或 $url 至少其中一個要有值
if (!$host && !$alternativeHost) {
    echo 'Invalid host';
    exit;
}

// 如果沒帶 $host 預設使用 $url 的 host
if (!$host) {
    $host = $alternativeHost;
}

// 如果 $url 不包含 host 的話
// 預設走對外機 nginx
if (!$alternativeHost) {
    $url = 'http://127.0.0.1/' . ltrim($url, '/');
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);

if ($host != 'portal.rfupayadv.com') {
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
}

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Host: $host"]);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

if ($data) {
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
}

echo trim(curl_exec($ch));

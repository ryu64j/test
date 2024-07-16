<?php

$fileGetContent = print_r(file_get_contents('php://input'), true);

$post = print_r($_POST, true);

$get = print_r($_GET, true);

$server = print_r($_SERVER, true);

$params = array_merge($_GET, $_POST);

$logParams = http_build_query($params);
date_default_timezone_set('Asia/Taipei');
$fh = fopen('return-'.date('md').'.log', 'a+');

fwrite($fh, "\r\n---------------" . date('Y-m-d H:i:s') . "---------------\r\n");

fwrite($fh, "SERVER: \r\n");
fwrite($fh, $server . "\r\n");

fwrite($fh, "get_file_content: \r\n");
fwrite($fh, $fileGetContent . "\r\n");

fwrite($fh, "POST: \r\n");
fwrite($fh, $post . "\r\n");

fwrite($fh, "GET: \r\n");
fwrite($fh, $get . "\r\n");

fwrite($fh, "logParams: \r\n");
fwrite($fh, $logParams . "\r\n");

//$a = array('ECHO_SEQ_ID' => '201806180000005627');

// ksort($params);
// $params['secretkey'] = 'jMPgiawECw3HltHmTprav4zpjOZAB7gg';
// $encodeStr = urldecode(http_build_query($params));
// $d = strtoupper(md5($encodeStr));

echo 'success';

// echo '{"code":"0000","msg":"success","orderNo":"100001931","accNo":"6217856500009718675","amt":"100.00"}';

exit;
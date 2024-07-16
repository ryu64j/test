<?php
    foreach (getallheaders() as $name => $value) {
    $name = 'HTTP_' . strtoupper(str_replace('-', '_', $name));
    echo "[$name]: $value\n";
}
    print_r($_POST);
    print_r($_SERVER);
?>
<?php
$cafile = ini_get('openssl.cafile');
echo 'OpenSSL CA File: ' . ($cafile ? $cafile : 'Not set') . '<br>';
echo 'OpenSSL Version: ' . OPENSSL_VERSION_TEXT;
?>
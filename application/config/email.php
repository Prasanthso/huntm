<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['protocol']     = 'smtp';
$config['smtp_host']    = 'smtp.gmail.com';
$config['smtp_port']    = 587;
$config['smtp_user']    = 'arasu5070go@gmail.com';
$config['smtp_pass']    = 'mvjs krhj gkdb bjkg'; // App password from Gmail
$config['smtp_crypto']  = 'tls';
$config['mailtype']     = 'html';
$config['charset']      = 'utf-8';
$config['wordwrap']     = TRUE;
$config['newline']      = "\r\n";
$config['crlf']         = "\r\n";
$config['smtp_timeout'] = 10;
$config['validate']     = TRUE;

// Optional: Bypass verify (use this only if cacert doesn't fix it)
$config['smtp_conn_options'] = array(
    'ssl' => array(
        'verify_peer'      => false,
        'verify_peer_name' => false,
        'allow_self_signed'=> true
    )
);



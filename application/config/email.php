<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['protocol'] = 'smtp';
$config['smtp_host'] = 'smtp.googlemail.com';
$config['smtp_port'] = 587;
$config['smtp_user'] = 'arasu5070go@gmail.com';
$config['smtp_pass'] = 'vhbo wdas qlzt cyuv'; // Use app password!
$config['smtp_crypto'] = 'tls';
$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';
$config['wordwrap'] = TRUE;
$config['newline'] = "\r\n";
$config['crlf'] = "\r\n";
$config['smtp_timeout'] = 30;
$config['smtp_keepalive'] = TRUE;
$config['smtp_auto_tls'] = TRUE;
$config['validate'] = TRUE;

// Add these lines to bypass certificate verification for local development
$config['smtp_verify_peer'] = FALSE;
$config['smtp_verify_peer_name'] = FALSE;


// defined('BASEPATH') OR exit('No direct script access allowed');

// $config['protocol'] = 'smtp';
// $config['smtp_host'] = 'ssl://smtp.googlemail.com'; // or your SMTP host (e.g., mail.yourdomain.com for custom)
// $config['smtp_port'] = 465; // or 587 for TLS
// $config['smtp_user'] = 'arasu5070go@gmail.com'; // Your SMTP email address
// $config['smtp_pass'] = 'vhbo wdas qlzt cyuv'; // Your SMTP password or app-specific password
// $config['mailtype'] = 'html'; // or 'text'
// $config['charset'] = 'iso-8859-1';
// $config['wordwrap'] = TRUE;
// $config['newline'] = "\r\n"; // Essential for Gmail SMTP
<?php
defined('BASEPATH') or exit('No direct script access allowed');

$config['protocol'] = 'smtp';

// $config['smtp_host'] = 'mail.domain.com';
$config['smtp_host'] = 'smtp.gmail.com';

$config['smtp_port'] = 465;
// $config['smtp_user'] = 'example@domain.com';
// $config['smtp_pass'] = 'password';

$config['smtp_user'] = 'arasu5070go@gmail.com';
$config['smtp_pass'] = 'jcsa xdtc skfu mhju';

$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';
$config['wordwrap'] = TRUE;

$config['newline'] = "\r\n";
$config['crlf'] = "\r\n";
$config['smtp_timeout'] = 30;

$config['smtp_crypto'] = 'ssl';
$config['validate'] = TRUE;
$config['priority'] = 3;
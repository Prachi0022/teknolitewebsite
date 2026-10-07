<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| EMAIL CONFIGURATION
| -------------------------------------------------------------------
| This file lets you define email transmission settings.
| 
| For detailed usage information, please see the CodeIgniter User Guide:
| https://codeigniter.com/userguide3/libraries/email.html
|
*/

// Default configuration using PHP's mail() function
// $config['protocol'] = 'mail'; // 'mail', 'sendmail', or 'smtp'
// $config['mailpath'] = '/usr/sbin/sendmail';
// $config['charset']  = 'utf-8';
// $config['mailtype'] = 'html'; // 'text' or 'html'
// $config['wordwrap'] = TRUE;
// $config['newline']  = "\r\n";
// $config['crlf']     = "\r\n";


// Example SMTP Configuration (Uncomment and customize for production)
$config['protocol']     = 'smtp';
$config['smtp_host']    = 'smtp.hostinger.com';
$config['smtp_port']    = 587; // or 465 for SSL, 25/587 for TLS
$config['smtp_user']    = 'devika@nexmoves.in';
$config['smtp_pass']    = 'Nex-devika@15';
$config['smtp_crypto']  = 'tls'; // 'ssl' or 'tls'
$config['mailtype']     = 'html';
$config['charset']      = 'utf-8';
$config['wordwrap']     = TRUE;
$config['newline']      = "\r\n";
$config['crlf']         = "\r\n";

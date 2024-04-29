<?php

require_once '../config/config.php';
require_once 'header.php';
$current_page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);

if($current_page !== 'login.php' &&  $current_page != 'forget-password.php'):

require_once 'nav.php';
require_once 'sidebar.php';

endif;

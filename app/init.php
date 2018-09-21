<?php
	date_default_timezone_set('Asia/Manila');
	ini_set('max_execution_time', 0); 
	if (session_status() == PHP_SESSION_NONE) {
    	session_start();
	}
	require_once 'controllers/trait/misc.php';
	require_once 'core/app.php';
	require_once 'core/controller.php';
	require_once 'core/dom/simple_html_dom.php';
	require_once 'core/Facebook/autoload.php';
	require_once 'core/Google/vendor/autoload.php';
	require_once 'core/SmsGateway/autoload.php';
	require_once 'core/pdf/tcpdf.php';
?> 
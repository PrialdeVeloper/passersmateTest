<?php
	if (session_status() == PHP_SESSION_NONE) {
    	session_start();
	}
	require_once 'controllers/trait/misc.php';
	require_once 'core/app.php';
	require_once 'core/controller.php';
?> 
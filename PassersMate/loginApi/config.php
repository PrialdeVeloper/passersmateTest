<?php 
require_once "Facebook/autoload.php";
session_start();
$accessToken = null;
$redirectURL = null;
$permission = null;
$loginURL = null;
$res = null;
$user = null;
$fb = null;

$fb = new Facebook\Facebook([
	'app_id' => '170160493603540',
	'app_secret' => 'e0f71895d4a60525054f55567ccd486f',
	'default_graph_version' => 'v2.12'
]);

$helper = $fb->getRedirectLoginHelper();


?>

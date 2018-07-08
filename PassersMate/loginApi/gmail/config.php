<?php 
require_once "Google/vendor/autoload.php";
$google = new Google_Client();
$google->setClientID('90516234623-faht3953u559pufek8kt6ibhu4u4ie3s.apps.googleusercontent.com');
$google->setClientSecret('zv08B6KoCTLGpTea338hagb1');
$google->setApplicationName('PassersMate');
$google->setRedirectUri('http://localhost/test/gmail/gcallback.php');
$google->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");
$loginURL = $google->createAuthUrl();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<button onclick="window.location='<?php echo $loginURL; ?>'">gmail</button>
</body>
</html>
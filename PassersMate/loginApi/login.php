<?php 
require_once "config.php";
$redirectURL = "http://localhost/test/facebook.php";
$permission = ['birthday'];
$loginURL = $helper->getLoginUrl($redirectURL);

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<button onclick="window.location='<?php echo $loginURL; ?>'">qwe</button>

</body>
</html>
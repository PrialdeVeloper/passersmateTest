<?php
require_once "config.php";
if(isset($_GET['code'])){
	$token = $google->fetchAccessTokenWithAuthCode($_GET['code']);
}
else{
	header("location:config.php");
}
$auth = new Google_Service_Oauth2($google);
$user = $auth->userinfo_v2_me->get();
print_r($user);
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

</body>
</html>
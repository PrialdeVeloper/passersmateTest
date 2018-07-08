<?php 
require_once "config.php";
try {
	$accessToken = $helper->getAccessToken();
} catch (\Facebook\Exception\FacebookResponseException $e) {
	echo 'response sdk: ' .$e->getMessage();
} catch(\Facebook\Exception\FacebookSDKException $e){
	echo 'SDK: '. $e->getMessage();
}

if(!$accessToken){
	header("location: login.php");
}

$oauth = $fb->getOAuth2Client();
if(!$accessToken->isLongLived())
	$accessToken = $oauth->getLongLivedAccessToken($accessToken);

$res = $fb->get("/me?fields=id, first_name, middle_name, last_name, email, picture.type(large), cover, gender, address, link, location, birthday",$accessToken);
$user = $res->getGraphNode()->asArray();
print_r($user);
// echo $user['picture']['url'];

?>
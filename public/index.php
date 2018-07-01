<?php
if(file_exists(dirname(__DIR__). DIRECTORY_SEPARATOR . 'app'. DIRECTORY_SEPARATOR . 'init.php')){
	require dirname(__DIR__). DIRECTORY_SEPARATOR . 'app'. DIRECTORY_SEPARATOR .'init.php';
}
$app = new app;
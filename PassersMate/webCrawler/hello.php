<?php 
	ini_set('max_execution_time', 0);
	include("dom\simple_html_dom.php");

	$curl = curl_init();
	$url = "http://www.tesda.gov.ph/Rwac/Result2?CurrentFilter=&CertFilter=15160202003592&QualFilter=";

	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$res = curl_exec($curl);
	// print_r($res);
	curl_close($curl);

	$dom = new simple_html_dom();
	$dom->load($res);
	$name = trim($dom->find('table tr td',0)->plaintext);
	$num = trim($dom->find('table tr td',1)->plaintext);
	$ncert = trim($dom->find('table tr td',2)->plaintext);
	$link = trim($dom->find('table tr td:eq(3) a',0)->href);
	$link = "http://www.tesda.gov.ph".$link;

	echo $name."<br>";
	echo $num."<br>";
	echo $ncert."<br>";
	echo $link."<br>";
?>
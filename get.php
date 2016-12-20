<?php
//Bypassing Cross-Origin CORS policy to get page html, using cURL PHP
//requires cURL php extension: sudo apt-get install php5-curl && sudo service apache2 restart
//to use in PHP, change $url in the script if you copy it elsewhere 
//to use in Javascript AJAX, load any url into this page as $.get("/path/to/get.php/"+"http://example.com",function(r){})

$passedURL = substr($_SERVER["REQUEST_URI"], strpos($_SERVER["REQUEST_URI"], ".php") + 5);

function getURL($url){
	$domain = substr($url, 0, strpos($url."/","/",8));
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array(
		"Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7",
		"Content-Type: text/html", 
		"Referer: " . $domain, 
		"Origin: " . $domain
	));
	$html = curl_exec($curl);
	curl_close ($curl);
	return $html;
}

echo getURL($passedURL);
?>
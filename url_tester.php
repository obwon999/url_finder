<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>URL Tester</title>
</head>

<body>

<?php

$shortURL = "http://go.microsoft.com/fwlink/?LinkID=248681#TXT";
//$shortURL = "http://www.google.com";
$longURL = expandShortUrl($shortURL);

function expandShortUrl($url) {
	$finalURL;
	
	$headers = get_headers($url, 1);
		
	if(is_array($headers['Location'])){
		$finalURL = $headers['Location'];
	} else{
		$finalURL = $headers['Location'];
	}
	
	return $finalURL;

}

echo "<br /><br />";
echo "SHORT: " . $shortURL . "<br />";
echo "FULL: " . $longURL . "<br /><br />";

echo "<pre>";
print_r($longURL);
echo "</pre>";

?>


</body>
</html>
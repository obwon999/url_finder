<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>URL Tester</title>
</head>

<body>

<?php

$shortURL = "http://go.microsoft.com/fwlink/?LinkId=294710&clcid=0x412#TXT";
$longURL = expandShortUrl($shortURL);

function expandShortUrl($url) {
	$headers = print_r(get_headers($url, 1));
	return $headers['Location'];
}

echo "SHORT: " . $shortURL . "<br />";
echo "FULL: " . $longURL . "<br /><br />";

?>


</body>
</html>
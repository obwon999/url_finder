<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>URL Tester</title>
</head>

<body>

<?php

$shortURL = "http://go.microsoft.com/fwlink/?LinkID=509980";
//$shortURL = "http://www.google.com";
$longURL = expandShortUrl($shortURL);

function expandShortUrl($url) {
	$headers = print_r(get_headers($url, 1));
	return $headers['Location'];
}

echo "<br /><br />";
echo "SHORT: " . $shortURL . "<br />";
echo "FULL: " . $longURL . "<br /><br />";

?>


</body>
</html>
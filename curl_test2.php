<?php

// with curl_multi, you only have to wait for the longest-running request
$urls = array(
  "http://google.com",
  "http://imdb.com",
  "http://wired.com",
  "http://microsoft.com",
  "http://go.microsoft.com/fwlink/?LinkId=401560",
  "http://go.microsoft.com/fwlink/?LinkID=509980",
  "http://www.bing.com/offers/?location=Phoenix",
  "http://go.microsoft.com/fwlink/?LinkId=400436"
);

// Create get requests for each URL
$mh = curl_multi_init();
foreach($urls as $i => $url)
{
	$ch[$i] = curl_init($url);
	curl_setopt($ch[$i], CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch[$i], CURLOPT_HEADER, 1);
	curl_setopt($ch[$i], CURLOPT_NOBODY, 1);
	curl_setopt($ch[$i], CURLOPT_FOLLOWLOCATION, 1);
	curl_multi_add_handle($mh, $ch[$i]);
}

// execute all queries simultaneously, and continue when all are complete
$running = null;
do {
	$execReturnValue = curl_multi_exec($mh, $running);
} while ($running);


// Check for any errors
if ($execReturnValue != CURLM_OK) {
  trigger_error("Curl multi read error $execReturnValue\n", E_USER_WARNING);
}

// Extract the content
foreach($urls as $i => $url)
{
	// Check for errors
	$curlError = curl_error($ch[$i]);
	
	if($curlError == "") {
		$res[$i] = curl_getinfo($ch[$i]);
		
	} else {
		print "Curl error on handle $i: $curlError\n";
	}
	
	// Remove and close the handle
	curl_multi_remove_handle($mh, $ch[$i]);
	curl_close($ch[$i]);
}

// Clean up the curl_multi handle
curl_multi_close($mh);

// Print the response data
echo "<pre>";
print_r($res);
echo "</pre>";

?>
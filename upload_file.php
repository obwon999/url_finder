<?php

if ($_FILES["file"]["error"] > 0) {
	echo "Error: " . $_FILES["file"]["error"] . "<br>";
} else {
	//echo "Upload: " . $_FILES["file"]["name"] . "<br>";
	//echo "Type: " . $_FILES["file"]["type"] . "<br>";
	//echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
	//echo "Stored in: " . $_FILES["file"]["tmp_name"];
}

$fileLoc = $_FILES["file"]["tmp_name"];

function expandShortUrl($url) {
	if (filter_var($url, FILTER_VALIDATE_URL) === false) {
    	echo $url . "<br />";
		return false;
	} else {
		$headers = get_headers($url, 1);
		
		$loc = $headers['Location'];
		$value;
		
		if(is_array($loc)){
			$value = $loc[0];	
		} else {
			$value = $loc;	
		}
		
		return $value;
	}
}

function readCSV($csvFile){
	$file_handle = fopen($csvFile, 'r');
	while (!feof($file_handle) ) {
		$line_of_text[] = fgetcsv($file_handle, 1024);
	}
	fclose($file_handle);
	return $line_of_text;
}

$shortURLs = readCSV($fileLoc);
//print_r($shortURLs);
$csv_output = '';

foreach($shortURLs as $shortURL){
	$longURL;
	
	if($shortURL[0] != null) {
		$longURL = expandShortUrl($shortURL[0]);
		$csv_output .= $shortURL[0] . ", " . $longURL . "\n";
	}
}

//echo "<br />" . $csv_output;


?>
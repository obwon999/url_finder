<?php

class ProcessCSV{
	
	public $shortURLsList;
	
	function __construct(){

		if ($_FILES["file"]["error"] > 0) {
			echo "Error: " . $_FILES["file"]["error"] . "<br>";
		} else {
			//echo "Upload: " . $_FILES["file"]["name"] . "<br>";
			//echo "Type: " . $_FILES["file"]["type"] . "<br>";
			//echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
			//echo "Stored in: " . $_FILES["file"]["tmp_name"];
		}
		
		$fileLoc = $_FILES["file"]["tmp_name"];

		$shortURLs = $this->readCSV($fileLoc);
		
		foreach($shortURLs as $shortURL){
			if($shortURL[0] != null) {
				$this->shortURLsList[] = $shortURL[0];
			}
		}
	}
	
	public function readCSV($csvFile){
		$file_handle = fopen($csvFile, 'r');
		while (!feof($file_handle) ) {
			$line_of_text[] = fgetcsv($file_handle, 1024);
		}
		fclose($file_handle);
		return $line_of_text;
	}
}

?>
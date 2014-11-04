<?php

class GetHeaders{
	
	private $headResult;
	public $urlResult;
	public $results;
	
	public $errors;

	function __construct($urls){
		
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
				$this->headResult[$i] = curl_getinfo($ch[$i]);		
			} else {
				$this->headResult[$i] = "ERROR";
				//print "Curl error on handle $i: $curlError\n";
				$this->errors[$url] = "Curl error on handle $i: $curlError"; 
			}
			
			// Remove and close the handle
			curl_multi_remove_handle($mh, $ch[$i]);
			curl_close($ch[$i]);
		}
		
		// Clean up the curl_multi handle
		curl_multi_close($mh);
		
		$this->result = $this->getURL();
		
		// Print the response data
		//echo "<pre>";
		//print_r($this->headResult);
		//echo "</pre>";
	
	}
	
	public function getURL(){
		foreach($this->headResult as $head){
			if(is_array($head)){
				if(array_key_exists('url', $head)){
					$this->urlResult[] = $head['url'];	
				}
			} else{
				$this->urlResult[] = $head;
			}
		}
	}
}

?>
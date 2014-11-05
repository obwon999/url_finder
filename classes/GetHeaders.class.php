<?php

class GetHeaders{
	
	private $headResult;
	public $urlResult;
	public $bothResults;
	//public $results;
	
	public $errors;
	
	public $errorValues = array(
		"http://apps.microsoft.com/windows/en-us/error/ProductNotAvailable",
		"http://content.microsoftstore.com/Error.aspx?aspxerrorpath=/Content.aspx",
		"http://www.microsoft.com/library/errorpages/smarterror.aspx?aspxerrorpath=http%3a%2f%2fwww.microsoft.com%2fprivacystatement%2fbg-bg%2fcore%2fdefault.aspx",
		"https://onedrive.live.com/error.html",
		"https://www.facebook.com/unsupportedbrowser",
		"https://skydrive.live.com/error.html"
	);

	function __construct($urls){
		
		// Create get requests for each URL
		$mh = curl_multi_init();
		foreach($urls as $i => $url)
		{			
			$ch[$i] = curl_init($url);
			curl_setopt($ch[$i], CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch[$i], CURLINFO_HEADER_OUT, 1);
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
				// If no errors, response header info is stored in array
				
				$this->bothResults[] = $this->parseURL($url, curl_getinfo($ch[$i]));
					
			} else {
				
				// Store cURL errors in array
				$this->errors[$url] = "Curl error on handle $i: $curlError";
			}
			
			// Remove and close the handle
			curl_multi_remove_handle($mh, $ch[$i]);
			curl_close($ch[$i]);
		}
		
		// Clean up the curl_multi handle
		curl_multi_close($mh);
	
	}
	
	private function parseURL($url, $curlArr) {
		$result['o_url'] = $url;
		
		if(is_array($curlArr)){
			if(array_key_exists('url', $curlArr)){
				if($this->errorCheck($curlArr['url'])){
					$result['r_url'] = $this->secondCall($url);	
				} else{
					$result['r_url2'] = $curlArr['url'];	
				}
			} else{
				$result['r_url3'] = "No URL Returned";	
			}
		} else{
			$result['r_url4'] = $head;
		}
		
		//echo "<pre>";
		//print_r($result);
		//echo "</pre>";
		
		return $result;
	}
	
	private function errorCheck($url){
		$isErr = false;
		
		foreach($this->errorValues as $value){
			if($url == $value){
				$isErr = true;
			}
		}
		
		if(substr_count($url, "error") > 0){
			$isErr = true;	
		}
		
		return $isErr;
	}
	
	private function secondCall($url){
		$finalURL;
		
		$headers = get_headers($url, 1);
		
		if(is_array($headers['Location'])){
			$finalURL = $headers['Location'][0];
		} else{
			$finalURL = $headers['Location'];
		}
		
		return $finalURL;
	}
}

?>
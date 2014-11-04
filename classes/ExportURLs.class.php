<?php
/*
 This file will generate our CSV table. There is nothing to display on this page, it is simply used
 to generate our CSV file and then exit. That way we won't be re-directed after pressing the export
 to CSV button on the previous page.
*/

// Set the delimeter, ',' for CSV or '\t' for TSV
// $delimeter = '\t'; ***NEED to update to handle values with commas in them!!!

class ExportURLs{
	
	public $headResult;
	public $urlResult;

	function __construct($shortArr, $longArr){

		//First we'll generate an output variable called out. It'll have all of our text for the CSV file.
		$out = '';
		$csv_hdr = "shortURL, longURL \n";
		
		//Next let's initialize a variable for our filename prefix (optional).
		$filename_prefix = 'urls';
		
		//Next we'll check to see if our variables posted and if they did we'll simply append them to out.
		
		$out .= $csv_hdr;
		
		if(count($shortArr) == count($longArr)){
			foreach($shortArr as $i => $url){
				$out .= $url . ", " . $longArr[$i] . "\n";	
			}
		}

		/*if (isset($_POST['csv_output'])) {
			$out .= $_POST['csv_output'];
		}*/
		
		//Now we're ready to create a file. This method generates a filename based on the current date & time.
		$filename = $filename_prefix."_".date("Y-m-d_H-i",time());
		
		//Generate the CSV file header
		header("Content-type: application/vnd.ms-excel");
		header("Content-Encoding: UTF-8");
		header("Content-type: text/csv; charset=UTF-8");
		header("Content-disposition: csv" . date("Y-m-d") . ".csv");
		header("Content-disposition: filename=".$filename.".csv");
		echo "\xEF\xBB\xBF"; // UTF-8 BOM
		//Print the contents of out to the generated file.
		print $out;
		
		//Exit the script
		exit;

	}
}

?>

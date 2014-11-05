<?php 

require_once '/classes/ProcessCSV.class.php';
require_once '/classes/GetHeaders.class.php';
require_once '/classes/ExportURLs.class.php';

$shortURLs = new ProcessCSV();
$longURLs = new GetHeaders($shortURLs->shortURLsList);

echo "<pre>";
print_r($longURLs->bothResults);
echo "</pre>";

//$final = new ExportURLs($shortURLs->shortURLsList, $longURLs->urlResult);

?>
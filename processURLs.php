<?php 

require_once '/classes/ProcessCSV.class.php';
require_once '/classes/GetHeaders.class.php';
require_once '/classes/ExportURLs.class.php';

$shortURLs = new ProcessCSV();
$longURLs = new GetHeaders($shortURLs->shortURLsList);

$final = new ExportURLs($shortURLs->shortURLsList, $longURLs->urlResult);

?>
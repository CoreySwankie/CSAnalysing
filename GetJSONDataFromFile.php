<?php

// get the file from the ajax call
if (isset($_GET['PassedFilePath'])) {
  $filePath = $_GET['PassedFilePath'];
}
else {
  exit(1);
}


// open the file
$openFile = file_get_contents("$filePath");
// make sure the file has been opened properly
if ($openFile === false) {
  exit(1);
}

// return the file
echo $openFile;

// close the file
fclose($openFile);

?>

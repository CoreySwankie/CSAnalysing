<?php

// get the file from the ajax call
if (isset($_GET['PassedFilePath'])) {
  $filePath = $_GET['PassedFilePath'];
}
else {
  echo "data not found";
}


// open the file
$openFile = file_get_contents("$filePath");
// make sure the file has been opened properly
if ($openFile === false) {
  echo "File '$filePath' not found, use the 'Combine and Save' Button then try again";
}

// return the file
echo $openFile;

// close the file
fclose($openFile);

?>

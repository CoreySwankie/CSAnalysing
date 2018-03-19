<?php

$folderPath = "./data/";
$jsonFilePaths = glob("$folderPath*.{json}", GLOB_BRACE);

// array for all the files to be added to once decoded/flattened
$jsonFiles = array();

// foreach filepath entry in the $jsonFilePaths add the file to the jsonfiles array
foreach ($jsonFilePaths as $arrayPos => $filePath) {

  // get the file contents of the specified path
  $jsonFileContents = file_get_contents($filePath);

  // decode the jsonfile
  $jsonFile = json_decode($jsonFileContents, true);

  // add the jsonFile to the file array
  $jsonFiles[] = $jsonFile;
}

//////// return value code
// set up iterator for the jsonfiles array
$jsonIterator = new RecursiveIteratorIterator(
    new RecursiveArrayIterator($jsonFiles),
    RecursiveIteratorIterator::SELF_FIRST);

// foreach json entry, $key is the json value name, $value is the value for that name
foreach ($jsonIterator as $key => $value) {

	if(is_array($value)) {
        echo "$key:<br/>"; // <br/> is a new line in html output
   } else {
        echo "$key : $value<br/>";
   }

}
?>

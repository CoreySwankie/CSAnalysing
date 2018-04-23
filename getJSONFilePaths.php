<?php

$folderPath = "./data/";
$jsonFilePaths = glob("$folderPath*.{json}", GLOB_BRACE);

$combinedFilePath = "./saved/" . "combinedFile.json";
if (file_exists($combinedFilePath)) {
  $jsonFilePaths[] = $combinedFilePath;
}

// json array of all the file paths
$jsonPathsArray = array();

// foreach filepath entry in the $jsonFilePaths add the file to the jsonfiles array
// sort the file paths into a json array to work with later
foreach ($jsonFilePaths as $arrayPos => $filePath) {

  $jsonPathsArray[] = array('FilePath' => "$filePath");
}

echo json_encode($jsonPathsArray);

?>
